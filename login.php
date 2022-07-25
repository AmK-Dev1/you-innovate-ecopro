<?php 
include('header.php');
?>


<!-- Check User -->
<script>
    check_1 = ()=>{
        if(localStorage.getItem('user')){
            window.location.href = "home.php";
        }
    }
    check_1();
</script>


<div class="container">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="assets/images/youinnovate.png" class="img-fluid brand_logo" alt="Logo">
					</div>
				</div>

				<!-- Form -->
				<div id="form-login" >
						<div class="d-flex justify-content-center form_container">
							<form>
								<div class="input-group mb-3">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fas fa-user"></i></span>
									</div>
									<input id="login_student_id" type="text" name="" class="form-control input_user" value="" placeholder="<?= $traduction['id_student']?>">
								</div>
								<div class="input-group mb-2">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fas fa-key"></i></span>
									</div>
									<input id="login_password" type="password" name="" class="form-control input_pass" value="" placeholder="<?= $traduction['password']?>">
								</div>


									<div class="d-flex justify-content-center mt-3 login_container">
							<button id="login_btn" type="button" name="button" class="btn login_btn mt-4">Login</button>
						</div>
							</form>
						</div>
				</div>
				


			</div>
		</div>


</div>


<?php
include('footer.php');
?>