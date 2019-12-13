<?php

/**
 * @author Peter Catania
 * @version 08.12.2019
 *
 * Provides the functionality of a controller.
 */
class Controller
{
    /**
     * @var string The controller name of this controller class.
     */
    protected $controllerName;

    /**
     * Controller empty constructor.
     */
    public function __construct()
    {
        $this->controllerName = get_class($this);
    }

	/**
	 * Import and return an instance of a Model.
	 *
	 * @param string $model The Model to import
	 * @return mixed Instance of the Model imported
	 */
	public function model($model)
	{
		require_once 'app/models/' . $model . '.php';
		return new $model();
	}

	/**
	 * Import a view.
	 *
	 * @param string $view The view to import
	 * @param array $data The data that is needed for the view
     * @return void
	 */
	public function view($view, $data = [])
	{
		require 'app/views/' . $view . '.php';
	}

	/**
	 * Import a js script file.
	 *
	 * @param string $file The js file to import
     * @param array $data The data passed to the script
     * @return void
	 */
	public function js($file, $data = [])
	{
		require_once 'app/scripts/' . $file . '.php';
	}

    /**
     * Import the footer, from footer directory.
     *
     * @param string $footer The footer to import, default is "footer"
     */
	public function footer($footer = 'footer'){
        require_once 'app/views/footer/' . $footer . '.php';
    }

    /**
     * Import the header, from header directory.
     *
     * @param string $title The title of the page
     * @param string $controllerName The page name where the header is inserted
     * @param string $header The header to import, default is "header"
     * @return void
     */
    public function header($title, $controllerName, $header = 'header')
    {
        require_once 'app/views/header/' . $header . '.php';
    }

    /**
     * Redirect to a page that is related with the given controller, and the method.
     *
     * @param string $controller The controller where the page is redirected
     * @param string $method The controller method where the page is redirected
     * @return void
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
     *
     * @return void
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
	 * @return void
	 */
	public function redirectToUserDefaultPermittedPageIfUserIsLogged()
	{
		if (
			isset($_SESSION[USER_SESSION_DATA])
		) {
			$this->redirectToPage('invoices');
		}
	}
}
