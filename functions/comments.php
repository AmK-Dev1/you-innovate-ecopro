<!-- In this page there is a function to add time to comments "Lu le" -->

<?php 
require "connection.php";
if(!$con){
    die("Connection failed :" . mysqli_connect_error());
}
