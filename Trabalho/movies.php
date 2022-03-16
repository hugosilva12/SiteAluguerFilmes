
<!DOCTYPE HTML>
<html lang="zxx">
 	
<?php  include 'menu.php'; ?>		
		<!-- breadcrumb area start -->
 
 
		<section class="breadcrumb-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumb-area-content">
							<h1>Filmes</h1>
						</div>
					</div>
				</div>
			</div>
		</section><!-- breadcrumb area end -->
		<!-- portfolio section start -->
		<section class="portfolio-area pt-60">
			<div class="container">
				<div class="row flexbox-center">
					<div class="col-lg-6 text-center text-lg-left">
					    <div class="section-title">
							<h1><i class="icofont icofont-movie"></i></h1>
						</div>
					</div>
				
					<div class="col-lg-6 text-center text-lg-right">
					    <div class="portfolio-menu">
					    		 <?php 
                $sql = "SELECT * FROM filmes";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
  // output data of each row
                  if($row3 = $result->fetch_assoc()) {
                    ?>
							<ul>
								<?php
                                     $categoria=$conn->query("SELECT * FROM categoria");
                                     if($categoria->num_rows>0){
                                      while($row2=$categoria->fetch_assoc()){
                                        ?>
                                        <li  <?php if($row2['id']==$row3['id_categoria']){ ?>  class="active" <?php } ?> data-filter=".<?php echo $row2['categoria']; ?>"> <?php echo $row2['categoria']; ?></li>
                                        <?php
                                      }
                                    }
                                    else{
                                      ?>
                                      <option value="0">Não há categorias disponiveis!</option>
                                      <?php
                                    }
                                    ?>
							</ul>
						</div>
					</div>
					  <?php 
                }
              } else {
                echo "0 results";
              }
              ?>
				</div>
				<hr />
				<div class="row portfolio-item">
					 <?php 
                $sql = "SELECT * FROM filmes";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
  // output data of each row
                  while($row = $result->fetch_assoc()) {
                    ?>
					<div class="col-lg-3 col-md-4 col-sm-6 <?php 
					$categoria=$conn->query("SELECT * FROM categoria");
                                     if($categoria->num_rows>0){
                                      while($row2=$categoria->fetch_assoc()){
                                      	if($row2['id']==$row['id_categoria']){ 
                                        echo $row2['categoria']; 
                                    }
                                      }
                                    } ?>">
						<div class="single-portfolio">
							<div class="single-portfolio-img" style="height: 250px;">
								<img src="bo/src/assets/filmes/<?php echo $row['img']; ?>" alt="portfolio" />
								<a href="<?php echo $row['url']; ?>" class="popup-youtube">
									<i class="icofont icofont-ui-play"></i>
								</a>
							</div>
							<div class="portfolio-content">
								<h2 style="white-space: nowrap;text-overflow: ellipsis;width: 100%;display: block;overflow: hidden "><?php echo $row['titulo']; ?></h2><br/>
								<a href="movie_details.php?id_movie=<?php echo $row['id']; ?>"><button class="btn btn-success" style="margin-left: 20%">Saber mais!</button></a>
							</div>
						</div>
					</div>
					 <?php 
                }
              } else {
                echo "0 results";
              }	
              ?>
				
		
				</div>
			</div>
		</section><!-- portfolio section end -->
		<!-- video section start -->
		<section class="video ptb-90">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
					    <div class="section-title pb-20">
							<h1><i class="icofont icofont-film"></i> Trailers & Videos</h1>
						</div>
					</div>
				</div>
				<hr />
				<div class="row">
                    <div class="col-md-12">
						<div class="video-slider mt-20">
							<div class="video-area">
								<img src="assets/img/video/video2.png" alt="video" />
								<a href="https://www.youtube.com/watch?v=RZXnugbhw_4" class="popup-youtube">
									<i class="icofont icofont-ui-play"></i>
								</a>
							</div>
							<div class="video-area">
								<img src="assets/img/video/video3.png" alt="video" />
								<a href="https://www.youtube.com/watch?v=RZXnugbhw_4" class="popup-youtube">
									<i class="icofont icofont-ui-play"></i>
								</a>
							</div>
							<div class="video-area">
								<img src="assets/img/video/video4.png" alt="video" />
								<a href="https://www.youtube.com/watch?v=RZXnugbhw_4" class="popup-youtube">
									<i class="icofont icofont-ui-play"></i>
								</a>
							</div>
							<div class="video-area">
								<img src="assets/img/video/video5.png" alt="video" />
								<a href="https://www.youtube.com/watch?v=RZXnugbhw_4" class="popup-youtube">
									<i class="icofont icofont-ui-play"></i>
								</a>
							</div>
							<div class="video-area">
								<img src="assets/img/video/video2.png" alt="video" />
								<a href="https://www.youtube.com/watch?v=RZXnugbhw_4" class="popup-youtube">
									<i class="icofont icofont-ui-play"></i>
								</a>
							</div>
							<div class="video-area">
								<img src="assets/img/video/video3.png" alt="video" />
								<a href="https://www.youtube.com/watch?v=RZXnugbhw_4" class="popup-youtube">
									<i class="icofont icofont-ui-play"></i>
								</a>
							</div>
							<div class="video-area">
								<img src="assets/img/video/video4.png" alt="video" />
								<a href="https://www.youtube.com/watch?v=RZXnugbhw_4" class="popup-youtube">
									<i class="icofont icofont-ui-play"></i>
								</a>
							</div>
							<div class="video-area">
								<img src="assets/img/video/video5.png" alt="video" />
								<a href="https://www.youtube.com/watch?v=RZXnugbhw_4" class="popup-youtube">
									<i class="icofont icofont-ui-play"></i>
								</a>
							</div>
						</div>
                    </div>
				</div>
			</div>
		</section><!-- video section end -->
	<?php include 'footer.php';?>
	</body>

</html>