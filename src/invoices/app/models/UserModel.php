<?php

use Propel\Runtime\Exception\PropelException;

/**
 * @author Peter Catania
 * @version 29.11.2019
 *
 * Provide methods that interact with the table user of the database.
 */
class UserModel
{
	/**
	 * Empty constructor.
	 * 
	 * @return void
	 */
	public function __construct()
	{ }

	/**
	 * Get the users from the database, that are not enabled.
	 * 
	 * @return User[] The users saved in the database
	 */
	public function getUsers()
	{
		$users =  new UserQuery();
		$users->orderByEnabled();
		$users->orderByUsername();
		return $users->find();
	}

    /**
     * Insert a new user in the database.
     *
     * @param string $username The username of the new user
     * @param string $password The password of the new user
     * @param string $email The email of the new user
     * @param bool $enabled The value that tell if a user is enabled, of the new user
     * @return void
     * @throws PropelException
     */
	public function saveUser($username, $password, $email, $enabled)
	{
		$user = new User();
		$user->setUsername($username);
		$user->setPassword($password);
		$user->setEmail($email);
		$user->setEnabled($enabled);
		$user->save();
	}

    /**
     * Update a user saved in the database.
     *
     * @param int $id The id of the user
     * @param string $username The username of the user
     * @param string $email The email of the user
     * @param bool $enabled The value that tell if a user is enabled, of the new user
     * @return void
     * @throws PropelException
     */
	public function updateUser($id, $username, $email, $enabled)
	{
		$users = new UserQuery();
		$user = $users->findPK($id);
		$user->setUsername($username);
		$user->setEmail($email);
		$user->setEnabled($enabled);
		$user->save();
	}

    /**
     * Delete a user from the database, where the id correspond with the given.
     *
     * @param int $id The id of the user to delete
     * @return void
     * @throws PropelException
     */
	public function deleteUserById($id)
	{
		$users = new UserQuery();
		$user = $users->findPK($id);
		$user->delete();
	}
}
