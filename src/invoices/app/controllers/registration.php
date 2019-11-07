<?php
/**
 * @author Peter Catania
 * @version 22.10.2019
 *
 * Controller for the registration.
 */
class Registration extends Controller
{
	/**
	 * Contains the CSS classes.
	 * This classes indicate if the registration inputs are valid or invalid.
	 * If the input is valid contains: "is-valid"
	 * If the input is not valid contains: "is-invalid"
	 */
	private $usernameCSSValidityClass = "Rightttttt!!!";
	private $emailCSSValidityClass = "";
	private $passwordCSSValidityClass = "";
	private $confirmedPasswordCSSValidityClass = "";

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
		global $usernameCSSValidityClass,
			$emailCSSValidityClass,
			$passwordCSSValidityClass,
			$confirmedPasswordCSSValidityClass;

		print_r($usernameCSSValidityClass);

		$ciao = 'Hello World';

		$this->view('registration/index', [
			'usernameCSSValidityClass' => $usernameCSSValidityClass,
			'usernameCSSValidityClass' => $usernameCSSValidityClass,
			'usernameCSSValidityClass' => $usernameCSSValidityClass,
			'usernameCSSValidityClass' => $usernameCSSValidityClass
		]);
	}

	/**
	 * Effetuate the login, and redirect to the next view.
	 */
	public function register()
	{
		session_start();
		// Effetuate the registration, if is submit a POST request
		if (isset($_POST['register'])) {
			// Import the Validator Model class, and inizialize a new istance.
			$this->model('Validator');
			$validator = new Validator();

			// get the validated field, and the hash of the passwords, from login form
			$username = $validator->validateString($_POST['username']);
			$email = $validator->validateEmail($_POST['username']);
			$password = hash('sha256', $_POST['password']);
			$confirmedPassword = hash('sha256', $_POST['confirmedPassword']);

			if ($username !== null) {
			}
		}
	}
}
