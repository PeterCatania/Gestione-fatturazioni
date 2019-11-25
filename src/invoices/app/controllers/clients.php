<?php

/**
 * @author Peter Catania
 * @version 12.11.2019
 *
 * Controller for the page that manage the clients.
 */
class Clients extends Controller
{
	/**
	 * Show the clients saved in the database.
	 */
	private function showClients()
	{
		// instance a new object of the model class "clientsModel"
		$this->model("ClientsModel");
		$clientsModel = new ClientsModel();

		// get the array that contains the saved clients
		$clients = $clientsModel->getClients();

		// require the clients default page
		$this->view('clients/index', ['clients' => $clients]);
	}

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

		// prevents that clients accounts can access this page, and execute this method 
		$this->redirectToUserDefaultPermittedPageIfUserIsLogged();

		// The clientName, clientSurname, street, houseNo, city, nap, telephone, email, companyName fields values, 
		// in the form for save a new client,
		// Their values will be printed in their corrispective fields
		$_SESSION['clientName'] = '';
		$_SESSION['clientSurname'] = '';
		$_SESSION['street'] = '';
		$_SESSION['houseNo'] = '';
		$_SESSION['nap'] = '';
		$_SESSION['city'] = '';
		$_SESSION['telephone'] = '';
		$_SESSION['email'] = '';
		$_SESSION['companyName'] = '';

		/**
		 * Contains names of CSS classes.
		 * This classes indicate if the registration inputs are valid or invalid.
		 * If the input is valid contains: "is-valid"
		 * If the input is not valid contains: "is-invalid"
		 */
		$_SESSION['clientNameCSSValidityClass'] = '';
		$_SESSION['clientSurnameCSSValidityClass'] = '';
		$_SESSION['streetCSSValidityClass'] = '';
		$_SESSION['houseNoCSSValidityClass'] = '';
		$_SESSION['cityCSSValidityClass'] = '';
		$_SESSION['napCSSValidityClass'] = '';
		$_SESSION['telephoneCSSValidityClass'] = '';
		$_SESSION['emailCSSValidityClass'] = '';
		$_SESSION['companyNameCSSValidityClass'] = '';

		// show the clients, in the clients default page.
		$this->showClients();
	}

	/**
	 * Save a new client in the database.
	 */
	public function saveClient()
	{
		session_start(); // important!

		// prevents that anyone that is not logged enter this page, and execute this method
		$this->redirectToHomePageIfAnyoneIsLogged();

		// prevents that clients accounts can access this page, and execute this method 
		$this->redirectToUserDefaultPermittedPageIfUserIsLogged();

		if (isset($_POST['saveClient'])) {

			// import the Validator Model class, and inizialize a new istance
			$this->model('Validator');
			$validator = new Validator();

			/**
			 * get the validated clientName, clientSurname, street, houseNo, city, nap, telephone, email and companyName,
			 * from the new clients form fields
			 */
			$clientName = $validator->validateString($_POST['clientName']);
			$clientSurname = $validator->validateString($_POST['clientSurname']);
			$street = $validator->validateString($_POST['street']);
			$houseNo = $validator->validateString($_POST['houseNo']);
			$city = $validator->validateString($_POST['city']);
			$nap = $validator->validateInt($_POST['nap']);
			$telephone = $validator->validateString($_POST['telephone']);
			$email = $validator->validateEmail($_POST['email']);
			$companyName = null;
			if (isset($_POST['companyName'])) {
				$companyName = $validator->validateString($_POST['companyName']);
			}

			// the getted fields values from the registration form are inserted in the Session.
			$_SESSION['clientName'] = $clientName;
			$_SESSION['clientSurname'] = $clientSurname;
			$_SESSION['street'] = $street;
			$_SESSION['houseNo'] = $street;
			$_SESSION['city'] = $city;
			$_SESSION['nap'] = $nap;
			$_SESSION['telephone'] = $telephone;
			$_SESSION['email'] = $email;
			$_SESSION['companyName'] = $companyName = null;

			// tell if all the fields are valid
			$allFieldAreValid = true;

			// verify if the fields values are valid
			$allFieldAreValid = $this->isFieldValueValid($clientName, 'clientName') ? $allFieldAreValid : false;
			$allFieldAreValid = $this->isFieldValueValid($clientSurname, 'clientSurname') ? $allFieldAreValid : false;
			$allFieldAreValid = $this->isFieldValueValid($street, 'street') ? $allFieldAreValid : false;
			$allFieldAreValid = $this->isFieldValueValid($houseNo, 'houseNo') ? $allFieldAreValid : false;
			$allFieldAreValid = $this->isFieldValueValid($city, 'city') ? $allFieldAreValid : false;
			$allFieldAreValid = $this->isFieldValueValid($nap, 'nap') ? $allFieldAreValid : false;
			$allFieldAreValid = $this->isFieldValueValid($telephone, 'telephone') ? $allFieldAreValid : false;
			$allFieldAreValid = $this->isFieldValueValid($email, 'email') ? $allFieldAreValid : false;
			if (isset($_POST['companyName'])) {
				$allFieldAreValid = $this->isFieldValueValid($companyName, 'companyName') ? $allFieldAreValid : false;;
			}

			if ($allFieldAreValid) {
				// instance a new object of the model class "ClientsModel"
				$this->model("ClientsModel");
				$clientsModel = new ClientsModel();

				// insert the new client in the database
				$clientsModel->saveClient(
					$clientName,
					$clientSurname,
					$street,
					$houseNo,
					$city,
					$nap,
					$telephone,
					$email,
					isset($_POST['companyName']) ? $companyName : null
				);

				// redirect to the default method of the clients page
				$this->redirectToPage('clients');
			}
			// show the clients, in the clients default page.
			$this->showClients();
		}
	}
}
