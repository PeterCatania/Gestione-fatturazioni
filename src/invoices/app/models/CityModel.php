<?php

use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Propel;

/**
 * @author Peter Catania
 * @version 26.11.2019
 *
 * Provide methods that interact with the table city of the database.
 */
class CityModel
{
    /**
     * Save a new city in the database.
     *
     * @param string $name The name of the new city
     * @param int $nap The nap of the new city
     * @return int The id of the saved city
     */
    public function saveCity($name, $nap)
    {
        $conn = Propel::getConnection();
        // prepare the query, to insert a new city in the database
        $insertCity = "INSERT ignore INTO city (id, name, nap) VALUES (null, :name, :nap)";
        $stmt = $conn->prepare($insertCity);

        // insert in the query, the data of the new city
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':nap', $nap);

        // execute the query
        $stmt->execute();

        // return the id of the saved city
        return $conn->lastInsertId();
    }

    /**
     * Get the city with the given NAP.
     *
     * @param int $nap The nap of the city
     * @return City The city with the given NAP, or null if doesn't exists
     */
    public function getCity($nap)
    {
        $cities = new CityQuery;
        $cities->find();
        return $cities->findOneByNap($nap);
    }
}
