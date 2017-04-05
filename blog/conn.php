<?php

$user = 'root';
$pass = 'love520...';

try {
    $dbh = new PDO('mysql:host=localhost;dbname=clbk;charset=utf8', $user, $pass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
