<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class M_karyawan_masuk extends CI_Model{
    
    public function getKaryawanmasuk($id= null)
    {
        if ($id===null) {
            $result = $this->db->get('karyawan_masuk')->result();
            return $result;              
        }else {
            $result = $this->db->get_where('karyawan_masuk',['id_karyawan_masuk' => $id])->result();
            return $result;               
        }
    }

    public function addKaryawanmasuk($data)
    {
        $result = $this->db->insert('karyawan_masuk',$data); 
        return $result;
    }

    public function editKaryawanmasuk($data,$id)
    {
        $this->db->where('id_karyawan_masuk', $id);
        $this->db->update('karyawan_masuk', $data);  
        return $this->db->affected_rows();
    }

    public function deleteKaryawanmasuk($id)
    {
        $this->db->where('id_karyawan_masuk', $id);
        $this->db->delete('karyawan_masuk');  
        return $this->db->affected_rows();
    }

}

/* End of file M_karyawan.php */
        