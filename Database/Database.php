<?php

namespace Database;

class Database extends \PDO {

	const BANCO = "mysql";
	const HOST = "192.168.10.10:3306";
	const DBNAME = "homestead";
	const USER = "homestead";
	const PASSWORD = "secret";

	public function __construct() {
		try {
			$dsn = static::BANCO . ':dbname=' . static::DBNAME . ';host=' . static::HOST;
			parent::__construct($dsn, static::USER, static::PASSWORD);	
			parent::setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
		}
		catch (PDOException $e) 
        {
            die($e->getMessage());
        }
	}
}