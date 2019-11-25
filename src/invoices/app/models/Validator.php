<?php

/**
 * @author Peter Catania
 * @version 08.11.2019
 *
 * Validate differents type of data.
 */
class Validator
{
	/**
	 *  Return true if the given email is valid, structurally and syntactically.
	 *
	 * @param email The email to check the validation
	 * @return boolean If the email is valid return true otherwise false
	 */
	function isValidEmail($email)
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL) &&
			preg_match('/@.+\./', $email);
	}

	/**
	 *  Return true if the given name is valid.
	 *
	 * @param name The name to check the validation
	 * @return boolean If the name is valid return true otherwise false
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
		return preg_match('/^[A-Za-z]{1}[A-Za-z0-9]{5-31}$/', $name);
	}

	/**
	 * Validate data of any kind.
	 *
	 * @param data The data to validate
	 * @return boolean The validated data
	 */
	private function generalValidation($data)
	{
		$data = trim(stripslashes(htmlspecialchars($data)));
		return $data;
	}

	/**
	 * Validate data to type int.
	 *
	 * @param intNumber The integer number to validate
	 * @return boolean The validated int number
	 */
	public function validateInt($intNumber)
	{
		$validInt = $this->generalValidation($intNumber);
		return intval($validInt);
	}

	/**
	 * Validate data to type float.
	 *
	 * @param floatNumber The float number to validate
	 * @return boolean The validated float number
	 */
	public function validateFloat($floatNumber)
	{
		$validFloat = $this->generalValidation($floatNumber);
		return floatval($validFloat);
	}

	/**
	 * Validate data to type string.
	 *
	 * @param str The string to validate
	 * @return boolean The validated string
	 */
	public function validateString($str)
	{
		$validStr = $this->generalValidation($str);

		$pattern = '/^[A-Za-z0-9_-]*$/';
		if (!preg_match($pattern, $validStr)) {
			$validStr = strval($validStr);
		}
		return $validStr;
	}

	/**
	 * Validate email data.
	 *
	 * @param email The email to validate
	 * @return boolean The validated email
	 */
	public function validateEmail($email)
	{
		$validEmail = $this->generalValidation($email);
		filter_var($validEmail, FILTER_VALIDATE_EMAIL);
		return strtolower($validEmail);
	}
}
