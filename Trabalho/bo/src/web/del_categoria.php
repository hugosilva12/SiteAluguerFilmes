  <?php 
  include'conexion.php'; 

  $stmt = $conn->prepare("DELETE FROM categoria WHERE id = ?;");
  $stmt->bind_param("i", $_GET['delid']);
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt->close();


  header("Location: categorias.php");
  ?>

  