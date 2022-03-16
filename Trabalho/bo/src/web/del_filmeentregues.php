  <?php 
include'conexion.php'; 
   
         $sql4 = "DELETE FROM filmes_entregues WHERE id_filme='".$_GET['delid']."'";

        $query = mysqli_query($conn,$sql4) or die($sql4);



        header("Location: filmes.php")
      
      ?>