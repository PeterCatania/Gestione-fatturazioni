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
     * The user registration fields values from the form,
     * Their values will be printed in their corrispettive fields before save
     */
    private $username = '';
    private $email = '';
    private $password = '';
    private $confirmedPassword = '';

    /**
     * Contains names of CSS classes.
     * This classes indicate if the user registration fields are valid or invalid.
     * If the input is valid contains: "is-valid"
     * If the input is not valid contains: "is-invalid"
     */
    private $usernameCSSValidityClass = '';
    private $emailCSSValidityClass = '';
    private $passwordCSSValidityClass = '';
    private $confirmedPasswordCSSValidityClass = '';

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
			$this->username = $validator->validateString($_POST['username']);
            $this->email = $validator->validateEmail($_POST['email']);

			// get the hash of the password and it's confirmation from the form that contains the information about a new user
            $this->password = hash(
			    'sha256',
                $_POST['password']
            );
            $this->confirmedPassword = hash(
			    'sha256',
                $_POST['confirmedPassword']
            );

            // verify if the fields values are valid
            $this->usernameCSSValidityClass = $validator->isNameFieldValid(
                $this->username
            );
            $this->emailCSSValidityClass = $validator->isEmailFieldValid(
                $this->email
            );

            // verify if the passwords are valid
            $this->passwordCSSValidityClass = $validator->isPasswordFieldValid(
                $this->password,
                $_POST['password']
            );
            $this->confirmedPasswordCSSValidityClass = $validator->isConfirmedPasswordFieldValid(
                $this->password,
                $this->confirmedPassword,
                $_POST['confirmedPassword']
            );

			if ($validator->areAllFieldsValid()) {
                // instance a new object of the model class "UserModel"
                $userModel = $this->model("UserModel");

                // insert the new user in the database
                $userModel->saveUser($this->username, $this->password, $this->email, 0);

                $this->redirectToPage('home');
			} else {
                $this->showView();
			}
		}
	}
}
