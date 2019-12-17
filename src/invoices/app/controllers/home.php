<?php

/**
 * @author Peter Catania
 * @version 22.10.2019
 *
 * Controller for the login.
 */
class Home extends Controller
{
    // The username and the email of the registration form,
    // They will bee printed in their corrispettive fields
    private $username = '';
    private $password = '';

    /**
     * Contains names of CSS classes.
     * This classes indicate if the registration inputs are valid or invalid.
     * If the input is valid contains: "is-valid"
     * If the input is not valid contains: "is-invalid"
     * This variable indicate if the username or the password are valid or not.
     */
    private $usernameCSSValidityClass = '';
    private $passwordCSSValidityClass = '';
    private $usernameOrPasswordCSSValidityClass = '';

	/**
	 * Show the view of the controller.
	 */
	private function showView()
	{
		$this->header('Login', $this->controllerName);
		$this->view(
		    'home/index',
            [
                'username' => $this->username,
                'password' => $this->password,
                'usernameCSSValidityClass' => $this->usernameCSSValidityClass,
                'passwordCSSValidityClass' => $this->passwordCSSValidityClass,
                'usernameOrPasswordCSSValidityClass' => $this->usernameOrPasswordCSSValidityClass
            ]
        );
		$this->footer();
	}

	/**
	 * Method that comunicate with the default page.
	 */
	public function index()
	{
		session_start();



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
			$this->username = $validator->validateString($_POST['username']);
			// get the hash of the password, from login form
			$this->password = hash(
				'sha256',
				$_POST['password']
			);

			// verify if the fields values are valid
			$this->usernameCSSValidityClass = $validator->isNameFieldValid(
			    $this->username
            );
			// verify if the passwords are valid
            $this->passwordCSSValidityClass = $validator->isPasswordFieldValid(
                $this->password,
                $_POST['password']
            );

			if ($validator->areAllFieldsValid()) {

				// Import models
				$userModel = $this->model('UserModel');
				$administratorModel = $this->model('AdministratorModel');

				// get the user with the same credentials from the login
				$user = $userModel->getUserByUsernamePassword(
					$this->username,
					$this->password
				);

				// if the query have find the user with the login credentials.
				if ($user) {

					// save the user login data in the session
					$_SESSION[USER_SESSION_DATA] = $user;

					// check if the user is enabled or not
					if ($user->getEnabled()) {
						$this->redirectToPage('invoices');
					} else {
						$this->redirectToPage('home', 'disableUser');
					}
				} else {
					// get the administrator with the same credentials from the login
					$administrator = $administratorModel->getAdministratorByUsernamePassword(
						$this->username,
						$this->password
					);

					// if the query have find the administrator with the login credentials
					if ($administrator) {

						// save the administrator data in the session
						$_SESSION[ADMINISTRATOR_SESSION_DATA] = $administrator;

						$this->redirectToPage('invoices');
					} else {
						$this->usernameOrPasswordCSSValidityClass = INVALID;
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
