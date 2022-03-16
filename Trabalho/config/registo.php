<?php
include('logs.php');
use PHPMailer\PHPMailer\PHPMailer;

require './vendor/autoload.php';
// require  'conexion.php';

///Valida pass
function validapass($pass,$passveri){
 if($pass == $passveri){
  $int=0;
  $por = 0;
  $arr1 = str_split($pass);
   $int1=0;
  ///Verifica se tem Maiuscluas
  foreach ( $arr1 as $testcase) {
   if (ctype_upper($testcase)) {
    $int=$int + 1;
  }
 ///Verifica se tem inteiros 
  if (ctype_digit($testcase)) {
    $por = $por + 1;
  }
  $int1= $int1+1;
} 

//Verifica se a pass tem maisculas e minusculas
if($por != 0 && $int != 0){
  if($int1 > 5){
       return true;
  } else{
    echo "<script language='javascript' type='text/javascript'>alert('Password Invalida, a password deve ter maisculas, minusculas e números e um minimo de 6 carcateres!');window.location.href='movies.php'</script>";
    return false;
  }
} else{

 echo "<script language='javascript' type='text/javascript'>alert('Password Invalida, a password deve ter maisculas, minusculas e números!');window.location.href='movies.php'</script>";
 return false;
}
} else{
  echo "<script language='javascript' type='text/javascript'>alert('Password não coincidem!');window.location.href='movies.php'</script>";
  return false;
}

}


/////////Manda Email///////////
function mandamail($email,$token,$pnome){

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
 $mail->setFrom('hugoquilatesaw@gmail.com', 'Segurança das Aplicações Web');
 //Set who the message is to be sent to
 $mail->addAddress($email, $pnome);
 //Set the subject line
 $mail->Subject = "Confirmar Registo - Movie Points";
$url =  "{$_SERVER['HTTP_HOST']}"; //Obter URL para link email
$escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
$link = $escaped_url . "/tp/phpmovies/config/confirmaremail.php?token=" . $token .  "&email=" .$email; 
$conteudo = "Confirmar Registo -  Movie Points <br> Clique no link abaixo para confirmar o seu registo: <br><br>" .$link;

 //allow html code in body message
$mail->IsHTML(true);
 //Body text for the message
$mail->Body =  $conteudo;
 //aditional options to SMTP

$mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));
if (!$mail->send()) {
 echo "Mailer Error: " . $mail->ErrorInfo;
  } else {
 echo "<script language='javascript' type='text/javascript'>alert('Email confirmaçao enviado!');window.location.href='movies.php'</script>";
   }

}


function verificarUtilizadorExistente($email, $conn)
{
    //Verifica se o mail é valido
  if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo "<script language='javascript' type='text/javascript'>alert('E-MAIL INVALIDO!');window.location.href='movies.php'</script>";
    return true;

  } else{
try {
    $stmt = $conn->prepare("SELECT * FROM users WHERE email  = (?)");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result!=null && $result->num_rows > 0) {
      echo "<script language='javascript' type='text/javascript'>alert('ERRO! Utilizador já existente!');window.location.href='movies.php'</script>";
      return true;
    }

    return false;
   } catch (Exception $e) {
      
      if ($conn->errno === 1062) 
                 /// error_log não usada pois n permite fazer configurações adicionais
          wh_log("Erro-Verificar o  Utilizador,  Dupla Entrada SQL");
       echo "<script language='javascript' type='text/javascript'>alert('Entrada Duplicada!!');window.location.href='movies.php'</script>";

  } 

  }

}

function RegistarUtilizador($conn,$nome,$pnome, $pass, $passveri,$email,$morada,$codigo){
 $pnome = filter_var($pnome, FILTER_SANITIZE_STRING);
 $nome = filter_var($nome, FILTER_SANITIZE_STRING);
 $morada = filter_var($morada, FILTER_SANITIZE_STRING); 
 $codigo = filter_var($codigo, FILTER_SANITIZE_STRING);
 $email = filter_var($email, FILTER_SANITIZE_EMAIL);
 //Verifica estado da pass 
 $estadopass = validapass($pass,$passveri);
   //Se estiver dentro dos parametros estabelecidos é incripetada
 if($estadopass == true){
  $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
  
  ///Verifica se email é valido e não está registado 
  $verificautilizador = verificarUtilizadorExistente($email,$conn);
 if($verificautilizador== false){
       $token = bin2hex(random_bytes(50)); //Cria o token
       $tent=5;
       $stmt=$conn->prepare("INSERT INTO `users` (`nome`,`apelido`,`email`,`codigo_postal`, `morada`,`password`,`token`,`tent`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
       $stmt->bind_param('sssssssi',$pnome, $nome,$email,$morada,$codigo,$hashed_password,$token,$tent);    
       $stmt->execute();
       $stmt->close();
       mandamail($email,$token,$pnome);  

 }


}

}


function mandamailconfirm($email,$token,$pnome){

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
 $mail->setFrom('hugoquilatesaw@gmail.com', 'Segurança das Aplicações Web');
 //Set who the message is to be sent to
 $mail->addAddress($email, $pnome);
 //Set the subject line
 $mail->Subject = "Confirmar Registo - Movie Points";

$escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
 
$conteudo = "Obrigado por confirmar o seu registo: <br><br>";

 //allow html code in body message
$mail->IsHTML(true);
 //Body text for the message
$mail->Body =  $conteudo;
 //aditional options to SMTP

$mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));
if (!$mail->send()) {

     wh_log("Erro-Confirmar Email, Email não enviado para , $email");
 echo "Mailer Error: " . $mail->ErrorInfo;
} else {

}

}

?>
