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
            <a class="blog-nav-item" href="newindex.php">后台管理</a>
            <a class="blog-nav-item signin" href="../signin/index.html">登录</a>
        </nav>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-8 blog-main">
        </div><!-- /.blog-sidebar -->
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
        <div id="cont" style="position: relative;left:0px;"></div>
      </div><!-- /.row -->
    </div><!-- /.container -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        localStorage.removeItem('ueditor_preference');
    </script>
    
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
                for (var i = 0, len = res.length; i < len; i++) { 
                    var hh = $('<div contentEditable="true" class="newessay" style="height:400px;margin: 100px 0px 10px;border: 2px dashed #c3bdbd;border-radius:10px;"><h3>' +'文章'  + '<small> <span class="artile-num">'+ res[i].id  +'</small>: <span class="artile-title">' + res[i].name + '</span></h3><div class="artile-contt">' + res[i].content + '</div></div><p style="font-size:14px;">' + new Date(parseInt(res[i].time + '000')).format('yyyy-MM-dd hh:mm:ss') + '</p>' +'<button type="button" class="chgeesy">' + '修改文章' + '</button>')
                    $('#cont').prepend(hh);
                }
            }
        });
    </script>
    <script type="text/javascript" src="new.js"></script>
  </body>
</html>
