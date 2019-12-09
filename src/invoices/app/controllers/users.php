<?php

use Propel\Runtime\Exception\PropelException;

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
        $this->header('Utenti','users');
		$this->view('users/index', ['users' => $users]);
		$this->footer();
	}

	/**
	 * Method that communicate with the default page.
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
		 * Their values will be printed in their corresponding fields before save
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

        /**
         * The name of the database table where the users data is memorized
         */
        $tableName = "user";

        /**
         * The fields name where are inserted the corresponding database fields values.
         *
         * If the field name is expressed with an object, the field is a checkbox mapped: Name => StatusToVerify
         * If the field is a checkbox, the field value is TRUE if is checked and FALSE if not.
         */
        $fieldsName = '{"0":"id", "1":"username", "2":"email", "3": {"enabled": ":checked"}}';

        /**
         * The message to print after actions on row or table data.
         */
        $successRowUpdateMessage = "Utente salvato";
        $successTableUpdateMessage  = "Utenti salvati";
        $successRowEliminationMessage = "Utente eliminato";

        /**
         * URL of the controllers methods.
         */
        $rowUpdateMethod = "users/updateUser";
        $tableUpdateMethod = "users/updateUsers";
        $rowDeleteMethod = "users/deleteUser";

        /**
         * The confirm message showed when deleting a table row.
         */
        $rowDeleteConfirmMessage = "Vuoi davvero cancellare l'utente?";

		// Import the required scripts
		$this->js("mainScript");
		$this->js(
		    "listTableScript",
            [
                'tableName' => $tableName,
                'fieldsName' => $fieldsName,
                'successRowUpdateMessage' => $successRowUpdateMessage,
                'successTableUpdateMessage' => $successTableUpdateMessage,
                'successRowEliminationMessage' => $successRowEliminationMessage,
                'rowUpdateMethod' => $rowUpdateMethod,
                'tableUpdateMethod' => $tableUpdateMethod,
                'rowDeleteMethod' => $rowDeleteMethod,
                'rowDeleteConfirmMessage' => $rowDeleteConfirmMessage
            ]
        );
	}

    /**
     * Update users information, of a single one or all at ones.
     *
     * @return void
     * @throws PropelException
     */
	public function saveUser()
	{
		session_start(); // important!

		if (isset($_POST['saveUser'])) {
			// import the Validator Model class, and initialize a new instance
			$this->model('Validator');
			$validator = new Validator();

			// get the validated data from the form that contains the information about a new user
			$username = $validator->validateString($_POST['username']);
			$email = $validator->validateEmail($_POST['email']);

			// get the hash of the password and it's confirmation from the form that contains the information about a new user
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
			$allFieldAreValid = $validator->isFieldValueValid($username, 'username') ? $allFieldAreValid : false;
			$allFieldAreValid = $validator->isFieldValueValid($email, 'email') ? $allFieldAreValid : false;

			// verify id the passwords are valid
			$allFieldAreValid = $validator->arePasswordsValueValid(
			    $password,
                'password',
                $confirmedPassword,
                'confirmedPassword'
            ) ? $allFieldAreValid : false;

			if ($allFieldAreValid) {
				// instance a new object of the model class "UserModel"
				$this->model("UserModel");
				$userModel = new UserModel();

				// insert the new user in the database
				$userModel->saveUser($username, $password, $email, 0);

				// redirect to the default method of the users page
				$this->redirectToPage('users');
			}
            $this->showUsers();
		}
	}


    /**
     * Update users information, of a single one or all at ones.
     *
     * @return void
     * @throws PropelException
     */
	public function updateUsers()
	{
		// the json containing the information of the new user
		$users = json_decode($_POST['data'], true);

		$this->model('UserModel');
		$userModel = new UserModel();
		foreach ($users as $user) {
			// update the user data
			$userModel->updateUser($user['id'], $user['username'], $user['email'], $user['enabled']);
		}

		// send the response to correlated AJAX function.
		echo "true";

		$this->redirectToPage('users');
	}

    /**
     * Update a user,
     * with the information contained in the upcoming POST request.
     *
     * @return void
     * @throws PropelException
     */
	public function updateUser()
	{
		// the json containing the information of the new user
		$user = json_decode($_POST['data'], true);

		// update the user data
		$this->model('UserModel');
		$userModel = new UserModel();
		$userModel->updateUser($user['id'], $user['username'], $user['email'], $user['enabled']);

		// send the response to correlated AJAX function.
		echo "true";

		$this->redirectToPage('users');
	}

    /**
     * Delete a user,
     * from the user id contained in the upcoming POST request.
     *
     * @return void
     * @throws PropelException
     */
	public function deleteUser()
	{
		// the user id to update
		$userId = $_POST['id'];

		// delete the user data
		$this->model('UserModel');
		$userModel = new UserModel();
		$userModel->deleteUserById($userId);

		// send the response to correlated AJAX function
		echo "true";

		$this->redirectToPage('users');
	}
}
