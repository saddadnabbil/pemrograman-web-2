<?php

class Home extends MY_Controller{
	
	function __construct()
    {
        //$this->tabel = "matakuliah";
        //$this->model = $this->load->model('Mquery');
        //$this->field = $this->Mquery->getField($this->tabel);
    }
	
    public function index() {
        echo "Selamat datang di halaman utama!";
    }

    public function about() {
        echo "Ini adalah halaman about.";
    }
}
