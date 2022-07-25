<?php 
require "connection.php";
if(!$con){
    die("Connection failed :" . mysqli_connect_error());
  }

  if( 
    isset($_GET['student_id']) &&
    $_SERVER['REQUEST_METHOD'] == "GET"
  )
  {
    $student_id = $_GET['student_id'];

    /* GET INSCRIPTIONS */
    $query_1 = mysqli_query($con,"SELECT idGroupe , CreditSeance FROM inscriptiongroupe  WHERE  idEleve= '".$student_id."'");
    
    $inscriptions = [];
    while($row = mysqli_fetch_assoc($query_1)){
        $inscriptions[]=$row;
    }

    /* For each Inscription get the name of module and prof .. ect */
    $resultat = [];

    foreach ($inscriptions as $inscription) {

        
        $groupe_id = $inscription['idGroupe'];

        $query_2 = mysqli_query($con,"  SELECT groupe.idGroupe, groupe.Designation, Module.Designation Module,Enseignat.Nom Enseignat,Niveau.Designation Niveau, groupe.Jour , groupe.Heure , groupe.Salle , groupe.NombreSeance , groupe.MontantTotal
                                        FROM (((groupe
                                        INNER JOIN Module ON groupe.idModule = Module.idModule)
                                        INNER JOIN Enseignat ON groupe.idEnseignat = Enseignat.idEnseignat)
                                        INNER JOIN Niveau ON groupe.idNiveau = Niveau.idNiveau) WHERE groupe.idGroupe='".$groupe_id."';");
        // while (par groupe)
        while($row = mysqli_fetch_assoc($query_2)){
            
            //GET history_e
            $query_3 = mysqli_query($con,"SELECT `Date` , Presence , temps FROM presence  WHERE  idEleve= '".$student_id."' AND idGroupe= '".$groupe_id."'" );
            
            $history_e = [];
            while($row_1 = mysqli_fetch_assoc($query_3)){
                $history_e[]=$row_1;
            }

            // GET history_p (paiement)
            $query_4 = mysqli_query($con,"SELECT `Date` , Somme  FROM caisse  WHERE  idEleve= '".$student_id."' AND idGroupe= '".$groupe_id."'" );
            $history_p = [];
            while($row_2 = mysqli_fetch_assoc($query_4)){
                $history_p[]=$row_2;
            }

            // GET comments 
            $query_5 = mysqli_query($con,"SELECT idCommentaireEleve, `Message` , `Date` , DateLu ,heureLu  FROM commentaireeleve  WHERE  idEleve= '".$student_id."' AND idGroupe= '".$groupe_id."'" );

            $comments = [];
            while($row_3 = mysqli_fetch_assoc($query_5)){
                $comments[]=$row_3;
            }
        

            // add the Credit Seance to the row 
            $row['CreditSeance'] = $inscription['CreditSeance'];
            // add the history_e (presence) to the row (groupe)
            $row['history_e'] = $history_e;
            // add the history_p (paiment) to the row (groupe)
            $row['history_p'] = $history_p;
            // add comments to the row
            $row['comments'] = $comments;
            
            $resultat[] = $row;   
        }


    }

    //var_dump($resultat);
    echo json_encode($resultat);

}




$con->close();
?>