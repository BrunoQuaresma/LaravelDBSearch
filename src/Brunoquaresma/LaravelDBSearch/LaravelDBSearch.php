<?php namespace Brunoquaresma\LaravelDBSearch;
 
class LaravelDBSearch {
 
	/**
	 * Self instance.
	 *
	 * @var LaravelDBSearch
	 */
	private static $instance;
 
	/**
	 * Eloquent search model.
	 *
	 * @var Eloquent
	 */
	private static $eloquentModel;
	
	/**
	 * Search query.
	 *
	 * @var string
	 */
	private static $query;
	
	/**
	 * The database search fields.
	 *
	 * @var array
	 */
	private static $fields = array();
 
	/**
	* Add search Eloquent model.
	*
	* @param Eloquent $model 
	* @return this
	*/
	public static function model($model)
	{
		self::$eloquentModel = new $model;
		self::$instance = new self;
		return self::$instance;
	}
	
	/**
	* Search query.
	*
	* @param string $query 
	* @return this
	*/
	public function query($query)
	{
		self::$query = $query;
		return $this;
	}
	
	/**
	* Add field for search.
	*
	* @param string $field 
	* @return this
	*/
	public function field($field)
	{
		if(is_array($field))
		{
			foreach($field as $item)
			{
				self::$fields[] = $item;
			}
		}
		else
		{
			self::$fields[] = $field;
		}		
		return $this;
	}
		
	/**
	* Get results.
	*
	* @return object
	*/
	public function get()
	{
		$sql = "MATCH(";
		foreach(self::$fields as $field)
		{
			$sql .= $field . ',';
		}				
		$sql = substr($sql,0,-1);
		$sql .= ") AGAINST(? IN BOOLEAN MODE)";			
		$result = self::$eloquentModel->whereRaw($sql, array(self::$query))->get();		
		return $result;
	}
	
	/**
	* Add join.
	*
	* @param string $table
	* @param string $first
	* @param string $operator
	* @param string $second
	* @param string $type = 'inner'
	* @return this
	*/	
	public function join($table, $first, $operator, $second, $type = 'inner')
	{		
		self::$eloquentModel = self::$eloquentModel->join($table, $first, $operator, $second, $type);
		return $this;
	}
	
	/**
	* Clear self properties.
	* 
	* @return void
	*/
	public static function clear()
	{
		self::$fields = array();
		self::$instance = NULL;
		self::$query = NULL;
		self::$eloquentModel = NULL;
	}
 
}