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

	<title>Prodotti</title>
</head>

<body class="bg-light">
	<!-- Navigation bar -->
	<nav class="navbar navbar-icon-top navbar-expand navbar-dark bg-dark fixed-top-sm">
		<a class="navbar-brand" href="#">Prodotti</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">

				<li class="nav-item">
					<a class="nav-link" href="<?= URL ?>invoices/index">
						<i class="fas fa-file-invoice"></i>
						Fatture
						<span class="badge badge-warning"></span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="<?= URL ?>clients/index">
						<i class="far fa-address-card"></i>
						Clienti
						<span class="badge badge-danger"></span>
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

	<!-- Products Card -->
	<div class"container">
		<div class="row d-flex justify-content-center mt-sm-6">
			<div class="col-md-11 col-xl-10">
				<div class="card card-primary">
					<div class="card-body">
						<!-- Login Form Title-->
						<h2 class="card-title">Prodotti</h2>
						<hr class="bg-dark mt-n1">

						<h3 class="mb-4">Nuovo prodotto</h3>

						<!-- New Product Form -->
						<form method="POST" action="<?php echo URL; ?>products/saveProduct">
							<div class="row">
								<div class="col-md-5">
									<div class="form-group mb-3">
										<label for="description" class="mb-n1">
											<p class="h4">Descrizione</p>
										</label>
										<input name="description" type="text" class="form-control mt-1 shadow-sm 
										<?= $_SESSION['descriptionCSSValidityClass'] ?>" value="<?= $_SESSION['description'] ?>">
										<div class="invalid-feedback very-small">
											Inserire una descrizione
										</div>
									</div>
								</div>
								<div class="col-md-7">
									<div class="form-group mb-3">
										<label for="price" class="mb-n1">
											<p class="h4">Prezzo</p>
										</label>
										<input name="price" type="number" step="0.01" class="form-control mt-1 shadow-sm
											<?= $_SESSION['priceCSSValidityClass'] ?>" value="<?= $_SESSION['price'] ?>">
										<div class="invalid-feedback very-small">
											Inserire un prezzo
										</div>
									</div>
								</div>
							</div>
							<!-- Submit -->
							<button type="submit" name="saveProduct" class="btn btn-primary">Salva</button>
						</form>

						<hr class="bg-dark mt-4">
						<?php if (!empty($data['products'])) : ?>
							<!-- List of products -->
							<div class="table-responsive">
								<table class="table table-striped mt-md-4 mt-2" class="col-12">
									<thead class="thead-dark">
										<tr>
											<th scope="col">Descrizione</th>
											<th scope="col">Prezzo</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($data['products'] as $product) : ?>
											<tr>
												<td><?= $product['description'] ?></td>
												<td>
													<?php number_format($product['price'], 2);
															echo $product['price']; ?>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						<?php else : ?>
							<p>Non è stato salvato nessun prodotto</p>
						<?php endif; ?>
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