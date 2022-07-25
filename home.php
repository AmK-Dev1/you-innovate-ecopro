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
<div class="container-fluid px-0">

    <div id="main_content" class="d-none">
        <header class="p-4 bg-primary">
                
                <div class="row align-items-end">
                    <div class="col-2 ml-2">
                        <img class="rounded-circle p-1  bg-white" src="assets/images/student_avatar.svg" width="40px" />
                    </div>
            
                    <div class="col">
                        <h5 id="student_name" class="text-white"></h5>
                    </div>

                </div>
        
        </header>

        <nav aria-label="breadcrumb" id="breadcumb">

                <ol class="breadcrumb">
                    <li class="breadcrumb-item ml-3"><a href="#grps"><?=$traduction['groupes']?></a></li>
                    <li class="breadcrumb-item"><a href="#he"><?=$traduction['historique_eleve']?></a></li>
                    <li class="breadcrumb-item"><a href="#hp"><?=$traduction['historique_paiement']?></a></li>
                    <li class="breadcrumb-item"><a href="#c"><?=$traduction['commentaires']?></a></li>
                    <li class="breadcrumb-item"><a id="logout_btn" href="#"><?=$traduction['logout']?></a></li>
                </ol>
        
        </nav>
    </div>
    

        <div id="second_content">
            <div class="container p-1">
                    
                <!-- Groupes -->
                <section id="grps">
                    <h4><?=$traduction['groupes']?> :</h4>
                    <nav id="groupes_buttons" class="d-flex flex-wrap flex-grow">
                            <!-- buttons by Jquerry -->
                    </nav>
                </section>


                <hr>

                <!-- Grp infos -->
                <section  class="mt-4">
                    
                    <h4><?=$traduction['groupe_informations']?> :</h4>
                    <div class="row">
                        <div id="grp_infos" class="col">
                            <!-- By javascript -->   
                        </div>
                    </div>
                    
                </section>

                    <hr> 

                <section id="he" class="mt-4">

                    <h4><?=$traduction['historique_eleve']?> : </h4>
                    <div class="table-responsive" >
                        
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <td scope="col" colspan="2" class="text-center bg-primary text-white"><?=$traduction["absence_presence"]?></th>
                                </tr>

                                <tr>
                                <td colspan="2">
                                    <select id="history_e_options" class="form-control" id="exampleFormControlSelect1">
                                        <!-- BY JS -->
                                    </select>                        
                                </td>
                                </tr>

                            </thead>

                            <tbody id="history_e_table">

            

                            
                            </tbody>

                        </table>

                    </div>
                </section>


                <hr> 

                <section id="hp" class="mt-4">

                    <h4><?= $traduction['historique_paiement']?> : </h4>
                    <ul>
                        <li id="fraisinsc"><?= $traduction['frais_pas_encore']?></li>
                    </ul>

                    <div class="table-responsive">
                        
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <td scope="col" colspan="2" class="text-center bg-success text-white"><?= $traduction['paiement_par_groupe']?></th>
                                </tr>
                            </thead>

                            <thead>
                                <tr>
                                <td scope="col" class="text-center"><?= $traduction['date']?></th>
                                <td scope="col" class="text-center"><?= $traduction['montant']?></th>
                                </tr>
                            </thead>

                            <tbody id="history_p_view">

                                <!-- By JS -->
                            
                            </tbody>

                        </table>

                    </div>
                </section>
                
                <hr>

                <section id="c" class="mt-4" style="padding-bottom: 4rem;">
                    <h4><?=$traduction['commentaires']?> : </h4>

                    <div class="table-responsive">
                        
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <td scope="col" colspan="2" class="text-center bg-warning text-white"><?=$traduction['commentaires']?></th>
                                </tr>
                            </thead>

                            <tbody id="comments_view">
                                <!-- BY JS -->
                            </tbody>

                        </table>

                    </div>


                </section>

                <!-- Go up button -->
                <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-arrow-up fa-2x"></i></button>


            </div>
        </div>
</div>


<!-- Spinner main load -->
<div id="main_spinner" class="d-flex justify-content-center" style="margin-top: 300px;">
  <div class="spinner-border text-primary" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>

<!-- Spinner onchange groupe-->

<div id="second_spinner" class="d-none justify-content-center" style="margin-top: 300px;">
  <div class="spinner-border text-primary" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>



<?php 
include('footer.php')
?>

<script>

const user = JSON.parse(localStorage.getItem('user'));
                $.ajax({
                            data:{
                                'student_id':user.idEleve
                            },
                            type: 'GET',
                            url : 'functions/get_groupes.php',
                        
                            success: function(res){
                                    const groupes = JSON.parse(res);
                                    //Save Results : 
                                    localStorage.setItem('groupes',JSON.stringify(groupes));
                                    
                                    //4) disable spinner and show view
                                    $('#main_spinner').removeClass('d-flex');
                                    $('#main_spinner').addClass('d-none');

                                    $('#main_content').removeClass('d-none');

                                    // by default set view of the first groupe on the list
                                    localStorage.setItem('selected_groupe',0)
                                    set_view(0);
                            },
                        });  

</script>