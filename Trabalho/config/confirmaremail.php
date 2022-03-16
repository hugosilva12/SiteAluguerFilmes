<?php
include 'conexion.php';
include 'logs.php';

if (isset($_GET['token']) && isset($_GET['email'])) {
    
    $token = $_GET['token'];
    $email = $_GET['email'];
    try {
     
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
                
                echo "<script language='javascript' type='text/javascript'>alert('Registo confirmado!!!');window.location.href='../movies.php'</script>";
            
            }else{
                echo "<script language='javascript' type='text/javascript'>alert('Registo já confirmado!!!');window.location.href='../movies.php'</script>";
            }
            
        } else {
           
            echo "<script language='javascript' type='text/javascript'>alert('Erro!!!');</script>";
       
        }

        $stmt->close();

        //echo "<script language='javascript' type='text/javascript'>alert('Login efetuado com sucesso!!!');</script>";
    } catch (Exception $e) {
        if ($conn->errno === 1062) echo "<script language='javascript' type='text/javascript'>alert('Erro no Login!!');window.location.href='../movies.php'</script>";

    }


    }


