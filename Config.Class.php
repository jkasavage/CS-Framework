<?php

/**
 * Configuration File - Club Systems Framework
 * Ensure all variables are set to match session variables
 * (ie. private ident = $_SESSION["YOURVARIABLE"])
 *
 * Created by Joseph Kasavage
 * Copyright Club Systems 2015
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
		return self::ident;
	}

	/**
	 * Site Getter
	 * 
	 * @return Integer
	 */
	public function getSite()
	{
		return self::site;
	}

	/**
	 * User Getter
	 * 
	 * @return String
	 */
	public function getUser()
	{
		return self::user;
	}

	/**
	 * Pwd Getter
	 * 
	 * @return String
	 */
	public function getPwd()
	{
		return self::pwd;
	}
}