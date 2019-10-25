<?php
/**
 * @author Peter Catania
 * @version 22.10.2019
 *
 * Provide a way to connect to a mysql database.
 */
class Database
{
    /**
     * Ensures that the constructor cannot be called from outside.
     */
    private function __construct(){}

    /**
     * Get the rappresentation of a connection to a database.
     *
     * @return PDO The rappresentation of a connection to a database
     */
    public static function getDBConnection()
    {
      $dbConnection = "";
      try
      {
        $dbConnection = new PDO(DSN, MYSQLUSER, MYSQLPASS);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch (PDOException $e)
      {
        echo 'Connection failed: ' . $e->getMessage();
      }
      return $dbConnection;
    }
}
