<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
use chriskacerguis\RestServer\RestController;


class Karyawan extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('karyawan/m_karyawan');
    }

    public function index_get()
    {
        // ambil data dari model
        $karyawan = $this->m_karyawan->getKaryawan();

        // buat respons API
        if ($karyawan) {
            $response = array(
                'success' => true,
                'data' => $karyawan
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data Karyawan tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function karyawan_get($id)
    {
        $data = $this->m_karyawan->getKaryawanbyid($id);

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

    public function addKaryawan_post()
    {
        // ambil data dari input
        $data = array(
            'nama'              => $this->input->post('nama'),
            'tgl_masuk'         => $this->input->post('tgl_masuk'),
            'masa_kerja'        => $this->input->post('masa_kerja'),
            'divisi'            => $this->input->post('divisi'),
            'jabatan'           => $this->input->post('jabatan'),
            'status_terakhir'   => $this->input->post('status_terakhir'),
            'golongan'          => $this->input->post('golongan'),
            'bpjs_tk'           => $this->input->post('bpjs_tk'),
            'bpjs_kes'          => $this->input->post('bpjs_kes'),
            'npwp'              => $this->input->post('npwp'),
            'status_ptkp'       => $this->input->post('status_ptkp'),
            'alamat_ktp'        => $this->input->post('alamat_ktp'),
            'alamat_domisili'   => $this->input->post('alamat_domisili'),
            'pkwt_mulai'        => $this->input->post('pkwt_mulai'),
            'pkwt_selesai'      => $this->input->post('pkwt_selesai'),
            'pkwt2_mulai'       => $this->input->post('pkwt2_mulai'),
            'pkwt2_selesai'     => $this->input->post('pkwt2_selesai'),
            'tht'               => $this->input->post('tht'),
            'thl'               => $this->input->post('thl'),
            'percobaan_mulai'   => $this->input->post('percobaan_mulai'),
            'percobaan_selesai' => $this->input->post('percobaan_selesai'),
            'karyawan_pribadi'  => $this->input->post('karyawan_pribadi'),
            'keluarga'          => $this->input->post('keluarga'),
        );

        // panggil model untuk menyimpan data
        $result = $this->m_karyawan->addKaryawan($data);

        // buat respons API
        if ($result) {
            $response = array(
                'success' => true,
                'message' => 'Data karyawan berhasil ditambahkan'
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data karyawan gagal ditambahkan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function editKaryawan_get($id)
    {
        $karyawan = new m_karyawan;
        $karyawan = $karyawan->editKaryawan($id);
        $this->response($karyawan, 200);
    }

    public function updateKaryawan_put($id)
    {
        $karyawan = new m_karyawan;

        $data = [
            'nama'              => $this->put('nama'),
            'tgl_masuk'         => $this->put('tgl_masuk'),
            'masa_kerja'        => $this->put('masa_kerja'),
            'divisi'            => $this->put('divisi'),
            'jabatan'           => $this->put('jabatan'),
            'status_terakhir'   => $this->put('status_terakhir'),
            'golongan'          => $this->put('golongan'),
            'bpjs_tk'           => $this->put('bpjs_tk'),
            'bpjs_kes'          => $this->put('bpjs_kes'),
            'npwp'              => $this->put('npwp'),
            'status_ptkp'       => $this->put('status_ptkp'),
            'alamat_ktp'        => $this->put('alamat_ktp'),
            'alamat_domisili'   => $this->put('alamat_domisili'),
            'pkwt_mulai'        => $this->put('pkwt_mulai'),
            'pkwt_selesai'      => $this->put('pkwt_selesai'),
            'pkwt2_mulai'       => $this->put('pkwt2_mulai'),
            'pkwt2_selesai'     => $this->put('pkwt2_selesai'),
            'tht'               => $this->put('tht'),
            'thl'               => $this->put('thl'),
            'percobaan_mulai'   => $this->put('percobaan_mulai'),
            'percobaan_selesai' => $this->put('percobaan_selesai'),
            'karyawan_pribadi'  => $this->put('karyawan_pribadi'),
            'keluarga'          => $this->put('keluarga'),
        ];

        $update_result = $karyawan->updateKaryawan($id, $data);
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

    public function deleteKaryawan_delete($id)
    {
        $karyawan = new m_karyawan;
        $result = $karyawan->deleteKaryawan($id);
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
