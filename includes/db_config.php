<?php
$host ="localhost";
$user="root";
$password="";
$dbname="hayii";
$connection = mysqli_connect($host,$user,$password,$dbname);

if(mysqli_connect_errno()) {
    die("Connection to database has failed.");
}
?> 