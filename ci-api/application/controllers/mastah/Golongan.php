<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
use chriskacerguis\RestServer\RestController;


class Golongan extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_golongan');
    }

    public function index_get()
    {
        // ambil data dari model
        $golongan = $this->m_golongan->getGolongan();

        // buat respons API
        if ($golongan) {
            $response = array(
                'success' => true,
                'data' => $golongan
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data golongan tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function golongan_get($id)
    {
        $data = $this->m_golongan->getGolonganbyid($id);

        // buat respons API
        if ($data) {
            $response = array(
                'success' => true,
                'data' => $data
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function addGolongan_post()
    {
        // ambil data dari input
        $data = array(
            'golongan' => $this->input->post('golongan'),
        );

        // panggil model untuk menyimpan data
        $result = $this->m_golongan->addGolongan($data);

        // buat respons API
        if ($result) {
            $response = array(
                'success' => true,
                'message' => 'Data golongan berhasil ditambahkan'
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data golongan gagal ditambahkan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function editGolongan_get($id)
    {
        $golongan = new m_golongan;
        $golongan = $golongan->editgolongan($id);
        $this->response($golongan, 200);
    }

    public function updateGolongan_put($id)
    {
        $golongan = new m_golongan;

        $data = [
            'golongan'  => $this->put('golongan'),
        ];

        $update_result = $golongan->updateGolongan($id, $data);
        if($update_result > 0)
        {
            $response = array(
                'success' => true,
                'data' => $data
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function deleteGolongan_delete($id)
    {
        $golongan = new m_golongan;
        $result = $golongan->deleteGolongan($id);
        if($result > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'DATA DELETED'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'FAILED TO DELETE DATA'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
