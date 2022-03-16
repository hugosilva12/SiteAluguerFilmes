<?php
include'config/functions.php';

if (isset($_GET['token']) && isset($_GET['email'])) {
    
    $token = $_GET['token'];
    $email = $_GET['email'];
    try {
       include('config/conexion.php');
       require './vendor/autoload.php';
        $stmt = $conn->prepare("SELECT * FROM users WHERE  email = ? and token = ?");
        $stmt->bind_param("ss", $email, $token);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $result->num_rows; 
 

        if ($count == 1) {
            $id = $row["id"];
            $nome =  $row["nome"] ; 
            $id_act = $row["id_active"] ; 
            if($id_act != 1){
                $sql = "UPDATE users SET id_active = 1 WHERE id = $id;";
                $result = $conn->query($sql);
                
                $titulomensagem = "Obrigado por confirmar o seu  Registo - It's Raining Tech Blog";
                $conteudotexto = "Registo";
                $conteudoalert = "'Registo confirmado com sucesso!!!!!"; 
                $conteudo = "Obrigado " . $nome ." por ter confirmado o seu registo! <br> Estamos muito feliz em te-lo como nosso membro! <br><br> Com os Melhores Cumprimentos,<br> It's Raining Tech Blog ";
                 mandamail($email,$token,$pnome);
                echo "<script language='javascript' type='text/javascript'>alert('Registo confirmado!!!');window.location.href='login.php'</script>";
            
            }else{
                echo "<script language='javascript' type='text/javascript'>alert('Registo já confirmado!!!');window.location.href='index.php'</script>";
            }
            
        } else {
           
            echo "<script language='javascript' type='text/javascript'>alert('Login ou password invalidos!!!');</script>";
        //$error = "Your Login Name or Password is invalid";
        }

        $stmt->close();

        //echo "<script language='javascript' type='text/javascript'>alert('Login efetuado com sucesso!!!');</script>";
    } catch (Exception $e) {
        if ($conn->errno === 1062) echo "<script language='javascript' type='text/javascript'>alert('Erro no Login!!');window.location.href='../index.php'</script>";

    }


    }

?>