<?php
require 'Database.php';

/**
 * @author Peter Catania
 * @version 21.11.2019
 *
 * Provide methods usefull for the clients Controller.
 */
class ClientsModel
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
	 * Get the saved clients in the database.
	 */
	public function getClients()
	{
		// prepare the query, that get the saved clients
		$selectClients = '
			select cl.id, cl.name, cl.surname, cl.street, cl.house_no, ci.name, ci.nap, co.name, cl.telephone, cl.email
			from client cl, client_company co, city ci
			where cl.id = co.client_id and cl.city_id = ci.id
		';
		$stmt = $this->connInvoices->prepare($selectClients);

		// the query statement is executed and returned
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Insert a new client in the database, also it might be a company.
	 *
	 * @param clientName the new name of the client, or the responsible of the company
	 * @param clientSurname the new surname of the client, or the responsible of the company
	 * @param street the new street of the client address
	 * @param houseNo the new client house_no of the client address
	 * @param city the new city of the client address
	 * @param nap the new nap of the client address 
	 * @param telephone the new telephone of the client
	 * @param email the new email of the client
	 * @param companyName the new company name of the client, if the client is a company
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
		// prepare the query, to insert a new city in the database
		$insertCity = "insert into city (id, name, nap) values (null, :city, :nap)";
		$stmt = $this->connInvoices->prepare($insertCity);

		// insert in the query, the data of the new city
		$stmt->bindParam(':city', $city);
		$stmt->bindParam(':nap', $nap);

		// the query statement that insert the new city is executed
		$stmt->execute();

		// get the id of the new city
		$selectNewCityId = "select id from city where nap = :nap";
		$stmt = $this->connInvoices->prepare($selectNewCityId);
		$stmt->bindParam(':nap', $nap);
		$cityId = $stmt->execute();

		// prepare the query, to insert a new client in the database
		$insertClient = "
			insert into client (id, name, surname, street, house_no, telephone, email) 
			values (null, :clientName, :clientSurname, :street, :house_no, :telephone, :email)
		";
		$stmt = $this->connInvoices->prepare($insertClient);

		// insert in the query, the data of the new client
		$stmt->bindParam(':clientName', $clientName);
		$stmt->bindParam(':clientSurname', $clientSurname);
		$stmt->bindParam(':street', $street);
		$stmt->bindParam(':house_no', $houseNo);
		$stmt->bindParam(':telephone', $telephone);
		$stmt->bindParam(':email', $email);

		// the query statement that insert the new client is executed
		$stmt->execute();

		if ($companyName) {
			//prepare the query, to insert a new company name in the database
			$insertCompanyName = "
				insert into client_company (id, name) 
				values (null, :companyName)
			";
			$stmt = $this->connInvoices->prepare($insertCompanyName);

			// insert in the query, the new company name
			$stmt->bindParam(':companyName', $companyName);

			// the query statement that insert the new company name is executed
			$stmt->execute();
		}
	}
}
