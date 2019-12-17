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
     * Tell if the saving with the modal is in progress.
     */
    private $isSaveModalInProcess = false;

    /**
     * The user fields values from the form,
     * Their values will be printed in their corresponding fields before save
     */
    private $username = '';
    private $email = '';
    private $password = '';
    private $confirmedPassword = '';

    /**
     * Contains names of CSS classes.
     * This classes indicate if the user fields are valid or invalid.
     * If the input is valid contains: "is-valid"
     * If the input is not valid contains: "is-invalid"
     */
    private $usernameCSSValidityClass = '';
    private $emailCSSValidityClass = '';
    private $passwordCSSValidityClass = '';
    private $confirmedPasswordCSSValidityClass = '';

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
		$this->view(
		    'users/index',
            [
                'users' => $users,
                'username' => $this->username,
                'email' => $this->email,
                'password' => $this->password,
                'confirmedPassword' => $this->confirmedPassword,
                'usernameCSSValidityClass' => $this->usernameCSSValidityClass,
                'emailCSSValidityClass' => $this->emailCSSValidityClass,
                'passwordCSSValidityClass' => $this->passwordCSSValidityClass,
                'confirmedPasswordCSSValidityClass' => $this->confirmedPasswordCSSValidityClass
            ]
        );
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
                'rowDeleteConfirmMessage' => $this->rowDeleteConfirmMessage,
                'isSaveModalInProcess' => $this->isSaveModalInProcess
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

		$this->showUsers();
	}

    /**
     * Save a new user.
     *
     * @return void
     */
	public function saveUser()
	{
		session_start(); // important!

		if (isset($_POST['saveUser'])) {
            // tell the save is in progress
            $this->isSaveModalInProcess = true;

			// import the Validator Model class, and initialize a new instance
			$validator = $this->model('Validator');

			// get the validated data from the form that contains the information about a new user
			$this->username = $validator->validateString($_POST['username']);
			$this->email = $validator->validateEmail($_POST['email']);

			// get the hash of the password and it's confirmation from the form that contains the information about a new user
			$this->password = hash( 'sha256', $_POST['password']);
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
				$userModel->saveUser(
				    $this->username,
                    $this->password,
                    $this->email,
                    0
                );

                // tell the save is not in progress
                $this->isSaveModalInProcess = false;

				// redirect to the default method of the users page
				$this->redirectToPage('users');
			}
            $this->showUsers();
		} else if (isset($_POST['cancelSaveUser'])){
            // tell the save is not in progress
            $this->isSaveModalInProcess = false;
            // redirect to the default method of the controller
            $this->redirectToPage($this->controllerName);
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