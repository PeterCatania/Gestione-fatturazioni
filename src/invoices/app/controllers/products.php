<?php

/**
 * @author Peter Catania
 * @version 12.11.2019
 *
 * Controller for the page that manage the products.
 */
class Products extends Controller
{
	/**
	 * Empty constructor.
	 */
	public function __construct()
	{ }

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

		// require the default page
		$this->view('products/index');
	}
}
