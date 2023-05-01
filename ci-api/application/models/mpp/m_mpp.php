<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class M_Mpp extends CI_Model{
    
    public function getMpp($id= null)
    {
        if ($id===null) {
            $result = $this->db->get('Mpp')->result();
            return $result;              
        }else {
            $result = $this->db->get_where('Mpp',['id_Mpp' => $id])->result();
            return $result;               
        }
    }

    public function addMpp($data)
    {
        $result = $this->db->insert('Mpp',$data); 
        return $result;
    }

    public function editMpp($data,$id)
    {
        $this->db->where('id_Mpp', $id);
        $this->db->update('Mpp', $data);  
        return $this->db->affected_rows();
    }

    public function deleteMpp($id)
    {
        $this->db->where('id_Mpp', $id);
        $this->db->delete('Mpp');  
        return $this->db->affected_rows();
    }

}

/* End of file M_Mpp.php */
        