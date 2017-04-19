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
    <title>后台管理首页</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet"> 
    <link href="blog.css" rel="stylesheet">
    <script type="text/javascript" src="jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="" id = 'link'/>
    <script type="text/javascript">
        var theme = localStorage.getItem('mySkin') || 'default';
        $('#link').attr('href', './style/' + theme + '.css');
    </script>
    <script type="text/javascript" src="marked.js"></script>
</head>
<body>
    <div class="blog-masthead navbar-fixed-top" style="overflow: hidden;">
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
    <div class="container" style="margin-top: 40px;">
      <div class="row">
        <div class="col-sm-8 blog-main">
        </div>
        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
                <!-- <h1 class="blog-title" id="blog-title"></h1> -->
                <h4>关于</h4>
                <p>此网页为博主发布的博客文章</p>
            </div>
        </div>
        <div id="cont" style="position: relative;left:0px;"></div>
        <div id="pages"></div>
      </div>
    </div>

    <script type="text/javascript">
        function getArticle(page = 1) {
            $.ajax({
                url: '../php/all.php?user_id=me&page=' + page,
                success: function(res) {
                    res = JSON.parse(res);
                    if (res.length) {
                        var hh = '';
                        for (var i = 0, len = res.length; i < len; i++) { 
                            hh += '<div class="newessay"><div class="alists"><h3>' +'文章'  + '<small><span style="display:none" class="artile-id">' + res[i].id + '</span> <span class="artile-num">'+ parseInt(1+parseInt(i))  +'</small>: <span class="artile-title">' + res[i].name + '</span></h3><div class="artile-contt">' + marked(res[i].content) + '</div><p style="font-size:14px;">' + new Date(parseInt(res[i].time + '000')).format('yyyy-MM-dd hh:mm:ss') + '</p></div>' +'<button class="btn btn-default chgeesy">修改文章</button><button class="btn btn-default deleteArtile">删除文章</button></div>';
                        }
                        $('#cont').html(hh);
                        
                        $('.chgeesy').on('click', function() {
                            var title = $(this).parent().find('.artile-title').html();
                            var num = $(this).parent().find('.artile-id').html();
                            location.href = `./article.php?id=${num}&title=${title}`;
                            console.log(title, num);
                        });
                        $('.deleteArtile').on('click', function() {
                            if (window.confirm('你是否确定删除该文章?')) {
                                var title = $(this).parent().find('.artile-title').html();
                                var id = $(this).parent().find('.artile-id').html();
                                $.ajax({
                                    url: '../php/delete.php',
                                    type: 'POST',
                                    data: {
                                        title,
                                        id
                                    },
                                    success: function (res) {
                                        alert('删除文章成功');
                                        location.reload();
                                    }
                                });
                            }
                        });
                    } else {
                        var hh = $('<h1>你还没有发表任何文章</h1>');
                        $('#cont').prepend(hh);
                    }
                }
            });
        }
    </script>
    <script type="text/javascript" src="new.js"></script>
    <script type="text/javascript" src="pages.js"></script>
    
    <script>
        $(function() {
            $.ajax({
                url: '../php/all.php?num=true&user_id=me',
                success: function(res) {
                    res = JSON.parse(res);
                    createPageNav({
                      $container: $("#pages"),
                        pageCount: res
                    });
                }
            });
            getArticle(1);
            $('#baocun').click(function() {
                var title = $('#name').val();
                if (!title.trim()) {
                    alert('请输入文章名');
                    return;
                }

                var content = '';
                for (var sessionName in window.localStorage) {
                    if (sessionName.match(/\d+\$article/g)) {
                        var val = window.localStorage[sessionName];
                        content = val;
                    }
                }
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
