<?php



/**
 * @author Peter Catania
 * @version 14.11.2019
 *
 * Provide methods that interact with the table user of the database.
 */
class UsersModel
{
	/**
	 * Connection with the database.
	 */
	private $connInvoices = null;

	/**
	 * Empty constructor.
	 */
	public function __construct()
	{
		// get the connection with the database
		require_once 'Database.php';
		$this->connInvoices = Database::getDBConnection();
	}

	/**
	 * Get the users from the database, that are not enabled.
	 */
	public function getNotEnabledUsers()
	{

		$users =  new UserQuery();
		$users->filterByEnabled(0);
		$users->find();


		/*// prepare the query, that get the disabled users
		$disabledUsers = 'select id,username,email from user where enabled = 0';
		$stmt = $this->connInvoices->prepare($disabledUsers);

		// the query statement is executed and returned
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);*/

		return $users;
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

		// insert in the query the data of the new user
		$stmt->bindParam(':id', $id);

		// the query statement is executed
		$stmt->execute();
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
