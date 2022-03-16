  <?php 
include'conexion.php'; 

         $sql3 = "DELETE FROM reservas WHERE id='".$_GET['delid']."'";

        $query = mysqli_query($conn,$sql3) or die($sql3);

        header("Location: reservas.php");
      ?>