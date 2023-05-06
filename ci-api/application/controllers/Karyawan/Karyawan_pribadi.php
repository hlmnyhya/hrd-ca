<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
use chriskacerguis\RestServer\RestController;


class Karyawan_pribadi extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('karyawan/m_karyawan_pribadi');
    }

    public function karyawanPribadi_get()
    {
        // ambil data dari model
        $karyawan_pribadi = $this->m_karyawan_pribadi->getKaryawanpribadi();

        // buat respons API
        if ($karyawan_pribadi) {
            $response = array(
                'success' => true,
                'data' => $karyawan_pribadi
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data Karyawan Pribadi tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function karyawanPribadibyid_get($id)
    {
        $data = $this->m_karyawan_pribadi->getKaryawanpribadibyid($id);

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

    public function addKaryawanpribadi_post()
    {
        // ambil data dari input
        $data = array(
            'nama'              => $this->input->post('nama'),
            'alamat'            => $this->input->post('alamat'),
            'alamat_ktp'        => $this->input->post('alamat_ktp'),
            'alamat_domisili'   => $this->input->post('alamat_domisili'),
            'agama'             => $this->input->post('agama'),
            'jenis_kelamin'     => $this->input->post('jenis_kelamin'),
            'pendidikan'        => $this->input->post('pendidikan'),
            'jurusan'           => $this->input->post('jurusan'),
            'tanggal_lahir'     => $this->input->post('tanggal_lahir'),
            'usia'              => $this->input->post('usia'),
            'keluarga'          => $this->input->post('keluarga'),
        );

        // panggil model untuk menyimpan data
        $result = $this->m_karyawan_pribadi->addKaryawanpribadi($data);

        // buat respons API
        if ($result) {
            $response = array(
                'success' => true,
                'message' => 'karyawan pribadi berhasil ditambahkan'
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'karyawan pribadi gagal ditambahkan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function editKaryawanpribadi_get($id)
    {
        $karyawan_pribadi = new m_karyawan_pribadi;
        $karyawan_pribadi = $karyawan_pribadi->editKaryawanpribadi($id);
        $this->response($karyawan_pribadi, 200);
    }

    public function updateKaryawanpribadi_put($id)
    {
        $karyawan_pribadi = new m_karyawan_pribadi;

        $data = [
            'nama'              => $this->put('nama'),
            'alamat'            => $this->put('alamat'),
            'alamat_ktp'        => $this->put('alamat_ktp'),
            'alamat_domisili'   => $this->put('alamat_domisili'),
            'agama'             => $this->put('agama'),
            'jenis_kelamin'     => $this->put('jenis_kelamin'),
            'pendidikan'        => $this->put('pendidikan'),
            'jurusan'           => $this->put('jurusan'),
            'tanggal_lahir'     => $this->put('tanggal_lahir'),
            'usia'              => $this->put('usia'),
            'keluarga'          => $this->put('keluarga'),
        ];

        $update_result = $karyawan_pribadi->updateKaryawanpribadi($id, $data);
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

    public function deleteKaryawanpribadi_delete($id)
    {
        $karyawan_pribadi = new m_karyawan_pribadi;
        $result = $karyawan_pribadi->deleteKaryawanpribadi($id);
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
