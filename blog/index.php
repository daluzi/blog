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
    <script src="jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="" id = 'link'/>
    <script type="text/javascript">
        var theme = localStorage.getItem('mySkin') || 'default';
        $('#link').attr('href', './style/' + theme + '.css');
    </script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="marked.js"></script>
    <script>
        $(function() {
            var search = location.search;
            if (search == '?theme=php') {
                $.ajax({
                    url: '../php/theme.php?theme=null',
                    success: function(res) {
                        res = JSON.parse(res);
                        skinValue = res.theme;
                        $('#link').attr('href',"style/"+skinValue+".css");
                    }
                });
                $('.targetElem').each(function() {
                    $(this).removeClass('targetElem').addClass('hehe');
                });
                $('.hehe').on('click', function() {
                    var type = $(this).data('value');
                    $.ajax({
                        url: '../php/theme.php?theme=' + type,
                        success: function(res) {
                            res = JSON.parse(res);
                            if (res.status_code) {
                                $('#link').attr('href',"style/"+type+".css");
                            }
                        }
                    });
                });
            }
        })
    </script>
    <script src="index-changcolor.js"></script>
  </head>
<body>
    <div class="blog-masthead changeclr navbar-fixed-top">
      <div class="container">
            <nav class="blog-nav">
                <a class="blog-nav-item active" href="index.php" style="float: left;">主页</a>
                <ul class="nav nav-tabs" style="float: left;">
                    <li class="active">
                    <li class="dropdown pull-right">
                         <a href="#" data-toggle="dropdown" class="dropdown-toggle">选择主题<strong class="caret"></strong></a>
                        <ul class="dropdown-menu" style="width: 100%; min-width: inherit;">
                            <li>
                                 <a href="##" data-value="default" class="targetElem">默认</a>
                            </li>
                            <li>
                                 <a href="##" data-value="green" class="targetElem">绿</a>
                            </li>
                            <li>
                                 <a href="##" data-value="red" class="targetElem">红</a>
                            </li>
                            <li>
                                 <a href="##" data-value="orange" class="targetElem">橘</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- <ul class="nav nav-tabs" style="float: right;">
                    <li class="active">
                    <li class="dropdown pull-right">
                         <a href="#" data-toggle="dropdown" class="dropdown-toggle">主题管理<strong class="caret"></strong></a>
                        <ul class="dropdown-menu" style="width: 100%; min-width: inherit;">
                            <li>
                                 <a href="./" data-value="cookie" class="theme">cookie</a>
                            </li>
                            <li>
                                 <a href="./" data-value="storage" class="theme">storage</a>
                            </li>
                            <li>
                                 <a href="./?theme=php" data-value="php" class="themes">后端</a>
                            </li>
                        </ul>
                    </li>
                </ul> -->
                <a class="blog-nav-item signin" href="./newindex.php">后台管理</a>
            </nav>
        </div>
    </div>
    <div class="container changeclr" style="margin-top: 40px;">
        <div class="row">
            <div class="col-sm-8 blog-main">
                <div id="cont" style="position: relative;left:0px;">
                </div>
            </div>
            <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
                <div class="sidebar-module sidebar-module-inset">
                    <h1 class="blog-title" id="blog-title"></h1>
                    <h4>关于</h4>
                    <p>这是博客主页，可以查看博主发布的所有文章</p>
                </div>
            </div>
        </div>
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
            url: '../php/all.php?user_id=0',
            success: function(res) {
                res = JSON.parse(res);
                for (var i = 0, len = res.length; i < len; i++) { 
                    var hh = $('<div class="newessay alists" style="border-bottom: 2px dashed #c3bdbd;"><h3>文章标题：<a class="items" href="./item.html?name=' + res[i].id + '">' + res[i].name + '</a></h3><div style="padding-left:20px;max-height:160px;overflow:hidden">' + marked(res[i].content) + '</div><p style="font-size:14px;margin-top:10px; color:#7c6363"><span style="color: #e15353;margin-right:20px;">作者：' + res[i].username +'</span>最后更新时间：' + new Date(parseInt(res[i].time + '000')).format('yyyy-MM-dd hh:mm:ss') + '</p></div>')
                    $('#cont').prepend(hh);
                }
            }
        });
    </script>
</body>
</html>
