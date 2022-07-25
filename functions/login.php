<?php

require "connection.php";
header('Access-Control-Allow-Origin: *');

if(!$con){
  die("Connection failed :" . mysqli_connect_error());
}


if( 
    isset($_POST['student_id']) &&
    isset($_POST['password']) &&
    $_SERVER['REQUEST_METHOD'] == "POST"
  )
  {

    $student_id = $_POST['student_id'];

    $password = $_POST['password'];

    // 1) GET USER INFO 
    $query = mysqli_query($con,"SELECT idEleve, Password , Nom FROM eleve  WHERE  idEleve= '".$student_id."'");

    $user_json = array();
    
    while($row = mysqli_fetch_assoc($query)){
        array_push($user_json , $row);
    }


    if(count($user_json)>0){
       
        $user = $user_json[0];
        
        if($user['Password'] == $password){
          //Get frais D'INS
          $query_1 = mysqli_query($con, "SELECT Montant , date FROM fraiinsc WHERE idEleve= '".$student_id."'");

          while($row_1 = mysqli_fetch_assoc($query_1)){
            $user['fraiinsc']= $row_1;
          }

            /* Remove password */
            unset($user['Password']);
            $res = array('status'=>200 , 'data'=>$user);
            echo json_encode($res);

        }else{
            $res = array('status'=>405 , 'data'=>'Wrong password');
            echo json_encode($res);
        }
    }else{
        $res = array('status'=>404 , 'data'=>'User not found');    
        echo json_encode($res);
    }


  }else{
    $res = array('status'=>404 , 'data'=>'Invalid data');
    echo json_encode($res);
}



$con->close();

?>