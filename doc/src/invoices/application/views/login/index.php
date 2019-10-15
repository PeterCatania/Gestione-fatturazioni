<!DOCTYPE html>
<html lang="it">
	<head>
		<!-- Required meta tags -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Login CSS -->
		<link rel="stylesheet" type="text/css" href="/invoices/application/assets/css/login.css">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="/invoices/application/assets/vendor/bootstrap/4.3.1/css/bootstrap.min.css">

		<title>Login</title>
	</head>

	<body>
		<div class="login-page">
  		<div class="form">
				<!-- Login Form-->
				<form class="login-form" method="POST" action="<?php echo URL; ?>login/logIn">
					<input type="text" placeholder="username"/>
					<input type="password" placeholder="password"/>
					<button>login</button>
					<p class="message">Not registered? <a href="#">Create an account</a></p>
				</form>
			</div>
		</div>

		<!-- jQuery -->
		<script src="/invoices/application/assets/vendor/jquery/jquery-3.4.1.min.js"></script>
		<!-- Popper -->
		<script src="/invoices/application/assets/vendor/popper/popper.min.js"></script>
		<!-- Login JS -->
		<script src="/invoices/application/assets/js/login.js"></script>
		<!-- Bootstrap JS -->
		<script src="/invoices/application/assets/vendor/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	</body>
</html>
