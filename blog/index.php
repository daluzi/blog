<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Blog</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="blog.css" rel="stylesheet">
    

    <link rel="stylesheet" type="text/css" href="./style/default.css" id = 'link'/>
    <!-- <link rel="stylesheet" type="text/css" href="../changeColor/style/green.css" id = 'link'/> -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="index-changcolor.js"></script>
    
  </head>

  <body>

    <div class="blog-masthead changeclr">
      <div class="container">
        <nav class="blog-nav">
            <a class="blog-nav-item active" href="index.php">主页</a>
            <a class="blog-nav-item" href="newindex.php">新文章</a>
            <input type="button" data-value="default" class="targetElem" value="default"/>
            <input type="button" data-value="green" class="targetElem" value="green"/>
            <input type="button" data-value="red" class="targetElem" value="red"/>
            <input type="button" data-value="orange" class="targetElem" value="orange"/>
            <?php if (true) {
                echo '<span class="blog-nav-item signin">';
                echo $_SESSION['username'];
                echo '</span>';
            } else {
                echo '<a class="blog-nav-item signin" href="../signin/index.html">登录</a>';
            }
            ?>
            <a class="blog-nav-item signin" href="../register/register.html">注册</a>
        </nav>
      </div>
    </div>

    <div class="container changeclr">

        <div class="blog-header">
            <h1 class="blog-title" id="blog-title">The Bootstrap Blog</h1>
            <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p>
        </div>

        <div class="row">

        <div class="col-sm-8 blog-main">
            
            
            
        </div><!-- /.blog-main -->
        
        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
                <h4>关于</h4>
                <p>这是博客主页，可以查看博主发布的所有文章</p>
            </div>
        </div><!-- /.blog-sidebar -->

        </div><!-- /.row -->
        
    </div><!-- /.container -->
    <div id="cont">
    <a href="##">asdasd</a>
    </div>
    <script>
        $.ajax({
            url: '../php/all.php',
            success: function(res) {
                res = JSON.parse(res);
                // console.log(res);
                for (var i = 0, len = res.length; i < len; i++) {
                    // var a = $(`
                    //     <div>
                    //         <h1>${res[0].name}<small>${res[0].id}</small> </h1>
                    //         <div>${res[0].content}</div>
                    //         <p>${res[0].time}</p>
                    //     </div>
                    // `);
                    var hh = $('<div><h1>' + res[i].name + '<small>' + res[i].id + 
                        '</small> </h1><div>' + res[i].content + '</div><p>' + res[i].time + '</p></div>')
                    $('#cont').append(hh);
                }
            }
        });
    </script>
</body>
</html>
