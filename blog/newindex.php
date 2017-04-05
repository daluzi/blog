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
    <script type="text/javascript" src="jquery.js"></script>
    

    <script type="text/javascript" charset="gbk" src="ueditor.config.js"></script>
    <script type="text/javascript" charset="gbk" src="ueditor.all.js"></script>
    <script type="text/javascript" charset="gbk" src="lang/zh-cn/zh-cn.js"></script>
  </head>

  <body>

    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item" href="index.php">主页</a>
          <a class="blog-nav-item" href="newindex.php">新文章</a>
        </nav>
      </div>
    </div>

    <div class="container">

      <div class="row">

        <div class="col-sm-8 blog-main">
            <button id="bianji">编辑文章</button>
            <button id="baocun">发表文章</button>
        </div><!-- /.blog-sidebar -->
        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
                <h4>关于</h4>
                <p>此网页可以为博主发布新的博客文章</p>
            </div>
        </div>
        <div id="biaoti" style="display: none;">
            <div>标题</div>
            <input type="text" name="name" id="name">
        </div>
        <div class="content">
            <script id="container" name="content" type="text/plain">
            </script>
        </div>
      </div><!-- /.row -->

    </div><!-- /.container -->

    <script type="text/javascript">
        var ue = UE.getEditor('container');
        localStorage.removeItem('ueditor_preference');
    </script>
    <script type="text/javascript" src="index.js"></script>
    <script type="text/javascript" src="new.js"></script>
  </body>
</html>
