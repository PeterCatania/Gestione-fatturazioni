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
	<link rel="icon" href="<?= ROOT ?>assets/img/favicon.png" />

	<title>Fatture</title>
</head>

<body class="bg-light">
	<!-- Navigation bar -->
	<nav class="navbar navbar-icon-top navbar-expand navbar-dark bg-dark fixed-top-sm">
		<a class="navbar-brand" href="#">Fatture</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">

				<li class="nav-item">
					<a class="nav-link" href="<?= URL ?>clients/index">
						<i class="far fa-address-card"></i>
						Clienti
						<span class="badge badge-danger"></span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="<?= URL ?>products/index">
						<i class="fas fa-cubes"></i>
						Prodotti
						<span class="badge badge-warning"></span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="<?= URL ?>users/index">
						<i class="fas fa-user-friends"></i>
						Utenti
						<span class="badge badge-warning"></span>
					</a>
				</li>
			</ul>
			<!-- Button Logout -->
			<form class="form-inline my-2 my-lg-0">
				<a href="<?= URL ?>home/logout" class="btn btn-outline-secondary my-2 my-sm-0 text-light border">logout</a>
			</form>
		</div>
	</nav>

	<!-- Invoices Card -->
	<div class"container">
		<div class="row d-flex justify-content-center mt-sm-6">
			<div class="col-md-11 col-xl-10">
				<div class="card card-primary">
					<div class="card-body">
						<!-- Login Form Title-->
						<h2 class="card-title">Fatture</h2>
						<hr class="bg-dark mt-n1">

						<!-- List of invoices -->
						<div class="table-responsive">
							<table class="table table-striped mt-md-4 mt-2" class="col-12">
								<thead class="thead-dark">
									<tr>
										<th scope="col">Tipologia</th>
										<th scope="col">Creata il</th>
										<th scope="col">Pagata il</th>
										<th scope="col">No. Stampe</th>
										<th scope="col">Importo</th>
									</tr>
								</thead>
								<tbody class="f-normal">
									<tr>
										<td>Fattura Legna da ardere per il camino</td>
										<td>20/10/19</td>
										<td>20/10/19</td>
										<td>0</td>
										<td>200 CHF</td>
									</tr>
									<tr>
										<td>Fattura Sega con motore a fusione nuclueare over 9000</td>
										<td>20/11/19</td>
										<td>20/10/19</td>
										<td>1</td>
										<td>100 CHF</td>
									</tr>
									<tr>
										<td>Richiamo Lavabo industriale per la cucina di tomas</td>
										<td>21/10/19</td>
										<td>20/10/19</td>
										<td>2</td>
										<td>120 CHF</td>
									</tr>
								</tbody>
							</table>
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
	<!-- Login JS -->
	<script src="<?php echo JS_URL; ?>login.js"></script>
	<!-- Bootstrap JS -->
	<script src="<?php print BOOTSTRAP_URL; ?>js/bootstrap.min.js"></script>
	<!-- Font Awesome JS  -->
	<script src="<?php echo FONTAWESOME_URL; ?>js/all.js"></script>
</body>

</html>