<?php

/**
 * @author Peter Catania
 * @version 26.11.2019
 *
 * Provide methods that interact with the table city of the database.
 */
class CityModel
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
     * Save a new city in the database.
     * 
     * @param string $name The name of the new city 
     * @param int $nap The nap of the new city
     * @return void
     */
    public function saveCity($name, $nap)
    {
        // prepare the query, to insert a new city in the database
        $insertCity = "
			insert ignore into city (id, name, nap) values (null, :name, :nap)
		";
        $stmt = $this->connInvoices->prepare($insertCity);

        // insert in the query, the data of the new city
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':nap', $nap);

        // execute the query
        $stmt->execute();
    }

    /**
     * Get the last id from the table city.
     *
     * @return string The last id from the table city.
     */
    public function getCityLastId()
    {
        // prepare the query, to get the last id from the table city
        $selectLastId = "select max(id) from city";
        $stmt = $this->connInvoices->prepare($selectLastId);

        // execute and get the last id 
        $stmt->execute();
        $lastId = ($stmt->fetch(PDO::FETCH_NUM))[0];
        return $lastId;
    }
}
