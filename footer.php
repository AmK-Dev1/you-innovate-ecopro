
<footer class="d-flex flex-column justify-content-center text-white align-items-center py-2 bg-primary mt-5 border-top">
<img src="assets/images/youinnovate.png" width="30" height="40" >
    <p class="">©YOUINNOVATE 2022</p>

</footer>
    
    
    
    <!-- For container --> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

    <script>
        $(document).ready(()=>{


            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const lang = urlParams.get("lang");
            if(lang != "fr"){
                $("body").css("text-align","right");  
                $("body").css("direction","rtl");  
                $("body").css("font-family","amiri");
            }
            
            get_history_e_view = (month_number , groupe_id_in_the_list)=>{

                    const groupes = JSON.parse(localStorage.getItem('groupes'));
                    const groupe = groupes[groupe_id_in_the_list];
                    const history_e = groupe.history_e;
                    const nbr_siences_month = groupe.NombreSeance;
                    let months = [];
                    let temp = [];
                    let condition = 0;
                    let nbr_months = 0;

                    let history_e_options_view = [];   

                    if(month_number === "all"){
                        history_e_options_view.push('<option value="all" selected><?= $traduction['tous_les_mois']?></option>')
                    }else{
                        history_e_options_view.push('<option value="all"><?= $traduction['tous_les_mois']?></option>')    
                    }

                    for (let i = 0; i < history_e.length; i++) {
                        
                        temp.push(history_e[i])       
                        condition ++;
                        if(condition == nbr_siences_month){

                            months.push(temp);
                            nbr_months++;
                            if(month_number == nbr_months){
                                history_e_options_view.push('<option value="'+nbr_months+'" selected> <?= $traduction['mois']?>-'+nbr_months+'</option>');
                            }else{
                                history_e_options_view.push('<option value="'+nbr_months+'"> <?= $traduction['mois']?>-'+nbr_months+'</option>');
                            }
                            temp = []
                            condition = 0;

                        }else if((i+1)== history_e.length){

                            months.push(temp);
                            nbr_months++;
                            history_e_options_view.push('<option value="'+nbr_months+'"> <?= $traduction['mois']?>-'+nbr_months+'</option>');
                        
                        }
                    };

                    // glbhom beh yji tartib s7i7
                    months = months.reverse();
                    history_e_options_view = history_e_options_view.reverse().join(";");

                    let history_e_table_view ='';

                    if(month_number === "all"){
                        for (let i = 0; i < months.length; i++) {
                            const month = months[i];
                            if(!i==0){

                                history_e_table_view +=    '<tr class="bg-light">'+
                                                            '<td></td>'+
                                                            '<td></td>'+
                                                        '</tr>'
                            }
                            
                            for (let j = 0; j < month.length; j++) {
                                let statu;
                                if(month[j].Presence==0){
                                    statu = "<?= $traduction['0']?>";
                                } else{
                                    statu = "<?= $traduction['1']?>";
                                }
                                
                                
                                history_e_table_view +=    '<tr>'+
                                                            '<td>'+month[j].Date+' <?= $traduction['a']?> '+month[j].temps.split(":").slice(0,2).join().replace(',',':')+'</td>'+
                                                            '<td>'+statu+'</td>'+
                                                        '</tr>' 
                            }
                        }
                    }else{
                        months = months.reverse();
                        if(months.length >0){
                            const month = months[month_number-1];
                        for (let j = 0; j < month.length; j++) {
                            let statu;
                                if(month[j].Presence==0){
                                    statu = "<?= $traduction['0']?>";
                                } else{
                                    statu = "<?= $traduction['1']?>";
                                }

                            history_e_table_view +=    '<tr>'+
                                                        '<td>'+month[j].Date+' <?= $traduction['a']?> '+month[j].temps.split(":").slice(0,2).join().replace(',',':')+'</td>'+
                                                        '<td>'+statu+'</td>'+
                                                    '</tr>' 
                        }
                        }
                        
                    }

                    //Set view 
                    $('#history_e_options').html(history_e_options_view);
                    $('#history_e_table').html(history_e_table_view);
            };

            set_view = (groupe_id_in_the_list)=>{

                localStorage.setItem('selected_groupe',groupe_id_in_the_list)

                $('#second_content').addClass('d-none');
                $('#second_spinner').addClass('d-flex');
                $('#second_spinner').removeClass('d-none');

                const groupes = JSON.parse(localStorage.getItem('groupes'));

                //Generate Groupes buttons:
                let groupes_buttons = '';
                for (let i = 0; i < groupes.length; i++) {
                    if(i=== groupe_id_in_the_list){//active
                        groupes_buttons +='<button onclick="set_view('+i+')" class="btn btn-primary groupe-btn m-2 " disabled>'+ groupes[i].Designation +'</button>';
                    }else{
                        groupes_buttons += '<button onclick="set_view('+i+')" class="btn btn-outline-primary groupe-btn m-2">'+ groupes[i].Designation +'</button>';
                    }
                }

                const groupe = groupes[groupe_id_in_the_list];


                //Groupe informations
                let credit;

                if(parseInt(groupe.CreditSeance) <= 0){
                    
                    credit='<h5><strong class="text-danger"><?=$traduction["seances_restante"]?> : '+groupe.CreditSeance+'</strong></h5>';

                } else{
                    credit='<h5><strong class="text-success"><?=$traduction["seances_restante"]?> : '+groupe.CreditSeance+'</strong></h5>';
                }

                const groupe_infos = '<ul class="">'+
                                    '<li><?=$traduction["module"]?> : '+groupe.Module+'</li>'+
                                    '<li><?=$traduction["date"]?> : '+groupe.Jour+'</li>'+
                                    '<li><?=$traduction["time"]?> : '+groupe.Heure+'</li>'+
                                    '<li><?=$traduction["nbr_seances_mois"]?> : '+groupe.NombreSeance+'</li>'+
                                    '<li><?=$traduction["prof"]?> : '+groupe.Enseignat+'</li>'+
                                    '<li><?=$traduction["prix"]?> : '+groupe.MontantTotal+' <?=$traduction["dzd_mois"]?> </li>'+
                                    '<br>'+
                                    credit+//Credit restant                        
                                    '</ul>'

                // history _ e 

                //By default all the history 
                //lahna lazem nbda nakhdem l options f had la function w lokhra njib byha bark le mois li bghah sayed .. 
                const history_e = groupe.history_e;
                const nbr_siences_month = groupe.NombreSeance;
                let months = [];
                let temp = [];
                let condition = 0;
                let nbr_months = 0;
                for (let i = 0; i < history_e.length; i++) {

                    temp.push(history_e[i])       
                    condition ++;
                    if(condition == nbr_siences_month){

                        months.push(temp);
                        nbr_months++;
                        temp = []
                        condition = 0;

                    }else if((i+1)== history_e.length){
                        months.push(temp);
                        nbr_months++;
                    }
                };

                get_history_e_view(months.length,groupe_id_in_the_list);


                // history _ p
                const history_p = groupe.history_p;
                let history_p_view = "";
                for (let i = 0; i < history_p.length; i++) {           
                    if(history_p[i].Somme != 0){
                        history_p_view += '<tr>'+
                                            '<td>'+history_p[i].Date+'</td>'+
                                            '<td>'+history_p[i].Somme+' <?= $traduction['dzd']?> </td>'+
                                        '</tr>'
                    }
                }

                // comments 
                const comments = groupe.comments;

                let comments_view = "";
                for (let i = 0; i < comments.length; i++) {
                    const comment = comments[i];
                    comments_view +=    '<tr>'+
                                            '<td>'+comment.Date+'</td>'+
                                            '<td>'+comment.Message+'</td>'+
                                        '</tr>'
                }


                // SET Data
                $('#student_name').text(JSON.parse(localStorage.getItem('user')).Nom);
                $('#groupes_buttons').html(groupes_buttons);
                $('#grp_infos').html(groupe_infos);
                $('#history_p_view').html(history_p_view);
                $('#comments_view').html(comments_view);

                // Set frais d'incription
                const frais = JSON.parse(localStorage.getItem('user')).fraiinsc ;
                if(frais){
                    $("#fraisinsc").text("<?= $traduction['frais_de_inscription']?> : "+frais.Montant + " <?= $traduction['dzd_le']?> "+ frais.date )
                }

                setTimeout(()=>{
                        //4) disable spinner and show view
                    $('#second_spinner').removeClass('d-flex');
                    $('#second_spinner').addClass('d-none');
                    $('#second_content').removeClass('d-none');
                },300)
            };

            /* GET Data */

            const user = JSON.parse(localStorage.getItem('user'));
            if(user){
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
            }
           

            
                    /* Events handlers */

   
   
   
            /* Switch months */
            $('#history_e_options').change((e)=>{
            const month_number = $('#history_e_options :selected').val();
            get_history_e_view(month_number , localStorage.getItem('selected_groupe'));
            });

            /* Log in */
            $('#login_btn').click((e)=>{
                e.preventDefault();

                if($('#login_password').val()==="" || $('#login_student_id').val() === "" ){
                    alert("<?= $traduction['missing_values']?>")
                }else{
                    /* Prepare data */
                    const data = {
                        'student_id':$('#login_student_id').val(),
                        'password':$('#login_password').val()
                    } 
                    console.log(data)
                    /* send ajax */
                    $.ajax({
                        data:data,
                        type: 'POST',
                        url : 'functions/login.php',
                    
                        success: function(res){

                                res = JSON.parse(res)  
                                if(res.status === 200){
                                    localStorage.setItem('user',JSON.stringify(res.data));
                                    /* Redirect */

                                    /* Comments 'VU' */
                                    /* $.ajax({
                                        data:{'student_id':res.data.idEleve},
                                        type: 'POST',
                                        url: 'functions/comments.php',
                                        success:(res)=>{
                                            console.log(res)
                                        }

                                    }) */
                                     window.location.href = 'home.php?lang='+lang+'';
                                
                                }else{
                                    alert("<?= $traduction['wrong_informations']?>")

                                }
                        },
                        
                    });    

                }
            });


            $('#logout_btn').click((e)=>{
                e.preventDefault();
                localStorage.clear();
                window.location.reload();
            });
        
        
        })    
        
        
    </script>


<!-- Down to Up button + Scrol trriger -->
<script>

    //Get the button
    var mybutton = document.getElementById("myBtn");
    var comments_element = document.getElementById('c'); 

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        /* Go to Up button */
        scrollFunction()

        /* Check if comments are in viewport */
        if(isInViewport(comments_element)){
            // In this case user has seen comments section

        }

    };

    /* Check comments */
    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    /* Go to Up */
    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }

</script>

</body>
</html>