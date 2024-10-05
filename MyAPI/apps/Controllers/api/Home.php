<?php

class Home extends MY_Controller
{
    public $tabel;
    public $model;
    public $field;


    function __construct()
    {
        $this->tabel = "user";
        $this->model = $this->load->model('Mquery');
        $this->field = $this->Mquery->getField($this->tabel);
    }

    public function index()
    {
        $where = array();
        $res = $this->model->getData($this->tabel);
        $data = mysqli_fetch_all($res, MYSQLI_ASSOC);

        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }

    public function about()
    {
        echo "Ini adalah halaman about.";
    }
}
