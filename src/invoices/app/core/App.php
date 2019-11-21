<?php

/**
 * @author Peter Catania
 * @version 20.10.2019
 *
 * Is the core class of the MVC pattern,
 * and verify the controller, the method and the params, passed in the URL.
 */
class App
{
	/**
	 * The controller parsed fro the URL,
	 * (Default = "login")
	 */
	protected $controller = DEFAULT_CONTROLLER;

	/**
	 * The method parsed from the URL
	 * (Default = "index")
	 */
	protected $method = DEFAULT_METHOD;

	/**
	 * The params parsed from the URL
	 */
	protected $params = [];

	/**
	 * Verify and require the parsed controller, method and params.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$url = $this->parseURL();

		// Verify if the controller exists
		if (file_exists('app/controllers/' . $url[0] . '.php')) {
			$this->controller = $url[0];
			unset($url[0]);
		}

		require_once 'app/controllers/' . $this->controller . '.php';

		$this->controller = new $this->controller();

		// Verify if the method exists in the controller
		if (isset($url[1])) {
			if (method_exists($this->controller, $url[1])) {
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		// Put the params in an array
		$this->params = $url ? array_values($url) : [];

		// Call the controller method with the params
		call_user_func_array([$this->controller, $this->method], $this->params);
		$url = $this->parseURL();
	}

	/**
	 * Parse the controller, method and params from the URL.
	 *
	 * @return array The parsed controller, method and params from the URL
	 */
	protected function parseURL()
	{
		// If the URL exists, parse it's elements
		if (isset($_GET['url'])) {
			// Delete the char "/" from the end of the string
			$url = rtrim($_GET['url'], '/');
			// Removes all illegal URL chars
			$url = filter_var($url, FILTER_SANITIZE_URL);
			// Make an an array, with every item between the chars "/"
			$url = explode('/', $url);

			return $url;
		}
	}
}
