<?php
session_start();

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
$sth = $dbh->prepare('SELECT * FROM user where username = :username limit 1');
$sth->bindParam('username', $username);
$sth->execute();
$res = $sth->fetchAll();

if(!$res) {
    echo json_encode([
        'status_code' => 2,
        'status' => '错误：用户名 ',$username,' 不存在.'
    ]);
    exit;
} else {
    if ($res[0]['password'] == MD5($password)) {
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $res[0]['id'];
        $_SESSION['theme'] = 'default';
        echo json_encode([
            'status_code' => 1,
            'status' => '登录成功'
        ]);
    } else {
        echo json_encode([
            'status_code' => 0,
            'status' => '密码错误'
        ]);
    }
}

