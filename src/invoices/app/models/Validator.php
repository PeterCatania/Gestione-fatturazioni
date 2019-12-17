<?php

/**
 * @author Peter Catania
 * @version 28.11.2019
 *
 * Validate different type of data.
 */
class Validator
{
    /**
     * the hash sha256 of an empty password
     */
    private const EMPTY_PASSWORD_HASH = "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855";

    /**
     * @var bool Tell if all the fields are valid.
     */
    private $allFieldsAreValid = true;

    /**
     * Tell if all the fields are valid.
     *
     * @return bool
     */
    public function areAllFieldsValid(){
        return $this->allFieldsAreValid;
    }

    /* Data Validity -------------------------------------------------------*/

    /**
     *  Return true if the given email is valid.
     *
     * @param mixed $email The email to check the validation
     * @return bool If the email is valid return true otherwise false
     */
    function isEmailValid($email)
    {
        $email = trim(htmlspecialchars($email));
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        return $email;
    }

    /**
     *  Return true if the given int is valid.
     *
     * @param mixed $number The number to check the validation
     * @return bool If the number is valid return true otherwise false
     */
    function isIntValid($number)
    {
        $number = $_POST['number'];
        $number = filter_var($number, FILTER_VALIDATE_INT);
        return $number;
    }

    /**
     *  Return true if the given data is valid as a name.
     *
     * @param mixed $name The data to validate as a name is valid
     * @return bool If the name is valid return true otherwise false
     */
    function isNameValid($name)
    {
        $accentedChars =
            'àèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ';
        $pattern =
            '/^[a-zA-Z' .
            $accentedChars .
            ']+[a-zA-Z0-9_.' .
            $accentedChars .
            '-]+$/';
        return preg_match($pattern, $name);
    }

    /**
     * Validate data of any kind.
     *
     * @param mixed $data The data to validate
     * @return boolean The validated data
     */
    public function generalValidation($data)
    {
        $data = trim(stripslashes(htmlspecialchars($data)));
        return $data;
    }

    /**
     * Validate data to type int.
     *
     * @param mixed $data The data to validate to int
     * @return int The validated int
     */
    public function validateInt($data)
    {
        $data = $this->generalValidation($data);
        $data = filter_var($data, FILTER_SANITIZE_NUMBER_INT);
        return intval($data);
    }

    /**
     * Validate data to type float/double.
     *
     * @param mixed $data The data to validate to float
     * @return float The validated float
     */
    public function validateFloat($data)
    {
        $data = $this->generalValidation($data);
        return floatval($data);
    }

    /**
     * Validate data to type bool.
     *
     * @param mixed $data The data to validate to bool
     * @return bool The validated bool
     */
    public function validateBool($data)
    {
        $data = $this->generalValidation($data);
        return boolval($data);
    }

    /**
     * Validate data to type string.
     *
     * @param mixed $data The data to validate to string
     * @return string The validated string
     */
    public function validateString($data)
    {
        $data = $this->generalValidation($data);
        return strval($data);
    }

    /**
     * Validate data as a name.
     * Es "peTer123" => "Peter123".
     *
     * @param mixed $data The data to validate as a name
     * @return string The validated name
     */
    public function validateName($data)
    {
        $data = $this->validateString($data);
        $data = strtolower($data);
        return ucfirst($data);
    }

    /**
     * Validate data as email.
     * es "Paolo.Vercisio@gmail.com" => "paolo.vercisio@gmail.com".
     *
     * @param mixed $data The data to validate as an email
     * @return string The validated email
     */
    public function validateEmail($data)
    {
        $data = filter_var($data, FILTER_VALIDATE_EMAIL);
        $data = $this->validateString($data);
        return strtolower($data);
    }

    /**
     * Validate data as a price.
     * Es "14.000,566" => "14000.57".
     *
     * @param mixed $data The data to validate as a price
     * @return float The validated price
     */
    public function validatePrice($data)
    {
        $data = $this->validateFloat($data);
        return number_format($data, 2, '.', '');
    }

    /**
     * Validate data as capitalized words.
     * Es "San gallO" => "San Gallo".
     *
     * @param mixed $data The data to validate as capitalized words
     * @return string The validated capitalized words
     */
    public function validateCapitalizedWords($data)
    {
        $data = $this->validateString($data);
        return ucwords($data, " ");
    }

    /**
     * Validate data as a telephone number.
     * Es "+41 787  322299" => "+41 78 732 22 99".
     *
     * @param mixed $data The data to validate as a telephone number
     * @return string The validated telephone number
     */
    public function validateTelephoneNumber($data)
    {
        // validate telephone number
        $data = filter_var($data, FILTER_SANITIZE_NUMBER_INT);
        $data = str_replace("-", "", $data);

        // construct the structure of the telephone number
        if(strlen($data) == 12){
            $data = substr_replace($data, substr($data, 0, 3) . ' ', 0, 3);
            $data = substr_replace($data, substr($data, 4, 2) . ' ', 4, 2);
            $data = substr_replace($data, substr($data, 7, 3) . ' ', 7, 3);
            $data = substr_replace($data, substr($data, 11, 2) . ' ', 11, 2);
        }

        return $data;
    }

    /* Fields Validity -------------------------------------------------------*/

    /**
     * Verify the validity of the field, from a form.
     * if the value is valid true or false if not.
     *
     * @param mixed $fieldValue the field value, from a form
     * @return string the validity of the field
     */
    public function isFieldValid($fieldValue)
    {
        // verify if the field value, from the form is empty
        if (empty($fieldValue)) {
            $this->allFieldsAreValid = false;
            return INVALID;
        }
        return VALID;
    }

    /**
     * Verify the validity of the field , from the price field
     * if the value is valid true or false if not.
     *
     * @param mixed $fieldValue the field value, from the price field
     * @return string the validity of the field
     */
    public function isPriceFieldValid($fieldValue)
    {
        $fieldValue = intval($fieldValue);

        // verify if the field value, from the form is empty
        if (empty($fieldValue) || $fieldValue == 0) {
            $this->allFieldsAreValid = false;
            return INVALID;
        }
        return VALID;
    }

    /**
     * Verify the validity of the field value, from the email field
     * if the value is valid true or false if not.
     *
     * @param mixed $fieldValue the field value, from the email field
     * @return string the validity of the field value
     */
    public function isEmailFieldValid($fieldValue)
    {
        // verify if the field value, from the form is empty
        if (empty($fieldValue) || !$this->isEmailValid($fieldValue)) {
            $this->allFieldsAreValid = false;
            return INVALID;
        }
        return VALID;
    }

    /**
     * Verify the validity of the field, from the email field
     * if the value is valid true or false if not.
     *
     * @param mixed $fieldValue the field value, from the email field
     * @return string the validity of the field
     */
    public function isFieldValidWithoutTags($fieldValue)
    {
        // verify if the field value, from the form is empty
        if (empty($fieldValue) || strip_tags($fieldValue) !== $fieldValue) {
            $this->allFieldsAreValid = false;
            return INVALID;
        }
        return VALID;
    }

    /**
     * Verify the validity of the field, from the email field
     * if the value is valid true or false if not.
     *
     * @param mixed $fieldValue the field value, from the email field
     * @return string the validity of the field
     */
    public function isNameFieldValid($fieldValue)
    {
        // verify if the field value, from the form is empty
        if (empty($fieldValue) || !$this->isNameValid($fieldValue)) {
            $this->allFieldsAreValid = false;
            return INVALID;
        }
        return VALID;
    }

    /**
     * Verify the validity of the password field, from a form.
     *
     * @param string $passwordHash The password field hash, from a form
     * @param string $passwordValue The password field value, from a form
     * @return string the validity of the password field
     */
    public function isPasswordFieldValid(
        $passwordHash,
        $passwordValue
    ) {
        // verify if the password field value, from the form is empty
        if (
            empty($passwordHash) ||
            $passwordHash === self::EMPTY_PASSWORD_HASH ||
            strip_tags($passwordValue) !== $passwordValue
        ) {
            $this->allFieldsAreValid = false;
            return INVALID;
        }
        return VALID;
    }

    /**
     * Verify the validity of the password fields value, from a form.
     *
     * @param string $passwordHash The password field hash, from a form
     * @param string $confirmedPasswordHash The confirmed password field hash, from a form
     * @param string $confirmedPasswordValue The confirmed password field value, from a form
     * @return bool the validity of the password fields value
     */
    public function isConfirmedPasswordFieldValid(
        $passwordHash,
        $confirmedPasswordHash,
        $confirmedPasswordValue
    ) {
        // verify if the password is valid
        $confirmedPasswordValidity = $this->isPasswordFieldValid(
            $confirmedPasswordHash,
            $confirmedPasswordValue
        );

        // verify if correspond with the anther one
        if ($confirmedPasswordHash !== $passwordHash) {
            $this->allFieldsAreValid = false;
            $confirmedPasswordValidity = INVALID;
        }

        return $confirmedPasswordValidity;
    }
}
