<?php

/**
 * @author Peter Catania
 * @version 21.11.2019
 *
 * Controller for the page that manage the products.
 */
class Products extends Controller
{
	/**
	 * Show the products saved in the database.
	 */
	private function showProducts()
	{
		// instance a new object of the model class "ProductsModel"
		$this->model("ProductsModel");
		$productsModel = new ProductsModel();

		// get the array that contains the saved products
		$products = $productsModel->getProducts();

		// require the products default page
		$this->view('products/index', ['products' => $products]);
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

		// prevents that products accounts can access this page, and execute this method 
		$this->redirectToUserDefaultPermittedPageIfUserIsLogged();

		// The description and the price fields values, in the form for save a new product,
		// Their values will be printed in their corrispective fields
		$_SESSION['description'] = '';
		$_SESSION['price'] = '';

		/**
		 * Contains names of CSS classes.
		 * This classes indicate if the registration inputs are valid or invalid.
		 * If the input is valid contains: "is-valid"
		 * If the input is not valid contains: "is-invalid"
		 */
		$_SESSION['descriptionCSSValidityClass'] = '';
		$_SESSION['priceCSSValidityClass'] = '';

		// show the products, in the products default page.
		$this->showProducts();
	}

	/**
	 * Save a new products in the database.
	 */
	public function saveProduct()
	{
		session_start(); // important!

		// prevents that anyone that is not logged enter this page, and execute this method
		$this->redirectToHomePageIfAnyoneIsLogged();

		// prevents that products accounts can access this page, and execute this method 
		$this->redirectToUserDefaultPermittedPageIfUserIsLogged();

		if (isset($_POST['saveProduct'])) {

			// import the Validator Model class, and inizialize a new istance
			$this->model('Validator');
			$validator = new Validator();

			/**
			 * get the validated description and price,
			 * from the new product form fields
			 */
			$description = $validator->validateString($_POST['description']);
			$price = $validator->validateFloat($_POST['price']);
			number_format($price, 2);

			// the getted fields values from the registration form are inserted in the Session.
			$_SESSION['description'] = $description;
			$_SESSION['price'] = $price;

			// tell if all the fields are valid
			$allFieldAreValid = true;

			// verify if the fields values are valid
			$allFieldAreValid = $this->isFieldValueValid($description, 'description') ? $allFieldAreValid : false;
			$allFieldAreValid = $this->isFieldValueValid($price, 'price') ? $allFieldAreValid : false;

			if ($allFieldAreValid) {
				// instance a new object of the model class "ProductsModel"
				$this->model("ProductsModel");
				$productsModel = new ProductsModel();

				// insert the new product in the database
				$productsModel->saveProduct($description, $price);

				// redirect to the default method of the products page
				$this->redirectToPage('products');
			}
			// show the products, in the products default page.
			$this->showProducts();
		}
	}
}
