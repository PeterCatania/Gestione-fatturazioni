<?php


class Validator
{

	public function validateInt($element)
	{
		$validElement=$this->generalValidation($element);
		return intval($validElement);
	}

	public function validateString($element)
	{
		$validElement=$this->generalValidation($element);

		$pattern = '/^[A-Za-z0-9_-]*$/';
		if (!preg_match($pattern, $validElement)) {
			$validElement=strval($validElement);
		}
		return $validElement;
	}

	private function generalValidation($element){
		$element = trim(stripslashes(htmlspecialchars($element)));
		return $element;
	}


}
