<!DOCTYPE html>
<html lang="en">
<?php include'menu.php'; 

include'../../../config/conexion.php';?>
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
            <h4 class="card-title">Utilizadores</h4>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th> Imagem </th>
                  <th> id </th>
                  <th> Nome </th>
                  <th> Apelido </th>
                  <th> Email </th>
                  <th> Morada </th>
                  <th> Código Postal </th>
                  <th> Tipo de Utilizador </th>
                  <th> Estado </th>
                  <th> </th>
                  <th>Filmes</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $filtro = "";
                $filtro = " WHERE nome LIKE '%" . $filtro . "%'";
                $sql = "SELECT * FROM users" . $filtro;
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
    // output data of each row
                  while($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                      <td class="py-1"> <img src="../assets/images/faces-clipart/pic-1.png" alt="image" /> </td>
                      <td ><?php echo $row['id']; ?></td>
                      <td ><?php echo $row['nome']; ?></td>
                      <td><?php echo $row['apelido']; ?></td>
                      <td style="white-space: nowrap;text-overflow: ellipsis;width: 100px;display: block;overflow: hidden "><?php echo $row['email']; ?></td>
                      <td><?php echo $row['codigo_postal']; ?></td>
                      <td style="white-space: nowrap;text-overflow: ellipsis;width: 100px;display: block;overflow: hidden "><?php echo $row['morada']; ?></td>
                      <td><?php if($row['tipo_utilizador']==1){
                        echo "Administrador";
                      } else if($row['tipo_utilizador']==2){
                        echo "Funcionário";
                      }
                      else{
                        echo "Cliente";
                      } ?></td>
                      <td><?php if($row['id_active']==1){
                        echo "Ativo";
                      } else if($row['id_active']==2){
                        echo "Inativo";
                      }?></td>
                      <td> <a href='#editEmployeeModal<?php echo $row['id']; ?>' class="btn btn-warning"  data-toggle='modal'><i class='mdi mdi-account-edit  '  title='Edit'></i></a>
                            


                        <a class="btn btn-danger" onclick="deleteme(<?php echo $row["id"]; ?>)" name="Delete" value="Delete"><i class='mdi mdi-delete  ' style="color: #fff;"  title='Delete'></i></a></td>
                        <td><a class="btn btn-info" onclick="view(<?php echo $row["id"]; ?>)" name="Delete" value="Delete"><i class='mdi mdi-movie  ' style="color: #fff;"  title='Delete'></i></a></td>

                        

                        <div id="editEmployeeModal<?php echo $row['id']; ?>" class="modal fade">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form method="POST">
                                <div class="modal-header">            
                                  <h4 class="modal-title">Editar Utilizador</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>

                                <div class="modal-body">  
                                  <input type="hidden" class="form-control" value="<?php echo $row['id']; ?>" name="id">
                                  <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" value="<?php echo $row['nome']; ?>" name="nome"required>
                                  </div>
                                  <div class="form-group">
                                    <label>Codigo-Postal</label>
                                    <input type="text" class="form-control"  value="<?php echo $row['apelido']; ?>"  name="apelido"required>
                                  </div>
                                  <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control"  value="<?php echo $row['email']; ?>" name="email"required>
                                  </div>
                                  <div class="form-group">
                                    <label>Morada</label>
                                    <input type="text" class="form-control"  value="<?php echo $row['morada']; ?>" name="morada" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Código de Postal</label>
                                    <input type="text" class="form-control" value="<?php echo $row['codigo_postal']; ?>" name="codigo_postal" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Tipo</label>
                                    <div class="form-radio" style="  margin-top: 0px !important; 
                                    margin-bottom: 0px !important;">
                                    <label class="form-check-label">
                                      <input type="radio"  name="tipo_utilizador" value="1" <?php if($row['tipo_utilizador'] == 1){echo 'checked';} ?>> Administrador</label>
                                    </div>
                                    <div class="form-radio" style="  margin-top: 0px !important; 
                                    margin-bottom: 0px !important;">
                                    <label class="form-check-label">
                                      <input type="radio"  name="tipo_utilizador" value="2" <?php if($row['tipo_utilizador'] == 2){echo 'checked';} ?>> Funcionário </label>
                                    </div>
                                    <div class="form-radio" style="  margin-top: 0px !important; 
                                    margin-bottom: 0px !important;">
                                    <label class="form-check-label">
                                      <input type="radio"  name="tipo_utilizador" value="3" <?php if($row['tipo_utilizador'] == 3){echo 'checked';} ?>> Cliente </label>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label>Estado</label>
                                    <div class="form-radio" style="  margin-top: 0px !important; 
                                    margin-bottom: 0px !important;">
                                    <label class="form-check-label">
                                      <input type="radio"  class="form-check-input" name="estado" value="1" <?php if($row['id_active'] == 1){echo 'checked';} ?>> Ativo</label>
                                    </div>
                                    <div class="form-radio" style="  margin-top: 0px !important; 
                                    margin-bottom: 0px !important;">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="estado" value="2" <?php if($row['id_active'] == 2){echo 'checked';} ?>> Inativo </label>
                                    </div>
                                  </div>
                                </div>

                                

                                <div class="modal-footer">
                                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                  <input type="hidden" name="editar" value="editado" />
                                  <input type="submit"  class="btn btn-info" value="Update">
                                </div>
                              </form>

                              <?php
                              if(isset($_POST['editar'])  == 'editado'){

                               $_POST['nome'] = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
                               $_POST['apelido'] = filter_var($_POST['apelido'], FILTER_SANITIZE_STRING);
                               $_POST['morada'] = filter_var( $_POST['morada'], FILTER_SANITIZE_STRING); 
                               $_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                               $_POST['codigo_postal'] = filter_var( $_POST['codigo_postal'], FILTER_SANITIZE_STRING);

                               if($_POST['nome']!="" && $_POST['apelido']!="" && $_POST['morada']!="" && $_POST['email']!="" && $_POST['tipo_utilizador']!="" && $_POST['codigo_postal']!="" && $_POST['id']!=""){

                                if($stmt = $conn->prepare("UPDATE users SET nome = ?, apelido = ?, email= ?,codigo_postal= ?, morada= ?,tipo_utilizador=?,id_active=? WHERE id = ?")){

                                $stmt->bind_param("sssssiii", $_POST['nome'], $_POST['apelido'], $_POST['email'], $_POST['codigo_postal'], $_POST['morada'], $_POST['tipo_utilizador'], $_POST['estado'], $_POST['id']);    
                                $stmt->execute();
                                $stmt->close();
                                echo "<meta http-equiv='refresh' content='1'>";
                                echo "<script> 
                                swal('Editado com sucesso!', 'Nice!', 'success',{
                                  });
                                  </script>";
                                  }
                                  else {
                                      //Error
                                      wh_log("Prep statment failed: %s\n", $conn->error);
                                  }
                                }

                                mysqli_close($conn);
                              }


                              ?>    

                            </div>
                          </div>  
                        </div>

                        <?php
                      }

                    } else {
                      echo "0 results";
                    }


                    ?>
                    <script>
                      function deleteme(delid) {
                        if (confirm("Tem a certeza que quer eliminar?")) {
                         window.location.href='del_user.php?delid='+delid+'';
                         return true;
                       }
                     }

                       function view(delid) {
                
                         window.location.href='filmes_utilizador.php?delid='+delid+'';
                         return true;
                    
                     }
                   </script>

                 </div>
               </tr>
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