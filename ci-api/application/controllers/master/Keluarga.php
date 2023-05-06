<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
use chriskacerguis\RestServer\RestController;


class Keluarga extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_keluarga');
    }

    public function keluarga_get()
    {
        // ambil data dari model
        $keluarga = $this->m_keluarga->getKeluarga();

        // buat respons API
        if ($keluarga) {
            $response = array(
                'success' => true,
                'data' => $keluarga
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data produk tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function keluargabyid_get($id)
    {
        $data = $this->m_keluarga->getKeluargabyid($id);

        // buat respons API
        if ($data) {
            $response = array(
                'success' => true,
                'data' => $data
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Keluarga tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function addKeluarga_post()
    {
        // ambil data dari input
        $data = array(
            'istri_suami' => $this->input->post('istri_suami'),
            'anak1' => $this->input->post('anak1'),
            'anak2' => $this->input->post('anak2'),
            'anak3' => $this->input->post('anak3'),
        );

        // panggil model untuk menyimpan data
        $result = $this->m_keluarga->addKeluarga($data);

        // buat respons API
        if ($result) {
            $response = array(
                'success' => true,
                'message' => 'Keluarga berhasil ditambahkan',
                'data' => $result
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Keluarga gagal ditambahkan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function editKeluarga_get($id)
    {
        $keluarga = new m_keluarga;
        $keluarga = $keluarga->editKeluarga($id);
        $this->response($keluarga, 200);
    }

    public function updateKeluarga_put($id)
    {
        $keluarga = new m_keluarga;

        $data = [
            'istri_suami' => $this->put('istri_suami'),
            'anak1' => $this->put('anak1'),
            'anak2' => $this->put('anak2'),
            'anak3' => $this->put('anak3'),
        ];

        $update_result = $keluarga->ubahKeluarga($id, $data);
        if($update_result > 0)
        {
            $response = array(
                'success' => true,
                'data' => $data
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data keluarga tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function deleteKeluarga_delete($id)
    {
        $keluarga = new m_keluarga;
        $result = $keluarga->deleteKeluarga($id);
        if($result > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'KELUARGA DELETED'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'FAILED TO DELETE KELUARGA'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
