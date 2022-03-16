
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>BackOffice</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/iconfonts/ionicons/css/ionicons.css">
  <link rel="stylesheet" href="../assets/vendors/iconfonts/typicons/src/font/typicons.css">
  <link rel="stylesheet" href="../assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->

  <!-- inject:css -->
  <link rel="stylesheet" href="../assets/css/shared/style.css">
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../assets/css/demo_1/style.css">
  <!-- End Layout styles -->
  <link rel="shortcut icon" href="../assets/images/favicon.png" />




  <!-- Jquery Core Js -->
  <script src="../assets/jquery/jquery.min.js"></script>
  <!-- sweet alert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <?php
  session_start();
  include'conexion.php';
  include'../../../config/login_config.php';
  include '../../../config/session.php';
  ob_start();
  ?>

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="index.php">
          <img src="../assets/images/logo.svg" alt="logo" /> </a>
          <a class="navbar-brand brand-logo-mini" href="index.php">
            <img src="../assets/images/logo-mini.svg" alt="logo" /> </a>
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-center">
            <ul class="navbar-nav ml-auto">

              <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                 <?php 
                 if(status_login($conn)== true){
                  $nome=$_SESSION['name'];
                  $img=$_SESSION['img'];
                  ?>
                  <img src="../assets/users/<?php echo $img; ?>" alt="logo"  style="width: 50px; height: 50px"/>
                  <?php    


                } ?> </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                  <div class="dropdown-header text-center">
                   <?php 
                   if(status_login($conn)== true){
                    $nome=$_SESSION['name'];
                    $img=$_SESSION['img'];
                    ?>

                    <img class="img-md rounded-circle" src="../assets/users/<?php echo $img; ?>" alt="Profile image">
                    <p class="mb-1 mt-3 font-weight-semibold"><?php echo $nome; ?></p>
                    <?php       
                  } ?>
                </div>  
                <a href="../../../config/logout.php" class="dropdown-item">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->