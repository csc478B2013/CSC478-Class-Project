/*
	This class is the base class for the rest of the DAO objects
*/
<?php

//include the interface and the DatabaseConnectionFactory class
//
include_once 'includeUtil.php'; 
include_once "DAOInterface.php";
include_once "DatabaseConnectionFactory.php";

/*
	This sets up the time zone for the date functions for the DAOs
*/
if( ! ini_get('date.timezone') )
{
   date_default_timezone_set('GMT');
}

class DAO implements DAOInterface
{
	
	public static function getDataBaseConnection()
	{
		return DatabaseConnectionFactory::getDatabaseConnectionFactoryInstance()->getDataBaseConnection();
	}
	
	public static function addNew($passedObject)
	{
		$this->addNew($passedObject);
	}
	
	public static function loadAll()
	{
		$this->loadAll();
	}
	
	public static function loadById($passedId)
	{
		$this->loadById($passedId);
	}
	
	public static function update($passedObject)
	{
		$this->update($passedObject);
	}
	
	public static function delete($passedObject)
	{
		$this->delete($passedObject);
	}




}
?>
	