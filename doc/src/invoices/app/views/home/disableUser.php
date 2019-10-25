<!DOCTYPE html>
<html lang="it">
<head>
	<!-- Required meta tags -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Login CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo CSS_URL?>main.css">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo BOOTSTRAP_URL?>css/bootstrap.min.css">
	<!-- Font Awesome JS  -->
	<link rel="stylesheet" type="text/css" href="<?php echo FONTAWESOME_URL?>css/all.css">
	<!-- Navbar CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo CSS_URL?>navbar.css">

	<title>Accesso</title>
</head>

<body class="bg-light">
	<div class"container">
		<nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
			<button class="navbar-toggler"
							type="button"
							data-toggle="collapse"
							data-target="#navbarSupportedContent"
							aria-controls="navbarSupportedContent"
							aria-expanded="false"
							aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">

					<li class="nav-item active">
						<a class="nav-link" href="#">
							<i class="fa fa-file-invoice"></i>
							Fatture
							<span class="sr-only">(current)</span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="#">
							<i class="far fa-address-card"></i>
							Clienti
							<span class="badge badge-danger"></span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="#">
							<i class="fas fa-cubes"></i>
							Prodotti
							<span class="badge badge-warning"></span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="#">
							<i class="fas fa-user-friends"></i>
							Utenti
							<span class="badge badge-warning"></span>
						</a>
					</li>

				</ul>
			</div>
		</nav>

    <div class="row justify-content-center align-self-center">
			<div class="card center personalized-card">
			  <div class="card-body">
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Attenzione!</h4>
            <p>L’accesso non può essere effettuato, perché questo utente non è ancora stato abilitato.<br><hr>
Per contattare l’amministratore si prega di inviare un email all’indirizzo: <strong>administrator@email.com</strong></p>
            <a class="close"  aria-label="Close" href="<?=URL?>home/index">
              <span >&times;</span>
            </a>
          </div>
			  </div>
			</div>
		</div>

	</div>

	<!-- Footer -->
	<footer class="page-footer fixed-bottom font-small ">
		<!-- Copyright -->
		<div class="footer-copyright text-center py-3">© 2019 Copyright:
			<a href="#">Invoices</a>
		</div>
	</footer>

	<!-- jQuery -->
	<script src="<?php echo JQUERY_URL?>"></script>
	<!-- Popper -->
	<script src="<?php echo POPPER_URL?>"></script>
	<!-- Login JS -->
	<script src="<?php echo JS_URL?>login.js"></script>
	<!-- Bootstrap JS -->
	<script src="<?php print BOOTSTRAP_URL?>js/bootstrap.min.js"></script>
	<!-- Font Awesome JS  -->
	<script src="<?php echo FONTAWESOME_URL?>js/all.js"></script>
</body>
</html>
