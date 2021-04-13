<?php 
	/**
	 * 
	 */
	class M_kota extends CI_Model
	{
		
		function getAllKota(){
            $this->db->select('*');
		    $this->db->join('tb_kelurahan', 'tb_kecamatan.id = tb_kelurahan.id_kecamatan');
            $query = $this->db->get('tb_kecamatan');
            return $query->result();
		}
		function getKec(){
            $this->db->select('*');
            $query = $this->db->get('tb_kecamatan');
            return $query->result();
		}
		function getBengkel(){
            $this->db->select('*');
            $query = $this->db->get('tb_bengkel');
            return $query->result();
		}
		function getKel(){
            $this->db->select('*');
            $query = $this->db->get('tb_kelurahan');
            return $query->result();
		}
		function getKelID($id){
        	$hasil = $this->db->get_where('tb_kelurahan', array('id_kecamatan' => $id));
        	return $hasil->result();
		}
		function getNamaID($id){
        	$hasil = $this->db->get_where('tb_bengkel', array('id_kelurahan' => $id));
        	return $hasil->result();
		}
		function getGambar($id){
            $this->db->select('*');
            $this->db->from('tb_gambar');
		    $this->db->join('tb_bengkel', 'tb_gambar.id_bengkel = tb_bengkel.id_bengkel');
		    $this->db->where('tb_gambar.id_bengkel',$id);
            $query = $this->db->get();
            return $query->result();
		}

	}


 ?>