<?php
/**
 * Other Helper Class
 *
 * @author     AB
 * @lastUpdate 1-9-11
 */
class OtherHelper {


	/**
	* Return array with all countries, select from DB table countries
	*
	* @return  array
	*/
	public static function allCountries(){
		$connection=Yii::app()->db;
		$sql = "SELECT name FROM countries WHERE languageId = '1'";
		$command=$connection->createCommand($sql);
		$rows=$command->queryColumn(); 
		return $rows;
	}


	/**
	* Return array with all countries to use in select box.
	*
	* @return  array
	*/
	public static function countriesSelect(){
		$rows = self::allCountries();
		$allCountries['0']= 'Country';
		foreach($rows as $row){
			$allCountries[$row]=$row;
		}
		return $allCountries;
	}
	

} 