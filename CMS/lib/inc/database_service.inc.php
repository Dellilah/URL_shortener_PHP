<?php

	/**
	* Database service
	*
	* @package database_service.inc.php
	* @author Alicja Cyganiewicz
    * @since 05.07.2012
    */
	
	/**
	* Database connect
	*
	* @param array $database array of connection data
	* @return mixed	Result
	*/
	
	function database_connect(&$database){
		
		if(!$database['connect'] = @mysql_connect($database['host'], $database['user'], $database['password'])){
			$database['errors'] = "Connection server failed";
			return false;
		}
		elseif(!@mysql_select_db($database['database'])){
			$database['errors'] = "Connection database failed";
			return false;
		}
		else{
			mysql_query('SET NAMES utf-8');
			mysql_query ('SET CHARACTER_SET utf8_unicode_ci');
			return $database['connect'];
		}
	}

	
	/**
	* 	Questioning a query
	*
	* @param string $query 
	* @return mixed Result
	*/
	
	function database_query($query){
		
		if(!($query_result = @mysql_query($query))){
			return false;
		}
		else{
			return $query_result;
		}
	
	}
	
		/**
	* Insert data into the database
	*
	* @param array $database array of connection data
	* @param string $table name of the destination table
	* @param array $data data to insert
	* @param array $pattern pattern of fields
	* @return boolean Result
	*/
		
		
	function insert_data(&$database, $table, &$data, $pattern=array()){
		
		if($connect = database_connect($database)){
			
			$query = insert_query($table, $pattern, $data);
			
			if(database_query($query)){
				return true;
			}
			else return false;
		}
		else{
			return false;
		}
	}
	
		/**
	* Selecting data from the database
	*
	* @param array $database array of connection data
	* @param string $table name of the source table
	* @param array $fields	fields to select
	* @param array  $conditions Conditions
	* @param array $options Additive options
	* 
	* @return mixed Result
	*/
	
	function download_data(&$database, $table, $fields = array(), $conditions = array(), $options=''){
		
		if(!($connect = database_connect($database))){
			return false;
		}
		else{
			$query = select_query($table, $fields, $conditions, $options);
			
			if(!($result = database_query($query))){
				$database['errors'] = "Nie mo¿na pobraæ danych z bazy";
				return false;
			}
			else{
				$data = array();
				while($row = mysql_fetch_assoc($result)){
					foreach($row as $key => $value){
						$row[$key] = $value;
					}
					$data[]=$row;
				}
				mysql_free_result($result);
				return $data;
			}
		}
	}
	
	/**
	* CREATE INSERT query
	*
	* @param string $table Name of the source table
	* @param array $pattern Pattern of the fields
	* @param array $data Data to insert
	* 
	* @return string Insert query
	*/
	
	function insert_query($table, $pattern, &$data){
		
		$data = prepare_data($data);
		
		foreach($pattern as $field){
			if(isset($data[$field])){	
				
				if(isset($fields)){
					$fields = $fields.','.$field;
				}
				else{
					$fields = $field;
				}
				
				if(isset($values)){
					
						$values.=', \''.$data[$field].'\'';
								
				}
				else{
					
						$values ='\''.$data[$field].'\'';
					
				}
			}			
		}
		
		$query = 'INSERT INTO '.$table.'('.$fields.') VALUES ('.$values.')';
		return $query;
	}
	
	/**
	*	Create SELECT query
	*
	* @param string $table Name of the source table
	* @param array $fields	Fields to select
	* @param array $conditions Conditions
	* @param string $options Additive options
	* 
	* @return string select query
	*/
	
	function select_query($table, $fields = array(), $conditions = array(), $options = ''){
		
		if(count($fields)){
			foreach($fields as $key  => $value){
				
				if(is_int($key)){
					$field = $value;
				}
				else{
					$field = $key.' AS '.$value;
				}
				
				if(isset($query_fields)){
					$query_fields = $query_fields.', '.$field;
				}
				else{
					$query_fields = $field;
				}
			}
		}
		else{
			$query_fields = '*';
		}

		$query = 'SELECT '.$query_fields.' FROM '.$table;
		
		if(count($conditions)){
			foreach($conditions as $key => $value){
				if(isset($query_conditions)){
					$query_conditions = $query_conditions.' AND '.$key.' = \''.$value.'\'';
				}
				else{
					$query_conditions =' WHERE '.$key.' = \''.$value.'\'';
				}
			}
			
			$query = $query.$query_conditions.' '.$options;
		}
		else{
			$query = $query.' '.$options;
		}
		
		return $query;
		
	}
