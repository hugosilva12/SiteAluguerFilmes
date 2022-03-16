<?php

//include('login_config.php');
//session_start();



function  status_login($conn){

    if($_SESSION!= null)
    {
       $user_check = $_SESSION['login_user'];


       $ses_sql = mysqli_query($conn, "Select id,email,img from users where email = '$user_check' ");

       $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

       $login_session = $row['email'];

       if ((!isset($_SESSION['login_user']) == true) && (!isset($_SESSION['password']) == true)  && (!isset($_SESSION['iduser']) == true) and (!isset($_SESSION['type']) == true) && (!isset($_SESSION['img']) == true) ) {
        unset($_SESSION['login_user']);
        unset($_SESSION['password']);
        unset($_SESSION['iduser']);
        unset($_SESSION['name']);
        unset($_SESSION['type']);
        unset($_SESSION['img']);
         session_destroy(); 
        echo "<script language='javascript' type='text/javascript'>alert('Faça Login!!!!');window.location.href='movies.php'</script>";
       
        return false;
        
    } else {
    
        return true;   
    }

}else{
    return false;
}

}

?>
