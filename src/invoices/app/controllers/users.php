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
	 */
	private function showUsersInDeafultPage()
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

		/**
		 * Contains names of CSS classes.
		 * This classes indicate if the user fields are valid or invalid.
		 * If the input is valid contains: "is-valid"
		 * If the input is not valid contains: "is-invalid"
		 */
		$_SESSION['usernameCSSValidityClass'] = '';
		$_SESSION['emailCSSValidityClass'] = '';

		$this->showUsersInDeafultPage();
	}

	/**
	 * Update users informations, of a single one or all at ones.
	 */
	public function updateUsers()
	{
		session_start(); // important!

		// prevents that anyone that is not logged enter this page
		$this->redirectToHomePageIfAnyoneIsLogged();

		// prevents that users accounts can access this page, and execute this method 
		$this->redirectToUserDefaultPermittedPageIfUserIsLogged();

		if (isset($_POST['saveUsers'])) {
			//get the array that contain the ids of the users to enable
			$usersIdToEnable = isset($_POST['usersIdToEnable']) ? $_POST['usersIdToEnable'] : null;

			// instance a new object of the model class "UsersModel"
			$this->model("UserModel");
			$userModel = new UserModel();

			//enable all users by id
			foreach ($_SESSION['users'] as $user) {
				$id = $user->getId();

				if (!empty($usersIdToEnable) && in_array($id, $usersIdToEnable)) {
					$userModel->enableUserById($id, true);
				} else {
					$userModel->enableUserById($id, false);
				}
			}

			//Show all the users saved in the database
			$this->showUsersInDeafultPage();
		} elseif (isset($_POST['updateUser'])) {
			$userId = $_POST['updateUser'];

			//Show all the users saved in the database
			$this->showUsersInDeafultPage();
		} elseif (isset($_POST['deleteUser'])) {
			// the id of the user
			$userId = $_POST['deleteUser'];

			// delete the user with the corrisponding id
			$this->deleteUserById($userId);

			//Show all the users saved in the database
			$this->showUsersInDeafultPage();
		}
	}
}
