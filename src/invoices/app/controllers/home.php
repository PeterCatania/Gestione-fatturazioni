<?php

/**
 * @author Peter Catania
 * @version 22.10.2019
 *
 * Controller for the login.
 */
class Home extends Controller
{
	/**
	 * Empty constructor.
	 */
	public function __construct()
	{ }

	/**
	 * Method that comunicate with the default page.
	 */
	public function index()
	{
		session_start();

		// The username and the email of the registration form,
		// They will bee printed in their corrispective fields
		$_SESSION['username'] = '';
		$_SESSION['password'] = '';

		/**
		 * Contains names of CSS classes.
		 * This classes indicate if the registration inputs are valid or invalid.
		 * If the input is valid contains: "is-valid"
		 * If the input is not valid contains: "is-invalid"
		 * This variable indicate if the username or the password are valid or not.
		 */
		$_SESSION['usernameOrPasswordCSSValidityClass'] = '';

		// require the default page
		$this->view('home/index');
	}

	/**
	 * Effetuate the login, and redirect to the next view.
	 */
	public function login()
	{
		session_start(); // !important

		// Effetuate the login, if is submit a POST request
		if (isset($_POST['login'])) {
			// Import the Validator Model class, and inizialize a new istance.
			$this->model('Validator');
			$validator = new Validator();

			// get the validated username, from login form
			$username = $validator->validateString($_POST['username']);

			// get the hash of the password, from login form
			$password = hash('sha256', $_POST['password']);

			// the getted field from the registration form are inserted in the Session
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $_POST['password'];

			// Import the LoginModel Model class, and inizialize a new istance.
			$this->model('LoginModel');
			$loginModel = new LoginModel();

			// get the user with the same credentials from the login
			$user = $loginModel->getUserByUsernameAndPassword(
				$username,
				$password
			);

			// if the query have find the user with the login credentials.
			if ($user) {
				// get the first array, in this case is our user
				$user = $user[0];

				// save the user login data in the session
				$_SESSION[USER_SESSION_DATA] = $user;

				// check if the user is enabled or not
				if ($user['enabled'] == 0) {
					unset($_SESSION['usernameOrPasswordCSSValidityClass']);
					$this->view('home/disableUser');
				} else {
					unset($_SESSION['usernameOrPasswordCSSValidityClass']);
					$this->view('invoices/index');
				}
			} else {
				// get the administrator with the same credentials from the login
				$administator = $loginModel->getAdministratorByUsernameAndPassword(
					$username,
					$password
				);

				// if the query have find the administrator with the login credentials
				if ($administator) {
					// get the first array, in this case is the administrator
					$administator = $administator[0];

					// save the administrator data in the session
					$_SESSION[ADMINISTRATOR_SESSION_DATA] = $administator;

					unset($_SESSION['usernameOrPasswordCSSValidityClass']);
					$this->view('invoices/index');
				} else {
					$_SESSION['usernameOrPasswordCSSValidityClass'] = INVALID;
					$this->view('home/index');
				}
			}
		}
	}

	/**
	 * Effetuate the logout
	 */
	public function logout()
	{
		session_start(); // !important

		// unset all saved session variables
		$_SESSION = array();

		// redirect to the default page
		header("Location: " . URL . "home/index");
	}
}
