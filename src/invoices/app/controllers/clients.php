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
        $this->view('clients/index', ['clients' => $clients]);
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
                'rowDeleteConfirmMessage' => $this->rowDeleteConfirmMessage
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

        /**
         * The client fields values from the form,
         * Their values will be printed in their corrispettive fields before save
         */
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
         * This classes indicate if the client fields are valid or invalid.
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

            // import the Validator Model class, and initialize a new instance
            $validator = $this->model('Validator');

            // get the validated data from the form that contains the information about a new client
            $clientName = $validator->validateName($_POST['clientName']);
            $clientSurname = $validator->validateName($_POST['clientSurname']);
            $street = $validator->validateCapitalizedWords($_POST['street']);
            $houseNo = $validator->validateString($_POST['houseNo']);
            $city = $validator->validateCapitalizedWords($_POST['city']);
            $nap = $validator->validateInt($_POST['nap']);
            $telephone = $validator->validateTelephoneNumber($_POST['telephone']);
            $email = $validator->validateEmail($_POST['email']);
            $companyName = null;
            if (isset($_POST['companyName'])) {
                $companyName = $validator->validateName($_POST['companyName']);
            }

            // The get fields values from the registration form are inserted in the Session.
            $_SESSION['clientName'] = $clientName;
            $_SESSION['clientSurname'] = $clientSurname;
            $_SESSION['street'] = $street;
            $_SESSION['houseNo'] = $street;
            $_SESSION['city'] = $city;
            $_SESSION['nap'] = $nap;
            $_SESSION['telephone'] = $telephone;
            $_SESSION['email'] = $email;
            $_SESSION['companyName'] = $companyName;

            // tell if all the fields are valid
            $allFieldAreValid = true;

            // verify if the fields values are valid
            $allFieldAreValid = $validator->isFieldValueValid(
                $clientName,
                'clientName'
            ) ? $allFieldAreValid : false;
            $allFieldAreValid = $validator->isFieldValueValid(
                $clientSurname,
                'clientSurname'
            ) ? $allFieldAreValid : false;
            $allFieldAreValid = $validator->isFieldValueValid(
                $street,
                'street'
            ) ? $allFieldAreValid : false;
            $allFieldAreValid = $validator->isFieldValueValid(
                $houseNo,
                'houseNo'
            ) ?
                $allFieldAreValid : false;
            $allFieldAreValid = $validator->isFieldValueValid(
                $city,
                'city'
            ) ? $allFieldAreValid : false;
            $allFieldAreValid = $validator->isFieldValueValid(
                $nap,
                'nap'
            ) ? $allFieldAreValid : false;
            $allFieldAreValid = $validator->isFieldValueValid(
                $telephone,
                'telephone'
            ) ? $allFieldAreValid : false;
            $allFieldAreValid = $validator->isFieldValueValid(
                $email,
                'email'
            ) ? $allFieldAreValid : false;
            if (isset($_POST['companyName'])) {
                $allFieldAreValid = $validator->isFieldValueValid(
                    $companyName,
                    'companyName'
                ) ? $allFieldAreValid : false;
            }

            if ($allFieldAreValid) {
                // instance a new object of the model class "ClientsModel"
                $clientsModel = $this->model("ClientModel");

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

                print_r($clientSurname);
            }
            // show the clients, in the clients default page.
            $this->showClients();
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
