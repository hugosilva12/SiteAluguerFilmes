  <?php 
include'conexion.php'; 
      
         $sql4 = "DELETE FROM filmes_alugados WHERE id='".$_GET['delid']."'";

        $query = mysqli_query($conn,$sql4) or die($sql4);

  

        
      
      ?>