<?php  include 'menu.php'; ?>
<section class="breadcrumb-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb-area-content">
					<h1>Detalhes Filme </h1>
				</div>
			</div>
		</div>
	</div>
</section><!-- breadcrumb area end -->
<!-- transformers area start -->
<section class="transformers-area">
	<div class="container">
		<div class="transformers-box">
			<div class="row flexbox-center">
				<?php 
				if(isset($_GET['id_movie'])){
					$sql = "SELECT * FROM filmes WHERE id='".$_GET['id_movie']."'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
// output data of each row
						while($row = $result->fetch_assoc()) {
							?>

							<div class="col-lg-5 text-lg-left text-center">
								<div class="transformers-content">
									<img style="max-width: 100%; height: auto;" src="bo/src/assets/filmes/<?php echo $row['img']; ?>" alt="about" />
									<a href="<?php echo $row['url']; ?>" class="popup-youtube">

										<i class="icofont icofont-ui-play"></i>
									</a>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="transformers-content">
									<form method="POST">
										<h2><?php echo $row['titulo']; ?></h2>
										<ul>
											<li>
												<div class="transformers-left">
													Categoria:
												</div>
												<div class="transformers-right">
													<?php 
													$categoria=$conn->query("SELECT * FROM categoria");
													if($categoria->num_rows>0){
														while($row2=$categoria->fetch_assoc()){
															if($row2['id']==$row['id_categoria']){ 
																?><a ><?php echo $row2['categoria'];?></a><?php  
															}
														}
													} ?>

												</div>
											</li>
											<li>
												<div class="transformers-left">
													Tempo: 
												</div>
												<div class="transformers-right">
													<?php echo $row['tempo'];?> min
												</div>
											</li>
											<li>
												<div class="transformers-left">
													Release:
												</div>
												<div class="transformers-right">
													<?php echo $row['data_lançamento'];?>
												</div>
											</li>
											<?php 
											if(status_login($conn)== true){
												?>
												<li>
													<div class="transformers-left">
														Estado:
													</div>

													<div class="transformers-right">
														<?php if($row['estado']==1){
															echo "<a style='color:green;'>Disponivel</a>";
														} else if($row['estado']==2){
															echo "<a style='color:red;'>Reservado</a>";
														}?>
													</div>
												</li>
											<?php }?>
											<li>
												<div class="transformers-left">
													Lojas:
												</div>
												<div class="transformers-right">
													Porto Movies  |  Braga Town | Faro Seats 
												</div>
											</li>
											<li>
												<li>
													<div class="transformers-left">
														Data de entrega:
													</div>
													<div class="transformers-right">
														<?php 
														$start_date = date("Y-m-d");  
														$date = strtotime($start_date);
														$date = strtotime("+1 week", $date);
														echo date('Y-m-d', $date);
														?>
													</div>
												</li>
												<li>
													<div class="transformers-left">
														Preço:
													</div>
													<div class="transformers-right">
														<?php echo $row['preco'];?> €
													</div>
												</li>
												<li>
													<div class="transformers-left">
														Share:
													</div>
													<div class="transformers-right">
														<a href="#"><i class="icofont icofont-social-facebook"></i></a>
														<a href="#"><i class="icofont icofont-social-twitter"></i></a>
														<a href="#"><i class="icofont icofont-social-google-plus"></i></a>
														<a href="#"><i class="icofont icofont-youtube-play"></i></a>
													</div>
												</li>
												<li>
													<button name="reserva" class="theme-btn" ><i class="icofont icofont-ticket" <?php if( $row['preco']==2){?> disabled <?php }?>></i> Reservar</button>

												</li>
											</ul>
										</form>
									</div>
								</div>
								<div class="details-content">
									<div class="details-overview">
										<h2>Sinopse</h2>
										<p><?php echo $row['descricao'];?></p>
									</div>


								</div>
								<?php 

								if(isset($_POST['reserva'])){
									if(status_login($conn)== true){
										$iduser=$_SESSION['iduser'];
										if($row['estado']==1){ 	

											$start_date = date("Y-m-d");  
											$date = strtotime($start_date);
											$data = strtotime($start_date);
											$date = strtotime("+1 week", $date);
											$id_movie = filter_var($_GET['id_movie'], FILTER_SANITIZE_NUMBER_INT);
											$id_user= filter_var($iduser, FILTER_SANITIZE_NUMBER_INT);
											$preco= filter_var($row['preco'], FILTER_SANITIZE_STRING);
											$date= filter_var($date, FILTER_SANITIZE_STRING);	
											$estado=2;
											
											


											if($stmt3=$conn->prepare("INSERT INTO filmes_alugados (id_user, id_filme, data_fim,preco,data_inicio) VALUES (?,?,?,?,?)")){
												$stmt3->bind_param("iisis", $id_user,$id_movie,date('Y-m-d', $date),$preco,date('Y-m-d',$data));    
												$stmt3->execute();
												$stmt3->close();
												

											}
											else {

                                        //Error
												wh_log("Prep statment failed: %s\n", $conn->error);
											}

											if($stmt5=$conn->prepare("INSERT INTO reservas (id_user,id_filme,preco,data_fim,datareserva) VALUES (?,?,?,?,?)")){
												$stmt5->bind_param("iiiss", $id_user,$id_movie,$preco,date('Y-m-d', $date),date('Y-m-d',$data));   
												$stmt5->execute();
												$stmt5->close();
												echo "<meta http-equiv='refresh' content='1'>";
												echo "<script> 
												swal('Reservado com sucesso!', 'Nice!', 'success',{
													});
													</script>";


												}

												if($stmt2 = $conn->prepare("UPDATE filmes SET estado = ?  WHERE id = ? ")){

													$stmt2->bind_param("ii",  $estado,  $id_movie);        
													$stmt2->execute();
													$stmt2->close();
													
												}
												else {
                                    //Error
													wh_log("Prep statment failed: %s\n", $conn->error);
												}
											}
											

											if($row['estado']==2){ 	
												echo "<script> 
												swal('Filme reservado!', 'Tente novamente noutro dia!', 'error',{
													});
													</script>";
												}
												mysqli_close($conn);
											}
										}
										if(status_login($conn)==false){
											echo "<script> 
											swal('Tem de  fazer login!', 'Faça login!', 'error',{
												});
												</script>";
											}
										}
									} else {
										echo "0 results";
									}	
								}
								?>
							</div >

						</div>
					</div>
				</section><!-- transformers area end -->


				<?php  include 'footer.php'; ?>
			</body>

			</html>