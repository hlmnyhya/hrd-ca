<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
use chriskacerguis\RestServer\RestController;


class Karyawan_masuk extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('karyawan/m_karyawan_masuk');
    }

    public function karyawanMasuk_get()
    {
       // ambil data dari model
        $karyawan_masuk = $this->m_karyawan_masuk->getKaryawanmasuk();

        // buat respons API
        if ($karyawan_masuk) {
            $response = array(
                'success' => true,
                'data' => $karyawan_masuk
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data Karyawan Masuk tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function karyawanMasukbyid_get($id)
    {
        $data = $this->m_karyawan_masuk->getKaryawanmasukbyid($id);

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

    public function addKaryawanmasuk_post()
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
        );

        // panggil model untuk menyimpan data
        $result = $this->m_karyawan_masuk->addKaryawanmasuk($data);

        // buat respons API
        if ($result) {
            $response = array(
                'success' => true,
                'message' => 'karyawan masuk berhasil ditambahkan'
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'karyawan masuk gagal ditambahkan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function editKaryawanmasuk_get($id)
    {
        $karyawan_masuk = new m_karyawan_masuk;
        $karyawan_masuk = $karyawan_masuk->editKaryawanmasuk($id);
        $this->response($karyawan_masuk, 200);
    }

    public function updateKaryawanmasuk_put($id)
    {
        $karyawan_masuk = new m_karyawan_masuk;

        $data = [
            'nama'              => $this->put('nama'),
            'nik'               => $this->put('nik'),
            'id_divisi'         => $this->put('id_divisi'),
            'id_jabatan'        => $this->put('id_jabatan'),
            'tanggal_masuk'     => $this->put('tanggal_masuk'),
            'tanggal_keluar'    => $this->put('tanggal_keluar'),
            'keterangan'        => $this->put('keterangan'),
        ];

        $update_result = $karyawan_masuk->updateKaryawanmasuk($id, $data);
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

    public function deleteKaryawanmasuk_delete($id)
    {
        $karyawan_masuk = new m_karyawan_masuk;
        $result = $karyawan_masuk->deleteKaryawanmasuk($id);
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
