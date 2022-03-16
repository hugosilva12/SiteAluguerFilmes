<?php


use PHPMailer\PHPMailer\PHPMailer;

require './vendor/autoload.php';
//////////////////////////////Verifica email
function verificarUtilizadorExistentes($email, $conn)
{

    //Verifica se o mail é valido
  if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo "<script language='javascript' type='text/javascript'>alert('E-MAIL INVALIDO!');window.location.href='movies.php'</script>";
    return true;

  } else{

    $stmt = $conn->prepare("SELECT * FROM users WHERE email  = (?)");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result!=null && $result->num_rows > 0) {

    
      return true;
    }
 echo "<script language='javascript' type='text/javascript'>alert('ERRO! Email não registado!');window.location.href='movies.php'</script>";
    return false;
  }

}



//////////////////////////////Recuperar Pass
function recuperarpass ($email, $conn){

   $email = filter_var($email, FILTER_SANITIZE_EMAIL);
     $token = bin2hex(random_bytes(50));


     if (verificarUtilizadorExistentes($email,$conn) == true) {

       try {

        $stmt = $conn->prepare("INSERT INTO recu_pass (email, token) VALUES ( ?, ?)");
        $stmt->bind_param("ss", $email, $token);
        $stmt->execute();
        $stmt->close();

        mandamailrec($email,$token);


      } catch (Exception $e) {

        echo "<script language='javascript' type='text/javascript'>alert('ERRO!!');window.location.href='../movies.php'</script>";

      }

    } 
  }

//////////////////////////////Manda email
  function mandamailrec($email,$token){

   $mail = new PHPMailer;
   $mail->CharSet = 'utf-8';
   $mail->isSMTP();
   $mail->Host = 'smtp.gmail.com';
   $mail->Port = 587;
   $mail->SMTPSecure = 'tls';
   $mail->SMTPAuth = true;
 //Username to use for SMTP authentication - use full email address for gmail
   $mail->Username = "hugoquilatesaw@gmail.com";
 //Password to use for SMTP authentication
   $mail->Password = "0000hug1";
 //Set who the message is to be sent from
   $mail->setFrom('hugsaf2132@gmail.com', 'Segurança das Aplicações Web');
 //Set who the message is to be sent to
   $mail->addAddress($email, 'Null');
 //Set the subject line
   $mail->Subject = "Recuperação Password - Movie Points";
$url =  "{$_SERVER['HTTP_HOST']}"; //Obter URL para link email
$escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
$link = $escaped_url . "/php/php/confirmpass.php?token=" . $token .  "&email=" .$email; 
$conteudo = "Recuperação Password - Movie Points <br> Clique no link abaixo para repor a sua password : <br><br>" .$link;

 //allow html code in body message
$mail->IsHTML(true);
 //Body text for the message
$mail->Body =  $conteudo;
 //aditional options to SMTP
$mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));
if (!$mail->send()) {
 echo "Mailer Error: " . $mail->ErrorInfo;
} else {
 echo "<script> 
 swal('Email enviado com sucesso!', 'Nice!', 'success',{
  });
  </script>";
}

}


function updatepass( $email, $token, $pass,$pass2,$conn){
  
     
        $emailrecebido = filter_var($email, FILTER_SANITIZE_EMAIL);

      if( validapass($pass,$pass2)== true){// Passowrd cumprir os parametros...
          $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
             ///Uptade password
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?;");
            $stmt->bind_param("ss", $hashed_password, $emailrecebido);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            ///Pass desbloqueada
            $int = 0;
            $stmt = $conn->prepare("UPDATE users SET passblock = ? WHERE email = ?;");
            $stmt->bind_param("ss", $int, $emailrecebido);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            
            
            $stmt = $conn->prepare("DELETE FROM recu_pass WHERE email = ?;");
            $stmt->bind_param("s", $emailrecebido);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

      echo "<script language='javascript' type='text/javascript'>alert('Password actualizada com sucesso!!');window.location.href='movies.php'</script>";
      } else {

      echo "<script language='javascript' type='text/javascript'>alert('Por favor coloque uma passoword com maiusculas,minusculas e números inteiros!!');window.location.href='movies.php'</script>";
      }
         

          
       /*     $sql = "UPDATE users SET password = $passwordrecebida WHERE email = $emailrecebido;";
            $result = $conn->query($sql);
            
            $titulomensagem = "Password Recuperada com Sucesso - It's Raining Tech Blog";
            $conteudotexto = "Password Recuperada";
            $conteudoalert = "Password actualizada com sucesso!!"; 
            $conteudo = "A sua password foi actualizada com sucesso! <br> Estamos muito feliz em te-lo como nosso membro! <br><br> Com os Melhores Cumprimentos,<br> It's Raining Tech Blog ";
            $Mailer = new Mailer($emailrecebido, $titulomensagem, $conteudo, $conteudotexto, $conteudoalert); 
        } catch (Exception $e) {
            if ($conn->errno === 1062) echo "<script language='javascript' type='text/javascript'>alert('ERRO!!');window.location.href='../index.php'</script>";
        }*/
    

}










?>
