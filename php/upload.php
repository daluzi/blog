<?php

include('../blog/conn.php');
$name = $_POST['name'];
$content = $_POST['content'];
$time = time();

$sth = $dbh->prepare('INSERT INTO category VALUES(null, :name, :content, :time)');

$sth->bindParam('name', $name);
$sth->bindParam('content', $content);
$sth->bindParam('time', $time);

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