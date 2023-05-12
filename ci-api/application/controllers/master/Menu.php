<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
use chriskacerguis\RestServer\RestController;


class Menu extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_menu');
    }

    public function menu_get()
    {
       // ambil data dari model
        $menu = $this->m_menu->getMenu();

        // buat respons API
        if ($menu) {
            $response = array(
                'success' => true,
                'data' => $menu
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data menu tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
            
    }

    public function subMenu_get()
    {
       // ambil data dari model
        $menu = $this->m_menu->getSubMenu();

        // buat respons API
        if ($menu) {
            $response = array(
                'success' => true,
                'data' => $menu
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data menu tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function menuAkses_get()
    {
       // ambil data dari model
        $menu = $this->m_menu->getMenuAkses();

        // buat respons API
        if ($menu) {
            $response = array(
                'success' => true,
                'data' => $menu
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data menu tidak ditemukan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function addmenuAkses_post()
    {
        // ambil data dari input
        $data = array(
            'id_menu_akses' => $this->input->post('id_menu_akses'),
            'id_menu'       => $this->input->post('id_menu'),
            'id_usergroup'  => $this->input->post('id_usergroup'),
        );

        // panggil model untuk menyimpan data
        $result = $this->m_menu->addMenuAkses($data);

        // buat respons API
        if ($result) {
            $response = array(
                'success' => true,
                'message' => 'menu akses berhasil ditambahkan',
                'data' => $result
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'menu akses gagal ditambahkan'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function deletemenuAkses_delete($id)
    {
        $menuakses = new m_menu;
        $result = $menuakses->delMenuAkses($id);
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
