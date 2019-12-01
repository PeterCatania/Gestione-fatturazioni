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

		/**
		 * The user registration fields values from the form,
		 * Their values will be printed in their corrispective fields before save
		 */
		$_SESSION['username'] = '';
		$_SESSION['email'] = '';
		$_SESSION['password'] = '';
		$_SESSION['confirmedPassword'] = '';

		/**
		 * Contains names of CSS classes.
		 * This classes indicate if the user registration fields are valid or invalid.
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

			// get the validated data from the form that contains the informations about a new user
			$username = $validator->validateName($_POST['username']);
			$email = $validator->validateEmail($_POST['email']);

			// get the hash of the password and it's confirmation from the form that contains the informations about a new user
			$password = hash('sha256', $validator->generalValidation($_POST['password']));
			$confirmedPassword = hash('sha256', $validator->generalValidation($_POST['confirmedPassword']));

			// the getted field values from the registration form are inserted in the Session
			$_SESSION['username'] = $username;
			$_SESSION['email'] = $email;
			$_SESSION['password'] = $_POST['password'];
			$_SESSION['confirmedPassword'] = $_POST['confirmedPassword'];

			// tell if all the fields are valid
			$allFieldAreValid = true;

			// verify if the fields values are valid
			$allFieldAreValid = $this->isFieldValueValid($username, 'username') ? $allFieldAreValid : false;
			$allFieldAreValid = $this->isFieldValueValid($email, 'email') ? $allFieldAreValid : false;
			$allFieldAreValid = $this->isPasswordValueValid($password, 'password') ? $allFieldAreValid : false;
			$allFieldAreValid = $this->isPasswordValueValid($confirmedPassword, 'confirmedPassword') ? $allFieldAreValid : false;

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
