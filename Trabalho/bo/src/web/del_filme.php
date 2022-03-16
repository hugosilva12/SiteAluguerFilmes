  <?php 
include'conexion.php'; 
        $sql1="SELECT img FROM filmes  WHERE id='".$_GET['delid']."'";
         $result = $conn->query($sql1);
  // output data of each row
                  $row = $result->fetch_assoc();
unlink('../assets/filmes/'.$row['img']);

         $sql4 = "DELETE FROM filmes WHERE id='".$_GET['delid']."'";

        $query = mysqli_query($conn,$sql4) or die($sql4);



        header("Location: filmes.php")
      
      ?>