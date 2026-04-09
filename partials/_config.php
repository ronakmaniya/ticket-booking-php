<?php

$DB_SERVER = "127.0.0.1";
$DB_USERNAME = "root";
$DB_PASSWORD = '';
$DB_NAME = "ticket_booking";

//connecting to database
$connect = mysqli_connect($DB_SERVER ,$DB_USERNAME ,$DB_PASSWORD ,$DB_NAME) or die("Couldnot Connect");

?>