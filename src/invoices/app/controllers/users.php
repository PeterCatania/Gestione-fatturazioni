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
     * The name of the database table where the data is memorized
     */
    private $tableName = "user";

    /**
     * The fields name where are inserted the corresponding database fields values.
     *
     * If the field name is expressed with an object, the field is a checkbox mapped: Name => StatusToVerify
     * If the field is a checkbox, the field value is TRUE if is checked and FALSE if not.
     */
    private $fieldsName = '{"0":"id", "1":"username", "2":"email", "3": {"enabled": ":checked"}}';

    /**
     * The message to print after actions on row or table data.
     */
    private $successRowUpdateMessage = "Utente salvato";
    private $successTableUpdateMessage  = "Utenti salvati";
    private $successRowEliminationMessage = "Utente eliminato";

    /**
     * URL of the controllers methods.
     */
    private $rowUpdateMethod = "users/updateUser";
    private $tableUpdateMethod = "users/updateUsers";
    private $rowDeleteMethod = "users/deleteUser";

    /**
     * The confirm message showed when deleting a table row.
     */
    private $rowDeleteConfirmMessage = "Vuoi davvero cancellare l'utente?";

    /**
	 * Show all the not enabled users from the database.
	 * 
	 * @return void
	 */
	private function showUsers()
	{
		// instance a new object of the model class "UsersModel"
		$userModel = $this->model("UserModel");

		// the array that contains the Users saved in the database.
		$users = $userModel->getUsers();

		// require the users default page
        $this->header('Utenti', $this->controllerName);
		$this->view('users/index', ['users' => $users]);
		$this->footer();

        // Import the required scripts
        $this->js("mainScript");
        $this->js(
            "listTableScript",
            [
                'tableName' => $this->tableName,
                'fieldsName' => $this->fieldsName,
                'successRowUpdateMessage' => $this->successRowUpdateMessage,
                'successTableUpdateMessage' => $this->successTableUpdateMessage,
                'successRowEliminationMessage' => $this->successRowEliminationMessage,
                'rowUpdateMethod' => $this->rowUpdateMethod,
                'tableUpdateMethod' => $this->tableUpdateMethod,
                'rowDeleteMethod' => $this->rowDeleteMethod,
                'rowDeleteConfirmMessage' => $this->rowDeleteConfirmMessage
            ]
        );
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
	}

    /**
     * Update users information, of a single one or all at ones.
     *
     * @return void
     */
	public function saveUser()
	{
		session_start(); // important!

		if (isset($_POST['saveUser'])) {
			// import the Validator Model class, and initialize a new instance
			$validator = $this->model('Validator');

			// get the validated data from the form that contains the information about a new user
			$username = $validator->validateString($_POST['username']);
			$email = $validator->validateEmail($_POST['email']);

			// get the hash of the password and it's confirmation from the form that contains the information about a new user
			$password = hash(
			    'sha256',
                $validator->generalValidation($_POST['password'])
            );
			$confirmedPassword = hash(
			    'sha256',
                $validator->generalValidation($_POST['confirmedPassword'])
            );

			// the get field values from the registration form are inserted in the Session
			$_SESSION['username'] = $username;
			$_SESSION['email'] = $email;
			$_SESSION['password'] = $_POST['password'];
			$_SESSION['confirmedPassword'] = $_POST['confirmedPassword'];

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
				// instance a new object of the model class "UserModel"
				$userModel = $this->model("UserModel");

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
     */
	public function updateUsers()
	{
		// the json containing the information of the new user
		$users = json_decode($_POST['data'], true);

		// new UserModel
		$userModel = $this->model('UserModel');

        // update the users data
		foreach ($users as $user) {
			$userModel->updateUser(
			    $user['id'],
                $user['username'],
                $user['email'],
                $user['enabled']
            );
		}

		// send the response to correlated AJAX function.
		echo "true";

		$this->redirectToPage($this->controllerName);
	}

    /**
     * Update a user,
     * with the information contained in the upcoming POST request.
     *
     * @return void
     */
	public function updateUser()
	{
		// the json containing the information of the new user
		$user = json_decode($_POST['data'], true);

		// update the user data
		$userModel = $this->model('UserModel');
		$userModel->updateUser(
		    $user['id'],
            $user['username'],
            $user['email'],
            $user['enabled']
        );

		// send the response to correlated AJAX function.
		echo "true";

		$this->redirectToPage($this->controllerName);
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
		$userModel = $this->model('UserModel');
		$userModel->deleteUserById($userId);

		// send the response to correlated AJAX function
		echo "true";

		$this->redirectToPage($this->controllerName);
	}
}