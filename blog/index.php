<?php 
    session_start();
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
    <link rel="stylesheet" type="text/css" href="./style/default.css" id = 'link'/>
    <script src="jquery.js"></script>
    <script src="index-changcolor.js"></script>
  </head>
<body>
    <div class="blog-masthead changeclr">
      <div class="container">
            <nav class="blog-nav">
                <a class="blog-nav-item active" href="index.php">主页</a>
                <input type="button" data-value="default" class="targetElem" value="default" style="width: 50px; border: 1px solid #fff;border-radius: 8px;background-color: #fbfbe3;" />
                <input type="button" data-value="green" class="targetElem" value="green" style="width: 50px;border: 1px solid #fff;border-radius: 8px;background-color: #fbfbe3;" />
                <input type="button" data-value="red" class="targetElem" value="red" style="width: 50px;border: 1px solid #fff;border-radius: 8px;background-color: #fbfbe3;"/>
                <input type="button" data-value="orange" class="targetElem" value="orange" style="width: 50px;border: 1px solid #fff;border-radius: 8px;background-color: #fbfbe3;"/>
                <?php if (isset($_SESSION['username'])) {
                    echo '<span class="blog-nav-item signin">';
                    echo $_SESSION['username'];
                    echo '</span>';
                } else {
                    echo '<a class="blog-nav-item signin" href="../signin/index.php">登录</a>';
                }
                ?>
                <a class="blog-nav-item signin" href="../register/register.html">注册</a>
            </nav>
        </div>
    </div>
    <div class="container changeclr">
        <div class="blog-header">
            <h1 class="blog-title" id="blog-title">Blog</h1>
            <p class="lead blog-description">主页查看文章</p>
        </div>
        <div class="row">
            <div class="col-sm-8 blog-main">
                <div id="cont" style="position: relative;left:0px;">
                </div>
            </div>
            <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
                <div class="sidebar-module sidebar-module-inset">
                    <h4>关于</h4>
                    <p>这是博客主页，可以查看博主发布的所有文章</p>
                </div>
            </div><!-- /.blog-sidebar -->
        </div><!-- /.row -->
    </div>
    <script>
        if (!Date.format) {
            Date.prototype.format = function (fmt) { //author: meizz 
                var o = {
                    "M+": this.getMonth() + 1, //月份 
                    "d+": this.getDate(), //日 
                    "h+": this.getHours(), //小时 
                    "m+": this.getMinutes(), //分 
                    "s+": this.getSeconds(), //秒 
                    "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
                    "S": this.getMilliseconds() //毫秒 
                };
                if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
                for (var k in o)
                if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
                return fmt;
            }
        }
        $.ajax({
            url: '../php/all.php',
            success: function(res) {
                res = JSON.parse(res);
                // var tm = new Date();
                for (var i = 0, len = res.length; i < len; i++) { 
                    var hh = $('<div class="newessay" style="height:400px;margin: 30px 0px 10px;border: 2px dashed #c3bdbd;border-radius:10px;"><h3>' +'文章'  + '<small>'+ res[i].id  +'</small>'+':' + res[i].name + '</h3><div>' + res[i].content + '</div></div><p style="font-size:14px;">' + new Date(parseInt(res[i].time + '000')).format('yyyy-MM-dd hh:mm:ss') + '</p>')
                    $('#cont').prepend(hh);
                }
            }
        });
    </script>
</body>
</html>
