<?php
session_start();
include('../blog/conn.php');

$id = $_GET['id'];
if (isset($_SESSION['username'])) {
    $user_id = $_SESSION['user_id'];
    $sth = $dbh->prepare('SELECT * FROM category WHERE user_id = :user_id AND id = :id');
    $sth->bindParam('user_id', $user_id);
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
