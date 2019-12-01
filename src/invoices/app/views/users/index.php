<!DOCTYPE html>
<html lang="it">

<head>
	<!-- Required meta tags -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="<?= BOOTSTRAP_URL ?>css/bootstrap.min.css">
	<!-- Font Awesome CSS  -->
	<link rel="stylesheet" type="text/css" href="<?= FONTAWESOME_URL ?>css/all.css">
	<!-- Flat UI CSS  -->
	<link rel="stylesheet" type="text/css" href="<?= FLATUI_URL ?>dist/css/flat-ui.css">
	<!-- Main CSS -->
	<link rel="stylesheet" type="text/css" href="<?= CSS_URL ?>main.css">
	<link rel="stylesheet" type="text/svg+xml" href="<?= FLATUI_GLYPS ?>flat-ui-pro-icons-regular.svg">

	<!-- Favicon -->
	<link rel="icon" href="<?= ROOT ?>assets/img/favicon.png" />

	<title>Utenti</title>
</head>

<body class="bg-cloud">
	<!-- Navigation bar -->
	<nav class="navbar navbar-inverse navbar-expand-md fixed-top-sm custom-navbar" role="navigation">
		<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-01"></button>
		<div class="collapse navbar-collapse" id="navbar-collapse-01">
			<ul class="nav navbar-nav mr-auto">
				<li><a href="<?= URL ?>invoices/index">Fatture</a></li>
				<li class="active"><a href="#">Utenti</a></li>
				<li><a href="<?= URL ?>clients/index">Clienti</a></li>
				<li><a href="<?= URL ?>products/index">Prodotti</a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
		<!-- Logout Button -->
		<form class="form-inline mr-2" method="POST" action="<?= URL ?>home/logout">
			<button class="btn btn-primary navbar-btn mr-2 text-capitalize" type="submit" name="logout">Logout</button>
		</form>
	</nav>

	<!-- Invoices Card -->
	<div class"container">
		<div class="row d-flex justify-content-center mt-sm-6 ">
			<div class="col-md-11 col-xl-10">
				<div class="card card-primary border-0">
					<div class="card-body px-4">
						<!-- Login Form Title-->
						<h2 class="card-title">Utenti</h2>

						<div class="container mb-5 mt-5">
							<div class="row justify-content-md-center">
								<div class="col-md-11 section-form px-4 pb-4">
									<h4 class="underlined-title">Nuovo Utente</h4>

									<!-- New User Form -->
									<form method="POST" action="<?php echo URL; ?>users/saveUser">
										<!-- 1th row -->
										<div class="row">
											<div class="col-md-5">
												<div class="form-group mb-3">
													<label for="username" class="mb-n1">
														<p class="h6">Nome Utente</p>
													</label>
													<input name="username" type="text" class="form-control mt-1 shadow-sm
												<?= $_SESSION['usernameCSSValidityClass'] ?>" value="<?= $_SESSION['username'] ?>">
													<div class="invalid-feedback very-small">
														Inserire un nome utente
													</div>
												</div>
											</div>
											<div class="col-md-7">
												<div class="form-group mb-3">
													<label for="email" class="mb-n1">
														<p class="h6">Email</p>
													</label>
													<input name="email" type="mail" class="form-control mt-1 shadow-sm
												<?= $_SESSION['emailCSSValidityClass'] ?>" value="<?= $_SESSION['email'] ?>">
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
													<label for="password" class="mb-n1">
														<p class="h6">Password</p>
													</label>
													<input name="password" type="password" class="form-control mt-1 shadow-sm
												<?= $_SESSION['passwordCSSValidityClass'] ?>" value="<?= $_SESSION['password'] ?>">
													<div class="invalid-feedback very-small">
														Inserire una password
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group mb-3">
													<label for="confirmedPassword" class="mb-n1">
														<p class="h6">Conferma Password</p>
													</label>
													<input name="confirmedPassword" type="password" class="form-control mt-1 shadow-sm
												<?= $_SESSION['confirmedPasswordCSSValidityClass'] ?>" value="<?= $_SESSION['confirmedPassword'] ?>">
													<div class="invalid-feedback very-small">
														Inserire la stessa password
													</div>
												</div>
											</div>
										</div>
										<!-- Submit -->
										<button class="btn btn-primary btn-wide" type="submit" name="saveUser">Aggiungi</button>
									</form>
								</div>
							</div>
						</div>

						<h3 class="mb-3 underlined-title">Lista Utenti</h3>

						<!-- List of users -->
						<form method="POST" action="<?php echo URL; ?>users/updateUsers">
							<button class="btn btn-primary btn-wide mr-1" type="submit" name="saveUsers"><i class="far fa-save fa-lg mr-2"></i>Salva Tutto</button>
							<button class="btn btn-primary btn-wide" type="button" name="saveUsers"><i class="far fa-edit fa-lg mr-2"></i>Modifica Tutto</button>
							<div class="table-responsive">
								<table class="table table-striped mt-md-3 mt-1 ty-align" class="col-12">
									<thead class="thead-midnight-blue">
										<tr>
											<th class="d-none">Id</th>
											<th scope="col">Nome Utente</th>
											<th scope="col">Email</th>
											<th class="text-center pl-4" scope="col">Abilitato</th>
											<th class="text-right" scope="col"></th>
										</tr>
									</thead>
									<?php if ($data['users']->count() > 0) : ?>
										<tbody>
											<?php foreach ($data['users'] as $user) : ?>
												<tr>
													<td class="d-none"><input class="<?= "user-" . $user->getId() . "-field" ?>" name="ids[]" value="<?= $user->getId() ?>" disabled></td>
													<td><input class="input-table form-control input-sm <?= "user-" . $user->getId() . "-field" ?>" type="text" name="usernames[]" value="<?= $user->getUsername() ?>" disabled></td>
													<td><input class="input-table form-control input-sm <?= "user-" . $user->getId() . "-field" ?>" type="text" name="emails[]" value="<?= $user->getEmail() ?>" disabled></td>
													<td>
														<div class="row justify-content-center">
															<label class="checkbox p-0" for="enabled<?= $user->getId() ?>">
																<input type="checkbox" name="usersIdToEnable[]" id="enabled<?= $user->getId() ?>" data-toggle="checkbox" value="<?= $user->getId() ?>" <?= $user->getEnabled() ? 'checked' : '' ?>>
															</label>
														</div>
													</td>
													<td class="text-right pl-0">
														<div class="btn-group">
															<button class="btn-icon icon-save mr-2" type="submit" name="updateUser" value="<?= $user->getId() ?>">
																<i class="far fa-save fa-lg btn-icon-src"></i>
															</button>
															<button class="btn-icon icon-modify mr-2" type="button" name="modifyUser" value="<?= $user->getId() ?>">
																<i class=" far fa-edit fa-lg btn-icon-src"></i>
															</button>
															<button class="btn-icon icon-delete" type="submit" name="deleteUser" value="<?= $user->getId() ?>">
																<i class="far fa-trash-alt fa-lg btn-icon-src"></i>
															</button>
														</div>
													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									<?php else : ?>
										<tbody>
											<td colspan="4">
												<p class="h6">Non ci sono utenti da abilitare</p>
											</td>
										</tbody>
									<?php endif; ?>
								</table>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<footer class="page-footer fixed-bottom font-small bg-dark">
		<!-- Copyright -->
		<div class="footer-copyright text-center py-1 text-secondary">
			© 2019 Copyright:
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
	<!-- Flat UI JS  -->
	<script src="<?php echo FLATUI_URL; ?>docs/assets/js/application.js"></script>
	<script src="<?php echo FLATUI_URL; ?>docs/assets/js/prettify.js"></script>
	<script src="<?php echo FLATUI_URL; ?>app/scripts/flat-ui.js"></script>
	<!-- Main JS -->
	<script src="<?php echo JS_URL; ?>main.js"></script>
</body>

</html>