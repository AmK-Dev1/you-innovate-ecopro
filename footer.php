

   <!-- For container --> 
   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

    <script>
        $(document).ready(()=>{

            // Check Location :
            let location = window.location.href.split('/');
            location = location[location.length -1 ];//Get the last item 
            if(location == "home.php"){
                //Get and Set Data to home page : 
                //1)Get
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

                                    //2) SET Data
                                    $('#student_name').val = user.Nom;

                                    //Generate Groupes buttons:
                                    let groupes_buttons = '';
                                    for (let i = 0; i < groupes.length; i++) {
                                        groupes_buttons += '<button class="btn btn-outline-primary groupe-btn m-2">'+ groupes[i].Designation +'</button>';
                                    }

                                    $('#groupes_buttons').html(groupes_buttons);

                                    //3) disable spinner and show view
                                    $('#main_spinner').removeClass('d-flex');
                                    $('#main_spinner').addClass('d-none');
                                    
                                    $('#main_content').removeClass('d-none');
                            },
                        });            
            }


            /* Events :  */

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
                                    window.location.href = "home.php";
                                
                                }else{
                                    alert("error :" +' '+ res.data)

                                }
                        },
                        
                    });    

                }
            })


        })
    </script>
</body>
</html>