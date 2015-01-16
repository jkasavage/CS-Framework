<?php

/**
 * Form Maker - Club Systems Framework
 * Do NOT modify
 *
 * Created by Joseph Kasavage
 * Copyright Club Systems 2015
 */

class Forms 
{
	/**
	 * Form Name
	 * 
	 * @var String
	 */
	private $formName = "";

	/**
	 * Form Method
	 * 
	 * @var String
	 */
	private $formMethod = "";

	/**
	 * Form Action
	 * 
	 * @var String
	 */
	private $formAction = "";

	/**
	 * Form Target
	 * 
	 * @var String
	 */
	private $formTarget = "";

	/**
	 * Set base Form attributes
	 * 
	 * @param Array $form
	 *
	 * @return NULL
	 */

	/**
	 * Create FORM tag and add Attributes
	 *
	 * Usage: $formAttributes = array(
	 * 		  	"name"=>"addMember",
	 * 		   	"method"=>"POST",
	 * 		   	"action"=>"anotherPage.php",
	 * 		   	"target"=>"_blank"
	 *   	  );
	 *   	  
	 *   	  $obj::CSFormStart($formAttributes);
	 * 
	 * @param Array $form
	 * 
	 * @return String $formStart
	 */
	public static function CSFormStart(Array $form)
	{
		$this->formName = $form["name"];
		$this->formMethod = $form["method"];
		$this->formAction = $form["action"];
		$this->formTarget = $form["target"] ? $form["target"] : NULL;

		$formStart '<form name="' . $this->formName . '" method="' . $this->formMethod . '" action="' . $this->formAction . '" ';

		if($this->formTarget != NULL) {
			$formStart .= 'target="' . $this->formTarget . '">'
		} else {
			$formStart .= '>';
		}

		return $formStart;
	}

	/**
	 * Create an Input Box with Parameters
	 *
	 * Usage: The only parameter that MUST be passed is the type.
	 * 		  You can only use the name parameter or the id parameter, NOT both!
	 * 		  
	 * 		  $inputParam = array(
	 * 			"type"=>"text",
	 * 			"name"=>"email", // Use either name OR id
	 * 			"maxlength"=>"30",
	 * 			"size"=>"25",
	 * 			"class"=>"magic",
	 * 			"events"=>array(
	 * 					  	"onClick"=>"javascript: functionName();"
	 * 					  	"onBlur"=>"javascript: validate();"
	 * 			          ),
	 * 			"value"=>"E-mail"
	 * 		  );
	 *
	 * 	      $obj::CSInput($inputParam);
	 * 
	 * @param Array $param 
	 *
	 * @return String $input
	 */
	public static function CSInput(Array $param)
	{
		$input = '<input type="' . $param["type"] . '" ';

		if($param["name"]) {
			$input .= 'name="' . $param["name"] . '" ';
		} else if($param["id"]) {
			$input .= 'id="' . $param["id"] . '" ';
		}

		if($param["maxlength"]) {
			$input .= 'maxlength="' . $param["maxlength"] . '" ';
		}

		if($param["size"]) {
			$input .= 'size="' . $param["size"] . '" ';
		}

		if($param["class"]) {
			$input .= 'class="' . $param["class"] . '" ';
		}

		if($param["events"]) {
			foreach($param["events"] as $key=>$value) {
				$input .= $key . "=" . $value . " ";
			}
		}

		if($param["value"]) {
			$input .= 'value="' . $param["value"] . '">';
		}

		return $input;
	}

	public static function CSSelect(Array $param)
	{
		$select = '<select ';

		if($param["id"]) {
			$select .= 'id="' . $param["id"] . '" ';
		} else if($param["name"]) {
			$select .= 'name="' . $param["name"] . '" ';
		}

		if($param["size"]) {
			$select .= 'size="' . $param["size"] . '" ';
		}

		if($param["events"]) {
			foreach($param["events"] as $key=>$value) {
				$select .= $key . '=' . $value . ' ';
			}
		}

		if($param["multiple"]) {
			$select .= 'multiple ';
		}

		if($param["disabled"]) {
			$select .= 'disabled ';
		}

		$select .= '>';

		foreach($param["options"] as $key=>$value) {
			
		}
	}
}