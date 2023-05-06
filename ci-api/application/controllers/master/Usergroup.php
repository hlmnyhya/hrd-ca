<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
use chriskacerguis\RestServer\RestController;


class Usergroup extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_usergroup');
    }

    public function userGroup_get()
    {
        // ambil data dari model
        $usergroup = $this->m_usergroup->getusergroup();

        // buat respons API
        if ($usergroup) {
            $response = array(
                'success' => true,
                'data' => $usergroup
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data usergroup tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function addUserGroup_post()
    {
        // ambil data dari input
        $data = array(
            'id_usergroup'  => $this->input->post('id_usergroup'),
            'usergroup'     => $this->input->post('usergroup'),
            'input_by'      => $this->input->post('input_by'),
            'tanggal_input' => $this->input->post('tanggal_input'),
            'edit_by'       => $this->input->post('edit_by'),
            'tanggal_edit'  => $this->input->post('tanggal_edit'),
            'row_status'    => $this->input->post('row_status'),
        );

        // panggil model untuk menyimpan data
        $result = $this->m_usergroup->addUserGroup($data);

        // buat respons API
        if ($result) {
            $response = array(
                'success' => true,
                'message' => 'usergroup berhasil ditambahkan',
                'data' => $result
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'usergroup gagal ditambahkan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function editUserGroup_get($id)
    {
        $usergroup = new m_usergroup;
        $usergroup = $usergroup->editUsergroup($id);
        $this->response($usergroup, 200);
    }

    public function updateUserGroup_put($id)
    {
        $usergroup = new m_usergroup;

        $data = [
            'id_usergroup'  => $this->put('id_usergroup'),
            'usergroup'     => $this->put('usergroup'),
            'input_by'      => $this->put('input_by'),
            'tanggal_input' => $this->put('tanggal_input'),
            'edit_by'       => $this->put('edit_by'),
            'tanggal_edit'  => $this->put('tanggal_edit'),
            'row_status'    => $this->put('row_status'),
        ];

        $update_result = $usergroup->updateUsergroup($id, $data);
        if($update_result > 0)
        {
            $response = array(
                'success' => true,
                'data' => $data
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data usergroup tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function deleteUserGroup_delete($id)
    {
        $usergroup = new m_usergroup;
        $result = $usergroup->delUsergroup($id);
        if($result > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'USERGROUP DELETED'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'FAILED TO DELETE USERGROUP'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
