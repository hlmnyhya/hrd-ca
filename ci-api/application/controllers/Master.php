<?php

defined('BASEPATH') OR exit('No direct script access allowed');

    require(APPPATH . 'libraries/REST_Controller.php');
    use Restserver\Libraries\REST_Controller;
    class Master extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_user','muser');
        $this->_tgl = date('Y-m-d');
        $this->_datetime = date('Y-m-d H:i:s');
        ini_set('max_execution_time', 30);
    }
 //------------------------------------------------------------USER-----------------------------------------------------------------//
    public function User_get(){
        $id= $this->get('id');
        $offset = $this->get('offset');
        
        if ($id===null) {
            $user= $this->muser->GetUser(null,$offset);
            
        }else{
            $user= $this->muser->GetUser($id);

        }
        if ($user) {
            $this->response([
                'status' => true,
                'data' => $user
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
}
