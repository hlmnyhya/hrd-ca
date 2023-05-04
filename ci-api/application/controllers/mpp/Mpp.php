<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
use chriskacerguis\RestServer\RestController;


class Mpp extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mpp/m_mpp');
    }

    public function index_get()
    {
         // ambil data dari model
        $mpp = $this->m_mpp->getMpp();

        // buat respons API
        if ($mpp) {
            $response = array(
                'success' => true,
                'data' => $mpp
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

    public function addMpp_post()
    {
        // ambil data dari input
        $data = array(
            'unit' => $this->input->post('unit'),
            'posisi' => $this->input->post('posisi'),
            'total' => $this->input->post('total'),
            'total_karyawan' => $this->input->post('total_karyawan'),
            'vacant' => $this->input->post('vacant'),
            'keterangan' => $this->input->post('keterangan'),
        );

        // panggil model untuk menyimpan data
        $result = $this->m_mpp->addMpp($data);

        // buat respons API
        if ($result) {
            $response = array(
                'success' => true,
                'message' => 'mpp berhasil ditambahkan',
                'data' => $result
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'mpp gagal ditambahkan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function editMpp_get($id)
    {
        $mpp = new m_mpp;
        $mpp = $mpp->editMpp($id);
        $this->response($mpp, 200);
    }

    public function updateMpp_put($id)
    {
        $mpp = new m_mpp;

        $data = [
            'unit'              => $this->put('unit'),
            'posisi'            => $this->put('posisi'),
            'total'             => $this->put('total'),
            'total_karyawan'    => $this->put('total_karyawan'),
            'vacant'            => $this->put('vacant'),
            'keterangan'        => $this->put('keterangan'),
        ];

        $update_result = $mpp->updateMpp($id, $data);
        if($update_result > 0)
        {
            $response = array(
                'success' => true,
                'data' => $data
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data mpp tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function deletempp_delete($id)
    {
        $mpp = new m_mpp;
        $result = $mpp->deletempp($id);
        if($result > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'mpp DELETED'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'FAILED TO DELETE mpp'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
