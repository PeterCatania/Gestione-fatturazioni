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
	 * @param model The Model to import
	 * @return The instance of the Model imported
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
	 */
	public function view($view, $data = [])
	{
		require 'app/views/' . $view . '.php';
	}

	/**
	 * Import a js script file.
	 *
	 * @param string $js The js file to import
	 */
	public function js($file)
	{
		require_once 'app/assets/js/' . $file . '.php';
	}

	/**
	 * Redirect to a page that is related with the given controller, and the method.
	 */
	public function redirectToPage(
		$controller = DEFAULT_CONTROLLER,
		$method = DEFAULT_METHOD
	) {
		header("Location: " . URL . $controller . "/" . $method);
		exit;
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
			$this->redirectToPage();
		}
	}

	/**
	 * Redirect to the the user default permitted page, 
	 * that a user can access, if a user is logged.
	 *
	 * @param session The current session saved on the server.
	 */
	public function redirectToUserDefaultPermittedPageIfUserIsLogged()
	{
		if (
			isset($_SESSION[USER_SESSION_DATA])
		) {
			$this->redirectToPage('invoices');
		}
	}

	/**
	 * Verify the vadility of the field value, from a form.
	 * if the value is valid true or false if not.
	 *
	 * @param fieldValue the field value, from a form
	 * @param fieldName the field name, from a form
	 * @return boolean the validity of the field value
	 */
	public function isFieldValueValid($fieldValue, $fieldName)
	{
		$fieldIsValid = true;
		// verify if the field value, from the form is empty
		if (empty($fieldValue)) {
			$_SESSION[$fieldName . 'CSSValidityClass'] = INVALID;
			$fieldIsValid = false;
		} else {
			$_SESSION[$fieldName . 'CSSValidityClass'] = VALID;
		}
		return $fieldIsValid;
	}

	/**
	 * Verify the vadility of the passsword field value, from a form.
	 * if the value is valid true or false if not.
	 *
	 * @param fieldValue the password field value, from a form
	 * @param fieldName the password field name, from a form
	 * @return boolean the validity of the password field value
	 */
	public function isPasswordValueValid($fieldValue, $fieldName)
	{
		$fieldIsValid = true;
		$emptyPasswordHash = "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855";
		// verify if the password field value, from the form is empty
		if (empty($fieldValue) || $fieldValue == $emptyPasswordHash) {
			$_SESSION[$fieldName . 'CSSValidityClass'] = INVALID;
			$fieldIsValid = false;
		} else {
			$_SESSION[$fieldName . 'CSSValidityClass'] = VALID;
		}
		return $fieldIsValid;
	}
}
