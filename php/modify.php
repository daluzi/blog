<?php

include('../blog/conn.php');
$name = $_POST['name'];
$content = $_POST['content'];
$id = $_POST['id'];
$time = time();

$sth = $dbh->prepare('UPDATE category SET name = :name, content = :content, time = :time WHERE id = :id');

$sth->bindParam('name', $name);
$sth->bindParam('content', $content);
$sth->bindParam('time', $time);
$sth->bindParam('id', $id);

$res = $sth->execute();
if($res) {
    echo json_encode([
        'status_code' => 2,
        'status' => '更新文章成功'
    ]);
} else {
    echo json_encode([
        'status_code' => 0,
        'status' => '更新失败失败'
    ]);
}