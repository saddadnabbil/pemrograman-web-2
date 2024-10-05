<?php

class Home extends MY_Controller
{

    function __construct()
    {
        $this->tabel = "user";
        $this->model = $this->load->model('Mquery');
        header('Content-Type: application/json');
        //$this->field = $this->Mquery->getField($this->tabel);
    }

    public function index()
    {

        $where = array();
        $result = $this->model->getData($this->tabel);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }

    public function about()
    {
        echo "Ini adalah halaman about.";
    }
}
