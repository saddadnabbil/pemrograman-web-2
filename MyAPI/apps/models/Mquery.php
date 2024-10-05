<?php 
 class Mquery extends MY_model{
	public function getData($tabel, $select = '*', $where = array()) {
        // Logika untuk mengambil data dari database
		//echo 'test'. $where;exit;
		$this->db->where($where);
		return $this->db->get($tabel, $select);
    }
	
	public function updateData($tabel, $data, $where) {
		$this->db->where($where);
        return $this->db->update($tabel, $data);
    }
	
	public function deleteData($tabel, $where) {
		$this->db->where($where);
        return $this->db->delete($tabel);
    }
	
	public function insertData($tabel, $data) {
		return $this->db->insert($tabel, $data);
    }
	
	function getField($tabel, $method = 'post'){
        //fungsi ini digunakan utk select field pada sebuah tabel dan membuat array postnya
        $qry = "SHOW COLUMNS FROM ".$tabel;
        $res = $this->db->query($qry);
		
		$data = array();
        foreach ($res as $row)
		{
            if(!empty($this->$method($row['Field']))) $data[$row['Field']] = $this->$method($row['Field']);
        }
		
		return $data;
    }
 }

?>