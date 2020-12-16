<?php

class Pesanan_Model extends CI_Model
{
    public function getPesanan($id_pesan = null)
    {
        if( $id_pesan===null){
            return $this->db->get('pesanan')->result_array();
        }
        else{
            return $this->db->get_where('pesanan',['id_pesan'=>$id_pesan])->result_array();
        }
       
    }

    public function deletePesanan($id_pesan)
    {
        
        $this->db->delete('pesanan',['id_pesan'=> $id_pesan]);
        return $this->db->affected_rows();
        
    }

    public function createPesanan($data)
    {
        
        $this->db->insert('pesanan', $data);
        return $this->db->affected_rows();
        
    }

    public function updatePesanan($data, $id_pesan)
    {
        
        $this->db->update('pesanan', $data, ['id_pesan'=>$id_pesan]);
        return $this->db->affected_rows();
        
    }


}