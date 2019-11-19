<?php

/**
 * @author Peter Catania
 * @version 08.11.2019
 *
 * Controller for the registration.
 */
class Registration extends Controller
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
		session_start(); // important!

		// The username and the email of the registration form,
		// They will bee printed in their corrispective fields
		$_SESSION['username'] = '';
		$_SESSION['email'] = '';
		$_SESSION['password'] = '';
		$_SESSION['confirmedPassword'] = '';

		/**
		 * Contains names of CSS classes.
		 * This classes indicate if the registration inputs are valid or invalid.
		 * If the input is valid contains: "is-valid"
		 * If the input is not valid contains: "is-invalid"
		 */
		$_SESSION['usernameCSSValidityClass'] = '';
		$_SESSION['emailCSSValidityClass'] = '';
		$_SESSION['passwordCSSValidityClass'] = '';
		$_SESSION['confirmedPasswordCSSValidityClass'] = '';

		$this->view('registration/index');
	}

	/**
	 * Effetuate the registration, and redirect to the next view.
	 */
	public function register()
	{
		session_start(); // important!

		// effetuate the registration, if is submit a POST request
		if (isset($_POST['register'])) {
			// import the Validator Model class, and inizialize a new istance
			$this->model('Validator');
			$validator = new Validator();

			/**
			 * get the validated username and email,
			 * from the registration form field
			 */
			$username = $validator->validateString($_POST['username']);
			$email = $validator->validateEmail($_POST['email']);

			/**
			 * get the sha256 hash of the password and confirmed password,
			 * from the registration form field
			 */
			$password = hash('sha256', $_POST['password']);
			$confirmedPassword = hash('sha256', $_POST['confirmedPassword']);

			// the getted field from the registration form are inserted in the Session
			$_SESSION['username'] = $username;
			$_SESSION['email'] = $email;
			$_SESSION['password'] = $_POST['password'];
			$_SESSION['confirmedPassword'] = $_POST['confirmedPassword'];

			// tell if all the fields are valid
			$allFieldAreValid = true;

			// verify if the username field, from the form is empty
			if (empty($username)) {
				$_SESSION['usernameCSSValidityClass'] = INVALID;
				$allFieldAreValid = false;
			} else {
				$_SESSION['usernameCSSValidityClass'] = VALID;
			}

			// verify if the email field, from the form is empty
			if (empty($email)) {
				$_SESSION['emailCSSValidityClass'] = INVALID;
				$allFieldAreValid = false;
			} else {
				$_SESSION['emailCSSValidityClass'] = VALID;
			}

			// verify if the password field, from the form is empty
			if (
				$password ==
				'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855'
			) {
				$_SESSION['passwordCSSValidityClass'] = INVALID;
				$allFieldAreValid = false;
			} else {
				$_SESSION['passwordCSSValidityClass'] = VALID;
			}

			// verify if the confirmed password field, from the form is empty
			if (
				$confirmedPassword ==
				'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855' ||
				$confirmedPassword != $password
			) {
				$_SESSION['confirmedPasswordCSSValidityClass'] = INVALID;
				$allFieldAreValid = false;
			} else {
				$_SESSION['confirmedPasswordCSSValidityClass'] = VALID;
			}

			if (!$allFieldAreValid) {
				// return to the default page for registration
				$this->view('registration/index');
			} else {
				// import the Validator Model class, and inizialize a new istance
				$this->model('RegistrationModel');
				$registrationModel = new RegistrationModel();

				// insert the user data in the database
				$registrationModel->insertUser($username, $password, $email);

				// reset the session
				$_SESSION = array();

				// return to the login form
				$this->view('home/index');
			}
		}
	}
}
