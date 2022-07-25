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
        history_e_options_view.push('<option value="all" selected>tous les mois</option>')
    }else{
        history_e_options_view.push('<option value="all">tous les mois</option>')    
    }

    for (let i = 0; i < history_e.length; i++) {
         
         temp.push(history_e[i])       
         condition ++;
         if(condition == nbr_siences_month){

             months.push(temp);
             nbr_months++;
             if(month_number == nbr_months){
                history_e_options_view.push('<option value="'+nbr_months+'" selected> mois-'+nbr_months+'</option>');
             }else{
                history_e_options_view.push('<option value="'+nbr_months+'"> mois-'+nbr_months+'</option>');
             }
             temp = []
             condition = 0;
 
           }else if((i+1)== history_e.length){

            months.push(temp);
            nbr_months++;
            history_e_options_view.push('<option value="'+nbr_months+'"> mois-'+nbr_months+'</option>');
          
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
                history_e_table_view +=    '<tr>'+
                                            '<td>'+month[j].Date+' a '+month[j].temps+'</td>'+
                                            '<td>'+month[j].Presence+'</td>'+
                                        '</tr>' 
            }
        }
    }else{
        months = months.reverse();
        if(months.length >0){
            const month = months[month_number-1];
        for (let j = 0; j < month.length; j++) {
            history_e_table_view +=    '<tr>'+
                                        '<td>'+month[j].Date+' a '+month[j].temps+'</td>'+
                                        '<td>'+month[j].Presence+'</td>'+
                                    '</tr>' 
        }
        }
        
    }

    //Set view 
    $('#history_e_options').html(history_e_options_view);
    $('#history_e_table').html(history_e_table_view);

    /* const views = {
        "options": history_e_options_view,
        "table": history_e_table_view
    }
    return views; */
}

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
            
            credit='<h5><strong class="text-danger">Séances restantes : '+groupe.CreditSeance+'</strong></h5>';

        } else{
            credit='<h5><strong class="text-success">Séances restantes : '+groupe.CreditSeance+'</strong></h5>';
        }

        const groupe_infos = '<ul class="">'+
                            '<li>matière : '+groupe.Module+'</li>'+
                            '<li>Date : '+groupe.Jour+'</li>'+
                            '<li>Temps : '+groupe.Heure+'</li>'+
                            '<li>Nbr de séances par mois : '+groupe.NombreSeance+'</li>'+
                            '<li>prof : '+groupe.Enseignat+'</li>'+
                            '<li>prix : '+groupe.MontantTotal+' Dzd / mois</li>'+
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
            '<td>'+history_p[i].Somme+'</td>'+
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
            $("#fraisinsc").text("Frais d'inscription : "+frais.Montant + " Dzd le "+ frais.date )
        }
         
        setTimeout(()=>{
            //4) disable spinner and show view
        $('#second_spinner').removeClass('d-flex');
        $('#second_spinner').addClass('d-none');
        $('#second_content').removeClass('d-none');
        }
        ,300)
        
            
}



/* Events handlers */

/* Switch months */
$('#history_e_options').change((e)=>{
    const month_number = $('#history_e_options :selected').val();
    get_history_e_view(month_number , localStorage.getItem('selected_groupe'));
})


/* Log in */
$('#login_btn').click((e)=>{
    e.preventDefault();
    console.log('Checking ..');

    if($('#login_password').val()==="" || $('#login_student_id').val() === "" ){
        console.log('empty');
        alert('Missing values ..')
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
                        window.location.href = "home.php?lang='haha'";
                    
                    }else{
                        alert("error :" +' '+ res.data)

                    }
            },
            
        });    

    }
})


$('#logout_btn').click((e)=>{
    e.preventDefault();
    localStorage.clear();
    window.location.reload();
})

