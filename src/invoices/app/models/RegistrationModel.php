<?php
require 'Database.php';

/**
 * @author Peter Catania
 * @version 08.11.2019
 *
 * Provide methods usefull for the login controller and for the login.
 */
class RegistrationModel
{
	/**
	 * Connection with the database "Invoices".
	 */
	private $connInvoices = null;

	/**
	 * Empty constructor.
	 */
	public function __construct()
	{
		// get the connection with the database
		$this->connInvoices = Database::getDBConnection();
	}

	/**
	 * Insert a user in the database (Table "user")
	 */
	public function insertUser($username, $password, $email)
	{
		// query
		$insertUser =
			'insert into user values(null,:username,:password,:email,0);';
		$stmt = $this->connInvoices->prepare($insertUser);

		// inserted in the query the params
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':email', $email);

		// the query is executed
		$stmt->execute();
	}
}
