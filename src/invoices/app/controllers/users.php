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
	{
	}

	/**
	 * Show all the not enabled users from the database.
	 */
	private function showNotEnabledUsersInDeafultPage()
	{
		// instance a new object of the model class "UsersModel"
		$this->model("UsersModel");
		$usersModel = new UsersModel();

		// the array that contain the Users saved in the database.
		$users = $usersModel->getNotEnabledUsers();

		// require the default page
		$this->view('users/index', ['users' => $users]);
	}

	/**
	 * Method that comunicate with the default page.
	 */
	public function index()
	{
		session_start();

		// redirect to the home page, if is logged a user or anyone
		$this->redirectToHomePageIfUserOrAnyoneIsLogged();

		$this->showNotEnabledUsersInDeafultPage();

		echo 'User: ';
		print_r($_SESSION[USER_SESSION_DATA]);
		echo 'administrator: ';
		print_r($_SESSION[ADMINISTRATOR_SESSION_DATA]);
	}

	/**
	 * Enable all users by id, getted from the post request.
	 */
	public function enable()
	{
		// redirect to the home page, if is logged a user or anyone
		$this->redirectToHomePageIfUserOrAnyoneIsLogged();

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
