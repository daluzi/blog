<?php
session_start();

$code = $_GET['code'];

if ($code == $_SESSION['captcha']) {
    echo true;
} else {
    echo false;
}