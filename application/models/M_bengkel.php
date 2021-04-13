<?php 

	class M_bengkel extends CI_Model{

		public function getAll()
		{
			$this->db->select('*');
			$this->db->from('tb_bengkel');
		    $this->db->join('tb_kecamatan', 'tb_bengkel.id_kecamatan = tb_kecamatan.id');
		    $this->db->join('tb_kelurahan', 'tb_bengkel.id_kelurahan = tb_kelurahan.id');
		    $query = $this->db->get();
		    return $query->result();
		}

		public function getAllGambar()
		{
			$this->db->select('*, COUNT(tb_gambar.id_bengkel) as total');
			$this->db->from('tb_gambar');
		    $this->db->join('tb_bengkel', 'tb_bengkel.id_bengkel = tb_gambar.id_bengkel');
		    $this->db->group_by('tb_gambar.id_bengkel'); 
		    $query = $this->db->get();
		    return $query->result();
		}

		public function getAllFasilitas()
		{
			$this->db->select('*, COUNT(tb_fasilitas.id_bengkel) as total');
			$this->db->from('tb_fasilitas');
		    $this->db->join('tb_bengkel', 'tb_bengkel.id_bengkel = tb_fasilitas.id_bengkel');
		    $this->db->join('tb_fas', 'tb_fas.id_fas = tb_fasilitas.id_fas');
		    $this->db->group_by('tb_fasilitas.id_bengkel'); 
		    $query = $this->db->get();
		    return $query->result();
		}

		public function getGambar()
		{
			$this->db->select('*');
			$this->db->from('tb_gambar');
		    $query = $this->db->get();
		    return $query->result();
		}

		public function getFas()
		{
			$this->db->select('*');
			$this->db->from('tb_fas');
			$this->db->join('tb_fasilitas', 'tb_fas.id_fas = tb_fasilitas.id_fas');
		    $query = $this->db->get();
		    return $query->result();
		}

		public function getFasi()
		{
			$this->db->select('*');
			$this->db->from('tb_fas');
		    $query = $this->db->get();
		    return $query->result();
		}

		public function getGambarWhere($id)
		{
			$this->db->select('*');
			$this->db->from('tb_gambar');
		    $this->db->join('tb_bengkel', 'tb_bengkel.id_bengkel = tb_gambar.id_bengkel');
		    $this->db->where('tb_gambar.id_bengkel', $id);
		    $query = $this->db->get();
		    return $query->result();
		}

		public function getFasilitasWhere($id)
		{
			$this->db->select('*');
			$this->db->from('tb_fasilitas');
		    $this->db->join('tb_bengkel', 'tb_bengkel.id_bengkel = tb_fasilitas.id_bengkel');
		    $this->db->join('tb_fas', 'tb_fas.id_fas = tb_fasilitas.id_fas');
		    $this->db->where('tb_fasilitas.id_bengkel', $id);
		    $query = $this->db->get();
		    return $query->result();
		}

		public function getDetailGambar($id)
		{
			$this->db->select('*');
			$this->db->from('tb_gambar');
		    $this->db->join('tb_bengkel', 'tb_bengkel.id_bengkel = tb_gambar.id_bengkel');
		    $this->db->where('tb_gambar.id', $id);
		    $query = $this->db->get();
		    return $query->row_array();
		}

		public function getDetailFasilitas($id)
		{
			$this->db->select('*');
			$this->db->from('tb_fasilitas');
		    $this->db->join('tb_bengkel', 'tb_bengkel.id_bengkel = tb_fasilitas.id_bengkel');
		    $this->db->join('tb_fas', 'tb_fas.id_fas = tb_fasilitas.id_fas');
		    $this->db->where('tb_fasilitas.id_fasilitas', $id);
		    $query = $this->db->get();
		    return $query->row_array();
		}


		public function getAllWhere($id)
		{
			$this->db->select('*');
			$this->db->from('tb_bengkel');
		    $this->db->join('tb_kecamatan', 'tb_bengkel.id_kecamatan = tb_kecamatan.id');
		    $this->db->join('tb_kelurahan', 'tb_bengkel.id_kelurahan = tb_kelurahan.id');
		    $this->db->where('tb_bengkel.id_bengkel', $id);
		    $query = $this->db->get();
		    return $query->row_array();
		}

		function detailBengkel($where,$table){		
			return $this->db->get_where($table,$where);
		}
		public function delete_data($id)
	    {
	        $this->db->delete('tb_jurusan', ['id_rute' => $id]);
		}
	}
 ?>