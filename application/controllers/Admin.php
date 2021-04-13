<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	function __construct(){
		parent::__construct();		
		$this->load->model('M_kota');
		$this->load->model('M_bengkel');
		$this->load->model('Bengkel_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('googlemaps');
	}

	public function index()
	{
		$config['center'] 		= '3.3280664, 99.1191069';
		$config['zoom']			= 15;
		$this->googlemaps->initialize($config);

		$bengkeldata = $this->Bengkel_model->get_all_data();
		foreach ($bengkeldata as $b ) {
			$marker=array();
			$marker['position']="$b->lng,$b->lat";
			$marker['animation']="DROP";
			$marker['infowindow_content'] = '<div class="media" style="width:250px;">';
			$marker['infowindow_content'] .= '<div class="media-body" >';
			$marker['infowindow_content'] .= '<h6>'.$b->nama_bengkel.'</h6>';
			$marker['infowindow_content'] .= '<p> <b>Alamat    :</b>'.$b->alamat_bengkel.'</p>';
			$marker['infowindow_content'] .= '<p> <b>kecamatan :</b>'.$b->nama_kecamatan.'</p>';
			$marker['infowindow_content'] .= '<p> <b>nama pem  :</b>'.$b->nama_pemilik.'</p>';
			$marker['infowindow_content'] .= '<p> <b>no hp     :</b>'.$b->no_hp.'</p>';

			$marker['infowindow_content'] .= '<div>';
			$marker['infowindow_content'] .= '<div>';
			$this->googlemaps->add_marker($marker);
		}

		

		$data['map'] = $this->googlemaps->create_map();
		$data['judul'] = 'Dashboard';
		$data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$data['totalbengkel'] = $this->db->count_all_results('tb_bengkel');
		$this->load->view('templates/admin_header', $data);
		$this->load->view('templates/admin_navbar', $data);
		$this->load->view('templates/admin_sidebar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/admin_footer', $data);
	}

	public function bengkel()
	{
		$data['judul'] = 'Data Bengkel';
		$data['bengkel'] = $this->M_bengkel->getAll();
		$data['map'] = $this->googlemaps->create_map();
		$data['kota'] = $this->M_kota->getAllKota();
		$data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/admin_header', $data);
		$this->load->view('templates/admin_navbar', $data);
		$this->load->view('templates/admin_sidebar', $data);
		$this->load->view('admin/bengkel', $data);
		$this->load->view('templates/admin_footer', $data);
	}

	function getKel(){
        $id=$this->input->post('id');
        $data=$this->M_kota->getKelID($id);
        echo json_encode($data);
    }

    function getNama(){
        $id=$this->input->post('id');
        $data=$this->M_kota->getNamaID($id);
        echo json_encode($data);
    }

	public function tambahBengkel()
	{
		$config['center'] 		= '3.3280664, 99.1191069';
		$config['zoom']			= 15;
		$this->googlemaps->initialize($config);

		$marker['position'] = '3.3280664, 99.1191069';
		$marker['draggable'] = true;
		$marker['ondragend'] = 'setToForm(event.latLng.lat(),event.latLng.lng())';
		$this->googlemaps->add_marker($marker);

		$data['judul'] = 'Tambah Bengkel';
		$data['map'] = $this->googlemaps->create_map();
		$data['user'] = $this->db->get('tb_bengkel')->result();
		$data['kota'] = $this->M_kota->getAllKota();
		$data['kec'] = $this->M_kota->getKec();
		$data['kel'] = $this->M_kota->getKel();

		$this->form_validation->set_rules('nama','Nama Bengkel','required|trim',
		[
			'required' => 'Nama Bengkel tidak boleh kosong'
		]);
		$this->form_validation->set_rules('latitude','Latitude Bengkel','required|trim',
		[
			'required' => 'Latitude Bengkel tidak boleh kosong'
		]);
		$this->form_validation->set_rules('longitude','Longitude Bengkel','required|trim',
		[
			'required' => 'Longitude Bengkel tidak boleh kosong'
		]);
		$this->form_validation->set_rules('alamat','Alamat Bengkel','required|trim',
		[
			'required' => 'Alamat Bengkel tidak boleh kosong'
		]);

		if( $this->form_validation->run() == false)
		{
			$this->load->view('templates/admin_header', $data);
			$this->load->view('templates/admin_navbar', $data);
			$this->load->view('templates/admin_sidebar', $data);
			$this->load->view('admin/tambahBengkel', $data);
			$this->load->view('templates/admin_footer', $data);
		} else {
			$nama = $this->input->post('nama');
			$latitude = $this->input->post('longitude');
			$longitude = $this->input->post('latitude');
			$alamat = $this->input->post('alamat');
			$kecamatan = $this->input->post('kecamatan');
			$kelurahan = $this->input->post('kelurahan');
			$no_hp = $this->input->post('no_hp');
			$nama_pemilik = $this->input->post('nama_pemilik');
			$hari = implode(", ", $_POST['hari']);
			$jam_buka = $this->input->post('jam_buka');
			$jam_tutup = $this->input->post('jam_tutup');

			//image
			$upload_img = $_FILES['image']['name'];

			if($upload_img){
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '5000';
				$config['upload_path']= './dist/img/sampul/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$new_image = $this->upload->data('file_name');
					$this->db->set('gambar_sampul',$new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}


			$this->db->set('nama_bengkel',$nama);
			$this->db->set('id_kecamatan',$kecamatan);
			$this->db->set('id_kelurahan',$kelurahan);
			$this->db->set('lat',$latitude);
			$this->db->set('long',$longitude);
			$this->db->set('alamat_bengkel',$alamat);
			$this->db->set('no_hp',$no_hp);
			$this->db->set('nama_pemilik',$nama_pemilik);
			$this->db->set('jam_buka',$jam_buka);
			$this->db->set('jam_tutup',$jam_tutup);
			$this->db->set('hari_kerja1',$hari);
			$this->db->insert('tb_bengkel');
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  				data berhasil ditambah
				</div>');
			redirect('admin/bengkel');
		}
	}

	public function detailBengkel($id)
	{
		$config['center'] 		= '3.3280664, 99.1191069';
		$config['zoom']			= 15;
		$this->googlemaps->initialize($config);

		$bengkeldata = $this->Bengkel_model->get_all_data();
		foreach ($bengkeldata as $b ) {
			$marker=array();
			$marker['position']="$b->lng,$b->lat";
			$marker['animation']="DROP";
			$marker['infowindow_content'] = '<div class="media" style="width:250px;">';
			$marker['infowindow_content'] .= '<div class="media-body" >';
			$marker['infowindow_content'] .= '<h6>'.$b->nama_bengkel.'</h6>';
			$marker['infowindow_content'] .= '<p> <b>Alamat    :</b>'.$b->alamat_bengkel.'</p>';
			$marker['infowindow_content'] .= '<p> <b>kecamatan :</b>'.$b->nama_kecamatan.'</p>';
			$marker['infowindow_content'] .= '<p> <b>nama pem  :</b>'.$b->nama_pemilik.'</p>';
			$marker['infowindow_content'] .= '<p> <b>no hp     :</b>'.$b->no_hp.'</p>';

			$marker['infowindow_content'] .= '<div>';
			$marker['infowindow_content'] .= '<div>';
			$this->googlemaps->add_marker($marker);
		}

		


		$data['judul'] = 'Detail Bengkel';
		$data['map'] = $this->googlemaps->create_map();
		$where = array('id' => $id);
		$data['bengkel'] = $this->M_bengkel->getAllWhere($id);
		$data['kota'] = $this->M_kota->getAllKota();

		$this->load->view('templates/admin_header', $data);
		$this->load->view('templates/admin_navbar', $data);
		$this->load->view('templates/admin_sidebar', $data);
		$this->load->view('admin/detailBengkel', $data);
		$this->load->view('templates/admin_footer', $data);
	}

	public function ubahBengkel($id)
	{
		$data['judul'] = 'Ubah Bengkel';
		$data['map'] = $this->googlemaps->create_map();
		$where = array('id' => $id);
		$data['bengkel'] = $this->M_bengkel->getAllWhere($id);
		$data['kota'] = $this->M_kota->getAllKota();
		$data['kec'] = $this->M_kota->getKec();
		$data['kel'] = $this->M_kota->getKel();

		$this->form_validation->set_rules('nama','Nama Bengkel','required|trim',
		[
			'required' => 'Nama Bengkel tidak boleh kosong'
		]);
		$this->form_validation->set_rules('latitude','Latitude Bengkel','required|trim',
		[
			'required' => 'Latitude Bengkel tidak boleh kosong'
		]);
		$this->form_validation->set_rules('longitude','Longitude Bengkel','required|trim',
		[
			'required' => 'Longitude Bengkel tidak boleh kosong'
		]);
		$this->form_validation->set_rules('alamat','Alamat Bengkel','required|trim',
		[
			'required' => 'Alamat Bengkel tidak boleh kosong'
		]);

		if( $this->form_validation->run() == false)
		{
			$this->load->view('templates/admin_header', $data);
			$this->load->view('templates/admin_navbar', $data);
			$this->load->view('templates/admin_sidebar', $data);
			$this->load->view('admin/ubahBengkel', $data);
			$this->load->view('templates/admin_footer', $data);
		} else {
			$nama = $this->input->post('nama');
			$latitude = $this->input->post('latitude');
			$longitude = $this->input->post('longitude');
			$alamat = $this->input->post('alamat');
			$kecamatan = $this->input->post('kecamatan');
			$kelurahan = $this->input->post('kelurahan');
			$no_hp = $this->input->post('no_hp');
			$nama_pemilik = $this->input->post('nama_pemilik');
			$hari = implode(", ", $_POST['hari']);
			$jam_buka = $this->input->post('jam_buka');
			$jam_tutup = $this->input->post('jam_tutup');

			//image
			$upload_img = $_FILES['image']['name'];

			if($upload_img){
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '5000';
				$config['upload_path']= './dist/img/sampul/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$old_img = $this->input->post('old_image');
					unlink(FCPATH . 'dist/img/sampul/' . $old_img);
					$new_image = $this->upload->data('file_name');
					$this->db->set('gambar_sampul',$new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}


			$this->db->set('nama_bengkel',$nama);
			$this->db->set('id_kecamatan',$kecamatan);
			$this->db->set('id_kelurahan',$kelurahan);
			$this->db->set('lat',$latitude);
			$this->db->set('long',$longitude);
			$this->db->set('alamat_bengkel',$alamat);
			$this->db->set('no_hp',$no_hp);
			$this->db->set('nama_pemilik',$nama_pemilik);
			$this->db->set('jam_buka',$jam_buka);
			$this->db->set('jam_tutup',$jam_tutup);
			$this->db->set('hari_kerja1',$hari);
			$this->db->where('id_bengkel',$id);
			$this->db->update('tb_bengkel');
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  				data berhasil diubah
				</div>');
			redirect('admin/bengkel');
		}
	}

	public function hapusBengkel($id)
  	{
  		$old_img = $this->db->get_where('tb_bengkel',['id_bengkel' => $id])->row_array();
		unlink(FCPATH . 'dist/img/sampul/' . $old_img['gambar_sampul']);
  		$this->db->delete('tb_bengkel', ['id_bengkel' => $id]);
    	$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  				data berhasil dihapus
				</div>');
    	redirect('admin/bengkel');
  	}


	public function gambar()
	{
		$data['judul'] = 'Data Gambar';
		$data['map'] = $this->googlemaps->create_map();
		$data['gambar'] = $this->M_bengkel->getAllGambar();
		$data['kota'] = $this->M_kota->getAllKota();
		$data['poto'] = $this->M_bengkel->getGambar();
		$data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/admin_header', $data);
		$this->load->view('templates/admin_navbar', $data);
		$this->load->view('templates/admin_sidebar', $data);
		$this->load->view('admin/gambar', $data);
		$this->load->view('templates/admin_footer', $data);
	}	

	public function fasilitas()
	{
		$data['judul'] = 'Data Fasilitas';
		$data['map'] = $this->googlemaps->create_map();
		$data['fasilitas'] = $this->M_bengkel->getAllFasilitas();
		$data['dataFas'] = $this->M_bengkel->getFas();
		$data['kota'] = $this->M_kota->getAllKota();
		$data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/admin_header', $data);
		$this->load->view('templates/admin_navbar', $data);
		$this->load->view('templates/admin_sidebar', $data);
		$this->load->view('admin/fasilitas', $data);
		$this->load->view('templates/admin_footer', $data);
	}

	public function tambahGambar()
	{
		$data['judul'] = 'Tambah Gambar';
		$data['map'] = $this->googlemaps->create_map();
		$data['user'] = $this->db->get('tb_bengkel')->result();
		$data['kota'] = $this->M_kota->getAllKota();
		$data['kec'] = $this->M_kota->getKec();
		$data['kel'] = $this->M_kota->getKel();

		$this->form_validation->set_rules('nama_bengkel','Nama Bengkel','required|trim',
		[
			'required' => 'Nama Bengkel tidak boleh kosong'
		]);

		if( $this->form_validation->run() == false)
		{
			$this->load->view('templates/admin_header', $data);
			$this->load->view('templates/admin_navbar', $data);
			$this->load->view('templates/admin_sidebar', $data);
			$this->load->view('admin/tambahGambar', $data);
			$this->load->view('templates/admin_footer', $data);
		}else {
			$nama = $this->input->post('nama_bengkel');

			//image
			$upload_img = $_FILES['image']['name'];

			if($upload_img){
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '5000';
				$config['upload_path']= './dist/img/gambar/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$new_image = $this->upload->data('file_name');
					$this->db->set('gambar',$new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}
			$this->db->set('id_bengkel',$nama);
			$this->db->insert('tb_Gambar');
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  				data berhasil ditambah
				</div>');
			redirect('admin/gambar');
		}
	}

	public function tambahFasilitas()
	{
		$data['judul'] = 'Tambah Fasilitas';
		$data['map'] = $this->googlemaps->create_map();
		$data['dataFas'] = $this->M_bengkel->getFasi();
		$data['kota'] = $this->M_kota->getAllKota();
		$data['kec'] = $this->M_kota->getKec();
		$data['kel'] = $this->M_kota->getKel();

		$this->form_validation->set_rules('fasilitas','Nama Bengkel','required|trim',
		[
			'required' => 'fasilitas tidak boleh kosong'
		]);

		if( $this->form_validation->run() == false)
		{
			$this->load->view('templates/admin_header', $data);
			$this->load->view('templates/admin_navbar', $data);
			$this->load->view('templates/admin_sidebar', $data);
			$this->load->view('admin/tambahFasilitas', $data);
			$this->load->view('templates/admin_footer', $data);
		}else {
			$nama = $this->input->post('nama_bengkel');
			$fasilitas = $this->input->post('fasilitas');
			$this->db->set('id_bengkel',$nama);
			$this->db->set('id_fas',$fasilitas);
			$this->db->insert('tb_fasilitas');
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  				data berhasil ditambah
				</div>');
			redirect('admin/fasilitas');
		}
	}

	public function detailGambar($id)
	{
		$data['judul'] = 'Detail Gambar';
		$data['map'] = $this->googlemaps->create_map();
		$where = array('id' => $id);
		$data['poto'] = $this->M_bengkel->getGambar();
		$data['bengkel'] = $this->M_bengkel->getGambarWhere($id);
		$data['kota'] = $this->M_kota->getAllKota();

		$this->load->view('templates/admin_header', $data);
		$this->load->view('templates/admin_navbar', $data);
		$this->load->view('templates/admin_sidebar', $data);
		$this->load->view('admin/detailGambar', $data);
		$this->load->view('templates/admin_footer', $data);
	}


	public function detailFasilitas($id)
	{
		$data['judul'] = 'Detail Fasilitas';
		$data['map'] = $this->googlemaps->create_map();
		$where = array('id' => $id);
		$data['poto'] = $this->M_bengkel->getFas();
		$data['bengkel'] = $this->M_bengkel->getFasilitasWhere($id);
		$data['kota'] = $this->M_kota->getAllKota();
		$data['dataFas'] = $this->M_bengkel->getFasi();

		$this->load->view('templates/admin_header', $data);
		$this->load->view('templates/admin_navbar', $data);
		$this->load->view('templates/admin_sidebar', $data);
		$this->load->view('admin/detailFasilitas', $data);
		$this->load->view('templates/admin_footer', $data);
	}


	public function ubahFasilitas($id)
	{
		$data['judul'] = 'Ubah Fasilitas';
		$data['map'] = $this->googlemaps->create_map();
		$where = array('id' => $id);
		$data['fasilitas'] = $this->M_bengkel->getDetailFasilitas($id);
		$data['kota'] = $this->M_kota->getAllKota();
		$data['kec'] = $this->M_kota->getKec();
		$data['kel'] = $this->M_kota->getKel();
		$data['bengkel'] = $this->M_kota->getBengkel();
		$data['dataFas'] = $this->M_bengkel->getFasi();


		$this->form_validation->set_rules('nama_bengkel','Nama Bengkel','required|trim',
		[
			'required' => 'Nama Bengkel tidak boleh kosong'
		]);
		
		if( $this->form_validation->run() == false)
		{
			$this->load->view('templates/admin_header', $data);
			$this->load->view('templates/admin_navbar', $data);
			$this->load->view('templates/admin_sidebar', $data);
			$this->load->view('admin/ubahFasilitas', $data);
			$this->load->view('templates/admin_footer', $data);
		} else {
			$nama = $this->input->post('nama_bengkel');
			$fasilitas = $this->input->post('fasilitas');
			$this->db->set('id_bengkel',$nama);
			$this->db->set('id_fas',$fasilitas);
			$this->db->where('id_fasilitas',$id);
			$this->db->update('tb_fasilitas');
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  				data berhasil ditambah
				</div>');
			redirect('admin/fasilitas');
		}
	}



	public function ubahGambar($id)
	{
		$data['judul'] = 'Ubah Gambar';
		$data['map'] = $this->googlemaps->create_map();
		$where = array('id' => $id);
		$data['gambar'] = $this->M_bengkel->getDetailGambar($id);
		$data['kota'] = $this->M_kota->getAllKota();
		$data['kec'] = $this->M_kota->getKec();
		$data['kel'] = $this->M_kota->getKel();
		$data['bengkel'] = $this->M_kota->getBengkel();


		$this->form_validation->set_rules('nama_bengkel','Nama Bengkel','required|trim',
		[
			'required' => 'Nama Bengkel tidak boleh kosong'
		]);
		
		if( $this->form_validation->run() == false)
		{
			$this->load->view('templates/admin_header', $data);
			$this->load->view('templates/admin_navbar', $data);
			$this->load->view('templates/admin_sidebar', $data);
			$this->load->view('admin/ubahGambar', $data);
			$this->load->view('templates/admin_footer', $data);
		} else {
			$nama_bengkel = $this->input->post('nama_bengkel');
			$id_gambar = $this->input->post('id_gambar');

			//image
			$upload_img = $_FILES['image']['name'];

			if($upload_img){
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '5000';
				$config['upload_path']= './dist/img/gambar/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$old_img = $this->input->post('old_image');
					unlink(FCPATH . 'dist/img/gambar/' . $old_img);
					$new_image = $this->upload->data('file_name');
					$this->db->set('gambar',$new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}
			$this->db->set('id_bengkel',$nama_bengkel);
			$this->db->where('id',$id);
			$this->db->update('tb_gambar');
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  				data berhasil diubah
				</div>');
			redirect('admin/detailGambar/'.$id_gambar);
		}
	}

	public function hapusGambar($id)
  	{
  		$old_img = $this->db->get_where('tb_gambar',['id' => $id])->row_array();
  		$idd = $this->db->get_where('tb_bengkel',['id_bengkel' => $old_img['id_bengkel']])->row_array();
		unlink(FCPATH . 'dist/img/gambar/' . $old_img['gambar']);
  		$this->db->delete('tb_gambar', ['id' => $id]);
  		$cekgambar = $this->M_kota->getGambar($idd['id_bengkel']);
    	$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  				data berhasil dihapus
				</div>');
    	if(count($cekgambar) != 0){
    		redirect('admin/detailGambar/'.$idd['id_bengkel']);
    	}else{
    		redirect('admin/gambar');
    	}
  	}


}