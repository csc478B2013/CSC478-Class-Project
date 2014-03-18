/*
	This class is used to set up and maintain a database connection for an application
*/
<?php
class DatabaseConnectionFactory
{
	const HOSTNAME = 'localhost';
	const USERNAME = 'root';
	const PASSWORD = 'PASSWORD';
	const DATABASE = 'myuplan';
	
	//this is the var that we use to hold the created DatabaseConnectionFactory instance
	//
	private static $databaseConnectionFactoryInstance;
	
	//way we create a new instance or get the instance of the DatabaseConnectionFactory
	//
	public static function getDatabaseConnectionFactoryInstance()
	{
		//ok we dont have a connection so create one
		//
		if(!self::$databaseConnectionFactoryInstance)
		{
			self::$databaseConnectionFactoryInstance = new DatabaseConnectionFactory();			
		}
		
		return self::$databaseConnectionFactoryInstance;
	}
	
	//the variable to hold the pdo database connection
	//
	private $dataBaseConnection;
	
	public function getDataBaseConnection()
	{
		if(!isset($dataBaseConnection))
		{
			$dataBaseConnection = new PDO("mysql:host=".self::HOSTNAME.";dbname=".self::DATABASE, self::USERNAME, self::PASSWORD);
			$dataBaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		
		return $dataBaseConnection;
	}

}





?>