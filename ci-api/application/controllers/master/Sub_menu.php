<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
use chriskacerguis\RestServer\RestController;


class Sub_menu extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_sub_menu');
    }

    public function index_get()
    {
        $data = new m_sub_menu;
        $data = $data->getSubMenu();
        $this->response($data, 200);
    }
}
