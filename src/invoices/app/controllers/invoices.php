<?php
/**
 * @author Peter Catania
 * @version 12.11.2019
 *
 * Controller for the page that manage the products.
 */
class Invoices extends Controller
{
	/**
	 * Empty constructor.
	 */
	public function __construct()
	{
	}

	/**
	 * Method that comunicate with the default page.
	 */
	public function index()
	{
		session_start();

		// redirect to the home page, if the login is not been effectuated by anyone
		$this->redirectToHomePageIfAnyoneIsLogged();

		// require the default page
		$this->view('invoices/index');
	}
}
