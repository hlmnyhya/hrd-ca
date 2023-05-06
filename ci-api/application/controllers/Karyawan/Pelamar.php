<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
use chriskacerguis\RestServer\RestController;


class Pelamar extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('karyawan/m_pelamar');
    }

    public function pelamar_get()
    {
         // ambil data dari model
        $pelamar = $this->m_pelamar->getPelamar();

        // buat respons API
        if ($pelamar) {
            $response = array(
                'success' => true,
                'data' => $pelamar
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data pelamar tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function pelamarbyid_get($id)
    {
        $data = $this->m_pelamar->getPelamarbyid($id);

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

    public function addPelamar_post()
    {
        // ambil data dari input
        $data = array(
            'nama'          => $this->input->post('nama'),
            'alamat'        => $this->input->post('alamat'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'no_telp'       => $this->input->post('no_telp'),
            'email'         => $this->input->post('email'),
            'file_scan'     => $this->input->post('file_scan'),
            'created_at'    => $this->input->post('created_at'),
        );

        // panggil model untuk menyimpan data
        $result = $this->m_pelamar->addPelamar($data);

        // buat respons API
        if ($result) {
            $response = array(
                'success' => true,
                'message' => 'Pelamar berhasil ditambahkan',
                'data' => $result
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Pelamar gagal ditambahkan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function editPelamar_get($id)
    {
        $pelamar = new m_pelamar;
        $pelamar = $pelamar->editpelamar($id);
        $this->response($pelamar, 200);
    }

    public function updatePelamar_put($id)
    {
        $pelamar = new m_pelamar;

        $data = [
            'nama'          => $this->put('nama'),
            'alamat'        => $this->put('alamat'),
            'tanggal_lahir' => $this->put('tanggal_lahir'),
            'jenis_kelamin' => $this->put('jenis_kelamin'),
            'no_telp'       => $this->put('no_telp'),
            'email'         => $this->put('email'),
            'file_scan'     => $this->put('file_scan'),
            'created_at'    => $this->put('created_at'),
        ];

        $update_result = $pelamar->updatePelamar($id, $data);
        if($update_result > 0)
        {
            $response = array(
                'success' => true,
                'data' => $data
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data pelamar tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function deletePelamar_delete($id)
    {
        $pelamar = new m_pelamar;
        $result = $pelamar->deletePelamar($id);
        if($result > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'PELAMAR DELETED'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'FAILED TO DELETE PELAMAR'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
