<?php
/**
 * @author Peter Catania
 * @version 22.10.2019
 *
 * Provides the functionality of a cotroller.
 */
class Controller
{
	/**
	 * Import and return an istance of a Model.
	 *
	 * @param $model The Model to import
	 * @return $model The instance of the Model imported
	 */
	public function model($model)
	{
		require_once 'app/models/' . $model . '.php';
		return new $model();
	}

	/**
	 * Import a view.
	 *
	 * @param view The view to import
	 * @param view The data that is needed for the view
	 * @return void
	 */
	public function view($view, $data = [])
	{
		require 'app/views/' . $view . '.php';
	}

	/**
	 * Check if the login data of a user or of the administrator
	 * is saved in the session.
	 */
	private function existsLoginSessionData()
	{
		return isset($_SESSION[USER_SESSION_DATA]) ||
			isset($_SESSION[ADMINISTRATOR_SESSION_DATA]);
	}

	/**
	 * Redirect to the home page, if the login is not been effectuated by anyone.
	 */
	public function redirectToHomePageIfAnyoneIsLogged()
	{
		if (!$this->existsLoginSessionData()) {
			header("Location: " . URL . "home/index");
		}
	}

	/**
	 * Redirect to the home page, if is logged a user or anyone.
	 *
	 * @param session The current session saved on the server.
	 */
	public function redirectToHomePageIfUserOrAnyoneIsLogged()
	{
		if (
			isset($_SESSION[USER_SESSION_DATA]) ||
			!$this->existsLoginSessionData()
		) {
			header("Location: " . URL . "home/index");
		}
	}
}
