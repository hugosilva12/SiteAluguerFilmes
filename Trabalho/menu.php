<html lang="zxx">
<?php 

session_start();
include'config/conexion.php';
include'config/registo.php';
include'config/login_config.php';
include'config/rec_pass.php';
include 'config/session.php';
 ob_start();

?>

<!DOCTYPE HTML>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Moviepoint - Online Movie,Vedio and TV Show HTML Template</title>
	<!-- Favicon Icon -->
	<link rel="icon" type="image/png" href="assets/img/favcion.png" />
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="all" />
	<!-- Slick nav CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/slicknav.min.css" media="all" />
	<!-- Iconfont CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/icofont.css" media="all" />
	<!-- Owl carousel CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
	<!-- Popup CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/magnific-popup.css">
	<!-- Main style CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="all" />
	<!-- Responsive CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="all" />

		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

  <!-- sweet alert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	</head>
	<body>
		<!-- Page loader -->
		<div id="preloader"></div>
		<!-- header section start -->
		<header class="header">
			<div class="container">
				<div class="header-area">
					<div class="logo">
						<a href="index-2.php"><img src="assets/img/logo.png" alt="logo" /></a>
					</div>
					<div class="header-right">
						
					</div>
					<div class="menu-area">
						<div class="responsive-menu"></div>
					    <div class="mainmenu">
                            <ul id="primary-menu">
                                <li><a class="active" href="movies.php">Movies</a></li>
                                <?php 
							if(status_login($conn)== true){
                                $tipo=$_SESSION['type'];
								if($tipo==1){
                              echo ' <li><a href="bo/src/web/index.php">Admin Dashboard</a></li>';}
                              else if($tipo==2){
								 echo ' <li><a href="bo/src/web/filmes.php">Admin Dashboard</a></li>';}
                              }
                              	 
							if(status_login($conn)== true){
                              echo ' <li><a href="reservas.php">Minhas reservas</a></li>';}
                          
                          if(status_login($conn)== true){
                              echo ' <li><a href="reservas_historico.php">Histórico de reservas</a></li>';}

                           ?>

							<?php 
							if(status_login($conn)== false){
                              echo '<li><a class="login-popup theme-btn" href="#"><i class="icofont icofont-user"></i> Log in</a></li>';} ?>
                              <?php 
							if(status_login($conn)== true){
								$nome=$_SESSION['name'];
						               echo'<a  data-toggle="modal" data-target="#edituser" href="#">Welcome'," " , $nome ,'!</a>
										<a href="config/logout.php"  class="theme-btn"><i class="icofont icofont-logout"></i>  Logout </a>';
										
										
							} else {

								echo'<li><a class="register-popup theme-btn"  href="#">Registe-se</a></li>';
  
							} ?>

                            </ul>
					    </div>
					</div>
				</div>
			</div>
		</header>
	<!--Login -->	
	
	
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

<!--RecuperaPass -->	
	
<div class="recuperarpass-area">
		<div class="recuperarpass-box">
			<a href="#"><i class="icofont icofont-close"></i></a>
			<h2>Recuperar Password</h2>
		<form method="post" >
				<h6>Digite o seu email</h6>
				<input type="text" name="email" required />	
				<button type="submit" class="theme-btn" name="recu"  value="enviado">Recuperar PAssword</button>
			</form>

		</div>
	</div>
<!--Cria Contas -->	
	<div class="register-area">
		<div class="register-box">
			<a href="#"><i class="icofont icofont-close"></i></a>
			<h2>Registo</h2>
			<form method="post" >
				<h6>Primeiro Nome</h6>
				<input type="text" name="primeiro" required />
				<h6>Último  Nome</h6>
				<input type="text" name="unome" required />
				<h6>EMAIL</h6>
				<input type="text" name="email" required />
				<h6>Código Postal</h6>
				<input type="text" name="cp" required/>
				<h6>Morada</h6>
				<input type="text"name="morada" required />
				<h6>PASSWORD</h6>
				<input type="password" name="pass" required />
				<h6>Confirmar PASSWORD</h6>
				<input type="password" name="nivel" required />

				<button type="submit" class="theme-btn" name="register"  value="enviado">Registar</button>
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



				<div id="edituser" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content" style="background: #24262d;">
							<form method="POST"  enctype="multipart/form-data">
								<div class="modal-header">            
									<h4 class="modal-title">Editar Utilizador</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>

								<div class="modal-body">  
									<?php
									$id= $_SESSION['iduser'];
						

									
									$sql99 = "SELECT * FROM users WHERE id='$id'";

									$result = $conn->query($sql99);

									if ($result->num_rows > 0) {
    // output data of each row
										while($row = $result->fetch_assoc()) {
											?>
											<input type="hidden" class="form-control" value="<?php echo $row['id']; ?>" name="id">
											<img style="width: 50%; height: auto;  border-radius: 50%;display: block;margin-left: auto;margin-right: auto;" src="bo/src/assets/users/<?php echo $row['img']; ?>" alt="about" />
											<div class="form-group">
												<label>Nome</label>
												<input type="text" style="background: #ffffff;" class="form-control" value="<?php echo $row['nome']; ?>" name="nome"required>
											</div>
											<div class="form-group">
												<label>Apelido</label>
												<input type="text" style="background: #ffffff;" class="form-control"  value="<?php echo $row['apelido']; ?>"  name="apelido"required>
											</div>
											<div class="form-group">
												<label>Email</label>
												<input type="email" style="background: #ffffff;" class="form-control"  value="<?php echo $row['email']; ?>" name="email"required>
											</div>
											<div class="form-group">
												<label>Morada</label>
												<input type="text" style="background: #ffffff;" class="form-control"  value="<?php echo $row['morada']; ?>" name="morada" required>
											</div>
											<div class="form-group">
												<label>Código de Postal</label>
												<input type="text"  style="background: #ffffff;" class="form-control" value="<?php echo $row['codigo_postal']; ?>" name="codigo_postal" required>
											</div>
											<div class="form-group">
												<label>Imagem</label>
												<input type="file" class="form-control"  name="arquivo" >
											</div>
											<?php
										}

									} else {
										echo "0 results";
									}


									?>
								</div>
								<div class="modal-footer">
									<input type="button" style="color: #666;" class="btn btn-default" data-dismiss="modal" value="Cancel">
									<input type="hidden" name="editar" value="editado" />
									<input type="submit"  style="background: #eb315a;border: 1px solid #eb315a;color: #fff;" class="btn theme-btn" value="Update">
								</div>
							</form>
							<?php
							if(isset($_POST['editar'])  == 'editado'){
								$_POST['nome'] = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
								$_POST['apelido'] = filter_var($_POST['apelido'], FILTER_SANITIZE_STRING);
								$_POST['morada'] = filter_var( $_POST['morada'], FILTER_SANITIZE_STRING); 
								$_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
								$_POST['codigo_postal'] = filter_var( $_POST['codigo_postal'], FILTER_SANITIZE_STRING);
								$id=filter_var($_SESSION['iduser'], FILTER_SANITIZE_NUMBER_INT);
								if($_POST['nome']!="" && $_POST['apelido']!="" && $_POST['morada']!="" && $_POST['email']!="" && $_POST['codigo_postal']!="" && $_POST['id']!=""){
                                      if(isset($_FILES['arquivo']['name']) && !empty($_FILES['arquivo']['name'])){//['arquivo']-> name do input da imagem 
                                                                //guardar o nome do ficheiro
                                      $nome=$_FILES['arquivo']['name'];
                                      $arquivo_tmp=$_FILES['arquivo']['tmp_name'];
                                                                //vamos retirar a extensao ao ficheiro para saber se é mesmo uma imagem
                                      $ext=strchr($nome, '.');
                                                                //strchr retira a ultima parte da variavel nome até ao ponto ou seja nome da imagem foto.jpg ele guarda o .jpg
                                                                //vamos colocar em minusculas
                                      $ext=strtolower($ext);
                                                                //verifica se a extensão é válida
                                      if(strstr('.jpg; .jpeg; .png; .gif',$ext)){
                                                                  //vamos criar  um novo nome para ter a certeza que nunca se repete
                                      	$novonome=md5(microtime()).$ext;
                                                                  //vamos definir onde guardar a imagem
                                      	$caminho="bo/src/assets/users/".$novonome;
                                                                  //vamos tentar mover a imagem
                                      	if(@move_uploaded_file($arquivo_tmp, $caminho)){
                                      		echo'$id';
                                      		if($stmt = $conn->prepare("UPDATE users SET nome = ?, apelido = ?, email= ?,codigo_postal= ?, morada= ?,img=? WHERE id = ?")){

                                      			$stmt->bind_param("ssssssi", $_POST['nome'], $_POST['apelido'], $_POST['email'], $_POST['codigo_postal'], $_POST['morada'], $novonome ,$id);    
                                      			$stmt->execute();
                                      			$stmt->close();
                                      			echo "<meta http-equiv='refresh' content='1'>";
                                      			echo "<script> 
                                      			swal('Editado com sucesso! 'Nice!',', 'Nice!', 'success',{
                                      				});
                                      				</script>";
                                      			}
                                      			else {
			                                      //Error
                                      				wh_log("Prep statment failed: %s\n", $conn->error);
                                      			}
                                      		}
                                      	}
                                      }

                                      else{
                                      	if($stmt = $conn->prepare("UPDATE users SET nome = ?, apelido = ?, email= ?,codigo_postal= ?, morada= ? WHERE id = ?")){

                                      		$stmt->bind_param("sssssi", $_POST['nome'], $_POST['apelido'], $_POST['email'], $_POST['codigo_postal'], $_POST['morada'], $id);    
                                      		$stmt->execute();
                                      		$stmt->close();
                                      		echo "<meta http-equiv='refresh' content='1'>";
                                      		echo "<script> 
                                      		swal('Editado com sucesso!', 'Nice!', 'success',{
                                      			});
                                      			</script>";
                                      			
                                      			echo $id;
                                      		}
                                      		else {
			                                      //Error
                                      			wh_log("Prep statment failed: %s\n", $conn->error);
                                      		}
                                      	}
                                      }
                                      mysqli_close($conn);
                                  }
                                  ?>  

                              </div>
                          </div>  
                      </div>
</body>
</html>
