<?php

/**
 * @author Peter Catania
 * @version 12.11.2019
 *
 * Controller for the page that manage the invoices.
 */
class Invoices extends Controller
{
    /**
     * The name of the database table where the data is memorized
     */
    private $tableName = "invoice";

    /**
     * The fields name where are inserted the corresponding database fields values.
     *
     * If the field name is expressed with an object, the field is a checkbox mapped: Name => StatusToVerify
     * If the field is a checkbox, the field value is TRUE if is checked and FALSE if not.
     */
    private $fieldsName = '{
        "0":"typology", 
        "1":"creationDate", 
        "2":"paymentDate", 
        "3":"printNo"
    }';

    /**
     * The message to print after actions on row or table data.
     */
    private $successRowUpdateMessage = "Fattura salvata";
    private $successTableUpdateMessage  = "Fattura salvati";
    private $successRowEliminationMessage = "Fattura eliminata";

    /**
     * URL of the controllers methods.
     */
    private $rowUpdateMethod = "invoices/updateInvoice";
    private $tableUpdateMethod = "invoices/updateInvoice";
    private $rowDeleteMethod = "invoices/deleteInvoice";

    /**
     * The confirm message showed when deleting a table row.
     */
    private $rowDeleteConfirmMessage = "Vuoi davvero cancellare la fattura?";

    /**
     * Tell if the saving with the modal is in progress.
     */
    private $isSaveModalInProcess = false;

    /**
     * Show all the invoices from the database.
     *
     * @return void
     */
    private function showInvoices()
    {
        // import model class for invoices
        $invoiceModel = $this->model("InvoiceModel");

        // the array that contains the Invoice saved in the database.
        $invoices = $invoiceModel->getInvoices();

        // require the users default page
        $this->header('Fatture', $this->controllerName);
        $this->view('invoices/index',['invoices' => $invoices]);
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
		session_start();

		// prevents that anyone that is not logged enter this page
		$this->redirectToHomePageIfAnyoneIsLogged();

        /**
         * The invoice fields values from the form,
         * Their values will be printed in their corrispettive fields before save
         */
        $_SESSION['productsId'] = '';
        $_SESSION['productsDescription'] = '';
        $_SESSION['productsPrice'] = '';
        $_SESSION['productsSellDate'] = '';
        $_SESSION['productsQuantity'] = '';
        $_SESSION['clientId'] = '';
        $_SESSION['clientName'] = '';
        $_SESSION['clientSurname'] = '';
        $_SESSION['companyName'] = '';
        $_SESSION['clientStreet'] = '';
        $_SESSION['clientHouseNo'] = '';
        $_SESSION['clientEmail'] = '';
        $_SESSION['clientTelephone'] = '';
        $_SESSION['clientCity'] = '';
        $_SESSION['clientNap'] = '';
        $_SESSION['typologyId'] = '';
        $_SESSION['typologyName'] = '';
        $_SESSION['paymentDate'] = '';


        /**
         * Contains names of CSS classes.
         * This classes indicate if the invoice fields are valid or invalid.
         * If the input is valid contains: "is-valid"
         * If the input is not valid contains: "is-invalid"
         */
        $_SESSION['descriptionCSSValidityClass'] = '';
        $_SESSION['priceCSSValidityClass'] = '';
        $_SESSION['productsId'] = '';
        $_SESSION['productsDescription'] = '';
        $_SESSION['productsPrice'] = '';
        $_SESSION['productsSellDate'] = '';
        $_SESSION['productsQuantity'] = '';
        $_SESSION['clientId'] = '';
        $_SESSION['clientName'] = '';
        $_SESSION['clientSurname'] = '';
        $_SESSION['companyName'] = '';
        $_SESSION['clientStreet'] = '';
        $_SESSION['clientHouseNo'] = '';
        $_SESSION['clientEmail'] = '';
        $_SESSION['clientTelephone'] = '';
        $_SESSION['clientCity'] = '';
        $_SESSION['clientNap'] = '';
        $_SESSION['typologyId'] = '';
        $_SESSION['typologyName'] = '';
        $_SESSION['paymentDate'] = '';

		// show the invoices
        $this->showInvoices();
	}

    /**
     * Save a new invoices in the database.
     */
    public function saveInvoice()
    {
        session_start(); // important!

        // prevents that anyone that is not logged enter this page, and execute this method
        $this->redirectToHomePageIfAnyoneIsLogged();

        // prevents that invoices accounts can access this page, and execute this method
        $this->redirectToUserDefaultPermittedPageIfUserIsLogged();

        if (isset($_POST['saveInvoice'])) {
            // tell the save is in progress
            $this->isSaveModalInProcess = true;

            // import the Validator Model class, and initialize a new instance
            $validator = $this->model('Validator');

            /**
             * get the validated description and price,
             * from the new invoice form fields
             */
            $productsId = $_POST['productsId'];
            $productsDescription = $_POST['productsDescription'];
            $productsPrice = $_POST['productsPrice'];
            $productsSellDate = $_POST['productsSellDate'];
            $productsQuantity = $_POST['productsQuantity'];
            $clientId = $validator->validateInt($_POST['clientId']);
            $clientName = $validator->validateName($_POST['clientName']);
            $clientSurname = $validator->validateName($_POST['clientSurname']);
            $companyName = $validator->validateName($_POST['companyName']);
            $clientStreet = $validator->validateName($_POST['clientStreet']);
            $clientHouseNo = $validator->validateString($_POST['clientHouseNo']);
            $clientEmail = $validator->validateEmail($_POST['clientEmail']);
            $clientTelephone = $validator->validateTelephoneNumber($_POST['clientTelephone']);
            $clientCity = $validator->validateName($_POST['clientCity']);
            $clientNap = $validator->validateInt($_POST['clientNap']);
            $typologyId = $validator->validateInt($_POST['typologyId']);
            $typologyName = $validator->validateName($_POST['typologyName']);
            $paymentDate = $validator->validateString($_POST['paymentDate']);

            // get the validated data from the form that contains the information about a new invoice
            $_SESSION['productsId'] = $productsId;
            $_SESSION['productsDescription'] = $productsDescription;
            $_SESSION['productsPrice'] = $productsPrice;
            $_SESSION['productsSellDate'] = $productsSellDate;
            $_SESSION['productsQuantity'] = $productsQuantity;
            $_SESSION['clientId'] = $clientId;
            $_SESSION['clientName'] = $clientName;
            $_SESSION['clientSurname'] = $clientSurname;
            $_SESSION['companyName'] = $companyName;
            $_SESSION['clientStreet'] = $clientStreet;
            $_SESSION['clientHouseNo'] = $clientHouseNo;
            $_SESSION['clientEmail'] = $clientEmail;
            $_SESSION['clientTelephone'] = $clientTelephone;
            $_SESSION['clientCity'] = $clientCity;
            $_SESSION['clientNap'] = $clientNap;
            $_SESSION['typologyId'] = $typologyId;
            $_SESSION['typologyName'] = $typologyName;
            $_SESSION['paymentDate'] = $paymentDate;

            // tell if all the fields are valid
            $allFieldAreValid = true;

            // verify if the fields values are valid
            $allFieldAreValid = $validator->isFieldValueValid($clientName, 'description') ? $allFieldAreValid : false;
            $allFieldAreValid = $validator->isNameFieldValid($clientSurname, 'price') ? $allFieldAreValid : false;
            $allFieldAreValid = $validator->isNameFieldValid($companyName, 'price') ? $allFieldAreValid : false;
            $allFieldAreValid = $validator->validateCapitalizedWords($clientStreet, 'price') ? $allFieldAreValid : false;
            $allFieldAreValid = $validator->isFieldValueValid($clientHouseNo, 'price') ? $allFieldAreValid : false;
            $allFieldAreValid = $validator->isEmailFieldValid($clientEmail, 'price') ? $allFieldAreValid : false;
            $allFieldAreValid = $validator->isFieldValueValid($clientTelephone, 'price') ? $allFieldAreValid : false;
            $allFieldAreValid = $validator->isNameFieldValid($clientCity, 'price') ? $allFieldAreValid : false;
            $allFieldAreValid = $validator->isFieldValueValid($clientNap, 'price') ? $allFieldAreValid : false;
            $allFieldAreValid = $validator->isNameFieldValid($typologyName, 'price') ? $allFieldAreValid : false;
            $allFieldAreValid = $validator->isFieldValueValid($paymentDate, 'price') ? $allFieldAreValid : false;

            if ($allFieldAreValid) {
                // instance a new object of the model class "invoicesModel"
                $invoicesModel = $this->model("InvoiceModel");

                // insert the new invoice in the database
                $invoicesModel->saveInvoice(
                    $productsId,
                    $productsDescription,
                    $productsPrice,
                    $productsSellDate,
                    $productsQuantity,
                    $clientId,
                    $clientName,
                    $clientSurname,
                    $companyName,
                    $clientStreet,
                    $clientHouseNo,
                    $clientEmail,
                    $clientTelephone,
                    $clientCity,
                    $clientNap,
                    $typologyId,
                    $typologyName,
                    $paymentDate
                );

                // tell the save is not in progress
                $this->isSaveModalInProcess = false;

                // redirect to the default method of the controller
                $this->redirectToPage($this->controllerName);
            }
            // show the invoices, in the invoices default page.
            $this->showInvoices();
        } else if (isset($_POST['cancelSaveInvoice'])){
            // tell the save is not in progress
            $this->isSaveModalInProcess = false;
            // redirect to the default method of the controller
            $this->redirectToPage($this->controllerName);
        }
    }
}
