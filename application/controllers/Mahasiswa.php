<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller Mahasiswa
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller REST
 * @author    Ahmad Faisol <mzfais@lecturer.itn.ac.id>
 * @link      https://github.com/mzfais/
 * @param     ...
 * @return    ...
 *
 */

require APPPATH . 'libraries/REST_Controller.php';

class Mahasiswa extends REST_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('mhs_model');
  }

  public function index_get()
  {
    $id = $this->get('id');
    if ($id === null) {
      $p = $this->get('page');
      $p = (empty($p) ? 1 : $p);
      $total_data = $this->mhs_model->get_jml_data();
      $total_page = ceil($total_data / 5);
      $start = ($p - 1) * 5;
      $list = $this->mhs_model->get_all_data($id,5, $start);
      $data = [
        'status' => true,
        'page' => $p,
        'total_data' => $total_data,
        'total_page' => $total_page,
        'data' => $list
      ];
      if ($list) {
        $this->response($data, REST_Controller::HTTP_OK);
      } else {
        $this->response(['status' => false, 'msg' => 'data tidak ditemukan'], REST_Controller::HTTP_NOT_FOUND);
      }
    } else {
      $mhs = $this->mhs_model->get_all_data($id);
      if ($mhs) {
        $this->response(['status' => true, 'data' => $mhs], REST_Controller::HTTP_OK);
      } else {
        $this->response(['status' => false, 'msg' => 'data tidak ditemukan'], REST_Controller::HTTP_NOT_FOUND);
      }
    }
  }

  public function jurusan_get()
  {
    $jurusan = $this->get('jurusan');
    if ($jurusan === null) {
      $p = $this->get('page');
      $p = (empty($p) ? 1 : $p);
      $total_data = $this->mhs_model->get_jml_data();
      $total_page = ceil($total_data / 5);
      $start = ($p - 1) * 5;
      $list = $this->mhs_model->get_all_data_jur($id,5, $start);
      $data = [
        'status' => true,
        'page' => $p,
        'total_data' => $total_data,
        'total_page' => $total_page,
        'data' => $list
      ];
      if ($list) {
        $this->response($data, REST_Controller::HTTP_OK);
      } else {
        $this->response(['status' => false, 'msg' => 'data tidak ditemukan'], REST_Controller::HTTP_NOT_FOUND);
      }
    } else {
      $mhs = $this->mhs_model->get_all_data_jur($jurusan);
      if ($mhs) {
        $p = $this->get('page');
        $p = (empty($p) ? 1 : $p);
        $total_data = $this->mhs_model->get_jml_data_jur($jurusan);
        $total_page = ceil($total_data / 5);
        $start = ($p - 1) * 5;
        $list = $this->mhs_model->get_all_data_jur($jurusan,5, $start);
        $this->response(
                        $data = [
                          'status' => true,
                          'page' => $p,
                          'total_data' => $total_data,
                          'total_page' => $total_page,
                          'data' => $list], REST_Controller::HTTP_OK);
      } else {
        $this->response(['status' => false, 'msg' => 'data tidak ditemukan'], REST_Controller::HTTP_NOT_FOUND);
      }
    }
  }

  public function index_post()
  {
    $data = [
      'nim' => $this->post('nim'),
      'nama_mhs' => $this->post('nama'),
      'alamat_mhs' => $this->post('alamat'),
      'kd_prodi' => $this->post('prodi'),
      'dsn_wali' => $this->post('dsnwali'),

    ];
    $simpan = $this->mhs_model->tambah_mhs($data);
    if ($simpan['status']) {
      $this->response(['status' => true, 'msg' => 'Data telah ditambahkan'], REST_Controller::HTTP_OK);
    } else {
      $this->response(['status' => false, 'msg' => $simpan['msg']], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  public function index_put()
  {
    $data = [
      'nim' => $this->put('nim'),
      'nama_mhs' => $this->put('nama'),
      'alamat_mhs' => $this->put('alamat'),
      'kd_prodi' => $this->put('prodi'),
      'dsn_wali' => $this->put('dsnwali'),

    ];
    $id = $this->put('id');
    $simpan = $this->mhs_model->update_mhs($data, $id);
    if ($simpan['status']) {
      $status = (int) $simpan['data'];
      if ($status > 0) {
        $this->response(['status' => true, 'msg' => 'Data telah diupdate'], REST_Controller::HTTP_OK);
      } else {
        $this->response(['status' => false, 'msg' => 'Tidak ada data yang dirubah'], REST_Controller::HTTP_BAD_REQUEST);
      }
    } else {
      $this->response(['status' => false, 'msg' => $simpan['msg']], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  public function index_delete()
  {
    $id = $this->delete('id');
     if ($id === null) {
      $this->response(['status' => false, 'msg' => 'id tidak boleh kosong'], REST_Controller::HTTP_BAD_REQUEST);
    } else {
      if($this->mhs_model->hapusmahasiswa($id)>0){
        $this->response(['status' => true, 'id' => $id, 'msg' => 'Data telah dihapus'], REST_Controller::HTTP_OK);
      } else{
        $this->response(['status' => false, 'msg' => 'id tidak ditemukan'], REST_Controller::HTTP_BAD_REQUEST);
      }
    }
  }

}



/* End of file Mahasiswa.php */
/* Location: ./application/controllers/Mahasiswa.php */
