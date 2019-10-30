<?php
require 'Database.php';

/**
 * @author Peter Catania
 * @version 24.10.2019
 *
 * Provide methods usefull for the login controller and for the login.
 */
class LoginModel
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
     * Get all users from the database.
     *
     * @return array All users from the database
     */
    public function getUserByUsernameAndPassword($username, $password)
    {
        // query
        $selectUserByUsernameAndPassword =
            'select id,username,email,enabled from user where username = :username and password = :password';
        $stmt = $this->connInvoices->prepare($selectUserByUsernameAndPassword);

        // inserted in the query the params
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        // the query is executed end returned
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all users from the database.
     *
     * @return array All users from the database
     */
    public function getAdministratorByUsernameAndPassword($username, $password)
    {
        // query
        $selectAllUsers =
            'select id,username,email from administrator where username = :username and password = :password';
        $stmt = $this->connInvoices->prepare($selectAllUsers);

        // inserted in the query the params
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        // the query is executed end returned
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
