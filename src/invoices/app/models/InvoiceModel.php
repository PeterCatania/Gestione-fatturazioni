<?php

use Propel\Runtime\Exception\PropelException;

class InvoiceModel
{

    /**
     * Get the invoices saved in the database.
     */
    public function getInvoices(){
        $invoices = new InvoiceQuery();
        return $invoices->find();
    }

    /**
     * Get the invoice with the given id.
     *
     * @param int $id The id of the invoice
     * @return Invoice The invoice with the given id, or null if don't exists
     */
    public function getOneById($id){
        $invoices = new InvoiceQuery();
        return $invoices->findOneById($id);
    }

    /**
     * Save a empty invoice in the database.
     *
     * @param Client $client The client associated with the invoice
     * @param Typology $typology The typology associated with the invoice
     * @param string $paymentDate The invoice payment date
     * @return Invoice The saved invoice
     */
    private function saveEmptyInvoice($client, $typology, $paymentDate){
        $invoice = new Invoice();
        $invoice->setPrintNo(0);
        $invoice->setCreationDate(date('Y-m-d'));
        $invoice->setStatus('saved');
        $invoice->setPaymentDate($paymentDate);
        $invoice->setCallback(0);
        try {
            $invoice->setClient($client);
            $invoice->setTypology($typology);
            $invoice->save();
        } catch (PropelException $e) {
        }
        return $invoice;
    }

    /**
     * Save a new invoice, and the associated typology, client and products.
     *
     * @param int[] $productsId The associated products id
     * @param string[] $productsDescription The associated products description
     * @param float[] $productsPrice The associated products price
     * @param string[] $productsSellDate The associated products sell date
     * @param int[] $productsQuantity The associated products quantity
     * @param int $clientId The associated client id
     * @param string $clientName The associated client name
     * @param string $clientSurname The associated client surname
     * @param string $companyName The associated client company name
     * @param string $clientStreet The associated client address street
     * @param string $clientHouseNo The associated client address house no
     * @param string $clientEmail The associated client email
     * @param string $clientTelephone The associated client telephone
     * @param string $clientCity The associated client address city
     * @param int $clientNap The associated client address nap
     * @param int $typologyId The associated typology id
     * @param string $typologyName The associated typology id
     * @param string $paymentDate The invoice payment date
     */
    public function saveInvoice(
        $productsId,
        $productsDescription,
        $productsPrice,
        $productsSellDate,
        $productsQuantity,
        $clientId,
        $clientName,
        $clientSurname,
        $companyName,
        $clientStreet,
        $clientHouseNo,
        $clientEmail,
        $clientTelephone,
        $clientCity,
        $clientNap,
        $typologyId,
        $typologyName,
        $paymentDate
    ){
        // import models
        require_once 'TypologyModel.php';
        $typologyModel = new TypologyModel();
        require_once 'ClientModel.php';
        $clientModel = new ClientModel();

        require_once 'ProductModel.php';
        $productModel = new ProductModel();
        require_once 'InsertedRelationshipModel.php';
        $insertedRelationshipModel = new InsertedRelationshipModel();

        // do if the typology exists
        if($typologyId && $typologyModel->getOneById($typologyId)){
            // update typology
            $typology = $typologyModel->updateTypology(
                $typologyId,
                $typologyName
            );
        } else {
            // save a new typology
            $typology = $typologyModel->saveTypology($typologyName);
        }

        // do if the client exists
        if($clientId && $clientModel->getOneById($clientId)){
            // update the associated client
            $client = $clientModel->updateClient(
                $clientId,
                $clientName,
                $clientSurname,
                $clientStreet,
                $clientHouseNo,
                $clientCity,
                $clientNap,
                $clientTelephone,
                $clientEmail,
                $companyName
            );
        } else {
            // save the associated client
            $client = $clientModel->saveClient(
                $clientName,
                $clientSurname,
                $clientStreet,
                $clientHouseNo,
                $clientCity,
                $clientNap,
                $clientTelephone,
                $clientEmail,
                $companyName
            );
        }

        // save the a new empty invoice with the associated client ad typology
        $invoice = $this->saveEmptyInvoice($client, $typology, $paymentDate);

        foreach (array_keys($productsDescription) as $i){
            if($productsId[$i] && $productModel->getOneById($i)){
                // update the product
                $product = $productModel->updateProduct(
                    $productsId[$i],
                    $productsDescription[$i],
                    $productsPrice[$i]
                );
            } else{
                $product = $productModel->saveProduct(
                    $productsDescription[$i],
                    $productsPrice[$i]
                );
            }

            // Save the  inserted relationship between product and invoice
            $insertedRelationshipModel->saveInsertedRelationship(
                $product,
                $invoice,
                $productsSellDate[$i],
                $productsQuantity[$i]
            );
        }
    }

    /**
     * Save a new invoice, and the associated typology, client and products.
     *
     * @param int $id The invoice id
     * @param int[] $productsId The associated products id
     * @param string[] $productsDescription The associated products description
     * @param float[] $productsPrice The associated products price
     * @param string[] $productsSellDate The associated products sell date
     * @param int[] $productsQuantity The associated products quantity
     * @param int $clientId The associated client id
     * @param string $clientName The associated client name
     * @param string $clientSurname The associated client surname
     * @param string $companyName The associated client company name
     * @param string $clientStreet The associated client address street
     * @param string $clientHouseNo The associated client address house no
     * @param string $clientEmail The associated client email
     * @param string $clientTelephone The associated client telephone
     * @param string $clientCity The associated client address city
     * @param int $clientNap The associated client address nap
     * @param int $typologyId The associated typology id
     * @param string $typologyName The associated typology id
     * @param string $paymentDate The invoice payment date
     */
    public function updateInvoice(
        $id,
        $productsId,
        $productsDescription,
        $productsPrice,
        $productsSellDate,
        $productsQuantity,
        $clientId,
        $clientName,
        $clientSurname,
        $companyName,
        $clientStreet,
        $clientHouseNo,
        $clientEmail,
        $clientTelephone,
        $clientCity,
        $clientNap,
        $typologyId,
        $typologyName,
        $paymentDate
    ){
        // import models
        require_once 'TypologyModel.php';
        $typologyModel = new TypologyModel();
        require_once 'ClientModel.php';
        $clientModel = new ClientModel();
        require_once 'ProductModel.php';
        $productModel = new ProductModel();
        require_once 'InsertedRelationshipModel.php';
        $insertedRelationshipModel = new InsertedRelationshipModel();

        // do if the typology exists
        if($typologyId && $typologyModel->getOneById($typologyId)){
            // update typology
            $typology = $typologyModel->updateTypology(
                $typologyId,
                $typologyName
            );
        } else {
            // save a new typology
            $typology = $typologyModel->saveTypology($typologyName);
        }

        // do if the client exists
        if($clientId && $clientModel->getOneById($clientId)){
            // update the associated client
            $client = $clientModel->updateClient(
                $clientId,
                $clientName,
                $clientSurname,
                $clientStreet,
                $clientHouseNo,
                $clientCity,
                $clientNap,
                $clientTelephone,
                $clientEmail,
                $companyName
            );
        } else {
            // save the associated client
            $client = $clientModel->saveClient(
                $clientName,
                $clientSurname,
                $clientStreet,
                $clientHouseNo,
                $clientCity,
                $clientNap,
                $clientTelephone,
                $clientEmail,
                $companyName
            );
        }

        // get the invoice with the given id
        $invoice = $this->getOneById($id);
        if($paymentDate){
            $invoice->setPaymentDate($paymentDate);
            $invoice->setStatus('paid');
        }
        $invoice->setTypologyId($typology->getId());
        $invoice->setClientId($client->getId());

        foreach (array_keys($productsDescription) as $i){
            if($productsId[$i] && $productModel->getOneById($i)){
                // update the product
                $product = $productModel->updateProduct(
                    $productsId[$i],
                    $productsDescription[$i],
                    $productsPrice[$i]
                );
            } else{
                $product = $productModel->saveProduct(
                    $productsDescription[$i],
                    $productsPrice[$i]
                );
            }

            // get the inserted relationship between product and invoice
            $inserted = $insertedRelationshipModel->getOneByInvoiceIdProductId(
                $id,$productsId[$i]
            );

            if($inserted){
                // update the  inserted relationship between product and invoice
                $insertedRelationshipModel->updateInsertedRelationship(
                    $product,
                    $invoice,
                    $productsSellDate[$i],
                    $productsQuantity[$i]
                );
            }else{
                // save the  inserted relationship between product and invoice
                $insertedRelationshipModel->saveInsertedRelationship(
                    $product,
                    $invoice,
                    $productsSellDate[$i],
                    $productsQuantity[$i]
                );
            }
        }

        try {
            $invoice->save();
        } catch (PropelException $e) {
            print_r($e);
        }
    }

    /**
     * Delete the invoice with the given id.
     *
     * @param int $id The id of the invoice to delete.
     * @return void
     */
    public function deleteInvoiceById($id){
        $invoice = $this->getOneById($id);
        try {
            foreach ($invoice->getInserteds() as $inserted) {
                $inserted->delete();
            }
            $invoice->delete();
        } catch (PropelException $e) {
            print_r($e);
        }
    }
}