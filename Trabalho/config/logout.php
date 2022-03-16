<?php

    session_start();
    require "conexion.php";
    
   if(session_destroy()) {
        $hour = time() - 3600;

        setcookie('login_user', $myEmail, $hour);
        setcookie('password', $password, $hour);

        echo "<script language='javascript' type='text/javascript'>alert('Logout efetuado com sucesso!!!!');window.location.href='../movies.php'</script>";
    }

?>