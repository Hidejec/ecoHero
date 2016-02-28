<?php

class DB {
	private static $_instance;
	private $_pdo;

	public function __construct() {
		$this->_pdo = new PDO('mysql:dbname=ecoTransit;host=127.0.0.1', 'root', '');
	}

	public function query() {
		if(!self::$_instance) {
			self::$_instance = new DB;
		}
		return self::$_instance;
	}

	function select_fetch($query, $where=null, $order=null) { //order= "id, DESC"
		$query = explode('/', $query);
		$query = "SELECT $query[1] FROM $query[0]";

		if(isset($where)) {
			$where = explode(', ', $where);
			$where = implode('\' AND ', $where);
			$where = explode('=', $where);
			$where = implode('=\'', $where);
			$where .= "'";
			$query .= " WHERE $where";	
		}
		

		if(isset($order)) {
			$order = explode(', ', $order);
			$query .= " ORDER BY $order[0] $order[1]";
		}



		$query = $this->_pdo->query($query);
		$query = $query->fetchAll();

		return $query;
	}

	function select_rowCount($query, $where=null) {
		$query = explode('/', $query);
		$query = "SELECT $query[1] FROM $query[0]";

		if(isset($where)) {
			$where = explode(', ', $where);
			$where = implode('\' AND ', $where);
			$where = explode('=', $where);
			$where = implode('=\'', $where);
			$where .= "'";
			$query .= " WHERE $where";	
		}

		$query = $this->_pdo->query($query);
		$query = $query->rowCount();
		return $query;
	}

	function delete($query, $where=null) {
		$query = "
			DELETE
			FROM $query
		";
		if(isset($where)) {
			$where = explode(', ', $where);
			$where = implode('\' AND ', $where);
			$where = explode('=', $where);
			$where = implode('=\'', $where);
			$where .= "'";
			$query .= " WHERE $where";	
		}
		$query = $this->_pdo->query($query);
	}

	//"todo/text, user_id, done, date_created/vitug, 10, 0: NOW()"

	function insert($query) {
		if(isset($date)) {$date = ", $date";}
		$query = explode('/', $query);
		$query[2] = explode(', ', $query[2]);
		$query[2] = implode('\', \'', $query[2]);
		$query = "INSERT INTO $query[0] ($query[1]) VALUES ('$query[2]')";

		$this->_pdo->query($query);
	}
	
	function insert_with_date($query) {
		$query = explode('/', $query);
		$query[2] = explode(', ', $query[2]);
		$query[2] = implode('\', \'', $query[2]);
		$query = "INSERT INTO $query[0] ($query[1]) VALUES ('$query[2])";
		$query = explode(':', $query);
		$query = implode('\', ', $query);
		$this->_pdo->query($query);
	}

	function update($query, $where=null) { //UPDATE todo SET text = '1234', done = '1' WHERE id = '44';
		//update("todo/text=1234, done=1", "id=44");
		$query = explode('/', $query);
		$query[1] = explode(', ', $query[1]);
		$query[1] = implode('\', ', $query[1]);
		$query[1] = explode('=', $query[1]);
		$query[1] = implode('=\'', $query[1]);
		$query[1] .= "'";
		$query = "UPDATE $query[0] SET $query[1]";

		if(isset($where)) {
			$where = explode(', ', $where);
			$where = implode('\' AND ', $where);
			$where = explode('=', $where);
			$where = implode('=\'', $where);
			$where .= "'";
			$query .= " WHERE $where";	
		}
		echo $query;
		$query = $this->_pdo->query($query);
	}

	function query_query($query) {
		$query = $this->_pdo->query($query);
	}

	function select_innerjoin($table, $select, $innerjoin, $values, $sort=null, $where=null) {
		$query = 
			"
			SELECT {$select}
				   FROM {$table}
				   INNER JOIN {$innerjoin} ON
				   {$values}
			";
		if(isset($sort)) {$query .= " ORDER BY {$sort}";}
		if(isset($where)) {$query .= " WHERE {$sort}";}
		$query = $this->_pdo->query($query);
		$query = $query->fetchAll();
		return $query;
	}

	function exist($query, $where=null) {
		$query = explode('/', $query);
		$query = 
			"
			SELECT {$query[1]} FROM {$query[0]}
			";

		if(isset($where)) {
			$where = explode(', ', $where);
			$where = implode('\' AND ', $where);
			$where = explode('=', $where);
			$where = implode('=\'', $where);
			$where .= "'";
			$query .= " WHERE $where";	
		}

		$query = $this->_pdo->query($query);
		$query = $query->rowCount();

		if(($query==1)) {return true;}
		return false;
	}

	function getuser_id($username) {
		$query = "
			SELECT id FROM users WHERE username = '$username'
		";
		$query = $this->_pdo->query($query);
		$query = $query->fetchAll();
		foreach ($query as $query_key) {
			return $query_key['id'];
		}
	}

	function get($query, $where=null) {  //SELECT * FROM users WHERE id = '22' 
		$query = explode('/', $query);
		$col_name = $query[2];
		$query = "SELECT $query[1] FROM $query[0]";

		if(isset($where)) {
			$where = explode(', ', $where);
			$where = implode('\' AND ', $where);
			$where = explode('=', $where);
			$where = implode('=\'', $where);
			$where .= "'";
			$query .= " WHERE $where";	
		}
		

		$query = $this->_pdo->query($query);
		$query = $query->fetchAll();

		foreach ($query as $query_key) {
			return $query_key[$col_name];
		}
	}

	function lastInsertedId() {
		$id = $this->_pdo->lastInsertId();
	}
}

?>