<?php

use GuzzleHttp\Client;

defined('BASEPATH') or exit('No direct script access allowed');

class M_Menu extends CI_Model
{
    private $_client;


    public function __construct()
    {
        parent::__construct();
        $this->_client = new Client([
            'base_uri' => SERVER_BASE . 'master/'
        ]);
    }

    public function getMenu($access = null)
    {
        $respon = $this->_client->request('GET', 'menu', [
            'query' => [
                'access' => $access
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
}