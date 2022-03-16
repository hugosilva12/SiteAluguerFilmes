<?php  include 'menu.php'; ?>
<section class="breadcrumb-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb-area-content">
					<h1>Filmes Não entregues </h1>
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
							<th class="th-sm">Terminar aluger
							</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$iduser=$_SESSION['iduser'];
						$sql = "SELECT * FROM filmes_alugados WHERE id_user = '$iduser'";
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
									<td >   <a class="btn btn-danger" onclick="deleteme(<?php echo $row["id"]; ?>,<?php echo $row["id_filme"]; ?>)" name="Delete" value="Delete"> Finalizar Aluguer</a></td>
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
	<script>
                      function deleteme(delid,id_film) {
                        if (confirm("Tem a certeza que pretende entregar o filme?")) {

                         window.location.href='config/del_filme.php?delid='+delid+'';
                         
                         window.location.href='config/update_film.php?id_film='+id_film+'';
                       
                         return true;
                       }
                     }
                   </script>
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