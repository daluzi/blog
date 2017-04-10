<?php 
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: ../signin/index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>Blog</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet"> 
    <link href="blog.css" rel="stylesheet">
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" charset="gbk" src="ueditor.config.js"></script>
    <script type="text/javascript" charset="gbk" src="ueditor.all.js"></script>
    <script type="text/javascript" charset="gbk" src="lang/zh-cn/zh-cn.js"></script>
</head>
<body>
    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
            <a class="blog-nav-item" href="./index.php">首页</a>
            <a class="blog-nav-item" href="./newindex.php">后台管理</a>
            <a class="blog-nav-item" href="./article.php">添加文章</a>
            <?php if (isset($_SESSION['username'])) {
                echo '<span class="blog-nav-item signin">';
                echo $_SESSION['username'];
                echo '</span><a class="blog-nav-item logout" href="##">注销</a>';
            
            } else {
                header("Location: ../signin/index.php");
            }
            ?>
        </nav>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-8 blog-main">
        </div>
        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
                <h4>关于</h4>
                <p>此网页为博主发布的博客文章</p>
            </div>
        </div>
        <div id="cont" style="position: relative;left:0px;"></div>
      </div>
    </div>
    <script type="text/javascript" src="new.js"></script>
    
    <script>
        $(function() {
            $.ajax({
                url: '../php/all.php',
                success: function(res) {
                    res = JSON.parse(res);
                    if (res.length) {
                        for (var i = 0, len = res.length; i < len; i++) { 
                            var hh = $('<div class="newessay" style="margin: 100px 0px 10px;padding:10px;border: 4px double #c3bdbd;border-radius:10px; overflow:hidden"><h3>' +'文章'  + '<small> <span class="artile-num">'+ res[i].id  +'</small>: <span class="artile-title">' + res[i].name + '</span></h3><div class="artile-contt">' + res[i].content + '</div><p style="font-size:14px;">' + new Date(parseInt(res[i].time + '000')).format('yyyy-MM-dd hh:mm:ss') + '</p>' +'<button type="button" class="chgeesy">' + '修改文章' + '</button></div>')
                            $('#cont').prepend(hh);
                        }
                        $('.chgeesy').on('click', function() {
                            var title = $(this).parent().find('.artile-title').html();
                            // var contt = $(this).parent().find('.artile-contt').html();
                            var num = $(this).parent().find('.artile-num').html();
                            location.href = `./article.php?id=${num}&title=${title}`;
                            // console.log(num, title);
                        });
                    } else {
                        var hh = $('<h1>你还没有发表任何文章</h1>');
                        $('#cont').prepend(hh);
                    }
                }
            });
            $('#baocun').click(function() {
                var title = $('#name').val();
                var content = localStorage.getItem('ueditor_preference');
                if (!title.trim()) {
                    alert('请输入文章名');
                    return;
                }

                content = JSON.parse(content);
                content = content['http_localhost_clblog_blog_article_phpcontainer-drafts-data'];
                
                if (!content.trim()) {
                    alert('请输入内容');
                    return;
                }
                $.ajax({
                    url: 'http://localhost/clblog/php/upload.php',
                    type: 'POST',
                    headrs: {
                        'content-type': 'application/x-www-form-urlencoded'
                    },
                    data: {
                        content,
                        name: title,
                    },
                    success: function(res) {
                        res = JSON.parse(res);
                        if (res.status_code === 2) {
                            document.getElementById("displayey").innerHTML = "添加文章成功";
                            alert('添加文章成功');
                            location.href = './newindex.php';
                        } else {
                            document.getElementById("displayey").innerHTML = "添加文章失败";
                        }
                    },
                    fail: err => {
                        console.log(err);
                    }
                });
            });
        });
    </script>
  </body>
</html>
