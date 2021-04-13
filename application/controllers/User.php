<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{

	public function index()
	{
		$data['judul'] = 'Profile';
		$data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('user/templates/header', $data);
		$this->load->view('user/templates/sidebar', $data);
		$this->load->view('user/templates/topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('user/templates/footer', $data);
	}

}