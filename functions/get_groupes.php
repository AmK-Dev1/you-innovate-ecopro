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

        
        $id_groupe = $inscription['idGroupe'];

        $query_2 = mysqli_query($con,"  SELECT groupe.idGroupe, groupe.Designation, Module.Designation Module,Enseignat.Nom Enseignat,Niveau.Designation Niveau, groupe.Jour , groupe.Heure , groupe.Salle , groupe.NombreSeance , groupe.MontantTotal
                                        FROM (((groupe
                                        INNER JOIN Module ON groupe.idModule = Module.idModule)
                                        INNER JOIN Enseignat ON groupe.idEnseignat = Enseignat.idEnseignat)
                                        INNER JOIN Niveau ON groupe.idNiveau = Niveau.idNiveau) WHERE groupe.idGroupe='".$id_groupe."';");

        while($row = mysqli_fetch_assoc($query_2)){
            // add the Credit Seance to the row 
            $row['CreditSeance'] = $inscription['CreditSeance'];

            // add row to Res

            $resultat[] = $row;   
        }

        //Resultat contains Groupes of a specific student and informations of every Groupe ... 

        /* !!!!!! THIS QUERY WILL GET THE VIEW OF TABLE "Groupe" joining all informations !!!!!
        SELECT groupe.idGroupe, groupe.Designation, Module.Designation Module,Enseignat.Nom Enseignat,Niveau.Designation Niveau, groupe.Jour , groupe.Heure , groupe.Salle , groupe.NombreSeance , groupe.MontantTotal
        FROM (((groupe
        INNER JOIN Module ON groupe.idModule = Module.idModule)
        INNER JOIN Enseignat ON groupe.idEnseignat = Enseignat.idEnseignat)
        INNER JOIN Niveau ON groupe.idNiveau = Niveau.idNiveau);
        */
    }

    echo json_encode($resultat);

}




$con->close();
?>