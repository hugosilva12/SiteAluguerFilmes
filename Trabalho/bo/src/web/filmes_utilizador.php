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
            <h4 class="card-title">Histórico de Reservas do Utilizador</h4>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th> Imagem </th>
                  <th> id </th>
                  <th> Titulo </th>
                  <th> Categoria </th>
                  <th> Tempo(min) </th>
                  <th> Data de lançamento </th>
                  <th> estado </th>
                  <th> url </th>  
                  <th> Preço </th>
                  <th></th>
     
                </tr>
              </thead>
              <tbody>
                <?php 
                $sql = "SELECT * FROM filmes";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
            

                          $users=$conn->query("SELECT * FROM reservas WHERE id_user = '".$_GET['delid']."'");
                              if($users->num_rows>0){
                                        while($row13=$users->fetch_assoc()){
                                     if($row13['id_filme']==$row['id']){
                                    
                                     
                    ?>
                    <tr>
                      <td class="py-1"> <img src="../assets/filmes/<?php echo $row['img']; ?>" alt="image" /> </td>
                      <td><?php echo $row['id']; ?></td>
                      <td style="white-space: nowrap;text-overflow: ellipsis;width: 100px;display: block;overflow: hidden "><?php echo $row['titulo']; ?></td>
                      <td><?php $categoria=$conn->query("SELECT * FROM categoria");
                      if($categoria->num_rows>0){
                        while($row3=$categoria->fetch_assoc()){
                         if($row3['id']==$row['id_categoria']){echo $row3['categoria'];}   
                       }
                     }
                     ?></td>
                     <td><?php echo $row['tempo']; ?></td>
                     <td><?php echo $row['data_lançamento']; ?></td>
                     <td><?php if($row['estado']==1){
                      echo "Disponivel";
                    } else if($row['estado']==2){
                      echo "Reservado";
                    }?></td>
                    <td style="white-space: nowrap;text-overflow: ellipsis;width: 100px;display: block;overflow: hidden "><?php echo $row['url']; ?></td>


                    <td><?php echo $row['preco']; ?> €</td>


                   
                    </tr>
                    <div id="editfilme<?php echo $row['id']; ?>" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form method="POST"  enctype="multipart/form-data">
                            <div class="modal-header">            
                              <h4 class="modal-title">Editar Filme</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>

                            <div class="modal-body">  
                              <input type="hidden" class="form-control" value="<?php echo $row['id']; ?>" name="id">
                              <div class="form-group">
                                <label>Titulo</label>
                                <input type="text" class="form-control"  name="titulo" value="<?php echo $row['titulo']; ?>" >
                              </div>
                              <div class="form-group">
                                <label>Categoria</label>
                                <div class="form-group">
                                  <select class="form-control form-control-lg" name="categoria" >
                                   <option value="0">-- Please select --</option>
                                   <?php
                                   $categoria=$conn->query("SELECT * FROM categoria");
                                   if($categoria->num_rows>0){
                                    while($row2=$categoria->fetch_assoc()){
                                      ?>
                                      <option <?php if($row2['id']==$row['id_categoria']){ ?> selected <?php } ?> value="<?php echo $row2['id']; ?>"><?php echo $row2['categoria']; ?></option>
                                      <?php
                                    }
                                  }
                                  else{
                                    ?>
                                    <option value="0">Não há categorias disponiveis!</option>
                                    <?php
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label>Tempo(min)</label>
                              <input type="text" class="form-control"  value="<?php echo $row['tempo']; ?>" name="tempo">
                            </div>
                            <div class="form-group">
                              <label>Data lançamento</label>
                              <input type="date" class="form-control"  id="datepicker" value="<?php echo $row['data_lançamento']; ?>" name="data" >
                            </div>
                            <div class="form-group">
                              <label>Estado</label>
                              <div class="form-radio" style="  margin-top: 0px !important; 
                              margin-bottom: 0px !important;">
                              <label class="form-check-label">
                                <input type="radio"  class="form-check-input" name="estado" value="1" <?php if($row['estado'] == 1){echo 'checked';} ?>> Disponivel</label>
                              </div>
                              <div class="form-radio" style="  margin-top: 0px !important; 
                              margin-bottom: 0px !important;">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="estado" value="2" <?php if($row['estado'] == 2){echo 'checked';} ?>> Reservado </label>
                              </div>
                            </div>
                            <div class="form-group">
                              <label>Trailer</label>
                              <input type="text" class="form-control" value="<?php echo $row['url']; ?>"  name="trailer" >
                            </div>
                            <div class="form-group">
                              <label>Descrição</label>
                              <textarea class="form-control" name="descricao"  rows="2" ><?php echo $row['descricao']; ?></textarea>
                            </div>
                            <div class="form-group">
                              <label>Preço</label>
                              <input type="text" class="form-control" min="0" value="<?php echo $row['preco']; ?>" name="preco" >
                            </div>
                            <div class="form-group">
                              <label>Imagem</label>
                              <input type="file" class="form-control"  name="arquivo" >
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
                          $titulo= filter_var($_POST['titulo'], FILTER_SANITIZE_STRING);
                          $cat=filter_var($_POST['categoria'] , FILTER_SANITIZE_NUMBER_INT);
                          $tempo=filter_var($_POST['tempo'], FILTER_SANITIZE_NUMBER_INT);
                          $data=filter_var($_POST['data'], FILTER_SANITIZE_STRING);
                          $estado=filter_var($_POST['estado'], FILTER_SANITIZE_NUMBER_INT);
                          $trailer=filter_var($_POST['trailer'], FILTER_SANITIZE_URL);
                          $descricao=filter_var($_POST['descricao'], FILTER_SANITIZE_STRING);
                          $preco=filter_var($_POST['preco'], FILTER_SANITIZE_NUMBER_FLOAT);
                          $id=filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

                          if($_POST['titulo']!="" && $_POST['categoria']!="" && $_POST['tempo']!="" && $_POST['data']!="" && $_POST['estado']!="" && $_POST['trailer']!="" && $_POST['preco']!="" && $_POST['descricao'] && $id!=""){
                                    if(isset($_FILES['arquivo']['name']) && !empty($_FILES['arquivo']['name'])){//['arquivo']-> name do input da imagem 
                                                              //guardar o nome do ficheiro
                                    $nome=$_FILES['arquivo']['name'];
                                    $arquivo_tmp=$_FILES['arquivo']['tmp_name'];
                                                              //vamos retirar a extensao ao ficheiro para saber se é mesmo uma imagem
                                    $ext=strchr($nome, '.');
                                                              //strchr retira a ultima parte da variavel nome até ao ponto ou seja nome da imagem foto.jpg ele guarda o .jpg
                                                              //vamos colocar em minusculas
                                    $ext=strtolower($ext);
                                                              //verifica se a extensão é válida
                                    if(strstr('.jpg; .jpeg; .png; .gif',$ext)){
                                                                //vamos criar  um novo nome para ter a certeza que nunca se repete
                                      $novonome=md5(microtime()).$ext;
                                                                //vamos definir onde guardar a imagem
                                      $caminho="../assets/filmes/".$novonome;
                                                                //vamos tentar mover a imagem
                                      if(@move_uploaded_file($arquivo_tmp, $caminho)){
                                        if($stmt = $conn->prepare("UPDATE filmes SET titulo = ?, id_categoria = ? ,tempo = ? ,data_lançamento = ? ,estado = ? ,url = ?,descricao= ? ,preco= ?, img= ?  WHERE id = ? ")){
                                          $stmt->bind_param("siisissssi", $titulo, $cat,  $tempo,  $data,  $estado,  $trailer,  $descricao,  $preco, $novonome,  $id);        
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
                                      }
                                    }

                                    else{
                                     if($stmt = $conn->prepare("UPDATE filmes SET titulo = ?, id_categoria = ? ,tempo = ? ,data_lançamento = ? ,estado = ? ,url = ?,descricao= ? ,preco= ? WHERE id = ? ")){

                                      $stmt->bind_param("siisisssi", $titulo, $cat,  $tempo,  $data,  $estado,  $trailer,  $descricao,  $preco,  $id);        
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
                                  }
                                  mysqli_close($conn);
                                }
                                ?>  
                              </div>
                            </div>  
                          </div>
                          <?php 
                          }   
                                       }
                        }
                      }
                      } else {
                        echo "0 results";
                      }
                      ?>

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
                                  <label>Titulo</label>
                                  <input type="text" class="form-control"  name="titulo" >
                                </div>
                                <div class="form-group">
                                  <label>Categoria</label>
                                  <div class="form-group">
                                    <select class="form-control form-control-lg" name="categoria" >
                                     <option value="0">-- Please select --</option>
                                     <?php
                                     $categoria=$conn->query("SELECT * FROM categoria");
                                     if($categoria->num_rows>0){
                                      while($row2=$categoria->fetch_assoc()){
                                        ?>
                                        <option  value="<?php echo $row2['id']; ?>"><?php echo $row2['categoria']; ?></option>
                                        <?php
                                      }
                                    }
                                    else{
                                      ?>
                                      <option value="0">Não há categorias disponiveis!</option>
                                      <?php
                                    }
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Tempo(min)</label>
                                <input type="text" class="form-control"   name="tempo">
                              </div>
                              <div class="form-group">
                                <label>Data lançamento</label>
                                <input type="date" class="form-control" id="datepicker"  name="data" >
                              </div>
                              <div class="form-group">
                                <label>Estado</label>
                                <div class="form-radio" style="  margin-top: 0px !important; 
                                margin-bottom: 0px !important;">
                                <label class="form-check-label">
                                  <input type="radio"  class="form-check-input" name="estado" value="1"> Disponivel</label>
                                </div>
                                <div class="form-radio" style="  margin-top: 0px !important; 
                                margin-bottom: 0px !important;">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="estado" value="2"> Reservado </label>
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Trailer</label>
                                <input type="text" class="form-control"  name="trailer" >
                              </div>
                              <div class="form-group">
                                <label>Descrição</label>
                                <textarea class="form-control" name="descricao" rows="2" ></textarea>
                              </div>

                              <div class="form-group">
                                <label>Preço</label>
                                <input type="text" class="form-control" min="0" name="preco" >
                              </div>

                              <div class="form-group">
                                <label>Imagem</label>
                                <input type="file" class="form-control"  name="arquivo" >
                              </div>

                            </div> 
                            <div class="modal-footer">
                              <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                              <input type="submit"  name="add" class="btn btn-success" value="Add">
                            </div>
                          </form>
                          <?php
                          if(isset($_POST['add'])){
                            $titulo= filter_var($_POST['titulo'], FILTER_SANITIZE_STRING);
                            $cat=filter_var($_POST['categoria'] , FILTER_SANITIZE_NUMBER_INT);
                            $tempo=filter_var($_POST['tempo'], FILTER_SANITIZE_NUMBER_INT);
                            $data=filter_var($_POST['data'], FILTER_SANITIZE_STRING);
                            $estado=filter_var($_POST['estado'], FILTER_SANITIZE_NUMBER_INT);
                            $trailer=filter_var($_POST['trailer'], FILTER_SANITIZE_URL);
                            $descricao=filter_var($_POST['descricao'], FILTER_SANITIZE_STRING);
                            $preco=filter_var($_POST['preco'], FILTER_SANITIZE_NUMBER_FLOAT);

                            if($_POST['titulo']!="" && $_POST['categoria']!="" && $_POST['tempo']!="" && $_POST['data']!="" && $_POST['estado']!="" && $_POST['trailer']!="" && $_POST['descricao']!="" && $_POST['preco']!=""){
                          if(isset($_FILES['arquivo']['name']) && !empty($_FILES['arquivo']['name'])){//['arquivo']-> name do input da imagem |   
                                                    //guardar o nome do ficheiro
                          $nome=$_FILES['arquivo']['name'];
                          $arquivo_tmp=$_FILES['arquivo']['tmp_name'];
                                                    //vamos retirar a extensao ao ficheiro para saber se é mesmo uma imagem
                          $ext=strchr($nome, '.');
                                                    //strchr retira a ultima parte da variavel nome até ao ponto ou seja nome da imagem foto.jpg ele guarda o .jpg
                                                    //vamos colocar em minusculas
                          $ext=strtolower($ext);
                                                    //verifica se a extensão é válida
                          if(strstr('.jpg; .jpeg; .png; .gif',$ext)){
                                                      //vamos criar  um novo nome para ter a certeza que nunca se repete
                            $novonome=md5(microtime()).$ext;
                                                      //vamos definir onde guardar a imagem
                            $caminho="../assets/filmes/".$novonome;
                                                      //vamos tentar mover a imagem

                            if(@move_uploaded_file($arquivo_tmp, $caminho)){

                              if($stmt=$conn->prepare("INSERT INTO filmes (titulo, id_categoria, tempo, data_lançamento, estado,url,descricao,preco,img) VALUES (?,?,?,?,?,?,?,?, ?)")){
                                $stmt->bind_param("siisissss", $titulo, $cat,  $tempo,  $data,  $estado,  $trailer,  $descricao,  $preco, $novonome);    
                                $stmt->execute();
                                $stmt->close();
                                echo "<meta http-equiv='refresh' content='1'>";
                                echo "<script> 
                                swal('Adicionado com sucesso!', 'Nice!', 'success',{
                                  });
                                  </script>";
                                }
                                else {
                                        //Error
                                  wh_log("Prep statment failed: %s\n", $conn->error);
                                }
                              }
                            }
                          }
                        }

                        mysqli_close($conn);
                      }
                      ?>  
                    </div>
                  </div>
                </div>
                <script>
                  function deleteme(delid) {
                    if (confirm("Tem a certeza que quer eliminar?")) {
                     window.location.href='del_filmeentregues.php?delid='+delid+'';
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