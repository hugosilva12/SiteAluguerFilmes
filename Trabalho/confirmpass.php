
<?php    
if (isset($_GET['token']) && isset($_GET['email'])) {
	
	$token = $_GET['token'];
	$email = $_GET['email'];
}
?>


<?php include 'menu.php';?>

<section class="breadcrumb-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb-area-content">
					<h1>Confirmar Palavra Passe</h1>
				</div>
			</div>
		</div>
	</div>
</section><!-- breadcrumb area end -->
<!-- blog area start -->
<section class="blog-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title pb-20">
					<form method="post" >
						<h6>PASSWORD</h6>
						<input type="password" name="pass" required /></br></br>
						<h6>Confirmar PASSWORD</h6>
						<input type="password" name="passs" required /></br></br>

						<button type="submit" class="theme-btn" name="update"  value="enviado">Registar</button>
					</form>

				</div>
			</div>
		</div>
	</div>
</section>

<?php
if(isset($_POST['update'])  == 'enviado'){
	$pass = ($_POST['pass']);
	$passs = ($_POST['passs']);
	echo updatepass( $email, $token, $pass,$passs,$conn);
}
?>


<!-- blog area end -->
<?php include 'footer.php';?>
</body>

</html>