
			<div class="clearfix"></div>
			<!-- Client Logos Section -->
			<section id="client-logos" class="padding ptb-xs-40 wow fadeIn ptb ">
				<div class="container">
					<div class="row pb-30 text-center">
						<div class="col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
							<div class="creative_heading">
								<h2><span>Nuestros</span> Asociados</h2>
							</div>
							<p>
								Cada asada que se une a nuestro movimiento crea un cambio en la percepción de la rapidez de los servicios públicos.
							</p>
						</div>
					</div>

					<div class="owl-carousel client-carousel nf-carousel-theme ">
                    <?php 
                    $sth = mysqli_query($link,"SELECT nombre, logo FROM asada where estado = 1 ");

                    while($r = mysqli_fetch_assoc($sth)) {
                        echo '						
                        <div class="item">
                            <div class="client-logo">
                                <img src="'.$r['logo'].'" alt="'.$r['nombre'].'" />
                            </div>
                        </div>';
                    }
                    ?>
					</div>
				</div>
			</section>
			<section id="blog" class="padding ptb-xs-40  gray-bg new-blog">
				<div class="container">
					<div class="row pb-30 text-center">
						<div class="col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
							<div class="creative_heading">
								<h2><span>Última</span> Noticias</h2>
							</div>
							<p>
								Para nuestros asociados cada actividad es de suma importancia para el mantenimiento y cuido hídrico del cantón.
							</p>
						</div>
					</div>

					<div class="row">
                    <?php 
                        $sth = mysqli_query($link,"SELECT * FROM noticia ORDER by fecha DESC LIMIT 3");
                        while($r = mysqli_fetch_assoc($sth)) {
                            echo '
                            <div class="col-md-4 mb-xs-30 mb-sm-30">
                                <div class="blog-post">
                                    <div class="post-media img-scale">
                                        <img src="'.$r['imagen'].'" alt="">
                                    </div>
                                    <div class="post-meta">
                                        <span>Fecha: '.$r['fecha'].' </span>
                                    </div>
                                    <div class="post-header">
                                        <h4><a href="blog-detail.html">'.$r['titulo'].'</a></h4>
                                    </div>
                                    <div class="post-entry">
                                        <p>
                                            '.substr($r['contenido'], 0, 100).'...
                                        </p>
                                    </div>
                                    <div class="post-more-link pull-left">
                                        <a href="?pag=general/noticia&id='.$r['id_noticia'].'" class="btn-text ">Leer más</a>
                                    </div>
                                </div>
                            </div>';
                        }
                    ?>
					</div>
				</div>
			</section>
			<div class="section-bar ptb-40">
				<div class="container">
					<div class="row text-center light-color">
						<div class="col-sm-4 bg-pic-2 ptb-20 ptb-xs-0">
							<div class="section-bar-text">
								<div class="icon-wrap">
									<span><i class="fa fa-users" aria-hidden="true"></i></span>
								</div>
								<h3 class="heading">Fácil</h3>
								<div class="desc">
									Intuitivo y rápido de activar, has una cuenta y realiza tu solicitud.
								</div>
							</div>
						</div>
						<div class="col-sm-4 bg-pic ptb-20 ptb-xs-0">
							<div class="section-bar-text">
								<div class="icon-wrap color">
									<span><i class="fa fa-money" aria-hidden="true"></i></span>
								</div>
								<h3 class="heading">Rápido</h3>
								<div class="desc">
									Los tiempos de respuesta son mejores, realiza tus tramites desde la comodidad de tu hogar.
								</div>
							</div>

						</div>

						<div class="col-sm-4 bg-pic-2 ptb-20 ptb-xs-0">

							<div class="section-bar-text">
								<div class="icon-wrap">
									<span><i class="fa fa-star" aria-hidden="true"></i></span>
								</div>
								<h3 class="heading">Moderno</h3>
								<div class="desc">
									Digital y sin moverse, puedes realizar los tramites desde tu celular, realizar consultas y más.
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>