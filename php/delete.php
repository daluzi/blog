<?php

session_start();

$article_id = $_POST['id'];
$user_id = $_SESSION['user_id'];

include('../blog/conn.php');

$sth = $dbh->prepare('DELETE FROM category WHERE id = :id');
$sth->bindParam('id', $article_id);
$res = $sth->execute();

echo $res;
