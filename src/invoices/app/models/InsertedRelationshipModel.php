<?php

use Propel\Runtime\Exception\PropelException;

class InsertedRelationshipModel
{
    /**
     * Get the inserted relationship between product and invoice tables.
     *
     * @param int $invoiceId The associated invoice id
     * @param int $productId The associated product id
     * @return Inserted The inserted relationship between product and invoice
     */
    public function getOneByInvoiceIdProductId(
        $invoiceId,
        $productId
    ){
        $inserted = new InsertedQuery();
        $inserted->filterByProductId($productId);
        return $inserted->findOneByInvoiceId($invoiceId);
    }

    /**
     * Save a new inserted relationship between product and invoice tables.
     *
     * @param Product $product The product of the inserted relationship
     * @param Invoice $invoice The invoice of the inserted relationship
     * @param string $sellDate The product sell date of the inserted relationship
     * @param int $quantity The product quantity of the inserted relationship
     */
    public function saveInsertedRelationship(
        $product,
        $invoice,
        $sellDate,
        $quantity
    ){
        $inserted = new Inserted();
        $inserted->setSellDate($sellDate);
        $inserted->setQuantity($quantity);
        try {
            $inserted->setProduct( $product );
            $inserted->setInvoice($invoice);
            $inserted->save();
        } catch (PropelException $e) {
            print_r($e);
        }
    }

    /**
     * Update a inserted relationship between product and invoice tables.
     *
     * @param Product $product The product of the inserted relationship
     * @param Invoice $invoice The invoice of the inserted relationship
     * @param string $sellDate The product sell date of the inserted relationship
     * @param int $quantity The product quantity of the inserted relationship
     */
    public function updateInsertedRelationship(
        $product,
        $invoice,
        $sellDate,
        $quantity
    ){
        $inserted = $this->getOneByInvoiceIdProductId(
            $invoice->getId(),
            $product->getId()
        );
        $inserted->setSellDate($sellDate);
        $inserted->setQuantity($quantity);
        try {
            $inserted->save();
        } catch (PropelException $e) {
            print_r($e);
        }
    }
}