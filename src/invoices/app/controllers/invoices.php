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
     * The invoice fields values from the form,
     * Their values will be printed in their corrispettive fields before save
     */
    private $companyName = '';
    private $companyStreet = '';
    private $companyHouseNo = '';
    private $companyCity = '';
    private $companyNap = '';
    private $companyTelephone = '';
    private $companyEmail = '';
    private $companySite = '';
    private $productsId = [''];
    private $productsDescription = [''];
    private $productsPrice = [''];
    private $productsSellDate = [''];
    private $productsQuantity = [''];
    private $clientId = '';
    private $clientName = '';
    private $clientSurname = '';
    private $clientCompanyName = '';
    private $clientStreet = '';
    private $clientHouseNo = '';
    private $clientEmail = '';
    private $clientTelephone = '';
    private $clientCity = '';
    private $clientNap = '';
    private $typologyId = '';
    private $typologyName = '';
    private $paymentDate = '';


    /**
     * Contains names of CSS classes.
     * This classes indicate if the invoice fields are valid or invalid.
     * If the input is valid contains: "is-valid"
     * If the input is not valid contains: "is-invalid"
     */
    private $companyNameCSSValidityClass = '';
    private $companyStreetCSSValidityClass = '';
    private $companyHouseNoCSSValidityClass = '';
    private $companyCityCSSValidityClass = '';
    private $companyNapCSSValidityClass = '';
    private $companyTelephoneCSSValidityClass = '';
    private $companyEmailCSSValidityClass = '';
    private $companySiteCSSValidityClass = '';
    private $productsIdCSSValidityClass = '';
    private $productsDescriptionCSSValidityClass = '';
    private $productsPriceCSSValidityClass = '';
    private $productsSellDateCSSValidityClass = '';
    private $productsQuantityCSSValidityClass = '';
    private $clientIdCSSValidityClass = '';
    private $clientNameCSSValidityClass = '';
    private $clientSurnameCSSValidityClass = '';
    private $clientCompanyNameCSSValidityClass = '';
    private $clientStreetCSSValidityClass = '';
    private $clientHouseNoCSSValidityClass = '';
    private $clientEmailCSSValidityClass = '';
    private $clientTelephoneCSSValidityClass = '';
    private $clientCityCSSValidityClass = '';
    private $clientNapCSSValidityClass = '';
    private $typologyIdCSSValidityClass = '';
    private $typologyNameCSSValidityClass = '';
    private $paymentDateCSSValidityClass = '';



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
        $invoiceNextId = $invoiceModel->getNextId();

        // require the users default page
        $this->header('Fatture', $this->controllerName);
        $this->view(
            'invoices/index',
            [
                'invoices' => $invoices,
                'invoiceNextId' => $invoiceNextId,
                'companyName' => $this->companyName,
                'companyStreet' => $this->companyStreet,
                'companyHouseNo' => $this->companyHouseNo,
                'companyCity' => $this->companyCity,
                'companyNap' => $this->companyNap,
                'companyTelephone' => $this->companyTelephone,
                'companyEmail' => $this->companyEmail,
                'companySite' => $this->companySite,
                'productsId' => $this->productsId,
                'productsDescription' => $this->productsDescription,
                'productsPrice' => $this->productsPrice,
                'productsSellDate' => $this->productsSellDate,
                'productsQuantity' => $this->productsQuantity,
                'clientId' => $this->clientId,
                'clientName' => $this->clientName,
                'clientSurname' => $this->clientSurname,
                'clientCompanyName' => $this->clientCompanyName,
                'clientStreet' => $this->clientStreet,
                'clientHouseNo' => $this->clientHouseNo,
                'clientEmail' => $this->clientEmail,
                'clientTelephone' => $this->clientTelephone,
                'clientCity' => $this->clientCity,
                'clientNap' => $this->clientNap,
                'typologyId' => $this->typologyId,
                'typologyName' => $this->typologyName,
                'paymentDate' => $this->paymentDate,
                'companyNameCSSValidityClass' => $this->companyNameCSSValidityClass,
                'companyStreetCSSValidityClass' => $this->companyStreetCSSValidityClass,
                'companyHouseNoCSSValidityClass' => $this->companyHouseNoCSSValidityClass,
                'companyCityCSSValidityClass' => $this->companyCityCSSValidityClass,
                'companyNapCSSValidityClass' => $this->companyNapCSSValidityClass,
                'companyTelephoneCSSValidityClass' => $this->companyTelephoneCSSValidityClass,
                'companyEmailCSSValidityClass' => $this->companyEmailCSSValidityClass,
                'companySiteCSSValidityClass' => $this->companySiteCSSValidityClass,
                'productsIdCSSValidityClass' => $this->productsIdCSSValidityClass,
                'productsDescriptionCSSValidityClass' => $this->productsDescriptionCSSValidityClass,
                'productsPriceCSSValidityClass' => $this->productsPriceCSSValidityClass,
                'productsSellDateCSSValidityClass' => $this->productsSellDateCSSValidityClass,
                'productsQuantityCSSValidityClass' => $this->productsQuantityCSSValidityClass,
                'clientIdCSSValidityClass' => $this->clientIdCSSValidityClass,
                'clientNameCSSValidityClass' => $this->clientNameCSSValidityClass,
                'clientSurnameCSSValidityClass' => $this->clientSurnameCSSValidityClass,
                'clientCompanyNameCSSValidityClass' => $this->clientCompanyNameCSSValidityClass,
                'clientStreetCSSValidityClass' => $this->clientStreetCSSValidityClass,
                'clientHouseNoCSSValidityClass' => $this->clientHouseNoCSSValidityClass,
                'clientEmailCSSValidityClass' => $this->clientEmailCSSValidityClass,
                'clientTelephoneCSSValidityClass' => $this->clientTelephoneCSSValidityClass,
                'clientCityCSSValidityClass' => $this->clientCityCSSValidityClass,
                'clientNapCSSValidityClass' => $this->clientNapCSSValidityClass,
                'typologyIdCSSValidityClass' => $this->typologyIdCSSValidityClass,
                'typologyNameCSSValidityClass' => $this->typologyNameCSSValidityClass,
                'paymentDateCSSValidityClass' => $this->paymentDateCSSValidityClass
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
		session_start();

		// prevents that anyone that is not logged enter this page
		$this->redirectToHomePageIfAnyoneIsLogged();

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
            $this->companyName = $validator->validateName($_POST['companyName']);
            $this->companyStreet = $validator->validateName($_POST['companyStreet']);
            $this->companyHouseNo = $validator->validateString($_POST['companyHouseNo']);
            $this->companyCity = $validator->validateName($_POST['companyCity']);
            $this->companyNap = $validator->validateInt($_POST['companyNap']);
            $this->companyTelephone = $validator->validateString($_POST['companyTelephone']);
            $this->companyEmail = $validator->validateEmail($_POST['companyEmail']);
            $this->companySite = $validator->validateString($_POST['companySite']);
            $this->productsId = $_POST['productsId'];
            $this->productsDescription = $_POST['productsDescription'];
            $this->productsPrice = $_POST['productsPrice'];
            $this->productsSellDate = $_POST['productsSellDate'];
            $this->productsQuantity = $_POST['productsQuantity'];
            $this->clientId = $validator->validateInt($_POST['clientId']);
            $this->clientName = $validator->validateName($_POST['clientName']);
            $this->clientSurname = $validator->validateName($_POST['clientSurname']);
            $this->clientCompanyName = $validator->validateName($_POST['clientCompanyName']);
            $this->clientStreet = $validator->validateCapitalizedWords($_POST['clientStreet']);
            $this->clientHouseNo = $validator->validateString($_POST['clientHouseNo']);
            $this->clientEmail = $validator->validateEmail($_POST['clientEmail']);
            $this->clientTelephone = $validator->validateTelephoneNumber($_POST['clientTelephone']);
            $this->clientCity = $validator->validateName($_POST['clientCity']);
            $this->clientNap = $validator->validateInt($_POST['clientNap']);
            $this->typologyId = $validator->validateInt($_POST['typologyId']);
            $this->typologyName = $validator->validateName($_POST['typologyName']);
            //$paymentDate = $validator->validateString($_POST['paymentDate']);

            // verify if the fields values are valid
            $this->companyNameCSSValidityClass = $validator->isNameFieldValid($this->companyName);
            $this->companyStreetCSSValidityClass = $validator->isNameFieldValid($this->companyStreet);
            $this->companyHouseNoCSSValidityClass= $validator->isFieldValidWithoutTags($this->companyHouseNo);
            $this->companyCityCSSValidityClass = $validator->isNameFieldValid($this->companyCity);
            $this->companyNapCSSValidityClass = $validator->isFieldValid($this->companyNap );
            $this->companyTelephoneCSSValidityClass = $validator->isFieldValidWithoutTags($this->companyTelephone);
            $this->companyEmailCSSValidityClass = $validator->isEmailFieldValid($this->companyEmail);
            $this->companySiteCSSValidityClass = $validator->isFieldValidWithoutTags($this->companySite);
            $this->clientNameCSSValidityClass = $validator->isNameFieldValid($this->clientName);
            $this->clientSurnameCSSValidityClass = $validator->isNameFieldValid($this->clientSurname);
            $this->clientCompanyNameCSSValidityClass = $validator->isNameFieldValid($this->clientCompanyName);
            $this->clientStreetCSSValidityClass = $validator->isFieldValidWithoutTags($this->clientStreet);
            $this->clientHouseNoCSSValidityClass = $validator->isFieldValidWithoutTags($this->clientHouseNo);
            $this->clientEmailCSSValidityClass = $validator->isEmailFieldValid($this->clientEmail);
            $this->clientTelephoneCSSValidityClass = $validator->isFieldValidWithoutTags($this->clientTelephone);
            $this->clientCityCSSValidityClass = $validator->isNameFieldValid($this->clientCity);
            $this->clientNapCSSValidityClass = $validator->isFieldValid($this->clientNap);
            $this->typologyNameCSSValidityClass = $validator->isNameFieldValid($this->typologyName);
            //$allFieldAreValid = $validator->isFieldValueValid($paymentDate, 'price') ? $allFieldAreValid : false;

            if ($validator->areAllFieldsValid()) {
                // instance a new object of the model class "invoicesModel"
                $invoicesModel = $this->model("InvoiceModel");

                // insert the new invoice in the database
                $invoicesModel->saveInvoice(
                    $this->productsId,
                    $this->productsDescription,
                    $this->productsPrice,
                    $this->productsSellDate,
                    $this->productsQuantity,
                    $this->clientId,
                    $this->clientName,
                    $this->clientSurname,
                    $this->clientCompanyName,
                    $this->clientStreet,
                    $this->clientHouseNo,
                    $this->clientEmail,
                    $this->clientTelephone,
                    $this->clientCity,
                    $this->clientNap,
                    $this->typologyId,
                    $this->typologyName,
                    null
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
