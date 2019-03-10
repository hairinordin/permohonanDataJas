<?php

class Pemohon_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function permohonan_baru($permohonan) {

        $this->db->insert('pemohon', $permohonan);

        return $this->db->insert_id();
    }

    public function jenis_data($jenis) {

        $this->db->insert('jenis_data', $jenis);

        return $this->db->insert_id();
    }



    public function pilihan_soalan_baru($soalan) {

        $this->db->insert('soalan_pilihan', $soalan);

        return true;
    }

    public function set_soalan($kat) {
        $sql = "SELECT *, soalan.id AS soalan_id FROM soalan_set 
                LEFT JOIN soalan_modul ON soalan_set.id_modul = soalan_modul.id
                LEFT JOIN soalan ON soalan.id_modul = soalan_modul.id
                WHERE soalan_set.kat_premis = ?      
                ORDER BY soalan.id_modul";
        $query = $this->db->query($sql, array($kat));

        return $query->result();
    }
 
    public function get_modul($kat){
        $sql = "SELECT 	*
	FROM 
	soalan_set 
	LEFT JOIN soalan_modul ON soalan_modul.id = soalan_set.id_modul
        where soalan_set.kat_premis = ?
        ";
        
        $query = $this->db->query($sql, array($kat));
        
        return $query->result();
    }

}
