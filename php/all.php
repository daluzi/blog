<?php
session_start();
include('../blog/conn.php');
$slicer = 5;

// 获取总数
if (isset($_GET['num'])) {
    if ($_GET['user_id']) {
        $id = $_SESSION['user_id'];
        $sth = $dbh->prepare('SELECT count(*) AS count FROM category AS c INNER JOIN user AS u ON c.user_id = :id AND u.id = c.user_id');
        $sth->bindParam('id', $id);
    } else {
        $sth = $dbh->prepare('SELECT count(*) AS count FROM category');
    }

    $sth->execute();
    $res = $sth->fetchAll();
    echo json_encode(ceil((int)$res[0]['count'] / $slicer));
    exit();
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

// 后台管理
if ($_GET['user_id']) {
    $id = $_SESSION['user_id'];
    $sth = $dbh->prepare('SELECT c.*, u.username FROM category AS c INNER JOIN user AS u ON c.user_id = :id AND u.id = c.user_id');
	$sth->bindParam('id', $id);
}
// 博客首页
else {
    $sth = $dbh->prepare('SELECT c.*, u.username FROM category AS c LEFT JOIN user AS u ON  u.id = c.user_id');
}

$sth->execute();
$res = $sth->fetchAll();

$articles = array_slice($res, $slicer * ($page-1), $slicer);

echo json_encode($articles);
