<?php
// include('../blog/conn.php');
// var_dump($dbh);

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
// var_dump($dbh); 
//检测用户名是否已经存在
$sth = $dbh->prepare('SELECT * FROM blog_user where username = :username limit 1');
$sth->bindParam('username', $username);
$sth->execute();
$res = $sth->fetchAll();
if(!empty($res)) {
    echo json_encode([
        'status_code' => 1,
        'status' => '错误：用户名 ',$username,' 已存在.'
    ]);
    exit;
}
//写入数据
$password = MD5($password);
// $regdate = time();
$sth = $dbh->prepare('INSERT INTO blog_user(id, username,password, theme) VALUES(null, :username,:password, "默认主题")');
$sth->bindParam('username', $username);
$sth->bindParam('password', $password);
$check_query = $sth->execute();

if($check_query) {
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
