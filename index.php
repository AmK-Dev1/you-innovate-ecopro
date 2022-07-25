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

				<!-- Traduction buttons -->
				<div id="trad-btns">
						<div class="d-flex flex-column justify-content-center mt-5">
							<a href="login.php?lang=fr" id="fr_btn" class="btn btn-primary">Français</a>
							<a href="login.php?lang=ar" id="ar_btn" class="btn btn-success mt-3">العربية</a>
						</div>
				</div>

			</div>
		</div>


</div>


<?php
include('footer.php');
?>