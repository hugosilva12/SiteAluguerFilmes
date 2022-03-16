  <?php 
include'conexion.php'; 

     $sql1="SELECT img FROM users  WHERE id='".$_GET['delid']."'";
         $result = $conn->query($sql1);
  // output data of each row
                  $row = $result->fetch_assoc();
unlink('../assets/users/'.$row['img']);

         $sql3 = "DELETE FROM users WHERE id='".$_GET['delid']."'";

        $query = mysqli_query($conn,$sql3) or die($sql3);

        header("Location: index.php")
      ?>