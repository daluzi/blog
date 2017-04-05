<?php

include('../blog/conn.php');

$sth = $dbh->prepare('SELECT * FROM category');
$sth->execute();
$res = $sth->fetchAll();

echo json_encode($res);
