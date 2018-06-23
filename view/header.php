<?php 
    if(isset($_SESSION["tipo"])){
        if ($_SESSION["tipo"] == 1){ //Usuario
            if (!isset($_SESSION['asada'])){ 
                $menu = "
                <li><a href='?pag=inicio'>Inicio</a></li>
                <li><a href='?pag=usuario/inicio'>Mis trámites</a></li>
                <li><a href='?pag=usuario/inicio'>Noticias</a></li>
                <li><a href='?pag=usuario/inicio'>Trámites</a></li>
                <li><a href='?pag=usuario/inicio'>Sobre Nosotros</a></li>
                <li><a href='?pag=usuario/inicio'>Contáctenos</a></li>";
            }else{
                $menu = "
                <li><a href='?pag=inicio'>Inicio</a></li>
                <li><a href='?pag=usuario/mistramites'>Mis trámites</a></li>
                <li><a href='?pag=usuario/noticias'>Noticias</a></li>
                <li><a href='?pag=usuario/seleccionartramite'>Trámites</a></li>
                <li><a href='?pag=usuario/sobreasada'>Sobre Nosotros</a></li>
                <li><a href='?pag=usuario/contactoCliente'>Contáctenos</a></li>";
            }
        }
        if ($_SESSION["tipo"] == 2){ //Administrador
            $menu = "
                <li><a href='?pag=inicio'>Inicio</a></li>

                 <li><a href='?pag=adm_tramitesPendientes'>Trámites</a> 
                    <ul class='sub-nav'>
                        <li><a href='?pag=adm_crearFormulario'>Crear Trámite</a><li>
                     </ul>
                 <li>
                 <li><a href='#'>Usuarios</a> 
                     <ul class='sub-nav'>
                        <li><a href='?pag=adm_admins'>Administradores</a> <li>
                        <li><a href='?pag=adm_fontaneros'>Fontaneros</a> <li>
                     </ul>
                 <li>
                 <li><a href='?pag=adm_estaAsociacion'>Esta Asociación</a>
                    <ul class='sub-nav'>
                        <li><a href='?pag=adm_juntaDirectiva'>Junta Directiva</a> <li>
                     </ul>
                 <li>
                 <li><a href='?pag=adm_noticias'>Noticias</a> <li>";
        }
        if ($_SESSION["tipo"] == 3){ //Master
            $menu = "
                    <li><a href='?pag=inicio'>Inicio</a></li>
                    <li><a href='?pag=master/master_tramitesPendientes'>Tramites</a></li>
                    <li><a href='?pag=master/fontaneros'>Fontaneros</a></li>
                    <li><a href='?pag=master/administradores'>Administradores</a></li>
                    <li><a href='?pag=master/master'>Master</a></li>
                    <li><a href='?pag=master/nueva_asada'>Crear Asada</a></li>";
        }

    }else{ //SIN LOGIN
        $menu = "<li><a href='index.php'>Inicio</a></li>";
    }
?>
<html>
    <head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Asadas TEC</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="shortcut icon" type="image/x-icon" href="assets/images/isotipo.png">
		<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700,800%7CLato:300,400,700" rel="stylesheet" type="text/css">
		<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="assets/css/font-awesome.css" rel="stylesheet" type="text/css">
		<link href="assets/css/ionicons.css" rel="stylesheet" type="text/css">
		<link href="assets/css/flaticon.css" rel="stylesheet" type="text/css">
		<link href="assets/css/owl.carousel.css" rel="stylesheet" type="text/css">
		<link href="assets/css/mediaelementplayer.css" rel="stylesheet" type="text/css">
		<link href="assets/css/jquery.fancybox.css" rel="stylesheet" type="text/css">
		<script src="assets/js/jquery-1.12.4.min.js" type="text/javascript"></script>




		<link href="assets/css/nav_corporate.css" rel="stylesheet" type="text/css">
		<link href="assets/css/style.css" rel="stylesheet" type="text/css">
		<link href="assets/css/theme-color/default.css" rel="stylesheet" id="theme-color" type="text/css">
        

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://selectize.github.io/selectize.js/css/selectize.default.css" data-theme="default">
    <link rel="stylesheet" href="https://selectize.github.io/selectize.js/css/selectize.bootstrap3.css" data-theme="bootstrap3" disabled="disabled">
    <script src="https://selectize.github.io/selectize.js/js/selectize.js"></script>

	</head>
	<body class="full-intro background--dark">
		<!--loader
		<div id="preloader">
			<div class="sk-circle">
				<div class="sk-circle1 sk-child"></div>
				<div class="sk-circle2 sk-child"></div>
				<div class="sk-circle3 sk-child"></div>
				<div class="sk-circle4 sk-child"></div>
				<div class="sk-circle5 sk-child"></div>
				<div class="sk-circle6 sk-child"></div>
				<div class="sk-circle7 sk-child"></div>
				<div class="sk-circle8 sk-child"></div>
				<div class="sk-circle9 sk-child"></div>
				<div class="sk-circle10 sk-child"></div>
				<div class="sk-circle11 sk-child"></div>
				<div class="sk-circle12 sk-child"></div>
			</div>
		</div>-->
		<!--loader-->
		<!-- Site Wraper -->
		<div class="wrapper">
				<header class="header-area">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-sm-12 col-xs-12">
							<a href="index.php" class="logo"><img src="assets/images/isotipo.png" width="70%"> </a>
						</div>
                        <div class="col-md-9 col-sm-12 col-xs-12">
							<div class="header-contact-info">
								<ul>
									<li>
										<div class="iocn-holder"><span class="fa fa-home"></span></div>
										<div class="text-holder"><h6>Asadas Tec</h6><p>San José, Costa Rica</p></div>
									</li>
									<li>
										<div class="iocn-holder"><span class="fa fa-phone-square"></span></div>
										<div class="text-holder"><h6>Soporte</h6><p>+506 2222-2222</p></div>
									</li>
									<li>
										<div class="iocn-holder"><span class="fa fa-envelope"></span></div>
										<div class="text-holder"><h6>Email</h6><a href="#"><p>info@asadascr.com</p></a></div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</header>
		
			<!--Start mainmenu area-->
			<section class="mainmenu-area">
				<div class="container">
					<div class="mainmenu-bg">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<!--Start mainmenu-->
								<nav class="main-menu">
									<div class="navbar-header">
										<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
											<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
										</button>
									</div>
									<div class="navbar-collapse collapse clearfix">
										<ul class="navigation clearfix">
                                            <?php echo $menu; ?>
										</ul>
										<ul class="mobile-menu clearfix">
								            <?php echo $menu; ?>
										</ul>
									</div>
								</nav>
							</div>
						</div>
						<div class="right-column">
							<div class="right-area">
                                <?php 
                                if(!isset($_SESSION["tipo"])){
                                    echo "<div class='link_btn float_right'><a href='?pag=general/login' class='thm-btn bg-clr1'>Iniciar Session</a></div>";
                                }else{
                                    echo "<div class='link_btn float_right'><a href='?pag=general/salir' class='thm-btn bg-clr1'>Salir</a></div>";
                                }
                                ?>
							</div>
						</div>
					</div>
				</div>
			</section>