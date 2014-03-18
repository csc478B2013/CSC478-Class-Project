/*
	This interface is used to set up a common set of methods for database access objects
*/
<?php
interface DAOInterface
{
	//make these methods static
	//
	public static function getDataBaseConnection();
	public static function addNew($passedObject);
	public static function loadAll();
	public static function loadById($passedId);
	public static function update($passedObject);
	public static function delete($passedObject);
	
}
?>