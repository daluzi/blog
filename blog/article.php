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
                <p>此网页可以为博主发布新的博客文章</p>
            </div>
        </div>
        <div id="biaoti">
            <div>标题</div>
            <input type="text" name="name" id="name">
            <button type="button" id="baocun">发表文章</button>
            <div id="displayey" style="display: inline-block;"></div>
        </div>
        <div class="content">
            <script id="container" name="content" type="text/plain" style="display: block;">
            </script>
        </div>
      </div>
    </div>
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        localStorage.removeItem('ueditor_preference');
    </script>
    <script type="text/javascript">
    var urlObj = {};

    if (window.location.search.length > 1) {
      for (var aItKey, nKeyId = 0, aCouples = window.location.search.substr(1).split("&"); nKeyId < aCouples.length; nKeyId++) {
        aItKey = aCouples[nKeyId].split("=");
        urlObj[decodeURIComponent(aItKey[0])] = aItKey.length > 1 ? decodeURIComponent(aItKey[1]) : "";
      }
    }
    if (urlObj.id) {
        $.ajax({
            url: `../php/article.php?id=${urlObj.id}&title=${urlObj.title}`,
            success: function(res) {
                res = JSON.parse(res);
                $('#name').val(res.name);
                var contentBody = $("#ueditor_0").contents().find('body.view'); 
                contentBody.html(res.content);

                $('#baocun').on('click', function() {
                    var content = localStorage.getItem('ueditor_preference');
                    var title = $('#name').val();
                    if (title === res.name) {
                        if (!content) {
                            alert('你还没有做任何修改');
                            return;
                        }
                    }
                    if (!title.trim()) {
                        alert('请输入文章名');
                        return;
                    }
                    content = JSON.parse(content);
                    try {
                        content = content['http_localhost_clblog_blog_article_phpcontainer-drafts-data'];
                    } catch(e) {
                        content = res.content;
                    } 
                    if (!content.trim()) {
                        alert('请输入内容');
                        return;
                    }
                    $.ajax({
                        url: '../php/modify.php',
                        type: 'POST',
                        data: {
                            id: urlObj.id,
                            name: title,
                            content
                        },
                        success: function(res) {
                            res = JSON.parse(res);
                            if (res.status_code) {
                                alert('更新文章成功');
                                location.href = './newindex.php';
                            }
                        }
                    })

                })
            }
        });
    } else {
        $('#baocun').on('click', function() {
            var content = localStorage.getItem('ueditor_preference');
            var title = $('#name').val();
            
            if (!title.trim()) {
                alert('请输入文章名');
                return;
            }
            content = JSON.parse(content);
            try {
                content = content['http_localhost_clblog_blog_article_phpcontainer-drafts-data'];
            } catch(e) {
                content = '';
            } 
            if (!content.trim()) {
                alert('请输入内容');
                return;
            }
            $.ajax({
                url: '../php/upload.php',
                type: 'POST',
                data: {
                    name: title,
                    content
                },
                success: function(res) {
                    res = JSON.parse(res);
                    if (res.status_code) {
                        alert('添加文章成功');
                        location.href = './newindex.php';
                    }
                }
            })

        })
    }
    </script>

    <script type="text/javascript" src="new.js"></script>
  </body>
</html>
