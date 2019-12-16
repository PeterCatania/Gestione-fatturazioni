<?php

use Propel\Runtime\Exception\PropelException;


/**
 * @author Peter Catania
 * @version 11.12.2019
 *
 * Provide methods that interact with the table client company of the database.
 */
class ClientCompanyModel
{

    /**
     * Save a new client company in the database.
     *
     * @param string $name The name of the client company
     * @param int $clientId The client company correlated client id
     * @return void
     */
    public function saveClientCompany($name,$clientId){
        $clientsCompany = new ClientCompany();
        $clientsCompany->setName($name );
        $clientsCompany->setClientId($clientId);
        try {
            $clientsCompany->save();
        } catch (PropelException $e) {
            print_r($e);
        }
    }

    /**
     * Update a client company in the database.
     *
     * @param string $name The name of the client company
     * @param int $clientId The client company correlated client id
     * @return void
     */
    public function updateClientCompany($name,$clientId){
        $clientCompany = $this->getOneByClientId($clientId);
        $clientCompany->setName($name);
        try {
            $clientCompany->save();
        } catch (PropelException $e) {
        }
    }

    /**
     * Delete a client company from the database, where the id correspond with the given.
     *
     * @param int $id The id of the client company to delete
     * @return void
     */
    public function deleteClientCompanyById($id)
    {
        $clientCompany = new ClientCompanyQuery();
        $clientCompany = $clientCompany->findPK($id);
        try {
            $clientCompany->delete();
        } catch (PropelException $e) {
            print_r($e);
        }
    }

    /**
     * Get the client company with the given id.
     *
     * @param int $id The id of the client company
     * @return ClientCompany The client company with the given id, or null if don't exists
     */
    public function getOneByClientId($id){
        $clientsCompany = new ClientCompanyQuery();
        return $clientsCompany->findOneByClientId($id);
    }
}