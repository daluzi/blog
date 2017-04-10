<?php
session_start();
$res = session_destroy();

echo $res;