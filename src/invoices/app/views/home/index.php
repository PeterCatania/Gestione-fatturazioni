<!DOCTYPE html>
<html lang="it">
<head>
	<!-- Required meta tags -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="<?= BOOTSTRAP_URL ?>css/bootstrap.min.css">
	<!-- Font Awesome JS  -->
	<link rel="stylesheet" type="text/css" href="<?= FONTAWESOME_URL ?>css/all.css">
	<!-- Navbar CSS -->
	<link rel="stylesheet" type="text/css" href="<?= CSS_URL ?>navbar.css">
	<!-- Main CSS -->
	<link rel="stylesheet" type="text/css" href="<?= CSS_URL ?>main.css">

	<!-- Favicon -->
	<link rel="icon" href="<?= ROOT ?>assets/img/favicon.png"/>

	<title>Accesso</title>
</head>

<body class="bg-light">
	<div class"container">
		<!-- Navigation bar -->
		<nav class="navbar navbar-icon-top navbar-expand navbar-dark bg-dark fixed-top-sm">
			<a class="navbar-brand" href="#">Accesso</a>
			<button class="navbar-toggler"
							type="button"
							data-toggle="collapse"
							data-target="#navbarSupportedContent"
							aria-controls="navbarSupportedContent"
							aria-expanded="false"
							aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			</div>
		</nav>

		<!-- Login Card -->
		<div class="row d-flex justify-content-center mt-sm-6">
	    <div class="col-md-6 col-xl-4">
				<div class="card card-primary">
				  <div class="card-body">
						<!-- Login Form Title-->
						<h2 class="card-title">Accedi<h2>
						<hr class="bg-dark mt-n1">
						<!-- Login Form -->
						<form method="POST" action="<?php echo URL; ?>home/login" autocomplete="on">
							<!-- 1th row -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group mb-3">
										<label for="username" class="mb-n1"><p class="h4">Username</p></label>
									  <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="Username">
									</div>
								</div>
							</div>
							<!-- 2nd row -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group mb-3">
										<label for="password" class="mb-n1"><p class="h4">Password</p></label>
									  <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="Password">
									</div>
								</div>
							</div>
							<!-- Submit -->
							<p class="form-control-static very-small mb-3">Non sei registrato? <a class="text-primary" href="<?= URL ?>registration/index">Crea un account</a></p>
						  <button type="submit" name="login" class="btn btn-primary">Login</button>
						</form>
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
	<script src="<?= JQUERY_URL ?>"></script>
	<!-- Popper -->
	<script src="<?= POPPER_URL ?>"></script>
	<!-- Bootstrap JS -->
	<script src="<?= BOOTSTRAP_URL ?>js/bootstrap.min.js"></script>
	<!-- Font Awesome JS  -->
	<script src="<?= FONTAWESOME_URL ?>js/all.js"></script>
</body>
</html>
