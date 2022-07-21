<?php
include('header.php');
?>

<!-- Check User -->
<script>
    check_2 = ()=>{
        if(!localStorage.getItem('user')){
            window.location.href = "index.php";
        }
    }
    check_2();
</script>


<!-- Main Content -->
<div id="main_content" class="container-fluid px-0 d-none">
    <header class="p-4 bg-primary">
            
            <div class="row align-items-end">
                <div class="col-2 ml-2">
                    <img class="rounded-circle p-1  bg-white" src="assets/images/student_avatar.svg" width="40px" />
                </div>
        
                <div class="col">
                    <h5 id="student_name" class="text-white">TEST TEST</h5>
                </div>

            </div>
    
    </header>

    <nav aria-label="breadcrumb">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Groupes</a></li>
                <li class="breadcrumb-item"><a href="#">Historique de présence</a></li>
                <li class="breadcrumb-item"><a href="#">Historique de payement</a></li>
                <li class="breadcrumb-item"><a href="#">Commentaires</a></li>
                <li class="breadcrumb-item"><a href="#">déconnecter</a></li>
            </ol>
    
    </nav>

    <div class="container p-1">
            
        <!-- Groupes -->
        <section>
            <h4>Groupes :</h4>
            <nav id="groupes_buttons" class="d-flex flex-wrap flex-grow">
               <!--  <button class="btn btn-outline-primary groupe-btn m-2">Grp1</button>
                <button class="btn btn-outline-primary groupe-btn m-2">Grp2</button>
                <button class="btn btn-outline-primary groupe-btn m-2">Grp3</button>
                <button class="btn btn-outline-primary groupe-btn m-2">Grp4</button>
                <button class="btn btn-outline-primary groupe-btn m-2">Grp5</button>
                <button class="btn btn-outline-primary groupe-btn m-2">Grp6</button>
                <button class="btn btn-outline-primary groupe-btn m-2">Grp7</button> -->
            </nav>
        </section>

            <hr>

        <!-- Grp infos -->
        <section class="mt-4">
            
            <h4>Groupe informations :</h4>
            <div class="row">
                <div class="col">
                    <ul class="">
                        <li>matière : Math</li>
                        <li>Date : chaque lundi</li>
                        <li>Temps : 14:30h</li>
                        <li>Séance par mois : 4</li>
                        <li>prof : Mejadba rabie</li>
                        <li>prix : 1500 Da / mois</li>
                        <br>
                        <h5><strong class="text-danger">Credit Restant : 3</strong></h5>

                    </ul>   
                </div>
            </div>
            
        </section>

            <hr> 

        <section class="mt-4">

            <h4>Historique étudiant : </h4>
            <div class="table-responsive">
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <td scope="col" colspan="2" class="text-center bg-primary text-white">Absence /  Présence</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                        <td colspan="2">
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>Mois 1</option>
                                <option>Mois 2</option>
                                <option>Mois 3</option>
                                <option>Mois 4</option>
                                <option>Mois 5</option>
                            </select>                        
                        </td>
                        </tr>

                        <tr>
                        <td>Séance de 21/juil/2022 a 16:30h</td>
                        <td>P</td>
                        </tr>

                        <tr>
                        <td>lorem</td>
                        <td>P</td>
                        </tr>
                        
                        <tr>
                        <td>Séance</td>
                        <td>P</td>
                        </tr>
                        
                        <tr>
                        <td>Séance</td>
                        <td>P</td>
                        </tr>
                    
                    </tbody>

                </table>

            </div>
        </section>


        <hr> 

        <section class="mt-4">

            <h4>Historique de paiement : </h4>
            <div class="table-responsive">
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <td scope="col" colspan="2" class="text-center bg-success text-white">Paiement par groupe</th>
                        </tr>
                    </thead>

                    <thead>
                        <tr>
                        <td scope="col" class="text-center">Date</th>
                        <td scope="col" class="text-center">Montant</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                        <td>le 21/juil/2022 a 16:00h</td>
                        <td>2500 Dzd</td>
                        </tr>

                        <tr>
                        <td>le 21/juil/2022 a 16:00h</td>
                        <td>2500 Dzd</td>
                        </tr>

                        <tr>
                        <td>le 21/juil/2022 a 16:00h</td>
                        <td>2500 Dzd</td>
                        </tr>

                        <tr>
                        <td>le 21/juil/2022 a 16:00h</td>
                        <td>2500 Dzd</td>
                        </tr>
                    
                    </tbody>

                </table>

            </div>
        </section>
        
        <hr>

        <section class="mt-4">
            <h4>Commentaires : </h4>

            <div class="table-responsive">
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <td scope="col" colspan="2" class="text-center bg-warning text-white">Commentaires</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                        <tr>
                            <td>Direction</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae illo, quam tenetur veniam numquam saepe ipsam, delectus, cupiditate odio aperiam laboriosam deserunt vel incidunt similique fuga modi cumque molestias rem.</td>
                        </tr>
                        
                        <tr>
                            <td>Direction</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae illo, quam tenetur veniam numquam saepe ipsam, delectus, cupiditate odio aperiam laboriosam deserunt vel incidunt similique fuga modi cumque molestias rem.</td>
                        </tr>

                        <tr>
                            <td>Direction</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae illo, quam tenetur veniam numquam saepe ipsam, delectus, cupiditate odio aperiam laboriosam deserunt vel incidunt similique fuga modi cumque molestias rem.</td>
                        </tr>
                    </tbody>

                </table>

            </div>


        </section>

    </div>
</div>


<!-- Spinner -->
<div id="main_spinner" class="d-flex justify-content-center" style="margin-top: 300px;">
  <div class="spinner-border text-primary" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>


<?php 
include('footer.php')
?>