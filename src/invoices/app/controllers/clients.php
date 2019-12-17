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
     * The name of the database table where the data is memorized
     */
    private $tableName = "client";

    /**
     * The fields name where are inserted the corresponding database fields values.
     *
     * If the field name is expressed with an object, the field is a checkbox mapped: Name => StatusToVerify
     * If the field is a checkbox, the field value is TRUE if is checked and FALSE if not.
     */
    private $fieldsName = '{
        "0":"clientName", 
        "1":"clientSurname", 
        "2":"companyName", 
        "3":"street", 
        "4":"houseNo", 
        "5":"nap", 
        "6":"city", 
        "7":"telephone", 
        "8":"email",
        "9":"id"
    }';

    /**
     * The message to print after actions on row or table data.
     */
    private $successRowUpdateMessage = "Cliente salvato";
    private $successTableUpdateMessage  = "Clienti salvati";
    private $successRowEliminationMessage = "Cliente eliminato";

    /**
     * URL of the controllers methods.
     */
    private $rowUpdateMethod = "clients/updateClient";
    private $tableUpdateMethod = "clients/updateClients";
    private $rowDeleteMethod = "clients/deleteClient";

    /**
     * The confirm message showed when deleting a table row.
     */
    private $rowDeleteConfirmMessage = "Vuoi davvero cancellare questo cliente?";

    /**
    * Tell if the saving with the modal is in progress.
    */
    private $isSaveModalInProcess = false;

    /**
     * The client fields values from the form,
     * Their values will be printed in their corrispettive fields before save
     */
    private $clientName = '';
    private $clientSurname = '';
    private $street = '';
    private $houseNo = '';
    private $nap = '';
    private $city = '';
    private $telephone = '';
    private $email = '';
    private $companyName = '';

    // the company name checkbox value if checked
    private $cbCompanyName = '';

    /**
     * Contains names of CSS classes.
     * This classes indicate if the client fields are valid or invalid.
     * If the input is valid contains: "is-valid"
     * If the input is not valid contains: "is-invalid"
     */
    private $clientNameCSSValidityClass = '';
    private $clientSurnameCSSValidityClass = '';
    private $streetCSSValidityClass = '';
    private $houseNoCSSValidityClass = '';
    private $cityCSSValidityClass = '';
    private $napCSSValidityClass = '';
    private $telephoneCSSValidityClass = '';
    private $emailCSSValidityClass = '';
    private $companyNameCSSValidityClass = '';

    /**
     * Show the clients saved in the database.
     */
    private function showClients()
    {
        // instance a new object of the model class "clientsModel"
        $clientsModel = $this->model("ClientModel");

        // get the array that contains the saved clients
        $clients = $clientsModel->getClients();

        // require the clients default page
        $this->header('Utenti', $this->controllerName);
        $this->view(
            'clients/index',
            [
                'clients' => $clients,
                'clientName' => $this->clientName,
                'clientSurname' => $this->clientSurname,
                'street' => $this->street,
                'houseNo' => $this->houseNo,
                'nap' => $this->nap,
                'city' => $this->city,
                'telephone' => $this->telephone,
                'email' => $this->email,
                'companyName' => $this->companyName,
                'cbCompanyName' => $this->cbCompanyName,
                'clientNameCSSValidityClass' => $this->clientNameCSSValidityClass,
                'clientSurnameCSSValidityClass' => $this->clientSurnameCSSValidityClass,
                'streetCSSValidityClass' => $this->streetCSSValidityClass,
                'houseNoCSSValidityClass' => $this->houseNoCSSValidityClass,
                'cityCSSValidityClass' => $this->cityCSSValidityClass,
                'napCSSValidityClass' => $this->napCSSValidityClass,
                'telephoneCSSValidityClass' => $this->telephoneCSSValidityClass,
                'emailCSSValidityClass' => $this->emailCSSValidityClass,
                'companyNameCSSValidityClass' => $this->companyNameCSSValidityClass
            ]
        );
        $this->footer();

        // Import the required scripts
        $this->js("mainScript");
        $this->js("clientScript");
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

        // prevents that clients accounts can access this page, and execute this method 
        $this->redirectToUserDefaultPermittedPageIfUserIsLogged();

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
            // tell the save is in progress
            $this->isSaveModalInProcess = true;

            // import the Validator Model class, and initialize a new instance
            $validator = $this->model('Validator');

            // get the validated data from the form that contains the information about a new client
            $this->clientName = $validator->validateName($_POST['clientName']);
            $this->clientSurname = $validator->validateName($_POST['clientSurname']);
            $this->street = $validator->validateName($_POST['street']);
            $this->houseNo = $validator->validateString($_POST['houseNo']);
            $this->city = $validator->validateCapitalizedWords($_POST['city']);
            $this->nap = $validator->validateInt($_POST['nap']);
            $this->telephone = $validator->validateTelephoneNumber(
                $_POST['telephone']
            );
            $this->email = $validator->validateEmail($_POST['email']);
            $this->companyName = null;
            if (isset($_POST['companyName'])) {
                $this->companyName = $validator->validateName($_POST['companyName']);
            }

            // the company name checkbox value if checked
            $this->cbCompanyName =
                isset($_POST['cbCompanyName']) ? $_POST['cbCompanyName'] : '';

            // verify if the fields values are valid
            $this->clientNameCSSValidityClass = $validator->isNameFieldValid(
                $this->clientName,
            );
            $this->clientSurnameCSSValidityClass = $validator->isNameFieldValid(
                $this->clientSurname,
            );
            $this->streetCSSValidityClass = $validator->isNameFieldValid(
                $this->street,
            );
            $this->houseNoCSSValidityClass = $validator->isFieldValidWithoutTags(
                $this->houseNo,
            ) ;
            $this->cityCSSValidityClass = $validator->isNameFieldValid(
                $this->city,
            );
            $this->napCSSValidityClass = $validator->isFieldValid(
                $this->nap,
            );
            $this->telephoneCSSValidityClass = $validator->isFieldValidWithoutTags(
                $this->telephone,
            );
            $this->emailCSSValidityClass = $validator->isEmailFieldValid(
                $this->email,
            );
            if (isset($_POST['companyName'])) {
                $this->companyNameCSSValidityClass = $validator->isNameFieldValid(
                    $this->companyName,
                );
            }

            if ($validator->areAllFieldsValid()) {
                // instance a new object of the model class "ClientsModel"
                $clientsModel = $this->model("ClientModel");

                // insert the new client in the database
                $clientsModel->saveClient(
                    $this->clientName,
                    $this->clientSurname,
                    $this->street,
                    $this->houseNo,
                    $this->city,
                    $this->nap,
                    $this->telephone,
                    $this->email,
                    isset($_POST['companyName']) ? $this->companyName : null
                );

                // tell the save is not in progress
                $this->isSaveModalInProcess = false;

                // redirect to the default method of the clients page
                $this->redirectToPage('clients');
            }
            // show the clients, in the clients default page.
            $this->showClients();
        } else if (isset($_POST['cancelSaveClient'])){
            // tell the save is not in progress
            $this->isSaveModalInProcess = false;
            // redirect to the default method of the controller
            $this->redirectToPage($this->controllerName);
        }
    }

    /**
     * Update clients information, of a single one or all at ones.
     *
     * @return void
     */
    public function updateClients()
    {
        // the json containing the information of the new client
        $clients = json_decode($_POST['data'], true);

        // new clientModel
        $clientModel = $this->model('ClientModel');

        print_r($clients);

        // update the clients data
        foreach ($clients as $client) {
            $clientModel->updateClient(
                $client['id'],
                $client['clientName'],
                $client['clientSurname'],
                $client['street'],
                $client['houseNo'],
                $client['city'],
                $client['nap'],
                $client['telephone'],
                $client['email'],
                isset($client['companyName']) ? $client['companyName'] : null
            );
        }

        // send the response to correlated AJAX function.
        echo "true";

        $this->redirectToPage($this->controllerName);
    }

    /**
     * Update a client,
     * with the information contained in the upcoming POST request.
     *
     * @return void
     */
    public function updateClient()
    {
        // the json containing the information of the new client
        $client = json_decode($_POST['data'], true);

        // update the client data
        $clientModel = $this->model('ClientModel');
        $clientModel->updateClient(
            $client['id'],
            $client['clientName'],
            $client['clientSurname'],
            $client['street'],
            $client['houseNo'],
            $client['city'],
            $client['nap'],
            $client['telephone'],
            $client['email'],
            isset($client['companyName']) ? $client['companyName'] : null
        );

        // send the response to correlated AJAX function.
        echo "true";

        $this->redirectToPage($this->controllerName);
    }

    /**
     * Delete a client and the corrispettive company name if exists,
     * from the client id contained in the upcoming POST request.
     *
     * @return void
     */
    public function deleteClient()
    {
        // the client id to update
        $clientId = $_POST['id'];

        // delete the client data
        $clientModel = $this->model('ClientModel');
        $clientModel->deleteClientById($clientId);

        // send the response to correlated AJAX function
        echo "true";

        $this->redirectToPage($this->controllerName);
    }
}
