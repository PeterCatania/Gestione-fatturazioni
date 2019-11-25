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

	<title>Clienti</title>
</head>

<body class="bg-light">
	<!-- Navigation bar -->
	<nav class="navbar navbar-icon-top navbar-expand navbar-dark bg-dark fixed-top-sm">
		<a class="navbar-brand" href="#">Clienti</a>
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
					<a class="nav-link" href="<?= URL ?>products/index">
						<i class="fas fa-cubes"></i>
						Prodotti
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

	<!-- Invoices Card -->
	<div class"container">
		<div class="row d-flex justify-content-center mt-sm-6">
			<div class="col-md-11 col-xl-10">
				<div class="card card-primary">
					<div class="card-body">
						<!-- Login Form Title-->
						<h2 class="card-title">Clienti</h2>
						<hr class="bg-dark mt-n1">

						<h3 class="mb-4">Nuovo cliente</h3>

						<!-- New Product Form -->
						<form method="POST" action="<?php echo URL; ?>clients/saveClient">
							<!-- 1° Row -->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group mb-3">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="cbCompany" name="cbCompany">
											<label class="custom-control-label" for="cbCompany">Cliente Aziendale</label>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group mb-">
										<label for="companyName" class="mb-n1">
											<p class="h4">Nome Azienda</p>
										</label>
										<input name="companyName" type="text" class="form-control mt-1 shadow-sm
											<?= $_SESSION['companyNameCSSValidityClass'] ?>" value="<?= $_SESSION['companyName'] ?>" disabled>
										<div class="invalid-feedback very-small">
											Inserire il nome dell'azienda, o disabilitare il campo se non necessario
										</div>
									</div>
								</div>
							</div>
							<!-- 2° Row -->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group mb-3">
										<label for="clientName" class="mb-n1">
											<p class="h4">Nome Cliente</p>
										</label>
										<input name="clientName" type="text" class="form-control mt-1 shadow-sm 
										<?= $_SESSION['clientNameCSSValidityClass'] ?>" value="<?= $_SESSION['clientName'] ?>">
										<div class="invalid-feedback very-small">
											Inserire il nome del cliente
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group mb-3">
										<label for="clientSurname" class="mb-n1">
											<p class="h4">Cognome Cliente</p>
										</label>
										<input name="clientSurname" type="text" class="form-control mt-1 shadow-sm
											<?= $_SESSION['clientSurnameCSSValidityClass'] ?>" value="<?= $_SESSION['clientSurname'] ?>">
										<div class="invalid-feedback very-small">
											Inserire il cognome del cliente
										</div>
									</div>
								</div>
							</div>
							<!-- 3° Row -->
							<div class="row">
								<div class="col-md-8">
									<div class="form-group mb-3">
										<label for="street" class="mb-n1">
											<p class="h4">Via</p>
										</label>
										<input name="street" type="text" class="form-control mt-1 shadow-sm 
										<?= $_SESSION['streetCSSValidityClass'] ?>" value="<?= $_SESSION['street'] ?>">
										<div class="invalid-feedback very-small">
											Inserire la via dell'indirizzo del cliente
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group mb-3">
										<label for="houseNo" class="mb-n1">
											<p class="h4">Numero Civico</p>
										</label>
										<input name="houseNo" type="text" class="form-control mt-1 shadow-sm
											<?= $_SESSION['houseNoCSSValidityClass'] ?>" value="<?= $_SESSION['houseNo'] ?>">
										<div class="invalid-feedback very-small">
											Inserire il numero civico dell'indirizzo del cliente
										</div>
									</div>
								</div>
							</div>
							<!-- 4° Row -->
							<div class="row">
								<div class="col-md-8">
									<div class="form-group mb-3">
										<label for="city" class="mb-n1">
											<p class="h4">Città</p>
										</label>
										<input name="city" type="text" class="form-control mt-1 shadow-sm
											<?= $_SESSION['cityCSSValidityClass'] ?>" value="<?= $_SESSION['city'] ?>">
										<div class="invalid-feedback very-small">
											Inserire la citta dell'indirizzo del cliente
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group mb-3">
										<label for="nap" class="mb-n1">
											<p class="h4">NAP</p>
										</label>
										<input name="nap" type="text" class="form-control mt-1 shadow-sm 
										<?= $_SESSION['napCSSValidityClass'] ?>" value="<?= $_SESSION['nap'] ?>">
										<div class="invalid-feedback very-small">
											Inserire il nap dell'indirizzo del cliente
										</div>
									</div>
								</div>
							</div>
							<!-- 5° Row -->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group mb-3">
										<label for="telephone" class="mb-n1">
											<p class="h4">Telefono</p>
										</label>
										<input name="telephone" type="text" class="form-control mt-1 shadow-sm 
										<?= $_SESSION['telephoneCSSValidityClass'] ?>" value="<?= $_SESSION['telephone'] ?>">
										<div class="invalid-feedback very-small">
											Inserire il telefono del cliente
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group mb-3">
										<label for="email" class="mb-n1">
											<p class="h4">Email</p>
										</label>
										<input name="email" type="text" class="form-control mt-1 shadow-sm
											<?= $_SESSION['emailCSSValidityClass'] ?>" value="<?= $_SESSION['email'] ?>">
										<div class="invalid-feedback very-small">
											Inserire l'email del cliente
										</div>
									</div>
								</div>
							</div>
							<!-- Submit -->
							<button type="submit" name="saveClient" class="btn btn-primary">Salva</button>
						</form>

						<hr class="bg-dark mt-4">
						<?php if (!empty($data['clients'])) : ?>
							<!-- List of clients -->
							<div class="table-responsive">
								<table class="table table-striped mt-md-4 mt-2" class="col-12">
									<thead class="thead-dark">
										<tr>
											<th scope="col">Nome</th>
											<th scope="col">Indirizzo</th>
											<th scope="col">Telefono</th>
											<th scope="col">Email</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($data['clients'] as $client) : ?>
											<tr>
												<td>
													<?= $client['clientName'] . ' ' ?>
													<?= $client['clientSurname'] . ' ' ?>
													<?= isset($client['companyName']) ? 'responsabile di ' . $client['companyName'] : '' ?>
												</td>
												<td>
													<?= $client['street'] . ' ' ?>
													<?= $client['houseNo'] . ', ' ?>
													<?= $client['nap'] . ' ' ?>
													<?= $client['city'] . ' ' ?>
												</td>
												<td><?= $client['telephone'] ?></td>
												<td><?= $client['email'] ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						<?php else : ?>
							<p>Non è stato salvato nessun cliente</p>
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