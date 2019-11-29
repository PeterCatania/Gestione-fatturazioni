<?php

/**
 * @author Peter Catania
 * @version 29.11.2019
 *
 * Provide methods that interact with the table user of the database.
 */
class UserModel
{
	/**
	 * Connection with the database.
	 */
	private $connInvoices = null;

	/**
	 * Empty constructor.
	 * 
	 * @return void
	 */
	public function __construct()
	{
		// get the connection with the database
		require_once 'Database.php';
		$this->connInvoices = Database::getDBConnection();
	}

	/**
	 * Get the users from the database, that are not enabled.
	 * 
	 * @return User[] The users saved in the database
	 */
	public function getUsers()
	{

		$users =  new UserQuery();
		$users->orderByEnabled();
		return $users->find();
	}

	/**
	 * Modify the value that tell if a user is enable or not. 
	 * Modify only the users with the id corrispond with the given.
	 *
	 * @param int $id The id of the user
	 * @param bool $enabled The value that tell if a user is enabled or not
	 * @return void
	 */
	public function enableUserById($id, $enabled = 1)
	{
		$users = new UserQuery();
		$user = $users->findPK($id);
		$user->setEnabled($enabled);
		$user->save();
	}

	/**
	 * Insert a new user.
	 *
	 * @param string $username The passeord of the new user
	 * @param string $password The password of the new user
	 * @param string $email The email of the new user
	 * @param int $enabled The value that tell if a user is enabled
	 * @return void
	 */
	public function insertUserById($username, $password, $email, $enabled)
	{
		// prepare the query, to update enabled field of the user with the given id.
		$insertUser = "insert into user (id,username,password,email,enabled) values (null, :username, :password, :email, :enabled);";
		$stmt = $this->connInvoices->prepare($insertUser);

		// insert in the query the data of the new user
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':enabled', $enabled);

		// the query statement is executed
		$stmt->execute();
	}

	/**
	 * Delete a user, where the id corrispond with the given.
	 *
	 * @param id the id of the user
	 * @return void
	 */
	public function deleteUserById($id)
	{
		// prepare the query, to update enabled field of the user with the given id.
		$deleteUserById = "delete from user where id = :id";
		$stmt = $this->connInvoices->prepare($deleteUserById);

		// insert in the query the data of the new user
		$stmt->bindParam(':id', $id);

		// the query statement is executed
		$stmt->execute();
	}
}
