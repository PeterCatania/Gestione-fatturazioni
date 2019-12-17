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
     * The name of the database table where the data is memorized
     */
    private $tableName = "product";

    /**
     * The fields name where are inserted the corresponding database fields values.
     *
     * If the field name is expressed with an object, the field is a checkbox mapped: Name => StatusToVerify
     * If the field is a checkbox, the field value is TRUE if is checked and FALSE if not.
     */
    private $fieldsName = '{"0":"id", "1":"description", "2":"price"}';

    /**
     * The message to print after actions on row or table data.
     */
    private $successRowUpdateMessage = "Prodotto salvato";
    private $successTableUpdateMessage  = "Prodotto salvati";
    private $successRowEliminationMessage = "Prodotto eliminato";

    /**
     * URL of the controllers methods.
     */
    private $rowUpdateMethod = "products/updateProduct";
    private $tableUpdateMethod = "products/updateProducts";
    private $rowDeleteMethod = "products/deleteProduct";

    /**
     * The confirm message showed when deleting a table row.
     */
    private $rowDeleteConfirmMessage = "Vuoi davvero cancellare il prodotto?";

    /**
     * Tell if the saving with the modal is in progress.
     */
    private $isSaveModalInProcess = false;

    /**
     * The product fields values from the form,
     * Their values will be printed in their corrispettive fields before save
     */
    private $description = '';
    private $price = '';

    /**
     * Contains names of CSS classes.
     * This classes indicate if the product fields are valid or invalid.
     * If the input is valid contains: "is-valid"
     * If the input is not valid contains: "is-invalid"
     */
    private $descriptionCSSValidityClass = '';
    private $priceCSSValidityClass = '';

    /**
	 * Show the products saved in the database.
	 */
	private function showProducts()
	{
		// instance a new object of the model class "ProductsModel"
		$productsModel = $this->model("ProductModel");

		// get the array that contains the saved products
		$products = $productsModel->getProducts();

		// require the products default page
        $this->header('Prodotti', $this->controllerName);
		$this->view(
		    'products/index',
            [
                'products' => $products,
                'description' => $this->description,
                'price' => $this->price,
                'descriptionCSSValidityClass' => $this->descriptionCSSValidityClass,
                'priceCSSValidityClass' => $this->priceCSSValidityClass
            ]
        );
        $this->footer();

        // Import the required scripts
        $this->js("mainScript");
        $this->js(
            "listTableScript",
            [
                'tableName' => $this->tableName,
                'fieldsName' => $this->fieldsName,
                'successRowUpdateMessage' => $this->successRowUpdateMessage,
                'successTableUpdateMessage' => $this->successTableUpdateMessage,
                'successRowEliminationMessage' => $this->successRowEliminationMessage,
                'rowUpdateMethod' => $this->rowUpdateMethod,
                'tableUpdateMethod' => $this->tableUpdateMethod,
                'rowDeleteMethod' => $this->rowDeleteMethod,
                'rowDeleteConfirmMessage' => $this->rowDeleteConfirmMessage,
                'isSaveModalInProcess' => $this->isSaveModalInProcess
            ]
        );
	}

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
		    // tell the save is in progress
            $this->isSaveModalInProcess = true;

			// import the Validator Model class, and initialize a new instance
			$validator = $this->model('Validator');

			/**
			 * get the validated description and price,
			 * from the new product form fields
			 */
			$this->description = $validator->validateName($_POST['description']);
			$this->price = $validator->validatePrice($_POST['price']);

			// verify if the fields values are valid
			$this->descriptionCSSValidityClass = $validator->isFieldValidWithoutTags(
			    $this->description
            );
			$this->priceCSSValidityClass = $validator->isPriceFieldValid(
			    $this->price)
            ;

			if ($validator->areAllFieldsValid()) {
				// instance a new object of the model class "ProductsModel"
				$productsModel = $this->model("ProductModel");

				// insert the new product in the database
				$productsModel->saveProduct($this->description, $this->price);

				// tell the save is not in progress
                $this->isSaveModalInProcess = false;

				// redirect to the default method of the controller
                $this->redirectToPage($this->controllerName);
			}
			// show the products, in the products default page.
			$this->showProducts();
		} else if (isset($_POST['cancelSaveProduct'])){
            // tell the save is not in progress
            $this->isSaveModalInProcess = false;
            // redirect to the default method of the controller
            $this->redirectToPage($this->controllerName);
        }
	}

    /**
     * Update products information, of a single one or all at ones.
     *
     * @return void
     */
    public function updateProducts()
    {
        // the json containing the information of the new product
        $products = json_decode($_POST['data'], true);

        // new productModel
        $productModel = $this->model('ProductModel');

        // update the products data
        foreach ($products as $product) {
            $productModel->updateProduct(
                $product['id'],
                $product['description'],
                $product['price']
            );
        }

        // send the response to correlated AJAX function.
        echo "true";

        // redirect to the default method of the controller
        $this->redirectToPage($this->controllerName);
    }

    /**
     * Update a product,
     * with the information contained in the upcoming POST request.
     *
     * @return void
     */
    public function updateProduct()
    {
        // the json containing the information of the new product
        $product = json_decode($_POST['data'], true);

        // update the product data
        $productModel = $this->model('ProductModel');
        $productModel->updateProduct(
            $product['id'],
            $product['description'],
            $product['price']
        );

        // send the response to correlated AJAX function.
        echo "true";

        // redirect to the default method of the controller
        $this->redirectToPage($this->controllerName);
    }

    /**
     * Delete a product,
     * from the product id contained in the upcoming POST request.
     *
     * @return void
     */
    public function deleteProduct()
    {
        // the product id to update
        $productId = $_POST['id'];

        // delete the product data
        $productModel = $this->model('ProductModel');
        $productModel->deleteProductById($productId);

        // send the response to correlated AJAX function
        echo "true";

        // redirect to the default method of the controller
        $this->redirectToPage($this->controllerName);
    }
}
