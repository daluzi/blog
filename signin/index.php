<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <title>Signin</title>
        <script type="text/javascript" src="jquery.js"></script>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="signin.css" rel="stylesheet">
    </head>
<body>
    <div class="container">
      <form class="form-signin">
        <h2 class="form-signin-heading">请登录</h2>
        <label for="inputEmail" class="sr-only">用户名</label>
        <input type="text" id="inputEmail" class="form-control userName" placeholder="用户名" required autofocus>
        <label for="inputPassword" class="sr-only">密码</label>
        <input type="password" id="inputPassword" class="form-control password" placeholder="密码" required>
        <button class="btn btn-lg btn-primary btn-block" type="button" id="submit">登录</button>
      </form>
      <div id="urge" style="width: 200px; position: relative; left: 520px; top: -190px;"></div>
    </div> <!-- /container -->
    <script type="text/javascript" src="signin.js"></script>
</body>
</html>
