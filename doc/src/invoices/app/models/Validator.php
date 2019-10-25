<?php
/**
 * @author Peter Catania
 * @version 24.10.2019
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
 	 * Validate data of type int.
	 *
	 * @param i The integer number to validate
	 * @return boolean The validated data
	 */
	public function validateInt($i)
	{
		$validElement=$this->generalValidation($element);
		return intval($validElement);
	}

	/**
	 * Validate data of type string.
	 *
	 * @param str The string to validate
	 * @return boolean The validated string
	 */
	public function validateString($str)
	{
		$validStr = $this->generalValidation($str);

		$pattern = '/^[A-Za-z0-9_-]*$/';
		if (!preg_match($pattern, $validStr))
		{
			$validStr = strval($validStr);
		}
		return $validStr;
	}

	/**
	 * Validate data of type string.
	 *
	 * @param email The email to validate
	 * @return boolean The validated email
	 */
	public function validateEmail($email)
	{
		$validEmail = $this->generalValidation($email);
		return filter_var($validEmail, FILTER_VALIDATE_EMAIL);
	}
}
