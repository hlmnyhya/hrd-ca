<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
use chriskacerguis\RestServer\RestController;


class Jabatan extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_jabatan');
    }

    public function index_get()
    {
        // ambil data dari model
        $jabatan = $this->m_jabatan->getJabatan();

        // buat respons API
        if ($jabatan) {
            $response = array(
                'success' => true,
                'data' => $jabatan
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

    public function jabatan_get($id)
    {
        $data = $this->m_jabatan->getJabatanbyid($id);

        // buat respons API
        if ($data) {
            $response = array(
                'success' => true,
                'data' => $data
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function tambahJabatan_post()
    {
        // ambil data dari input
        $data = array(
            'jabatan' => $this->input->post('jabatan'),
        );

        // panggil model untuk menyimpan data
        $result = $this->m_jabatan->addJabatan($data);

        // buat respons API
        if ($result) {
            $response = array(
                'success' => true,
                'message' => 'Jabatan berhasil ditambahkan'
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Jabatan gagal ditambahkan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function editJabatan_get($id)
    {
        $jabatan = new m_jabatan;
        $jabatan = $jabatan->editjabatan($id);
        $this->response($jabatan, 200);
    }

    public function updateJabatan_put($id)
    {
        $jabatan = new m_jabatan;

        $data = [
            'jabatan' =>  $this->put('jabatan'),
        ];

        $update_result = $jabatan->updateJabatan($id, $data);
        if($update_result > 0)
        {
            $response = array(
                'success' => true,
                'data' => $data
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

    public function deleteJabatan_delete($id)
    {
        $jabatan = new m_jabatan;
        $result = $jabatan->deletejabatan($id);
        if($result > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'JABATAN DELETED'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'FAILED TO DELETE JABATAN'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
