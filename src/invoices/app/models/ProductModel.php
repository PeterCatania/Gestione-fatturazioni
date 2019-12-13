<?php

use Propel\Runtime\Exception\PropelException;

/**
 * @author Peter Catania
 * @version 19.11.2019
 *
 * Provide methods that interact with the table product of the database.
 */
class ProductModel
{

	/**
	 * Get the saved products in the database.
	 */
	public function getProducts()
	{
        $product =  new ProductQuery();
        $product->orderByDescription();
        return $product->find();
	}

	/**
	 * Insert a new product in the database.
	 *
	 * @param string $description The description of the new product
	 * @param string $price The price of the new product
     * @return Product The saved product
	 */
	public function saveProduct($description, $price)
	{
	    $product= new Product();
        $product->setDescription($description);
        $product->setPrice(number_format($price, 2, '.', ''));
        try {
            $product->save();
        } catch (PropelException $e) {
            print_r($e);
        }

        return $product;
    }

    /**
     * Update a product saved in the database.
     *
     * @param int $id The id of the product
     * @param string $description The description of the product
     * @param string $price The price of the product
     * @return void
     */
    public function updateProduct($id, $description, $price)
    {
        $products = new ProductQuery();
        $product = $products->findPK($id);
        $product->setDescription($description);
        $product->setPrice($price);
        try {
            $product->save();
        } catch (PropelException $e) {
            print_r($e);
        }
    }

    /**
     * Delete a product from the database, where the id correspond with the given.
     *
     * @param int $id The id of the product to delete
     * @return void
     */
    public function deleteProductById($id)
    {
        $products = new ProductQuery();
        $product = $products->findPK($id);
        try {
            $product->delete();
        } catch (PropelException $e) {
            print_r($e);
        }
    }
}
