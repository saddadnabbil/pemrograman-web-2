<?php

class MY_Model extends MY_helper{
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }
}




