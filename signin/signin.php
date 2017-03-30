<?php

if(!isset($_POST['submit'])) {
    echo json_encode([
        'status_code' => 0,
        'status' => '非法访问'
    ]);
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];


include('../blog/conn.php');
//检测用户名是否已经存在
$sth = $dbh->prepare('SELECT * FROM blog_user where username = :username limit 1');
$sth->bindParam('username', $username);
$sth->execute();
$res = $sth->fetchAll();
// var_dump($res[0]['password']);
if(!$res) {
    echo json_encode([
        'status_code' => 2,
        'status' => '错误：用户名 ',$username,' 不存在.'
    ]);
    exit;
} else {
    if ($res[0]['password'] == MD5($password)) {
        $_SESSION['username'] = $username;
        $_SESSION['theme'] = '默认主题';
        echo json_encode([
            'status_code' => 1,
            'status' => '登陆成功'
        ]);
    } else {
        $_SESSION['username'] = $username;
        $_SESSION['theme'] = '默认主题';
        echo json_encode([
            'status_code' => 1,
            'status' => 'asdasd'
        ]);
    }
}

