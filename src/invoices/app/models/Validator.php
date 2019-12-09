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
     *  Return true if the given email is valid, structurally and syntactically.
     *
     * @param mixed $email The email to check the validation
     * @return bool If the email is valid return true otherwise false
     */
    function isValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) &&
            preg_match('/@.+\./', $email);
    }

    /**
     *  Return true if the given data is valid as a name.
     *
     * @param mixed $name The data to validate as a name is valid
     * @return bool If the name is valid return true otherwise false
     */
    function isValidName($name)
    {
        $accentedChars =
            'àèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ';
        $pattern =
            '/^[a-zA-Z' .
            $accentedChars .
            ']+,\s[a-zA-Z' .
            $accentedChars .
            ']+$/';
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
        $data = substr_replace($data, substr($data, 0, 3) . ' ', 0, 3);
        $data = substr_replace($data, substr($data, 4, 2) . ' ', 4, 2);
        $data = substr_replace($data, substr($data, 7, 3) . ' ', 7, 3);
        $data = substr_replace($data, substr($data, 11, 2) . ' ', 11, 2);
        return $data;
    }

    /**
     * Verify the validity of the field value, from a form.
     * if the value is valid true or false if not.
     *
     * @param mixed $fieldValue the field value, from a form
     * @param string $fieldName the field name, from a form
     * @return boolean the validity of the field value
     */
    public function isFieldValueValid($fieldValue, $fieldName)
    {
        // verify if the field value, from the form is empty
        if (empty($fieldValue)) {
            $_SESSION[$fieldName . 'CSSValidityClass'] = INVALID;
            return false;
        }

        $_SESSION[$fieldName . 'CSSValidityClass'] = VALID;
        return true;
    }

    /**
     * Verify the validity of the password fields value, from a form.
     *
     * @param string $passwordValue The password field value, from a form
     * @param string $passwordName The password field name, from a form
     * @param string $confirmedPasswordValue The confirmed password field value, from a form
     * @param string $confirmedPasswordName The confirmed password field name, from a form
     * @return boolean the validity of the password field value
     */
    public function arePasswordsValueValid(
        $passwordValue,
        $passwordName,
        $confirmedPasswordValue,
        $confirmedPasswordName
    ){
        $passwordIsValid = false;
        $confirmedPasswordIsValid = false;

        // the hash sha256 of an empty password
        $emptyPasswordHash = "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855";

        // verify if the password field value, from the form is empty
        if (empty($passwordValue) || $passwordValue === $emptyPasswordHash) {
            $_SESSION[$passwordName . 'CSSValidityClass'] = INVALID;
        }else{
            $_SESSION[$passwordName . 'CSSValidityClass'] = VALID;
            $passwordIsValid = true;
        }

        // verify if the confirmed password field value, from the form is empty
        if (empty($confirmedPasswordValue) || $confirmedPasswordValue === $emptyPasswordHash) {
            $_SESSION[$confirmedPasswordName . 'CSSValidityClass'] = INVALID;
        }else{
            $_SESSION[$confirmedPasswordName . 'CSSValidityClass'] = VALID;
            $confirmedPasswordIsValid = true;
        }

        // verify if the passwords corresponds
        if($passwordIsValid && $confirmedPasswordIsValid){
            if($confirmedPasswordValue !== $passwordValue){
                $_SESSION[$confirmedPasswordName . 'CSSValidityClass'] = INVALID;
                $confirmedPasswordIsValid = false;
            }
        }

        return $passwordIsValid && $confirmedPasswordIsValid;
    }
}
