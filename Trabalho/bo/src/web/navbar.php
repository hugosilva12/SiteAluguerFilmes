<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
       <?php 
       if(status_login($conn)== true){
        $nome=$_SESSION['name'];
        $img=$_SESSION['img'];
        ?>

        <div class="profile-image">
          <img class="img-xs rounded-circle" src="../assets/Users/<?php echo $img; ?>" alt="profile image">
          <div class="dot-indicator bg-success"></div>
        </div>
        <div class="text-wrapper">
          <p class="profile-name"><?php echo $nome; ?></p>
        </div>

        <?php       
      } ?>
    </a>
  </li>
  <li class="nav-item nav-category">Main Menu</li>
  <?php if(status_login($conn)== true){
    $tipo=$_SESSION['type'];
    if($tipo==1){
      echo '
      <li class="nav-item">
      <a class="nav-link" href="index.php">
      <i class="menu-icon typcn typcn-document-text"></i>
      <span class="menu-title">Users</span>
      </a>
      </li>

      ';}} ?>


      <li class="nav-item">
        <a class="nav-link" href="filmes.php">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title">Filmes</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reservas.php">
          <i class="menu-icon typcn typcn-shopping-bag"></i>
          <span class="menu-title">Reservas</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="categorias.php">
          <i class="menu-icon typcn typcn-shopping-bag"></i>
          <span class="menu-title">Categorias</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="filmes_entregues.php">
          <i class="menu-icon typcn typcn-shopping-bag"></i>
          <span class="menu-title">Filmes Entregues</span>
        </a>
      </li>
    </ul>
  </nav>