<?php

session_start();
// 判断是否登录

if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
} else {
    echo json_encode([
        'status_code' => 0,
        'theme' => 'default',
        'status' => '请先在后台登录'
    ]);
    exit();
}
$theme = $_GET['theme'];

include('../blog/conn.php');
if ($theme == 'null') {
    $sth = $dbh->prepare('SELECT theme FROM user WHERE id = :id');
    $sth->bindParam('id', $id);
    $sth->execute();
    $res = $sth->fetch();
    $myTheme = $res['theme'];
    echo json_encode([
        'status_code' => 200,
        'theme' => $myTheme,
    ]);
} else {
    $sth = $dbh->prepare('UPDATE user SET theme = :theme WHERE id = :id');
    $sth->bindParam('theme', $theme);
    $sth->bindParam('id', $id);
    $res = $sth->execute();
    echo json_encode([
        'status_code' => 200,
    ]);
}



