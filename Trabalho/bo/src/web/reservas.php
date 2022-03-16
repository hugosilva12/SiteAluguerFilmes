<!DOCTYPE html>
<html lang="en">
<?php include'menu.php'; 

include'conexion.php';?>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
<?php include'navbar.php'; 
?>
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
       <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Reservas</h4>
              <table class="table table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th> Utilizador </th>
                  <th> Filme </th>
                  <th> Data Entrega </th>
                  <th></th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <?php 
                $sql = "SELECT * FROM reservas";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                                  while($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                      <td ><?php echo $row['id']; ?></td>
                                       <td><?php $users=$conn->query("SELECT * FROM users");
                                      if($users->num_rows>0){
                                        while($row3=$users->fetch_assoc()){
                                         if($row3['id']==$row['id_user']){echo $row3['nome'];}   
                                       }
                                     }
                                     ?></td>
                                     <td><?php $filmes=$conn->query("SELECT * FROM filmes");
                                      if($filmes->num_rows>0){
                                        while($row3=$filmes->fetch_assoc()){
                                         if($row3['id']==$row['id_filme']){echo $row3['titulo'];}   
                                       }
                                     }
                                     ?></td>
                                     <td><?php echo $row['data_fim']; ?></td>
                                      <td> 
                                        <a class="btn btn-danger" onclick="deleteme(<?php echo $row["id"]; ?>)" name="Delete" value="Delete"><i class='mdi mdi-delete  ' style="color: #fff;"  title='Delete'></i></a></td>
                                      <?php
                                    }

                                  } else {
                                    echo "0 results";
                                  }


                                  ?>

                  <script>
                    function deleteme(delreser) {
                      if (confirm("Tem a certeza que quer eliminar?")) {
                       window.location.href='del_reserva.php?delid='+delreser+'';
                       return true;
                     }
                   }
                 </script>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include'footer.php'; ?>


</body>
</html>