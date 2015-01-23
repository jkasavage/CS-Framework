<?php

namespace CSF\Modules;

/**
 * Configuration File - Club Systems Framework
 * Ensure all variables are set to match session variables
 * (ie. private ident = $_SESSION["YOURVARIABLE"])
 *
 * Copyright Club Systems 2015
 * @author Joseph Kasavage
 */

class Config
{
	/**
	 * Customer Identity
	 * 
	 * @var String
	 */
	private $ident = 00;

	/**
	 * Customer Site
	 * 
	 * @var Integer
	 */
	private $site = 0;

	/**
	 * User
	 *
	 * @var String
	 */
	private $user = "root";

	/**
	 * Password
	 *
	 * @var String
	 */
	private $pwd = "michael8";

	########################################
	# DO NOT MODIFY BELOW
	########################################

	/**
	 * Identity Getter
	 * 
	 * @return Strin
	 */
	public function getIdent() 
	{
		return $this->ident;
	}

	/**
	 * Site Getter
	 * 
	 * @return Integer
	 */
	public function getSite()
	{
		return $this->site;
	}

	/**
	 * User Getter
	 * 
	 * @return String
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * Pwd Getter
	 * 
	 * @return String
	 */
	public function getPwd()
	{
		return $this->pwd;
	}

	/**
	 * Get Server
	 * 
	 * @return String
	 */
	public function getServer()
	{
		$host = explode(".", $_SERVER["HTTP_HOST"]);

		if($host[1] == "v2kpro") {
			return '172.16.238.23';
		} else {
			return 'localhost';
		}
	}
}