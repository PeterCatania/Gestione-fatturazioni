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
     * Show the view of the controller.
     */
    function showView(){
        $this->header('Login', $this->controllerName);
        $this->view('home/index');
        $this->footer();
    }

	/**
	 * Method that comunicate with the default page.
	 */
	public function index()
	{
		session_start();

		// The username and the email of the registration form,
		// They will bee printed in their corrispettive fields
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
        $this->showView();
	}

	public function disableUser(){
        $this->header('Login', $this->controllerName);
        $this->view('home/disableUser');
        $this->footer();
    }

	/**
	 * Effectuate the login, and redirect to the next view.
	 */
	public function login()
	{
		session_start(); // !important

		// Effectuate the login, if is submit a POST request
		if (isset($_POST['login'])) {
			// Import the Validator Model class, and initialize a new instance.
			$validator = $this->model('Validator');

			// get the validated username, from login form
			$username = $validator->validateString($_POST['username']);

			// get the hash of the password, from login form
            $password = hash(
                'sha256',
                $validator->generalValidation($_POST['password'])
            );

			// the get field from the registration form are inserted in the Session
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $_POST['password'];

			// Import the LoginModel Model class, and initialize a new instance.
			$loginModel = $this->model('LoginModel');

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
					print_r('aa'.$user);
                    //$this->redirectToPage('home','disableUser');
				} else {
					unset($_SESSION['usernameOrPasswordCSSValidityClass']);
                    //$this->redirectToPage('invoices');
                    print_r('ee'.$user);
				}
			} else {
				// get the administrator with the same credentials from the login
				$administrator = $loginModel->getAdministratorByUsernameAndPassword(
					$username,
					$password
				);

				// if the query have find the administrator with the login credentials
				if ($administrator) {
					// get the first array, in this case is the administrator
					$administrator = $administrator[0];

					// save the administrator data in the session
					$_SESSION[ADMINISTRATOR_SESSION_DATA] = $administrator;

					unset($_SESSION['usernameOrPasswordCSSValidityClass']);
					$this->redirectToPage('invoices');
				} else {
					$_SESSION['usernameOrPasswordCSSValidityClass'] = INVALID;
                    //$this->redirectToPage('home');
                    print_r($user);
                    print_r($administrator);
				}
			}
		}
	}

	/**
	 * Effectuate the logout
	 */
	public function logout()
	{
		session_start(); // !important

		// unset all saved session variables
		$_SESSION = array();

		// redirect to the default page
        $this->redirectToPage('home');
	}
}
