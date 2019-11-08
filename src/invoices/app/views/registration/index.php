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

	<title>Registrazione</title>
</head>

<body class="bg-light">
	<div class"container">
		<!-- Navigation bar -->
		<nav class="navbar navbar-icon-top navbar-expand navbar-dark bg-dark fixed-top-sm">
			<a class="navbar-brand" href="#">Registrazione</a>
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

		<!-- Registration Card -->
		<div class="row d-flex justify-content-center mt-sm-6">
	    <div class="col-md-8 col-xl-6">
				<div class="card card-primary">
				  <div class="card-body">
						<!-- Registration Form Title-->
						<h2 class="mb-4">Registrati<h2>
						<hr class="bg-dark mt-n1">
						<!-- Registration Form -->
						<form method="POST" action="<?php echo URL; ?>registration/register">
							<!-- 1th row -->
							<div class="row">
								<div class="col-md-5">
		            	<div class="form-group mb-3">
			              <label for="username" class="mb-n1"><p class="h4">Nome Utente</p></label>
			              <input
											name="username"
											type="text"
											class="form-control mt-1 shadow-sm
												<?= $_SESSION['usernameCSSValidityClass'] ?>"
											value="<?= $_SESSION['username'] ?>">
										<div class="invalid-feedback very-small">
						        	Inserire un nome utente
						        </div>
		            	</div>
								</div>
								<div class="col-md-7">
			            <div class="form-group mb-3">
			              <label for="email" class="mb-n1"><p class="h4">Email</p></label>
			              <input
											name="email"
											type="mail"
											class="form-control mt-1 shadow-sm
												<?= $_SESSION['emailCSSValidityClass'] ?>"
											value="<?= $_SESSION['email'] ?>">
										<div class="invalid-feedback very-small">
						        	Inserire un email
						        </div>
			            </div>
								</div>
							</div>
							<!-- 2th row -->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group mb-3">
										<label for="password" class="mb-n1"><p class="h4">Password</p></label>
									  <input
											name="password"
											type="password"
											class="form-control mt-1 shadow-sm
												<?= $_SESSION['passwordCSSValidityClass'] ?>"
												value="<?= $_SESSION['password'] ?>">
										<div class="invalid-feedback very-small">
						        	Inserire una password
						        </div>
									</div>
								</div>
								<div class="col-md-6">
			            <div class="form-group mb-3">
										<label for="confirmedPassword" class="mb-n1"><p class="h4">Conferma Password</p></label>
									  <input
											name="confirmedPassword"
											type="password"
											class="form-control mt-1 shadow-sm
												<?= $_SESSION['confirmedPasswordCSSValidityClass'] ?>"
												value="<?= $_SESSION['confirmedPassword'] ?>">
										<div class="invalid-feedback very-small">
						        	Inserire la stessa password
						        </div>
									</div>
								</div>
							</div>
							<!-- Submit -->
							<p class="form-control-static very-small mb-3"><a class="text-primary" href="<?= URL ?>home/index">Ho già un account</a></p>
						  <button type="submit" name="register" class="btn btn-primary">Registrati</button>
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
