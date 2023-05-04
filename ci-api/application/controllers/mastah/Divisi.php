<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
use chriskacerguis\RestServer\RestController;


class Divisi extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_divisi');
    }

    public function index_get()
    {
        // ambil data dari model
        $divisi = $this->m_divisi->getDivisi();

        // buat respons API
        if ($divisi) {
            $response = array(
                'success' => true,
                'data' => $divisi
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data divisi tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function divisi_get($id)
    {
        $data = $this->m_divisi->getDivisibyid($id);

        // buat respons API
        if ($data) {
            $response = array(
                'success' => true,
                'data' => $data
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Divisi tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function addDivisi_post()
    {
        // ambil data dari input
        $data = array(
            'divisi' => $this->input->post('divisi'),
        );

        // panggil model untuk menyimpan data
        $result = $this->m_divisi->addDivisi($data);

        // buat respons API
        if ($result) {
            $response = array(
                'success' => true,
                'message' => 'Divisi berhasil ditambahkan',
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Divisi gagal ditambahkan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function editDivisi_get($id)
    {
        $divisi = new m_divisi;
        $divisi = $divisi->editDivisi($id);
        $this->response($divisi, 200);
    }

    public function updateDivisi_put($id)
    {
        $divisi = new m_divisi;

        $data = [
            'divisi' =>  $this->put('divisi'),
        ];

        $update_result = $divisi->ubahDivisi($id, $data);
        if($update_result > 0)
        {
            $response = array(
                'success' => true,
                'data' => $data
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data divisi tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function deleteDivisi_delete($id)
    {
        $divisi = new m_divisi;
        $result = $divisi->deleteDivisi($id);
        if($result > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'DIVISI DELETED'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'FAILED TO DELETE DIVISI'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
