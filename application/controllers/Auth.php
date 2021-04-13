<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
	//Method Construct
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	//halaman login
	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($this->form_validation->run() == false)
		{
			$data['judul'] = 'Login';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			//validasi sukses
			$this->_login();
		}
	}

	//method login
	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('tb_user',['email' => $email])->row_array();
		//user ada
		if($user) {
			if($user['is_active'] == 1)
			{
				//cek password
				if(password_verify($password, $user['password'])){
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
				$this->session->set_userdata($data);

				//cek role
				if($user['role_id']==1)
				{
					redirect('admin');
				}
				else{
					redirect('user');
				}
					
				}else {
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
  				Password Salah
				</div>');
				redirect('auth');
				}
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
  				Email Belum aktif
				</div>');
				redirect('auth');
			}
		} else
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
  				Email tidak ditemukan
				</div>');
			redirect('auth');
		}		
	}

	//Halaman Daftar member
	public function daftar()
	{

		//rules
		$this->form_validation->set_rules('namaDepan', 'Nama Depan', 'required|trim',
		[
			'required' => 'tidak boleh kosong'
		]);
		$this->form_validation->set_rules('namaBelakang', 'Nama Belakang', 'required|trim',
		[
			'required' => 'tidak boleh kosong'
		]);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]',
		[
			'is_unique' => 'email sudah terdaftar'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[password2]',
		[
			'matches' => 'password tidak sama',
			'min_length' => 'password pendek',
			'required' => 'tidak boleh kosong'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]');

		if( $this->form_validation->run() == false)
		{
			$data['judul'] = 'Daftar Member';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/daftar');
			$this->load->view('templates/auth_footer');
		} else {
			$data =[
				'nama_depan' => htmlspecialchars($this->input->post('namaDepan', true)),
				'nama_belakang' => htmlspecialchars($this->input->post('namaBelakang', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'gambar' => 'default.jpg',
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 1,
				'date_create' => time()
			];

			$this->db->insert('tb_user',$data);
			$this->session->set_flashdata('message','1');
			redirect('auth');
		}
	}

	//logout
	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message','2');
		redirect('auth');
	}

}
