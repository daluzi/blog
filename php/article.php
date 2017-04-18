<?php
session_start();
include('../blog/conn.php');

$id = $_GET['id'];
if (isset($_SESSION['user_id'])) {
    $sth = $dbh->prepare('SELECT * FROM category, user WHERE user.id = category.user_id AND category.id = :id');
    $sth->bindParam('id', $id);
} else {
    echo json_encode([
        'code' => 0,
        'status' => 'login before'
    ]);
    exit();
}
$sth->execute();
$res = $sth->fetch();

echo json_encode($res);
