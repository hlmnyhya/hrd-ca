<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
use chriskacerguis\RestServer\RestController;


class Thl extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('thl/m_thl');
    }

    public function thl_get()
    {
        // ambil data dari model
        $thl = $this->m_thl->getThl();

        // buat respons API
        if ($thl) {
            $response = array(
                'success' => true,
                'data' => $thl
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data THL tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function thlbyid_get($id)
    {
        $data = $this->m_thl->getThlbyid($id);

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

    public function addThl_post()
    {
        // ambil data dari input
        $data = array(
            'nama'              => $this->input->post('nama'),
            'nik'               => $this->input->post('nik'),
            'id_divisi'         => $this->input->post('id_divisi'),
            'id_jabatan'        => $this->input->post('id_jabatan'),
            'tanggal_masuk'     => $this->input->post('tanggal_masuk'),
            'tanggal_keluar'    => $this->input->post('tanggal_keluar'),
            'keterangan'        => $this->input->post('keterangan'),
            'status'            => $this->input->post('status'),
        );

        // panggil model untuk menyimpan data
        $result = $this->m_thl->addThl($data);

        // buat respons API
        if ($result) {
            $response = array(
                'success' => true,
                'message' => 'Data THL berhasil ditambahkan'
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data THL gagal ditambahkan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function editThl_get($id)
    {
        $thl = new m_thl;
        $thl = $thl->editThl($id);
        $this->response($thl, 200);
    }

    public function updatethl_put($id)
    {
        $thl = new m_thl;

        $data = [
            'nama'              => $this->put('nama'),
            'nik'               => $this->put('nik'),
            'id_divisi'         => $this->put('id_divisi'),
            'id_jabatan'        => $this->put('id_jabatan'),
            'tanggal_masuk'     => $this->put('tanggal_masuk'),
            'tanggal_keluar'    => $this->put('tanggal_keluar'),
            'keterangan'        => $this->put('keterangan'),
            'status'            => $this->put('status'),
        ];

        $update_result = $thl->updateThl($id, $data);
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

    public function deleteThl_delete($id)
    {
        $thl = new m_thl;
        $result = $thl->deleteThl($id);
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
