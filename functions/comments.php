<?php 
require "connection.php";
if(!$con){
    die("Connection failed :" . mysqli_connect_error());
}

if(isset($_POST['comment_id'])){

$comment_id = $_POST['comment_id'];

$date = date('d-m-y');

$heure = date("h:i");

$query = "UPDATE commentaireeleve SET DateLu='".$date."',heureLu='".$heure."' WHERE  idCommentaireEleve= '".$comment_id."'";


if(mysqli_query($con , $query)){
        echo "200";
}else{
        echo "The Query failed";
}


}

?>
