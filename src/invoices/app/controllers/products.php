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
	{
	}

	/**
	 * Method that comunicate with the default page.
	 */
	public function index()
	{
		session_start();

		// redirect to the home page, if is logged a user or anyone
		$this->redirectToHomePageIfUserOrAnyoneIsLogged();

		// require the default page
		$this->view('products/index');
	}
}
