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

class Bengkel extends REST_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Bengkel_model');
  }

  public function bengkel_get()
  {
    $id = $this->get('id');
    if ($id === null) {
      $p = $this->get('page');
      $p = (empty($p) ? 1 : $p);
      $start = ($p - 1) * 5;
      $list = $this->Bengkel_model->get_all_data($id);


      $arraylist = array();

        foreach ($list as $key) {
          $indo = $this->Bengkel_model->indo($key->id_bengkel);
          $eng = $this->Bengkel_model->eng($key->id_bengkel);
           $arraylist[]=array(
            'id_bengkel' => $key->id_bengkel,
            'nama_kecamatan' => $key->nama_kecamatan,
            'nama_kel' => $key->nama_kel,
            'nama_bengkel' => $key->nama_bengkel,
            'lat' => $key->lat,
            'lng' => $key->lng,
            'alamat_bengkel' => $key->alamat_bengkel,
            'no_hp' => $key->no_hp,
            'nama_pemilik' => $key->nama_pemilik,
            'hari_kerja' => $key->hari_kerja,
            'hari_buka_indo' => $indo,
            'hari_buka_end' => $eng,
            'jam_buka' => $key->jam_buka,
            'jam_tutup' => $key->jam_tutup,
            'gambar_sampul' => $key->gambar_sampul
          );
        }
      $data = [
        'value' => 1,
        'data' => $arraylist
      ];
      if ($list) {
        $this->response($data, REST_Controller::HTTP_OK);
      } else {
        $this->response(['status' => false, 'msg' => 'data tidak ditemukan'], REST_Controller::HTTP_NOT_FOUND);
      }
    }
  }


  public function bengkel_post()
  {
    $jurusan = $this->post('id_bengkel');
    $bengkel = $this->Bengkel_model->get_all_data_bengkel($jurusan);
      if ($bengkel) {
        $p = $this->get('page');
        $p = (empty($p) ? 1 : $p);
        $list = $this->Bengkel_model->get_all_data_bengkel($jurusan);
        $jml = $this->Bengkel_model->get_all_jumlah_gambar($jurusan);
        $fasi = $this->Bengkel_model->get_all_jumlah_fasi($jurusan);
        $gambar = $this->Bengkel_model->getGambarWhere($jurusan);
        $fasilitas = $this->Bengkel_model->getFasiWhere($jurusan);
        $this->response(
                        $data = [
                          'status' => 1,
                          'id_bengkel' => $jurusan,
                          'nama_bengkel' => $list['nama_bengkel'],
                          'data' => $list,
                          'jml_gambar' => $jml['total'],
                          'gambar' => $gambar,
                          'jml_fasi' => $fasi['total'],
                          'fasilitas' => $fasilitas,
                        ], REST_Controller::HTTP_OK);
      } else {
        $this->response(['status' => false, 'msg' => 'data tidak ditemukan'], REST_Controller::HTTP_NOT_FOUND);
      }
  }

  public function bengkelCari_post()
  {
    $jurusan = $this->post('keyword');
    $bengkel = $this->Bengkel_model->get_search_bengkel($jurusan);
    $p = $this->get('page');
    $p = (empty($p) ? 1 : $p);
    $start = ($p - 1) * 5;
    $list = $this->Bengkel_model->get_search_bengkel($jurusan);
    $data = [
        'value' => 1,
        'data' => $list
      ];
      if ($list) {
        $this->response($data, REST_Controller::HTTP_OK);
      } else {
        $this->response(['status' => false, 'msg' => 'data tidak ditemukan'], REST_Controller::HTTP_NOT_FOUND);
      }
  }

  public function bengkelFasi_post()
  {
    $jur = $this->post('keyword');
    $bengkel = $this->Bengkel_model->get_search_fasi($jur);
    $list = $this->Bengkel_model->get_search_fasi($jur);
    $data = [
        'value' => 1,
        'data' => $list
      ];
      if ($list) {
        $this->response($data, REST_Controller::HTTP_OK);
      } else {
        $this->response(['status' => false, 'msg' => 'data tidak ditemukan'], REST_Controller::HTTP_NOT_FOUND);
      }
  }



}



/* End of file Mahasiswa.php */
/* Location: ./application/controllers/Mahasiswa.php */
