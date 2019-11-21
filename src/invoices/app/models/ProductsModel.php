<?php
require 'Database.php';

/**
 * @author Peter Catania
 * @version 19.11.2019
 *
 * Provide methods usefull for the products Controller.
 */
class ProductsModel
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
	 * Get the saved products in the database.
	 */
	public function getProducts()
	{
		// prepare the query, that get the saved products
		$selectProducts = 'select id,description,price from product';
		$stmt = $this->connInvoices->prepare($selectProducts);

		// the query statement is executed and returned
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Insert a new product in the database.
	 *
	 * @param description the description of the new product
	 * @param price the price of the new product
	 */
	public function saveProduct($description, $price)
	{
		// prepare the query, to insert a new product in the database
		$selectUserById = "insert into product (id, description, price) values (null, :description, :price)";
		$stmt = $this->connInvoices->prepare($selectUserById);

		// insert in the query the data of the new product
		$stmt->bindParam(':description', $description);
		$stmt->bindParam(':price', $price);

		// the query statement is executed
		$stmt->execute();
	}
}
