<?php

class Users extends MY_Controller
{
    public $tabel;
    public $model;
    public $field;

    function __construct()
    {
        $this->tabel = "user";
        $this->model = $this->load->model('Mquery');
        $this->field = $this->Mquery->getField($this->tabel);
        header('Content-Type: application/json');
    }

    public function index()
    {
        $where = array();
        $res = $this->model->getData($this->tabel);
        $data = mysqli_fetch_all($res, MYSQLI_ASSOC);

        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }

    public function insert()
    {
        $data = array(
            'username' => $this->input->post('username'),
            'nama' => $this->input->post('nama'),
            'password' => $this->input->post('password'),
            'tipeuser' => $this->input->post('tipeuser'),
            'alamat' => $this->input->post('alamat'),
            'email' => $this->input->post('email'),
        );

        $res = $this->model->insert($this->tabel, $data);
        if ($res) {
            $msg = array(
                'status' => true,
                'message' => 'data inserted',
                'data' => $data,
            );

            echo json_encode($msg, JSON_PRETTY_PRINT);
        } else {
            $msg = array(
                'status' => false,
                'message' => 'data not inserted',
                'data' => $data,
            );

            echo json_encode($msg, JSON_PRETTY_PRINT);
        }
    }

    // update
    public function update()
    {
        $data = array(
            'username' => $this->input->post('username'),
            'nama' => $this->input->post('nama'),
            'password' => $this->input->post('password'),
            'tipeuser' => $this->input->post('tipeuser'),
            'alamat' => $this->input->post('alamat'),
            'email' => $this->input->post('email'),
        );

        $where = array(
            'id' => $this->input->post('id')
        );
        $res = $this->model->getData($this->tabel, '*', $where);

        // make condition when not same id/not found from method getData
        if (!$res) {
            $msg = array(
                'status' => false,
                'message' => 'data not found',
                'data' => $data,
            );

            echo json_encode($msg, JSON_PRETTY_PRINT);
            exit;
        } else {

            $res = $this->model->updateData($this->tabel, $data, $where);
            if ($res) {

                $msg = array(
                    'status' => true,
                    'message' => 'data updated',
                    'data' => $data,
                );

                echo json_encode($msg, JSON_PRETTY_PRINT);
            } else {

                $msg = array(
                    'status' => false,
                    'message' => 'data not updated',
                    'data' => $data,
                );

                echo json_encode($msg, JSON_PRETTY_PRINT);
            }
        }
    }
}
