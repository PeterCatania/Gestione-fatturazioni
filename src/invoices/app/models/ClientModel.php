<?php

use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Propel;

/**
 * @author Peter Catania
 * @version 11.12.2019
 *
 * Provide methods that interact with the table client of the database.
 */
class ClientModel
{

    /**
     * Get the saved clients in the database.
     */
    public function getClients()
    {
        //get the connection with the database
        $conn = Propel::getConnection();

        // prepare the query, that get the saved clients
        $selectClients = '
			SELECT cl.id, cl.name AS clientName, cl.surname AS clientSurname, cl.street, cl.house_no AS houseNo, ci.name AS city, ci.nap, cl.telephone, cl.email,
			IF(EXISTS (
					SELECT co.name
					FROM client_company co
					WHERE co.client_id = cl.id
				), (
					SELECT co.name
					FROM client_company co
					WHERE co.client_id = cl.id
				), null) AS companyName
			FROM client cl, city ci
			WHERE cl.city_id = ci.id;
		';
        $stmt = $conn->prepare($selectClients);

        // the query statement is executed and returned
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the client with the given id.
     *
     * @param int $id The id of the client
     * @return Client The client with the given id, or null if don't exists
     */
    public function getOneById($id)
    {
        $clients = new ClientQuery();
        return $clients->findOneById($id);
    }

    /**
     * Save a new client in the database, also it might be a company.
     *
     * @param string $clientName The new name of the client, or the responsible of the company
     * @param string $clientSurname The new surname of the client, or the responsible of the company
     * @param string $street The new street of the client address
     * @param string $houseNo The new client house_no of the client address
     * @param string $city The new city of the client address
     * @param int $nap The new nap of the client address
     * @param string $telephone The new telephone of the client
     * @param string $email The new email of the client
     * @param string $companyName The new company name of the client, if the client is a company
     * @return Client The new saved client.
     */
    public function saveClient(
        $clientName,
        $clientSurname,
        $street,
        $houseNo,
        $city,
        $nap,
        $telephone,
        $email,
        $companyName = null
    ) {
        // set the client values
        $client = new Client();
        $client->setName($clientName);
        $client->setSurname($clientSurname);
        $client->setStreet($street);
        $client->setHouseNo($houseNo);
        $client->setTelephone($telephone);
        $client->setEmail($email);

        // set and save the correlated city
        require_once 'CityModel.php';
        $cityModel = new CityModel();
        $cityId = $cityModel->saveCity($city, $nap);
        $client->setCityId($cityId);

        try {
            $client->save();

            if ($companyName) {
                $clientCompany = new ClientCompany();
                $clientCompany->setName($companyName);
                $clientCompany->setClient($client);
                $clientCompany->save();
            }
        } catch (PropelException $e) {
            print_r($e);
        }
        return $client;
    }

    /**
     * Update a client saved in the database.
     *
     * @param int $id The id of the client to update
     * @param string $clientName The new name of the client, or the responsible of the company
     * @param string $clientSurname The new surname of the client, or the responsible of the company
     * @param string $street The new street of the client address
     * @param string $houseNo The new client house_no of the client address
     * @param string $city The new city of the client address
     * @param int $nap The new nap of the client address
     * @param string $telephone The new telephone of the client
     * @param string $email The new email of the client
     * @param string $companyName The new company name of the client, if the client is a company
     * @return Client The updated client
     */
    public function updateClient(
        $id,
        $clientName,
        $clientSurname,
        $street,
        $houseNo,
        $city,
        $nap,
        $telephone,
        $email,
        $companyName = null
    ) {
        // import models
        require_once 'CityModel.php';
        $cityModel = new CityModel();
        require_once 'ClientCompanyModel.php';
        $clientCompanyModel = new ClientCompanyModel();

        // save the associated city in the database
        $cityModel->saveCity($city, $nap);

        $clients = new ClientQuery();
        $client = $clients->findPK($id);
        $client->setName($clientName);
        $client->setSurname($clientSurname);
        $client->setStreet($street);
        $client->setHouseNo($houseNo);
        $client->setTelephone($telephone);
        $client->setEmail($email);

        // get the correlated city
        $savedCity = $cityModel->getCity($nap);

        try {
            $client->setCity($savedCity);
            $client->save();

            if ($companyName) {
                if ($clientCompanyModel->getOneByClientId($id)) {
                    $clientCompanyModel->updateClientCompany($companyName, $id);
                } else {
                    $clientCompanyModel->saveClientCompany($companyName, $id);
                }
            }
        } catch (PropelException $e) {
            print_r($e);
        }
        return $client;
    }

    /**
     * Delete a client from the database, where the id correspond with the given.
     *
     * @param int $id The id of the client to delete
     * @return void
     */
    public function deleteClientById($id)
    {
        $client = $this->getOneById($id);
        try {
            foreach ($client->getClientCompanies() as $company) {
                $company->delete();
            }
            $client->delete();
        } catch (PropelException $e) {
            print_r($e);
        }
    }
}
