<!DOCTYPE html>
<html lang="it">

<head>
	<!-- Required meta tags -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Login CSS -->
	<link rel="stylesheet" type="text/css" href="<?= CSS_URL ?>main.css">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="<?= BOOTSTRAP_URL ?>css/bootstrap.min.css">
	<!-- Font Awesome JS  -->
	<link rel="stylesheet" type="text/css" href="<?= FONTAWESOME_URL ?>css/all.css">
	<!-- Navbar CSS -->
	<link rel="stylesheet" type="text/css" href="<?= CSS_URL ?>navbar.css">

	<title>Accesso</title>
</head>

<body class="bg-light">
	<div class"container">
		<nav class="navbar navbar-icon-top navbar-expand navbar-dark bg-dark fixed-top-sm">
			<a class="navbar-brand" href="<?= URL ?>home/index">Accesso</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
	</div>
	</nav>

	<div class="row d-flex justify-content-center mt-md-5 mt-lg-6">
		<div class="col-md-8 col-xl-6">
			<div class="card card-primary">
				<div class="card-body">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<h4 class="alert-heading">Attenzione!</h4>
						<p>L’accesso non può essere effettuato, perché questo utente non è ancora stato abilitato.<br>
							<hr>
							Per contattare l’amministratore si prega di inviare un email all’indirizzo: <strong>administrator@email.com</strong></p>
						<a class="close" aria-label="Close" href="<?= URL ?>home/index">
							<span>&times;</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	</div>

	<!-- Footer -->
	<footer class="page-footer fixed-bottom font-small bg-dark">
		<!-- Copyright -->
		<div class="footer-copyright text-center py-1 text-secondary">© 2019 Copyright:
			<a class="text-info active no-underline" href="#">Invoices</a>
		</div>
	</footer>

	<!-- jQuery -->
	<script src="<?php echo JQUERY_URL; ?>"></script>
	<!-- Popper -->
	<script src="<?php echo POPPER_URL; ?>"></script>
	<!-- Bootstrap JS -->
	<script src="<?php print BOOTSTRAP_URL; ?>js/bootstrap.min.js"></script>
	<!-- Font Awesome JS  -->
	<script src="<?php echo FONTAWESOME_URL; ?>js/all.js"></script>
</body>

</html>