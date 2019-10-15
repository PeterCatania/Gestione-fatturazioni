<?php
/**
* Provide the way to connect to the database of the site "Invoices"
*/
Class Database
{
    /**
    * The connectio with the database.
    */
    private static $_connection = NULL;

    /**
    * Ensures that the constructor cannot be called from outside.
    */
    private function __construct(){}

    /**
    * Get the connection with the database.
    */
    public static function getConnection()
    {
        if (!self::$_connection) {
            try {
                self::$_connection = new PDO(DSN, MYSQLUSER, MYSQLPASS);
                self::$_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }
        return self::$_connection;
    }
}
