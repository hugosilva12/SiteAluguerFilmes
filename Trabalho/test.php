	
<?php 

session_start();
include'config/conexion.php';
include'config/registo.php';
include'config/login_config.php';
include'config/rec_pass.php';
include 'config/session.php';
 ob_start();

?>

	<div class="login-area">
		<div class="login-box">
			<a href="#"><i class="icofont icofont-close"></i></a>
			<h2>LOGIN</h2>
		<form method="post" >
				<h6>EMAIL ADDRESS</h6>
				<input type="text" name="email" value="<?php echo $_COOKIE['email']; ?>" required />
				<h6>PASSWORD</h6>
				<input type="password" name="password" value="<?php echo $_COOKIE['password']; ?>" required />
				<div class="login-signup">
						<span><a class="recuperarpass-popup" href="#">Recuperar Password</a></span>
				</div>
				<div class="login-remember">
					<input type="checkbox" name="remember" checked="true"/>
					<span>Remember Me</span>
				</div>
				<div class="login-signup">
					<span><a class="register-popup" href="#">Registe-se</a></span>
				</div>
				<button type="submit" class="theme-btn" name="login"  value="enviado">Login</button>
			</form>

		</div>
	</div>
	<?php
     ///Formulário Registo
	if(isset($_POST['register'])  == 'enviado'){
		$pnome  = ucfirst($_POST['primeiro']);
		$nome = ($_POST['unome']);
		$pass = ($_POST['pass']);
		$passveri = ($_POST['nivel']);
		$email = ($_POST['email']);
		$morada = ($_POST['morada']);
		$codigo = ($_POST['cp']);
       ///Regista utilizador
		RegistarUtilizador($conn,$nome,$pnome, $pass, $passveri,$email,$morada,$codigo);
	}
      ///Formulário Login
	if(isset($_POST['login'])  == 'enviado'){
		$email = ($_POST['email']);
		$pass = ($_POST['password']);
		$remember=($_POST['remember']);

		if($remember== true){
			$hour = time() + 3600 * 24 * 30;
			setcookie('email', $email, $hour);
			setcookie('password', $pass, $hour);   

		//	ob_end_flush();
		}

      // Login
		login($pass,$email,$conn,$remember);	
	                    	       
	                  
	}
   ///Formulário Recuperaçao pass
if(isset($_POST['recu'])  == 'enviado'){
		$email = ($_POST['email']);
		recuperarpass ($email, $conn);
	}

	?>