	<?php


	function login($pass,$email,$conn,$remember)
	{

    try {	
		session_reset();
	include('conexion.php');


	  $myEmail = mysqli_real_escape_string($conn,$email); /// filtra erros como este -> pass = "123"fd"; ficaria "123\fd"
	  $myEmail = filter_var($myEmail, FILTER_SANITIZE_EMAIL);
	  $mypassword = $pass;
	  
	  $hashed_password = password_hash($mypassword, PASSWORD_DEFAULT);

	 
	            $stmt = $conn->prepare("SELECT * FROM users WHERE  email = ?");
	            $stmt->bind_param("s", $myEmail);
	            $stmt->execute();

	            $result = $stmt->get_result();
	            $row = $result->fetch_assoc();
	            $count = $result->num_rows;
	        
	           $estado_pass = $row["passblock"]; // verifica estado da pass
	         
	   				///Passe correta       
	            if ($count == 1 && password_verify($mypassword, $row["password"])) {
	                $id_active = $row["id_active"];
       
                   if(  $estado_pass == 1){

	                echo "<script language='javascript' type='text/javascript'>alert('Password  bloqueada, por favor execute a recuperação da password');window.location.href='movies.php'</script>";
                     	

	                ///Caso email não esteja ativado
	                   }  elseif ($id_active == 0 ) {
	                	
	                
	                    echo "<script language='javascript' type='text/javascript'>alert('E-MAIL AINDA NÃO CONFIRMADO!!  POR FAVOR VERIFIQUE A SUA CAIXA DE CORREIO/SPAM DO SEU E-MAIL !!');window.location.href='movies.php'</script>";
	                }else {

	                    $id_user = $row["id"];
	                    $name_user = $row["nome"];
	                    $type = $row["tipo_utilizador"];
	                    $_SESSION['login_user'] = $myEmail;
	                    $_SESSION['password'] = $mypassword;
	                    $_SESSION['iduser'] = $id_user;
	                    $_SESSION['name'] = $name_user;
	                    $_SESSION['type'] = $type;
	                    $_SESSION['img']= $row["img"];
	                  $_SESSION['login_user'] = $myEmail;

	                  ///Quandoó login é feito o numero de tentativas   é reposto
	                   $int= 5;
	                   $stmt = $conn->prepare("UPDATE users SET tent = ? WHERE email = ?;");
                       $stmt->bind_param("is", $int,$myEmail );
   					   $stmt->execute();
                       $stmt->close();
	                 
	                   echo "<script language='javascript' type='text/javascript'>alert('Login Efetuado com sucesso!!');window.location.href='movies.php'</script>";
	                   	}

	            } else {
	                unset ($_SESSION['login_user']);
	                unset ($_SESSION['password']);
	                unset ($_SESSION['iduser']);
	                unset ($_SESSION['name']);
	                unset ($_SESSION['type']);
	                echo $estado_pass;
	               
                    tent($myEmail,$conn,$estado_pass);
	               
	           
	            }

	            $stmt->close();


				  } catch (Exception $e) {
				        if ($conn->error === 1062) 
				        	  /// error_log não usada pois n permite fazer configurações adicionais
				          wh_log("Erro-Login,  Dupla Entrada SQL");
					   	echo "<script language='javascript' type='text/javascript'>alert('Erro no Login!!!');window.location.href='movies.php'</script>";

					}
		}


		///Função para as tentativas falhadas da pass

function tent( $email,$conn,$int1){
	
     
        $myEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

	        $stmt = $conn->prepare("SELECT tent FROM users WHERE  email = ?");

         
            $stmt->bind_param("s", $myEmail);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $stmt->close();
 			if( $int1 == 1){ /// Verifica se pass esta bloqueada
     	 	  echo "<script language='javascript' type='text/javascript'>alert('Password  bloqueada, por favor execute a recuperação da password');window.location.href='movies.php'</script>";
              }else{

            if( $row["tent"] == 1){
            	///Passa o estado da pass a bloqueado
               $int= 1;
               $stmt = $conn->prepare("UPDATE users SET passblock = ? WHERE email = ?;");
               $stmt->bind_param("is", $int,$myEmail );
               $stmt->execute();
               $stmt->close();
              ///Update ao numero de tentativas
               $int= 5;
               $stmt = $conn->prepare("UPDATE users SET tent = ?  WHERE email = ?;");
               $stmt->bind_param("is", $int,$myEmail );
               $stmt->execute();
               $stmt->close();
  		       echo "<script language='javascript' type='text/javascript'>alert('Password bloqueada for favor processada à recuperação da password!!');window.location.href='movies.php'</script>";

            } else{

        	 $row["tent"]=$row["tent"]-1;
        	 $stmt = $conn->prepare("UPDATE users SET tent = ? WHERE email = ?;");
             $stmt->bind_param("is", $row["tent"],$myEmail);
             $stmt->execute();
             $stmt->close();
 
             $aux= $row['tent'];
  		    echo "<script language='javascript' type='text/javascript'>alert('Password errada restam $aux tentativas!!');window.location.href='movies.php'</script>";
            }
          
		  }
     
}


?>
