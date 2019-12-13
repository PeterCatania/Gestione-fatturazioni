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
}