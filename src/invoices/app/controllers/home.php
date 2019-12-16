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
	private function showView()
	{
		$this->header('Login', $this->controllerName);
		$this->view('home/index');
		$this->footer();
	}

    /**
     * Unset the session variables required for the default page of the controller.
     */
	private function unsetDefaultPageSessionVariables(){
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['usernameCSSValidityClass']);
        unset($_SESSION['passwordCSSValidityClass']);
        unset($_SESSION['usernameOrPasswordCSSValidityClass']);
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
		$_SESSION['usernameCSSValidityClass'] = '';
		$_SESSION['passwordCSSValidityClass'] = '';
		$_SESSION['usernameOrPasswordCSSValidityClass'] = '';

		// require the default page
		$this->showView();
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
				$_POST['password']
			);

			// the get field from the registration form are inserted in the Session
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $validator->generalValidation($_POST['password']);

			// tell if all the fields are valid
			$allFieldAreValid = true;

			// verify if the fields values are valid
			$allFieldAreValid = $validator->isNameFieldValid($username, 'username') ? $allFieldAreValid : false;

			// verify if the passwords are valid
			$allFieldAreValid = $validator->isPasswordsValueValid(
				$password,
				$_POST['password'],
				'password'
			) ? $allFieldAreValid : false;

			if ($allFieldAreValid) {

				// Import models
				$userModel = $this->model('UserModel');
				$administratorModel = $this->model('AdministratorModel');

				// get the user with the same credentials from the login
				$user = $userModel->getUserByUsernamePassword(
					$username,
					$password
				);

				// if the query have find the user with the login credentials.
				if ($user) {

					// save the user login data in the session
					$_SESSION[USER_SESSION_DATA] = $user;

					// check if the user is enabled or not
					if ($user->getEnabled()) {
                        $this->unsetDefaultPageSessionVariables();
						$this->redirectToPage('invoices');
					} else {
						unset($_SESSION['usernameOrPasswordCSSValidityClass']);
                        $this->unsetDefaultPageSessionVariables();
						$this->redirectToPage('home', 'disableUser');
					}
				} else {
					// get the administrator with the same credentials from the login
					$administrator = $administratorModel->getAdministratorByUsernamePassword(
						$username,
						$password
					);

					// if the query have find the administrator with the login credentials
					if ($administrator) {

						// save the administrator data in the session
						$_SESSION[ADMINISTRATOR_SESSION_DATA] = $administrator;

						unset($_SESSION['usernameOrPasswordCSSValidityClass']);
                        $this->unsetDefaultPageSessionVariables();
						$this->redirectToPage('invoices');
					} else {
						$_SESSION['usernameOrPasswordCSSValidityClass'] = INVALID;
						$this->showView();
					}
				}
			} else {
				$this->showView();
			}
		}
	}

	/**
	 * Show the message of user disabled.
	 */
	public function disableUser()
	{
        session_start(); // !important

        // prevents that anyone that is not logged enter this page
        $this->redirectToHomePageIfAnyoneIsLogged();

		$administratorModel = $this->model('AdministratorModel');

		$this->header('Login', $this->controllerName);
		$this->view(
			'home/disableUser',
			['administrator' => $administratorModel->getAdministratorById(1)]
		);
		$this->footer();
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
