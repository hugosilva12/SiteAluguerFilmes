<?php  include 'menu.php'; ?>
<section class="breadcrumb-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb-area-content">
					<h1>Histórico de Alugueres </h1>
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
				<table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th class="th-sm">Nome filme
							</th>
							<th class="th-sm">Data de entrega
							</th>
								<th class="th-sm">Estado
							</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$iduser=$_SESSION['iduser'];
						$sql = "SELECT * FROM reservas WHERE id_user = '$iduser'";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
                    // output data of each row
							while($row = $result->fetch_assoc()) {
								$id_film=  $row['id_user'];
								?>
								<tr>
									<td><?php $filmes=$conn->query("SELECT * FROM filmes");
									if($filmes->num_rows>0){
										
										while($row3=$filmes->fetch_assoc()){
										
											if($row3['id']==$row['id_filme']){echo $row3['titulo'];}   
										}
									}
									?></td>
									<td><?php echo $row['data_fim']; ?></td>

									<td><?php if($row['estado'] == 0){echo 'Por Entregar';} else{ echo'Filme Entregue';} ?> 
								
									<?php
								}

							} else {
								echo "0 results";
							}


							?>
						</tbody>
					</table> 	
				</div >

			</div>
		</div>
	</section><!-- transformers area end -->
	<script type="text/javascript">
 		// Material Design example
 		$(document).ready(function () {
 			$('#dtMaterialDesignExample').DataTable();
 			$('#dtMaterialDesignExample_wrapper').find('label').each(function () {
 				$(this).parent().append($(this).children());
 			});
 			$('#dtMaterialDesignExample_wrapper .dataTables_filter').find('input').each(function () {
 				const $this = $(this);
 				$this.attr("placeholder", "Search");
 				$this.removeClass('form-control-sm');
 			});
 			$('#dtMaterialDesignExample_wrapper .dataTables_length').addClass('d-flex flex-row');
 			$('#dtMaterialDesignExample_wrapper .dataTables_filter').addClass('md-form');
 			$('#dtMaterialDesignExample_wrapper select').removeClass(
 				'custom-select custom-select-sm form-control form-control-sm');
 			$('#dtMaterialDesignExample_wrapper select').addClass('mdb-select');
 			$('#dtMaterialDesignExample_wrapper .mdb-select').materialSelect();
 			$('#dtMaterialDesignExample_wrapper .dataTables_filter').find('label').remove();
 		});
 	</script>

 	<?php  include 'footer.php'; ?>
 </body>

 </html>