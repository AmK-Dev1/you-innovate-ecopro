<?php 


if ( isset($_GET['lang'])) {
    if($_GET['lang']=="fr"){
        include("traduction_fr.php");
    }else{
        include("traduction_ar.php");
    }
}else{
    /* By default lang == "ar" */
    include("traduction_ar.php");
}

?>

