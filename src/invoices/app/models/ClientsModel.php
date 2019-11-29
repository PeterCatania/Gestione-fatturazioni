<?php

/**
 * @author Peter Catania
 * @version 26.11.2019
 *
 * Provide methods that interact with the table client of the database.
 */
class ClientsModel
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
	 * Get the saved clients in the database.
	 */
	public function getClients()
	{
		// prepare the query, that get the saved clients
		$selectClients = '
			SELECT cl.id, cl.name AS clientName, cl.surname AS clientSurname, cl.street, cl.house_no AS houseNo, ci.name AS city, ci.nap, cl.telephone, cl.email, 
			CASE 
				WHEN EXISTS (
					SELECT co.name
					FROM client_company co
					WHERE co.client_id = cl.id
				) 
				THEN (
					SELECT co.name
					FROM client_company co
					WHERE co.client_id = cl.id
				)
				ELSE null
			END AS companyName 
			FROM client cl, city ci
			WHERE cl.city_id = ci.id;
		';
		$stmt = $this->connInvoices->prepare($selectClients);

		// the query statement is executed and returned
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Save a new client in the database, also it might be a company.
	 *
	 * @param string $clientName the new name of the client, or the responsible of the company
	 * @param string $clientSurname the new surname of the client, or the responsible of the company
	 * @param string $street the new street of the client address
	 * @param string $houseNo the new client house_no of the client address
	 * @param string $city the new city of the client address
	 * @param int $nap the new nap of the client address 
	 * @param string $telephone the new telephone of the client
	 * @param string $email the new email of the client
	 * @param string $companyName the new company name of the client, if the client is a company
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
		require_once 'CityModel.php';
		$cityModel = new CityModel();

		// save the associeted city in the database
		$cityModel->saveCity($city, $nap);

		// get the last id of the new city
		$cityLastId = $cityModel->getCityLastId();

		// prepare the query, to insert a new client in the database
		$insertClient = "
			insert into client (id, name, surname, street, house_no, telephone, email, city_id) 
			values (null, :clientName, :clientSurname, :street, :house_no, :telephone, :email, :cityId)
		";
		$stmt = $this->connInvoices->prepare($insertClient);

		// insert in the query, the data of the new client
		$stmt->bindParam(':clientName', $clientName);
		$stmt->bindParam(':clientSurname', $clientSurname);
		$stmt->bindParam(':street', $street);
		$stmt->bindParam(':house_no', $houseNo);
		$stmt->bindParam(':telephone', $telephone);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':cityId', $cityLastId);

		// execute the query
		$stmt->execute();

		if ($companyName) {
			// get the last id of the new client
			$clientLastId = $this->getClientLastId();

			//prepare the query, to save the associeted company name in the database
			$insertCompanyName = "
				insert into client_company (id, name, client_id) 
				values (null, :companyName, :clientId)
			";
			$stmt = $this->connInvoices->prepare($insertCompanyName);

			// insert in the query, the new company name
			$stmt->bindParam(':companyName', $companyName);
			$stmt->bindParam(':clientId', $clientLastId);

			// the query statement that insert the new company name is executed
			$stmt->execute();
		}
	}

	/**
	 * Get the last id from the client city.
	 *
	 * @return string The last id from the table client.
	 */
	public function getClientLastId()
	{
		// prepare the query, to get the last id from the table client
		$selectLastId = "select max(id) from client";
		$stmt = $this->connInvoices->prepare($selectLastId);

		// execute and get the last id 
		$stmt->execute();
		$lastId = ($stmt->fetch(PDO::FETCH_NUM))[0];
		return $lastId;
	}
}
