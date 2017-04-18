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

// if(strlen($password) < 6){
//     echo json_encode([
//         'status_code' => 0,
//         'status' => '密码长度不够'
//     ]);
//     exit;
// }

include('../blog/conn.php');

//检测用户名是否已经存在
$sth = $dbh->prepare('SELECT * FROM user where username = :username limit 1');
$sth->bindParam('username', $username);
$sth->execute();
$res = $sth->fetchAll();
if(!empty($res)) {
    echo json_encode([
        'status_code' => 0,
        'status' => '错误：用户名 ',$username,' 已存在.'
    ]);
    exit;
}
//写入数据
$password = MD5($password);

$sth = $dbh->prepare('INSERT INTO user(id, username, password, theme) VALUES(null, :username,:password, "default")');
$sth->bindParam('username', $username);
$sth->bindParam('password', $password);
$res = $sth->execute();

if($res) {
    echo json_encode([
        'status_code' => 2,
        'status' => '注册成功'
    ]);
} else {
    echo json_encode([
        'status_code' => 0,
        'status' => '添加用户失败'
    ]);
}
