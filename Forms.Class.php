<?php

/**
 * Forms Class - Club Systems Framework
 * Do NOT modify
 *
 * Usage: This class relies on Static Method calls:
 * 		  		ie. $obj::MethodName($params);
 * 		  You must choose to use either an id attribute OR the name attribute.
 * 		  
 * 		  echo $obj::CSFormStart($params);
 * 		  echo $obj::CSInput($inputParam);
 * 		  echo $obj::CSSubmit();
 * 		  echo $obj::CSFormEnd();
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
	 * Form ID
	 * 
	 * @var String
	 */
	private $formID = "";

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
	 * Create FORM tag and add Attributes
	 *
	 * Usage: $formAttributes = array(
	 * 		  	"name"=>"addMember",
	 * 		   	"method"=>"POST",
	 * 		   	"action"=>"anotherPage.php",
	 * 		   	"target"=>"_blank"
	 *   	  );
	 *   	  
	 *   	  echo $obj::CSFormStart($formAttributes);
	 *
	 * 		  Allowed Parameters: name (String),
	 * 		  					  method (String),
	 * 		  					  action (String),
	 * 		  					  target (String)
	 * 
	 * @param Array $form
	 * 
	 * @return String
	 */
	public static function CSFormStart(Array $form)
	{
		$this->formName = $form["name"];
		$this->formMethod = $form["method"];
		$this->formAction = $form["action"];
		$this->formTarget = $form["target"] ? $form["target"] : NULL;

		$formStart '<form ';

		if($this->formName) {
			$formStart .= 'name="' . $this->formName . '" method="' . $this->formMethod . '" action="' . $this->formAction . '" ';
		} else if($this->formID) {
			$formStart .= 'id="' . $this->formID . '" method="' . $this->formMethod . '" action="' . $this->formAction . '" ';
		}

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
	 *
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
	 * 			"value"=>"yourmail@email.com",
	 * 			"label"=>"E-mail Address"
	 * 		  );
	 *
	 * 	      echo $obj::CSInput($inputParam);
	 *
	 * 		  Allowed Parameters: id (String),
	 * 		     				  name (String),
	 * 		     				  maxlength (String),
	 * 		     				  size (String),
	 * 		     				  class (String),
	 * 		     				  events (Array),
	 * 		     				  value (String),
	 * 		     				  label (String)
	 * 
	 * @param Array $param 
	 *
	 * @return String
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

		return '<label>' . $param["label"] . '</label><br />' . $input;
	}

	/**
	 * Create a Select box with Values and/or Parameters
	 *
	 * Usage: $selectParam = array(
	 * 						 	"id"=>"selectIntegers",
	 * 						 	"size"=>"1",
	 * 						 	"events"=>array(
	 * 						 			  	"onClick"=>"javascript: aFunc();",
	 * 						 			  	"onChange"=>"javascript: alert('Welcome!');"
	 * 						 			  );
	 * 						 	"options"=>array(
	 * 						 				 "option1ID", "Option 1 Value!",
	 * 						 				 "option2ID", "Option 2 Value!"
	 * 						 			   );
	 *                       );
	 *
	 * 		 echo $obj::CSSelect($selectParam);
	 *
	 * 		 Allowed Parameters: label (String),
	 * 		 					 id (String),
	 * 		 					 name (String),
	 * 		 					 size (String),
	 * 		 					 events (Array),
	 * 		 					 multiple (Boolean),
	 * 		 					 disabled (Boolean),
	 * 		 					 options (Array),
	 * 		 					 label (String)
	 * 
	 * @param Array $param
	 *
	 * @return String
	 */
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
			foreach() {
				$select .= '<option id="' . $key . '">' . $value . '</option>';
			}
		}

		$select .= '</select>';

		return '<label>' . $param["label"] . '</label><br />' . $select;
	}

	/**
	 * Create a Checkbox with a Name or ID
	 *
	 * Usage: $checkboxParam = array(
	 * 						   	 "id"=>"thisCheckbox",
	 * 						   	 "checked"=>"true",
	 * 						   );
	 *
	 * 		  echo $obj::CSCheckbox($checkboxParam);
	 *
	 * 		  Allowed Parameters: label (String),
	 * 		  					  id (String),
	 * 		                      name (String),
	 * 		                      checked (Boolean),
	 * 		                      disabled (Boolean),
	 * 		                      label (String)
	 * 
	 * @param Array $param
	 *
	 * @return String
	 */
	public static function CSCheckbox(Array $param)
	{
		$checkbox = '<input type="checkbox" ';

		if($param["id"]) {
			$checkbox .= 'id=' . $param["id"] . ' ';
		} else if($param["name"]) {
			$checkbox .= 'name=' . $param["name"] . ' '; 
		}

		if($param["checked"]) {
			$checkbox .= 'checked ';
		}

		if($param["disabled"]) {
			$checkbox .= 'disabled />';
		} else {
			$checked .= '/>';
		}

		return $checkbox . '<br />' . '<label>' . $param["label"] . '</label>';
	}

	/**
	 * Create a Radio Button with Parameters
	 *
	 * Usage: $radioParam = array(
	 * 							"id"=>"gender",
	 * 							"value"=>"male",
	 * 							"label"=>"Male"
	 * 						);
	 *
	 * 		  echo $obj::CSRadio($radioParam);
	 *
	 * 		  Allowed Parameters: id (String),
	 * 		  					  name (String),
	 * 		  					  value (String),
	 * 		  					  checked (Boolean),
	 * 		  					  label (String)
	 * 
	 * @param Array $param
	 *
	 * @return String
	 */
	public static function CSRadio(Array $param)
	{
		$radio = '<input type="radio" ';

		if($param["id"]) {
			$radio .= 'id=' . $param["id"] . ' ';
		} else if($param["name"]) {
			$radio .= 'name=' . $param["name"] . ' ';
		}

		if($param["value"]) {
			$radio .= 'value=' . $param["value"] . ' ';
		}

		if($param["checked"]) {
			$radio .= 'checked />';
		} else {
			$radio .= '/>';
		}

		return $radio . '<br />' . '<label>' . $param["label"] . '</label>';
	}

	public static function CSSubmit()
	{
		
	}
}