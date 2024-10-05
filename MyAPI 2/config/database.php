<?php 
class Database {
    private $hostname = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'latihanasp_db';
    protected $db;
    private $where;

    public function __construct() {
        $this->db = new mysqli($this->hostname, $this->username, $this->password, $this->database);

        if ($this->db->connect_error) {
            throw new Exception('Koneksi database gagal: ' . $this->db->connect_error);
        }
    }
    
    public function where($where) {
        $this->where = $where;
    }
	
	public function query($sql) {
		return $this->db->query($sql);
	}
    
    public function get($table, $select = '*') {
        $query = "SELECT $select FROM $table ";

        if (!empty($this->where)) {
            $where = [];
            foreach ($this->where as $column => $value) {
                $where[] = "$column = '$value'";
            }
            $where = implode(" AND ", $where);
            $query .= " WHERE $where";
        }
		//echo $query;exit;
		
        $result = $this->db->query($query);
		//var_dump($result);//exit;
        if ($result) {
            //$data = $result->fetch_all(MYSQLI_ASSOC);
            //return $data;
            return $result;
        } else {
            throw new Exception('Error executing query: ' . $this->db->error);
			//die($this->db->error);
        }
    }
	
	public function insert($table, $data) {
		// Mendapatkan nama kolom dan nilai dari array data
		$columns = implode(", ", array_keys($data));
		//$values = implode(", ", array_fill(0, count($data), array_values($data)));
		$values = "'". implode("', '", array_values($data)) ."'";

		$query = "INSERT INTO $table ($columns) VALUES ($values)";
		
		//echo $query;//exit;
		$result = mysqli_query($this->db, $query);

        if ($result) {
            // Query berhasil dijalankan
            return true;
        } else {
            // Query gagal
            return false;
        }
	}
    
    public function update($table, $data) {
        $set = [];
        foreach ($data as $column => $value) {
            $set[] = "$column = '$value'";
        }
        $set = implode(", ", $set);

        $query = "UPDATE $table SET $set";

        if (!empty($this->where)) {
            $where = [];
            foreach ($this->where as $column => $value) {
                $where[] = "$column = '$value'";
            }
            $where = implode(" AND ", $where);
            $query .= " WHERE $where";
        }
		$result = mysqli_query($this->db, $query);

        if ($result) {
            // Query berhasil dijalankan
            return true;
        } else {
            // Query gagal
            return false;
        }
    }
	
	public function delete($table) {
        $query = "DELETE From $table ";

        if (!empty($this->where)) {
            $where = [];
            foreach ($this->where as $column => $value) {
                $where[] = "$column = '$value'";
            }
            $where = implode(" AND ", $where);
            $query .= " WHERE $where";
			$result = mysqli_query($this->db, $query);
        }else $result = false;
		

        if ($result) {
            // Query berhasil dijalankan
            return true;
        } else {
            // Query gagal
            return false;
        }
    }
}

?>