  <?php 
include'conexion.php'; 
      

$sql5 = "UPDATE reservas set estado = 1  WHERE id_filme='".$_GET['id_film']."'";

    $query = mysqli_query($conn,$sql5) or die($sql5);

$sql6 = "INSERT INTO filmes_entregues(id_filme) VALUES(".$_GET['id_film'].")" ;

    $query = mysqli_query($conn,$sql6) or die($sql6);


        header("Location: ../reservas.php")
      
      ?>