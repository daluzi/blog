<?php
session_start();

include('../blog/conn.php');
$name = $_POST['name'];
$content = $_POST['content'];
$time = time();

$id = $_SESSION['user_id'];
$sth = $dbh->prepare('INSERT INTO category VALUES(null, :name, :content, :time, :id)');

$sth->bindParam('name', $name);
$sth->bindParam('content', $content);
$sth->bindParam('time', $time);
$sth->bindParam('id', $id);

$res = $sth->execute();
if($res) {
    echo json_encode([
        'status_code' => 2,
        'status' => '添加文章成功'
    ]);
} else {
    echo json_encode([
        'status_code' => 0,
        'status' => '添加失败失败'
    ]);
}