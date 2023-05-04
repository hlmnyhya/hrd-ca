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

    public function index_get()
    {
        $data = new m_user;
        $data = $data->getUser();
        $this->response($data, 200);
    }
}
