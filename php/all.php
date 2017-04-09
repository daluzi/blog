<?php
session_start();
include('../blog/conn.php');

if (!isset($_SESSION['username'])) {
    $id = $_SESSION['user_id'];
    $sth = $dbh->prepare('SELECT * FROM category WHERE user_id = :id');
	$sth->bindParam('id', $id);
} else {
    $sth = $dbh->prepare('SELECT * FROM category');
}
$sth->execute();
$res = $sth->fetchAll();

echo json_encode($res);
