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
	{
	}

	/**
	 * Method that comunicate with the default page.
	 */
	public function index()
	{
		// require the default page
		$this->view('home/index');
	}

	/**
	 * Effetuate the login, and redirect to the next view.
	 */
	public function login()
	{
		session_start();
		// Effetuate the login, if is submit a POST request
		if (isset($_POST['login'])) {
			// Import the Validator Model class, and inizialize a new istance.
			$this->model('Validator');
			$validator = new Validator();

			// get the validated username, and the hash of the password, from login form
			$username = $validator->validateString($_POST['username']);
			$password = hash('sha256', $_POST['password']);

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

				if ($user['enabled'] == 0) {
					$this->view('home/disableUser');
				} else {
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

					$this->view('invoices/index');
				} else {
				}
			}
		}
	}

	/**
	 * Effetuate the logout
	 */
	public function logout()
	{
		// unset all saved session variables
		$_SESSION = array();

		// require the default page
		$this->view('home/index');
	}
}
