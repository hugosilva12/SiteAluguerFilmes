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
            <h4 class="card-title">Categorias</h4>
                 <h4 class="card-title">Adicionar Categorias</h4><a href='#addMovie' class="btn btn-success"  data-toggle='modal'><i class='mdi mdi-plus-circle  '  title='Add'></i></a>
              <table class="table table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th> Nome </th>
                 
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <?php 
                $sql = "SELECT * FROM categoria";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                                  while($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                      <td ><?php echo $row['id']; ?></td>
                                       <td ><?php echo $row['categoria']; ?></td>
                                     <td><?php $filmes=$conn->query("SELECT * FROM filmes");
                                      if($filmes->num_rows>0){
                                        while($row3=$filmes->fetch_assoc()){
                                         if($row3['id']==$row['id']){echo $row3['categoria'];}   
                                       }
                                     }
                                     ?></td>
                                  
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
                       window.location.href='del_categoria.php?delid='+delreser+'';
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
     <div id="addMovie" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form method="post" enctype="multipart/form-data">
                              <div class="modal-header">            
                                <h4 class="modal-title">Adicionar Filmes</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              </div>

                              <div class="modal-body">  
                                <div class="form-group">
                                  <label>Nome da categoria</label>
                                  <input type="text" class="form-control"  name="titulo" >
                                </div>
                                
                             
                               
                             
                           

                            </div> 
                            <div class="modal-footer">
                              <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                              <input type="submit"  name="add" class="btn btn-success" value="Add">
                            </div>
                          </form>
                          <?php
                          if(isset($_POST['add'])){
                            $nome= filter_var($_POST['titulo'], FILTER_SANITIZE_STRING);
                            

                            
                          

                                $stmt=$conn->prepare("INSERT INTO categoria (categoria) VALUES (?)");
                                $stmt->bind_param("s", $nome );    
                                $stmt->execute();
                                $stmt->close();
                                echo "<meta http-equiv='refresh' content='1'>";
                                echo "<script> 
                                swal('Adicionado com sucesso!', 'Nice!', 'success',{
                                  });
                                  </script>";
                                
                          
                          
                          }
                     

                        mysqli_close($conn);
                   
                      ?>  
                    </div>
                  </div>
                </div>
<?php include'footer.php'; ?>


</body>
</html>