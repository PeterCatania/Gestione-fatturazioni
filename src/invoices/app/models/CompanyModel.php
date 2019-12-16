<?php

use Propel\Runtime\Exception\PropelException;

/**
 * @author Peter Catania
 * @version 14.12.2019
 *
 * Provide methods that interact with the table company of the database.
 */
class CompanyModel
{
    /**
     * Save a new company in the database.
     *
     * @param string $name The company name
     * @param string $logoPath The company logo path
     * @param string $iban The company iban
     * @param string $street The company street address
     * @param string $houseNo The company houseNo address
     * @param string $email The company email
     * @param string $site The company site
     * @param string $telephone The company telephone
     * @param string $city The company city
     * @param string $nap The company nap address
     */
    public function saveCompany(
        $name,
        $logoPath,
        $iban,
        $street,
        $houseNo,
        $email,
        $site,
        $telephone,
        $city,
        $nap
    ){
        // set the company values
        $company = new Company();
        $company->setName($name);
        $company->setLogoPath($logoPath);
        $company->setIban($iban);
        $company->setStreet($street);
        $company->setHouseNo($houseNo);
        $company->setEmail($email);
        $company->setSite($site);
        $company->setTelefone($telephone);

        // set and save the correlated city
        require_once 'CityModel.php';
        $cityModel = new CityModel();
        $cityId = $cityModel->saveCity($city, $nap);
        $company->setCityId($cityId);

        try {
            $company->save();
        } catch (PropelException $e) {
            print_r($e);
        }
    }

    /**
     * Update a company saved in the database.
     *
     * @param int $id The company id
     * @param string $name The company name
     * @param string $logoPath The company logo path
     * @param string $iban The company iban
     * @param string $street The company street address
     * @param string $houseNo The company houseNo address
     * @param string $email The company email
     * @param string $site The company site
     * @param string $telephone The company telephone
     * @param string $city The company city
     * @param string $nap The company nap address
     */
    public function updateCompany(
        $id,
        $name,
        $logoPath,
        $iban,
        $street,
        $houseNo,
        $email,
        $site,
        $telephone,
        $city,
        $nap
    ){
        // set the company values
        $company = $this->getCompanyById($id);
        $company->setName($name);
        $company->setLogoPath($logoPath);
        $company->setIban($iban);
        $company->setStreet($street);
        $company->setHouseNo($houseNo);
        $company->setEmail($email);
        $company->setSite($site);
        $company->setTelefone($telephone);

        // set and save the correlated city
        require_once 'CityModel.php';
        $cityModel = new CityModel();
        $cityId = $cityModel->saveCity($city, $nap);
        $company->setCityId($cityId);

        try {
            $company->save();
        } catch (PropelException $e) {
            print_r($e);
        }
    }

    /**
     * Get the company with the given id.
     *
     * @param int $id The id of the company
     * @return Company The company with the given id
     */
    public function getCompanyById($id){
        $companies = new CompanyQuery();
        return $companies->findOneById($id);
    }
}