<!-- In this page there is a function to add time to comments "Lu le" -->

<?php 
require "connection.php";
if(!$con){
    die("Connection failed :" . mysqli_connect_error());
}

if(isset($_POST['student_id'])){
// GET comments  BY GROUPE AND GLOBAL COMMENTS WITH ID = 0

$date = date('d-m-y');

$query = "INSERT INTO commentaireeleve (DateLu) VALUES ($date) WHERE  idEleve= '".$student_id."'";
echo $query;

    if(mysqli_query($con , $query)){
        echo "200";
    }else{
        echo "The Query failed";
    }


}


