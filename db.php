<?php
$host='localhost'; $user='root'; $password=''; $database='mishkat_campus_hub';
$conn=mysqli_connect($host,$user,$password,$database);
if(!$conn){die('The website cannot connect to the database right now.');}
mysqli_set_charset($conn,'utf8mb4');
?>
