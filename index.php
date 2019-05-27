<!DOCTYPE HTML>
<!--
	Aesthetic by gettemplates.co
	Twitter: http://twitter.com/gettemplateco
	URL: http://gettemplates.co
-->
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cantina DiSabores</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="Lucas César" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="images/favicon/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="images/favicon/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="images/favicon/manifest.json">
	<link rel="mask-icon" href="images/favicon/safari-pinned-tab.svg" color="#f19e87">
	<meta name="theme-color" content="#ffffff">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Anton|Great+Vibes|Montserrat|Quicksand" rel="stylesheet">

	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Bootstrap DateTimePicker -->
	<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div class="gtco-loader"></div>
	
	<div id="page">

	
	<!-- <div class="page-inner"> -->
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="inicio" class="cursive-font"></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li><a href="#gtco-subscribe">Contato</a></li>
						<li class="btn-cta"><a href="cliente/"><span>Área do cliente</span></a></li>
					</ul>	
				</div>
			</div>
			
		</div>
	</nav>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/img_bg_1.jpg)" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">		
					<div class="row row-mt-15em">
						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<h1 class="cursive-font">DiSabores</h1>	
						</div>
						<div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3 class="cursive-font">Área do cliente</h3>
											<form action="cliente/entrar.php" method="post">
												<div class="row form-group">
													<div class="col-md-12">
														<label for="date-start">Usuário</label>
														<input name="email" type="text" id="user" class="form-control">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<label for="date-start">Senha</label>
														<input name="senha" type="password" id="password" class="form-control">
													</div>
												</div>

												<div class="row form-group">
													<div class="col-md-12">
														<input type="submit" class="btn btn-primary btn-block" value="Entrar">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<a href="http://disabores.com.br/cliente/recoverpw.php" style="color: white;text-decoration: underline;">Esqueceu sua senha?</a>
													</div>
												</div>
											</form>	
										</div>										
									</div>
								</div>
							</div>
						</div>
					</div>		
				</div>
			</div>
		</div>
	</header>	
	
	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2 class="cursive-font primary-color">Cardápio Semanal</h2>
				</div>
			</div>
			<div class="row">				
				<?php
	                require_once './_connect/connect_pdo.php';
	                $dbh = Database::conexao();

	                $stmt = $dbh->prepare('SELECT * FROM cardapio');
	                $stmt->execute();

	                foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
	                    echo '
	                    <div class="col-lg-4 col-md-4 col-sm-6">
							<a href="#" class="fh5co-card-item">
								<figure>
									<div class="overlay"><i class="ti-plus"></i></div>
									<img src="images/'.$row["dia"].'.png" alt="Image" class="img-responsive">
								</figure>
								<div class="fh5co-text">
									<p>'.$row["cardapio"].'</p>
								</div>
							</a>
						</div>';
	                }
	            
				?>

			</div>
		</div>
	</div>
	
	<div id="gtco-subscribe">
		<div class="gtco-container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2 class="cursive-font">Contato</h2>
					<p>Preencha os dados abaixo para nos enviar sua mensagem.</p>
				</div>
			</div>
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2">
					<form method="post" id="contato-SaveForm" action="#" role="form">
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Nome</label>
								<input type="text" name="nome" id="name" class="form-control" placeholder="Insira seu nome completo">
							</div>							
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="email">E-mail</label>
								<input type="text" name="email" id="email" class="form-control" placeholder="Insira seu e-mail">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="message">Mensagem</label>
								<textarea name="mensagem" id="message" cols="30" rows="10" class="form-control" placeholder="Mensagem"></textarea>
							</div>
						</div>
						<div class="form-group">
							<input type="submit" value="Enviar contato" class="btn btn-primary">
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

	<footer id="gtco-footer" role="contentinfo" style="background-image: url(images/img_bg_1.jpg)" data-stellar-background-ratio="0.9">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row row-pb-md">
				
				<div class="col-md-12 text-center">
					<div class="gtco-widget">
						<h3>Dados de contato</h3>
						<ul class="gtco-quick-contact">
							<li style="color: white;"><a href="#"><i class="icon-phone"></i> Ramal 100</a></li>
							<li><a href="mailto:contato@disabores.com.br"><i class="icon-mail2"></i> contato@disabores.com.br</a></li>
						</ul>
					</div>
				</div>

				<div class="col-md-12 text-center copyright">
					<p><small class="block">&copy; 2018. Cantina DiSabores todos os diretos reservados.</small></p>
				</div>

			</div>

			

		</div>
	</footer>
	<!-- </div> -->

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>

	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>

	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	
	<script src="js/moment.min.js"></script>
	<script src="js/bootstrap-datetimepicker.min.js"></script>

	<script src="forms/js/cliente_form.js"></script>
	<!--  Notifications Plugin    -->
	<script src="app/assets/js/bootstrap-notify.js"></script>
	<!--  Notifications Plugin    -->
	<script src="app/assets/js/notify.js"></script>


	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>

