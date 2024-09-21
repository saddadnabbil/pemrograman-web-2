<?php

class Database
{
    private $hostname = 'localhost';
    private $username = 'root';
    private $password = 'root';
    private $database = 'pemrograman_web_2';
    protected $db;

    public function __construct()
    {
        $this->db = new mysqli($this->hostname, $this->username, $this->password, $this->database);

        if ($this->db->connect_error) {
            throw new Exception('Koneksi database gagal: ' . $this->db->connect_error);
        };
    }
}
