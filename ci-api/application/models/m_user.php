<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    public function getUser($id=null, $offset=null)
    {
        if ($id === null) {
            $this->db->select('user.*, user_group ');
            $this->db->from('user');
            $this->db->join('user_group', 'user.id_usergroup = user_group.id_usergroup', 'left');
            $this->db->limit(15);
            $this->db->offset($offset);
            
            
            
            $result = $this->db->get()->result();

            return $result;
        }else {
            $this->db->select('user.*, user_group');
            $this->db->from('user');
            $this->db->join('user_group', 'user.id_usergroup = user_group.id_usergroup', 'left');
            $this->db->where('id_user', $id);
            
            $result = $this->db->get()->result();

            return $result;
        }
        
    }
}