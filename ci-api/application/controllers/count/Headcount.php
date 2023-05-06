<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
use chriskacerguis\RestServer\RestController;


class Headcount extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('count/m_headcount');
    }

    public function index_get()
    {
        $data = new m_headcount;
        $data = $data->getHeadcount();
        $this->response($data, 200);
    }
}
