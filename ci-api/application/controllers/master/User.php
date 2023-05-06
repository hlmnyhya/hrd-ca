<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
use chriskacerguis\RestServer\RestController;


class User extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_user');
    }

    public function user_get()
    {
        // ambil data dari model
        $user = $this->m_user->getUser();

        // buat respons API
        if ($user) {
            $response = array(
                'success' => true,
                'data' => $user
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'User tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function userPass_get($id,$pass)
    {
        $data = $this->m_user->getUserPass($id,$pass);

        // buat respons API
        if ($data) {
            $response = array(
                'success' => true,
                'data' => $data
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'user tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function addUser_post()
    {
        // ambil data dari input
        $data = array(
            'id_user'       => $this->input->post('id_user'),
            'nama'          => $this->input->post('nama'),
            'username'      => $this->input->post('username'),
            'password'      => $this->input->post('password'),
            'id_usergroup'  => $this->input->post('id_usergroup'),
            'status'        => $this->input->post('status'),
            'input_by'      => $this->input->post('input_by'),
            'tanggal_input' => $this->input->post('tanggal_input'),
            'edit_by'       => $this->input->post('edit_by'),
            'tanggal_edit'  => $this->input->post('tanggal_edit'),
            'row_status'    => $this->input->post('row_status'),
        );

        // panggil model untuk menyimpan data
        $result = $this->m_user->addUser($data);

        // buat respons API
        if ($result) {
            $response = array(
                'success' => true,
                'message' => 'user berhasil ditambahkan',
                'data' => $result
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'user gagal ditambahkan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function editUser_get($id)
    {
        $user = new m_user;
        $user = $user->editUser($id);
        $this->response($user, 200);
    }

    public function updateUser_put($id)
    {
        $user = new m_user;

        $data = [
            'id_user'       => $this->put('id_user'),
            'nama'          => $this->put('nama'),
            'username'      => $this->put('username'),
            'password'      => $this->put('password'),
            'id_usergroup'  => $this->put('id_usergroup'),
            'status'        => $this->put('status'),
            'input_by'      => $this->put('input_by'),
            'tanggal_input' => $this->put('tanggal_input'),
            'edit_by'       => $this->put('edit_by'),
            'tanggal_edit'  => $this->put('tanggal_edit'),
            'row_status'    => $this->put('row_status'),
        ];

        $update_result = $user->updateUser($id, $data);
        if($update_result > 0)
        {
            $response = array(
                'success' => true,
                'data' => $data
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data user tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function deleteUser_delete($id)
    {
        $user = new m_user;
        $result = $user->delUser($id);
        if($result > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'USER DELETED'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'FAILED TO DELETE USER'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
