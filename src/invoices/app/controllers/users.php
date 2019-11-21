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
	private function showNotEnabledUsersInDeafultPage()
	{
		// instance a new object of the model class "UsersModel"
		$this->model("UsersModel");
		$usersModel = new UsersModel();

		// the array that contains the Users saved in the database.
		$users = $usersModel->getNotEnabledUsers();

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

		$this->showNotEnabledUsersInDeafultPage();
	}

	/**
	 * Enable all users by id, getted from the post request.
	 */
	public function enable()
	{
		session_start(); // important!

		// prevents that anyone that is not logged enter this page
		$this->redirectToHomePageIfAnyoneIsLogged();

		// prevents that users accounts can access this page, and execute this method 
		$this->redirectToUserDefaultPermittedPageIfUserIsLogged();

		if (isset($_POST['enable'])) {
			//get the array that contain the ids of the users to enable
			$usersIdToEnable = $_POST['usersIdToEnable'];

			// instance a new object of the model class "UsersModel"
			$this->model("UsersModel");
			$usersModel = new UsersModel();

			//enable all users by id
			foreach ($usersIdToEnable as $userId) {
				$usersModel->enableUserById($userId);
			}

			//Show all the not enabled users from the database.
			$this->showNotEnabledUsersInDeafultPage();
		}
	}
}
