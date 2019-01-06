<?php
require_once('class.database.php');

class Connection
{
	private $instance;
	private $con;

	public function __construct()
	{
		$this->instance = Database::getInstance();
		$this->con 		= $this->instance->getConnection();

		define('VERSION','2.0');
		define('BUILD','06012019');
		define('DB_NAME', 'mec_app');
		define('LANGUAGE', 'en');
		define('SERVER_ROOT', $_SERVER['DOCUMENT_ROOT']);
		define('DS', '/');
		define('APP_ROOT', 'MECAPPV2');
		define('APP_HOST', $_SERVER['HTTP_HOST']);
		define('BASE_URL', 'http://'.APP_HOST.DS.APP_ROOT.DS);
		define('BASE_PATH', SERVER_ROOT.DS.APP_ROOT.DS);
		define('CURR_FILE', basename($_SERVER['PHP_SELF'],".php"));
		define('PAGE_TITLE', 'MobilityeCommerce');
	}

	public function execute($query)
	{
		$result = $this->con->query($query);
		return $result;
	}

	public function execute_multi_query($query)
	{
		$result = $this->con->multi_query($query);
		return $result;
	}

	public function getLastInsertId()
	{
		return $this->con->insert_id;
	}

	public function getNumRows($query)
	{
		$data = $this->execute($query);

		$result = $data->num_rows;

		return $result;
	}

	public function getSingleRow($query)
	{
		$result = $this->execute($query);

		$data = $result->fetch_assoc();

		return $this->je($data);
	}

	public function getMultipleRows($query)
	{
		$resource = $this->execute($query);

		$num = $resource->num_rows;

		if($num == 0)
		{
			return false;
		}
		else
		{
			while($row = $resource->fetch_assoc())
			{
				$rows[] = $row;
			}

			$result = $this->je($rows);

			return $result;
		}
	}

	public function getdbName()
	{
		$query = "SELECT DATABASE() FROM DUAL";

		$result = $this->getSingleRow($query);

		return $result;
	}

	public function changedb($db_name)
	{
		$query = "USE $db_name";

		$this->execute($query);

		return true;
	}

	public function select($table,array $columnName = [],array $condition_array = [],$seprator="AND",array $groupby = [],array $orderby = [],$limit = "")
	{
		$col 	= "";
		if(isset($columnName) && !empty($columnName))
		{
			foreach($columnName as $coln)
			{
				$col 	.= "`".$coln."`,";
			}

			$col 		= rtrim($col,",");
		}

		$cond 	= "";
		if(isset($condition_array) && !empty($condition_array))
		{
			$cond 		.= "WHERE";
			foreach($condition_array as $condition => $value)
			{
				$cond 	.= " `".$condition."` = '".$value."' $seprator";
			}

			$cond 		= rtrim($cond,"$seprator");
		}

		$grp 	= "";
		if(isset($groupby) && !empty($groupby))
		{
			$grp 		.= "GROUP BY";
			foreach($groupby as $group)
			{
				$grp 	.= " `".$group."`,";
			}

			$grp 		= rtrim($grp,",");
		}

		$ord 	= "";
		if(isset($orderby) && !empty($orderby))
		{
			$ord 		.= "ORDER BY";
			foreach($orderby as $order => $val)
			{
				$ord 	.= " `".$order."` ".strtoupper($val).",";
			}

			$ord 		= rtrim($ord,",");
		}

		if(isset($limit) && $limit != '')
		{
			$limit 		= "LIMIT ".$limit;
		}

		$query 			= "SELECT ".$col." "."FROM `".$table."`"." ".$cond." ".$grp." ".$ord." ".$limit;

		$count 			= $this->getNumRows($query);

		if($count == 1)
		{
			$result 	= $this->getSingleRow($query);

			return $result;
		}
		elseif($count >= 2)
		{
			$result 	= $this->getMultipleRows($query);

			return $result;
		}
		else
		{
			return false;
		}
	}

	public function getError($query)
	{
		$this->execute($query);

		if(isset($this->con->error))
		{
			return $this->con->error;
		}
		else
		{
			return false;
		}		
	}

	public function getAffectedRows()
	{
		return $this->con->affected_rows;
	}

	public function update(array $array,$table,array $condition_array)
	{
		$column 	= "";
		$condition 	= "";

		foreach($array as $key => $value)
		{
			$column .= "`".$key."` = "."'".$value."',";
		}

		foreach($condition_array as $key => $value)
		{
			$condition .= "`".$key."` = "."'".$value."' AND ";
		}

		$column 	= rtrim($column,",");
		$condition 	= rtrim($condition," AND ");

		$query 		= "UPDATE $table SET $column WHERE $condition";
		$result 	= $this->execute($query);

		return $this->getAffectedRows();
	}

	public function insert($data,$table)
	{
		$column = "";
		$value  = "";

		foreach($data as $col => $val)
		{
			$column .= "`".$col."`,";
			$value 	.= "'".$val."',";
		}

		$column = rtrim($column,",");
		$value 	= rtrim($value,",");

		$query = "INSERT INTO `$table` (".$column.") VALUES(".$value.")";

		return $this->execute($query);		
	}

	public function where($condition_array,$table,$column='')
	{
		$condition 	= "";
		$col 		= "";

		if(!empty($column))
		{
			foreach($column as $val)
			{
				$col .= "`".$val."`,";
			}

			$col = rtrim($col,",");
		}
		else
		{
			$col = "*";
		}

		foreach($condition_array as $key => $val)
		{
			$condition .= "`".$key."` = '".$val."'"." "."AND";
		}

		$condition = rtrim($condition," AND");

		$query = "SELECT $col FROM $table WHERE $condition";

		return $query;
	}

	public function removeCarraige($tableName,$field)
	{
		$updateQry 	= '';

		$updateQry 	.= "UPDATE `$tableName` SET `$field`= REPLACE(`$field`,'\r','');";

		$updateQry 	.= "UPDATE `$tableName` SET `$field`= REPLACE(`$field`,'\n','');";

		$updateQry 	.= "UPDATE `$tableName` SET `$field`= REPLACE(`$field`,'\r\n','');";

		$this->execute_multi_query($updateQry);
	}

	public function drop($table)
	{
		$query = "DROP TABLE $table";
	}

	public function truncate($table)
	{
		$query 	= "TRUNCATE TABLE $table";

		$this->execute($query);
	}

	public function delete(array $condition_array,$table)
	{
		$condition 	= "";

		foreach($condition_array as $key => $val)
		{
			$condition .= "`".$key."` = '".$val."'"." "."AND";
		}

		$condition = rtrim($condition," AND");

		$query = "DELETE FROM $table WHERE $condition";

		return $this->execute($query);
	}

	public function getColumns($table,$sortby="ASC",array $where = [])
	{
		$str = "";

		if(isset($where))
		{
			foreach($where as $val)
			{
				$str .= "AND COLUMN_NAME != '".$val."'";
			}

			$str 	= rtrim($str,"AND");
		}

		$query 	= "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '".DB_NAME."' AND TABLE_NAME ='".$table."' $str ORDER BY ORDINAL_POSITION ".$sortby;

		// echo "$query";

		/*if(!empty($where) || $where != '')
		{
			$query 	= "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '".DB_NAME."' AND TABLE_NAME ='".$table."' WHERE COLUMN_NAME != '".$where."' ORDER BY ORDINAL_POSITION ".$sortby;
		}
		else
		{
			$query 	= "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '".DB_NAME."' AND TABLE_NAME ='".$table."' ORDER BY ORDINAL_POSITION ".$sortby;
		}*/

		$result = $this->getMultipleRows($query);

		return $result;
	}

	public function getSelectedColumns($table,$sortby="ASC",array $where = [])
	{
		$str 	= "";

		if(isset($where) && !empty($where))
		{
			$str 	.= " AND `COLUMN_NAME` IN(";

			foreach($where as $col)
			{
				$str .= "'".$col."',";
			}
			$str 	= rtrim($str,",");

			$str 	.= ")";
		}

		$query 	= "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '".DB_NAME."' AND TABLE_NAME ='".$table."' $str ORDER BY ORDINAL_POSITION ".$sortby;

		$result = $this->getMultipleRows($query);

		return $result;
	}

	public function getRowCount($table)
	{
		$query 	= "SELECT COUNT(*) as count FROM $table";

		$count 	= $this->getSingleRow($query);

		$result = $this->jd($count);

		return $result;
	}

	public function addremoveColumn($tableName,$columnName,$action=1,$datatype="VARCHAR",$length=250)
	{
		if($action == 1)
		{
			$query 	= "ALTER TABLE `$tableName` ADD `$columnName` $datatype($length) DEFAULT NULL";

			$this->execute($query);

			return true;
		}
		elseif($action == 2)
		{
			$query 	= "ALTER TABLE `$tableName` DROP COLUMN $columnName";

			$this->execute($query);

			return true;
		}
		else
		{
			return false;
		}
	}

	public function je($data)
	{
		return json_encode($data,true);
	}

	public function jd($data)
	{
		return json_decode($data,true);
	}

	// Generate token
	public function generateToken($length)
	{
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet.= "0123456789";
		$max = strlen($codeAlphabet); // edited

		for ($i=0; $i < $length; $i++)
		{
			$token .= $codeAlphabet[random_int(0, $max-1)];
		}

		return $token;
	}
}
?>