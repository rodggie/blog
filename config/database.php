<?php
require 'config/constants.php';

mysqli_report(MYSQLI_REPORT_OFF);

//connect to the database
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (mysqli_errno($connection)) {
    die(mysqli_error($connection));
}