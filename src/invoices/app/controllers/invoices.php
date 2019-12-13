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
     * Show all the invoices from the database.
     *
     * @return void
     */
    private function showInvoices()
    {
        // instance a new object of the model class "UsersModel"
        //$invoiceModel = $this->model("InvoiceModel");

        // the array that contains the Users saved in the database.
        //$users = $invoiceModel->getUsers();

        // require the users default page
        $this->header('Fatture', $this->controllerName);
        $this->view('invoices/index');
        $this->footer();

        // Import the required scripts
        $this->js("mainScript");

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
}
