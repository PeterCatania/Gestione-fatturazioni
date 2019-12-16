<?php

use Propel\Runtime\Exception\PropelException;

class TypologyModel
{
    /**
     * Save a new typology in the database.
     *
     * @param string $name The name of the typology
     * @return Typology The new saved typology.
     */
    public function saveTypology($name){
        $typology = new Typology();
        $typology->setName($name);
        try {
            $typology->save();
        } catch (PropelException $e) {
            print_r($e);
        }
        return $typology;
    }

    /**
     * Get the typology with the given id.
     *
     * @param int $id The id of the typology
     * @return Typology The typology with the given id, or null if doesn't exists
     */
    public function getOneById($id){
        $typologies = new TypologyQuery();
        return $typologies->findOneById($id);
    }

    /**
     * Update a typology saved the database.
     *
     * @param int $id The id of the typology
     * @param string $name The name of the typology
     * @return Typology The typology updated
     */
    public function updateTypology($id, $name){
        $typology = $this->getOneById($id);
        $typology->setName($name);
        try {
            $typology->save();
        } catch (PropelException $e) {
            print_r($e);
        }
        return $typology;
    }
}