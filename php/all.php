<?php
session_start();
include('../blog/conn.php');

// var_dump($_GET['user_id']);

if ($_GET['user_id']) {
    $id = $_SESSION['user_id'];
    $sth = $dbh->prepare('SELECT c.*, u.username FROM category AS c INNER JOIN user AS u ON c.user_id = :id AND u.id = c.user_id');
	$sth->bindParam('id', $id);
} else {
    $sth = $dbh->prepare('SELECT c.*, u.username FROM category AS c LEFT JOIN user AS u ON  u.id = c.user_id');
}
$sth->execute();
$res = $sth->fetchAll();

echo json_encode($res);
