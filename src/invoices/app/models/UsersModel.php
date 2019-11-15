<?php
require 'Database.php';

/**
 * @author Peter Catania
 * @version 14.11.2019
 *
 * Provide methods usefull for the users controller.
 */
class UsersModel
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
	 * Get the users from the database, that are not enabled.
	 */
	public function getNotEnabledUsers()
	{
		// prepare the query, that get all the not enabled users
		$insertUser = 'select id,username,email from user where enabled = 0';
		$stmt = $this->connInvoices->prepare($insertUser);

		// the query statement is executed and returned
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Enable a user, where the id corrispond with the given.
	 *
	 * @param id the id of the user
	 */
	public function enableUserById($id)
	{
		// prepare the query, to update enabled field of the user with the given id.
		$selectUserById = "update user set enabled = 1 where id = :id";
		$stmt = $this->connInvoices->prepare($selectUserById);

		// insert in the query the id of the user
		$stmt->bindParam(':id', $id);

		// the query statement is executed
		$stmt->execute();
	}
}
