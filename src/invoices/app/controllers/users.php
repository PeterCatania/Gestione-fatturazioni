<?php

/**
 * @author Peter Catania
 * @version 12.11.2019
 *
 * Controller for the page that manage the users.
 */
class Users extends Controller
{
	/**
	 * Empty constructor.
	 */
	public function __construct()
	{ }

	/**
	 * Show all the not enabled users from the database.
	 * 
	 * @return void
	 */
	private function showUsers()
	{
		// instance a new object of the model class "UsersModel"
		$this->model("UserModel");
		$userModel = new UserModel();

		// the array that contains the Users saved in the database.
		$users = $userModel->getUsers();

		// require the users default page
		$this->view('users/index', ['users' => $users]);
	}

	/**
	 * Method that comunicate with the default page.
	 * 
	 * @return void
	 */
	public function index()
	{
		session_start(); // important!

		// prevents that anyone that is not logged enter this page
		$this->redirectToHomePageIfAnyoneIsLogged();

		// prevents that users accounts can access this page, and execute this method 
		$this->redirectToUserDefaultPermittedPageIfUserIsLogged();

		/**
		 * The user fields values from the form,
		 * Their values will be printed in their corrispective fields before save
		 */
		$_SESSION['username'] = '';
		$_SESSION['email'] = '';
		$_SESSION['password'] = '';
		$_SESSION['confirmedPassword'] = '';

		/**
		 * Contains names of CSS classes.
		 * This classes indicate if the user fields are valid or invalid.
		 * If the input is valid contains: "is-valid"
		 * If the input is not valid contains: "is-invalid"
		 */
		$_SESSION['usernameCSSValidityClass'] = '';
		$_SESSION['emailCSSValidityClass'] = '';
		$_SESSION['passwordCSSValidityClass'] = '';
		$_SESSION['confirmedPasswordCSSValidityClass'] = '';

		$this->showUsers();

		// Import the required js file
		$this->js("usersScript");
	}

	/**
	 * Update users informations, of a single one or all at ones.
	 * 
	 * @return void
	 */
	public function saveUser()
	{
		session_start(); // important!

		if (isset($_POST['saveUser'])) {
			// import the Validator Model class, and inizialize a new istance
			$this->model('Validator');
			$validator = new Validator();

			// get the validated data from the form that contains the informations about a new user
			$username = $validator->validateString($_POST['username']);
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

			if ($allFieldAreValid) {
				// instance a new object of the model class "UserModel"
				$this->model("UserModel");
				$userModel = new UserModel();

				// insert the new user in the database
				$userModel->saveUser($username, $password, $email, 0);

				// redirect to the default method of the users page
				$this->redirectToPage('users');
			}
			// show the products, in the products default page.
			$this->showUsers();
		}
	}


	/**
	 * Update users informations, of a single one or all at ones.
	 * 
	 * @return void
	 */
	public function updateUsers()
	{
		// the json containing the informations of the new user
		$users = json_decode($_POST['users'], true);

		$this->model('UserModel');
		$userModel = new UserModel();
		foreach ($users as $user) {
			// update the user data
			$userModel->updateUser($user['id'], $user['username'], $user['email'], $user['enabled']);
		}

		// send the response to currelated AJAX function.
		echo "true";

		$this->redirectToPage('users');
	}

	/**
	 * Update a user, 
	 * with the informations contained in the upcoming POST request.
	 * 
	 * @return void
	 */
	public function updateUser()
	{
		// the json containing the informations of the new user
		$user = json_decode($_POST['user'], true);

		// update the user data
		$this->model('UserModel');
		$userModel = new UserModel();
		$userModel->updateUser($user['id'], $user['username'], $user['email'], $user['enabled']);

		// send the response to currelated AJAX function.
		echo "true";

		$this->redirectToPage('users');
	}

	/**
	 * Delete a user, 
	 * from the user id contained in the upcoming POST request.
	 *
	 * @return void
	 */
	public function deleteUser()
	{
		// the user id to update
		$userId = $_POST['id'];

		// delete the user data
		$this->model('UserModel');
		$userModel = new UserModel();
		$userModel->deleteUserById($userId);

		// send the response to currelated AJAX function
		echo "true";

		$this->redirectToPage('users');
	}
}
