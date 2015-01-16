<?php

/**
 * Data Abstraction Layer - Club Systems Framework
 * Do NOT modify
 *
 * Usage: This class is specifically made to use chain methods.
 * 		  Example:
 * 		  	$obj->selectData(array("table"=>"table name", "columns"=>array("column1", "column2")))
 * 		  	    ->where(array("column", "value"))
 * 		  	    ->limit(10);
 * 
 * Created by Joseph Kasavage
 * Copyright Club Systems 2015
 */

require_once("./Config.Class.php");

class Data 
{
	/**
	 * Customer Identity
	 * 
	 * @var String
	 */
	private $data_ident = "";

	/**
	 * Customer Site
	 * 
	 * @var Integer
	 */
	private $data_site = 0;

	/**
	 * Global Variables
	 * 
	 * @var Object
	 */
	private $globals;

	/**
	 * Query Builder
	 * 
	 * @var String
	 */
	private $builder = "";

	/**
	 * SQL Type
	 * 
	 * @var String
	 */
	private $buildType = "";

	/**
	 * Counter
	 * 
	 * @var integer
	 */
	private $counter = 0;

	/**
	 * Class Constructor - Set Identifier and Site from Config.Class.php
	 */
	public function __construct() 
	{
		$this->globals = new Config();

		$this->data_ident =	$this->globals->getIdent();
		$this->data_site = $this->globals->getSite();
	}

	/**
	 * Accept Raw SQL Requests without Parameters
	 *
	 * Usage: $obj->rawRequest("PUT QUERY HERE");
	 *        All words aside from table should be
	 *        in caps.
	 * 
	 * @param  String $sql  
	 * 
	 * @return Boolean OR Array
	 */
	public function rawRequest(String $sql)
	{
		try {
			$con = new PDO("mysql:host=$this->server;dbname=data$this->ident", $this->globals->getUser(), $this->globals->getPwd());
            $prep = $con->prepare($sql);
            $prep->execute();

            $check = $prep->rowCount();

            $type = split(" ", $sql);

            switch($type[0]) {
            	case 'UPDATE':
            	case 'DELETE':
            	case 'INSERT':
            		if($check) {
            			return true;
            		} else {
            			return false;
            		}

            		break;

            	case 'SELECT':
            		$data = $prep->fetch(PDO::FETCH_ASSOC);
            		return $data;
            		break;
            }
		} catch (PDOException $ex) {
			//Exception Class Here
		}
	}

	/**
	 * Accept Raw SQL with Parameters
	 *
	 * Usage: $obj->rawRequestWithParam("SELECT * FROM table WHERE param=? AND param2=?", array("param", "param2"));
	 * 
	 * @param  String $sql
	 * @param  Array  $param
	 * 
	 * @return Boolean OR Array
	 */
	public function rawRequestWithParam(String $sql, Array $param)
	{
		try {
			$con = new PDO("mysql:host=$this->server;dbname=data$this->ident", $this->globals->getUser(), $this->globals->getPwd());
            $prep = $con->prepare($sql);
            $prep->execute($param);

            $type = split(" ", $sql);

            switch($type[0]) {
            	case 'UPDATE':
            	case 'DELETE':
            	case 'INSERT':
            		if($check) {
            			return true;
            		} else {
            			return false;
            		}

            		break;

            	case 'SELECT':
            		$data = $prep->fetch(PDO::FETCH_ASSOC);
            		return $data;
            		break;
            }
		} catch (PDOException $ex) {
			//Exception Class Here
		}
	}

	/**
	 * Create a Select SQL Statement
	 *
	 * Usage: $obj->selectData(array("table"=>"table name", "columns"=>array("column1", "column2")))
	 * 		  If no columns are set the all (*) symbol will be used
	 * 
	 * @param  Array  $request [description]
	 * 
	 * @return Null
	 */
	public function selectData(Array $request)
	{
		//Exceptions Here

		$this->buildType = "SELECT";

		$requestCount = count($request);
		$columnCount = count($request["columns"]);

		$this->builder = "SELECT ";

		if($columnCount === 0) {
			$this->builder .= "* FROM " . $request["table"];
		} else {
			foreach($request["columns"] as $col) {
				if($this->counter === $columnCount) {
					$this->builder .= $col . " FROM " . $request["table"];
				} else {
					$this->builder .= $col . ", ";
				}

				$this->counter++;
			}
		}

		$this->counter = 0;
	}

	/**
	 * Create an Insert SQL Statement
	 *
	 * Usage: $obj->insertData(array("table"=>"table", "columns"=>array("column1", "column2"), "values"=>array("value1", "value2")));
	 * 
	 * @param  Array  $request
	 * 
	 * @return Null
	 */
	public function insertData(Array $request)
	{
		//Exceptions Here
		
		$this->buildType = "INSERT";

		$columnCount = count($request["columns"]);
		$valueCount = count($request["values"]);
		$counter = 0;

		$this->builder .= "INSERT INTO " . $request["table"] . " (";

		foreach($request["columns"] as $col) {
			if($this->counter === $columnCount) {
				$this->builder .= $col;
			} else {
				$this->builder .= $col . ", ";
			}

			$this->counter++;
		}

		$this->counter = 0;

		$this->builder .= ") VALUES (";

		foreach($request["values"] as $val) {
			if($this->counter === $valueCount) {
				$this->builder .= $val . ")";
			} else {
				$this->builder .= $val . ", ";
			}
		}

		$this->counter = 0;
	}

	/**
	 * Create an Update SQL Statement
	 *
	 * Usuage: $obj->updateData(array("table"=>"table", "columns"=>array("column1", "column2"), "values"=>array("value1", "value2")));
	 * 
	 * @param  Array  $request
	 * 
	 * @return Null
	 */
	public function updateData(Array $request)
	{
		$this->buildType = "UPDATE";

		$columnCount = $request["columns"];
		$valueCount = $request["values"];

		//Exceptions Here

		$this->builder = "UPDATE " . $request["table"] . " SET ";

		for($i=0; $i < $columnCount; $i++) {
			if($i === $columnCount) {
				$this->builder .= $col . "=" . $val;
			} else {
				$this->builder .= $col . "=" . $val . ", ";
			}
		}
	}

	/**
	 * Create a Delete SQL Statement
	 *
	 * Usage: $obj->deleteData("table");
	 * 
	 * @param  String $table
	 * @return Null
	 */
	public function deleteData(String $table) 
	{
		$this->buildType = "DELETE";
		
		$this->builder .= "DELETE FROM " . $table;
	}

	/**
	 * Append WHERE clause to SQL Statement
	 *
	 * Usage: $obj->where(array("column"=>"value", "column2"=>"value2"));
	 * 
	 * @param  Array  $param
	 * @return Null
	 */
	public function where(Array $param)
	{
		//Exceptions Here

		$requestCount = count($param);

		foreach($param as $key=>$value) {
			if($this->counter === $requestCount) {
				$this->builder .= $key . "=" . $value;
			} else {
				$this->builder .= $key . "=" . $value . ", ";
			}
		}
	}

	/**
	 * Append LIMIT clause to SQL Statement
	 *
	 * Usage: $obj->limit(5);
	 * 
	 * @param  Integer $val
	 * @return Null
	 */
	public function limit(Integer $val)
	{
		$this->builder .= "LIMIT " . $val;
	}

	/**
	 * Execute SQL Statement
	 * 
	 * @return Boolean OR Array
	 */
	public function execute()
	{
		try {
			$con = new PDO("mysql:host=$this->server;dbname=data$this->ident", $this->globals->getUser(), $this->globals->getPwd());
			$prep = $con->prepare($this->builder);
			$prep->execute();

			switch($this->buildType) {
				case "INSERT":
				case "UPDATE":
				case "DELETE":
					$check = $prep->rowCount();
					if($check) {
						return true;
					} else {
						return false;
					}
					break;

				case "SELECT":
					$data = $prep->fetch(PDO::FETCH_ASSOC);
					return $data;
					break;
			}

			$this->builder = "";
			$this->buildType = "";
			$this->counter = 0;
		} catch (PDOException $ex) {
			//Exceptions Here
		}
	}
}