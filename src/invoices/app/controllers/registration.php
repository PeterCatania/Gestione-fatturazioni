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
     * Show the view of the controller.
     */
    private function showView(){
        $this->header('Registrazione', $this->controllerName);
        $this->view('registration/index');
        $this->footer();
    }

	/**
	 * Method that comunicate with the default page.
	 */
	public function index()
	{
		session_start(); // important!

		/**
		 * The user registration fields values from the form,
		 * Their values will be printed in their corrispettive fields before save
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

        $this->showView();
	}

	/**
	 * Effectuate the registration, and redirect to the next view.
	 */
	public function register()
	{
		session_start(); // important!

		// effectuate the registration, if is submit a POST request
		if (isset($_POST['register'])) {
			// import the Validator Model class, and initialize a new instance
			$validator = $this->model('Validator');

			// get the validated data from the form that contains the information about a new user
			$username = $validator->validateString($_POST['username']);
			$email = $validator->validateEmail($_POST['email']);

			// get the hash of the password and it's confirmation from the form that contains the information about a new user
			$password = hash(
			    'sha256',
                $_POST['password']
            );
			$confirmedPassword = hash(
			    'sha256',
                $_POST['confirmedPassword']
            );

			// the get field values from the registration form are inserted in the Session
			$_SESSION['username'] = $username;
			$_SESSION['email'] = $email;
			$_SESSION['password'] = $validator->generalValidation($_POST['password']);
			$_SESSION['confirmedPassword'] = $validator->generalValidation($_POST['confirmedPassword']);

			// tell if all the fields are valid
			$allFieldAreValid = true;

			// verify if the fields values are valid
			$allFieldAreValid = $validator->isNameFieldValid($username, 'username') ? $allFieldAreValid : false;
			$allFieldAreValid = $validator->isEmailFieldValid($email, 'email') ? $allFieldAreValid : false;

            // verify if the passwords are valid
            $allFieldAreValid = $validator->arePasswordsValueValid(
                $password,
                $_POST['password'],
                'password',
                $confirmedPassword,
                $_POST['confirmedPassword'],
                'confirmedPassword'
            ) ? $allFieldAreValid : false;

			if ($allFieldAreValid) {
                // import the Validator Model class, and initialize a new instance
                $registrationModel = $this->model('RegistrationModel');

                // insert the user data in the database
                $registrationModel->insertUser($username, $password, $email);

                // reset the session
                $_SESSION = array();

                $this->redirectToPage('home');
			} else {
                $this->showView();
			}
		}
	}
}
