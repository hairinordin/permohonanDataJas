<?php

class Pemohon_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function get_all_permohonan(){
        
        return $this->db->get('pemohon')->result_array();
    }

    public function get_lampiran_by_id($id){
        return $this->db->get_where('lampiran', array('id_pemohon' => $id))->result_array();
    }

    public function get_jenisdata_by_id($id){
        return $this->db->get_where('jenis_data', array('id_pemohon' => $id))->result_array();
    }

    public function permohonan_baru($permohonan) { //Simpan maklumat pemohon

        $this->db->insert('pemohon', $permohonan);

        return $this->db->insert_id();
    }

    public function jenis_data($jenis) { //Simpan maklumat jenis data dipohon

        $this->db->insert('jenis_data', $jenis);

        return $this->db->insert_id();
    }
    
    public function lampiran($data){ //Simpan maklumat lampiran pemohon
        $this->db->insert('lampiran', $data);

        return $this->db->insert_id();
    }

}
