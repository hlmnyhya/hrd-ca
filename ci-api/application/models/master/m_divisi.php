<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class M_divisi extends CI_Model{
        
       public function getUser($id=null, $offset=null)
    {
        if ($id === null) {
            $this->db->select('divisi.*');
            $this->db->from('divisi');
            $this->db->limit(15);
            $this->db->offset($offset);

            $result = $this->db->get()->result();

            return $result;
        }else {
            $this->db->select('divisi.*');
            $this->db->from('divisi');
            $this->db->where('divisi', $id);
            
            $result = $this->db->get()->result();

            return $result;
        }
        
    }
        public function getDivisibyid($id=null)
    {
        if ($id === null) {
            $this->db->select('divisi.*');
            $this->db->from('divisi');
            $this->db->limit(15);
            $this->db->offset($offset);

            $result = $this->db->get()->result();

            return $result;
        }else {
            $this->db->select('divisi.*');
            $this->db->from('divisi');
            $this->db->where('id_divisi', $id);
            
            $result = $this->db->get()->result();

            return $result;
        }
        
    }
    
    public function addDivisi($data)
    {
        $result = $this->db->insert('divisi',$data); 
        return $result;
    }

    public function editDivisi($data,$id)
    {
        $this->db->where('id_divisi', $id);
        $this->db->update('divisi', $data);  
        return $this->db->affected_rows();
    }

    public function deleteDivisi($id)
    {
        $this->db->where('id_divisi', $id);
        $this->db->delete('divisi');  
        return $this->db->affected_rows();
    }

}