<?php


class AdministratorModel
{
    /**
     * Get all users from the database.
     *
     * @param string $username The administrator username
     * @param string $password The administrator password
     * @return Administrator The user with the given username and password
     */
    public function getAdministratorByUsernamePassword($username, $password)
    {
        $administrators = new AdministratorQuery();
        $administrators->filterByUsername($username);
        return $administrators->findOneByPassword($password);
    }

    /**
     * Get the administrator with the given name.
     *
     * @param int $id The id of the administrator
     * @return Administrator The administrator with the given id, or null if doesn't exists
     */
    public function getAdministratorById($id){
        $administrators = new AdministratorQuery();
        return $administrators->findOneById($id);
    }
}