<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Mhs_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Ahmad Faisol <mzfais@lecturer.itn.ac.id>
 * @link      https://github.com/mzfais/
 * @param     ...
 * @return    ...
 *
 */

class Bengkel_model extends CI_Model
{

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function get_all_data($id = null)
  {
      $this->db->select('tb_bengkel.id_bengkel ,tb_kecamatan.nama_kecamatan, tb_kelurahan.nama_kel, tb_bengkel.nama_bengkel, tb_bengkel.lat, tb_bengkel.long as lng, tb_bengkel.alamat_bengkel,tb_bengkel.no_hp, tb_bengkel.nama_pemilik, tb_bengkel.hari_kerja, tb_bengkel.hari_kerja1 as hari_buka, tb_bengkel.jam_buka, tb_bengkel.jam_tutup, tb_bengkel.gambar_sampul'); 
        $this->db->from('tb_bengkel');
        $this->db->join('tb_kecamatan', 'tb_bengkel.id_kecamatan = tb_kecamatan.id');
        $this->db->join('tb_kelurahan', 'tb_bengkel.id_kelurahan = tb_kelurahan.id');
        $query = $this->db->get();
        return $query->result();
  }

  public function indo($id)
  {
    $tb_bengkel = $this->db->get_where('tb_bengkel',['id_bengkel' => $id])->result();
    $tb_hari = $this->db->get('tb_hari')->result();

    foreach ($tb_bengkel as $val) {
    
      $hari_buka = (explode(", ",$val->hari_kerja1));
      $ind_hari_buka = array();
      $eng_hari_buka = array();

      foreach ($hari_buka as $id) {
        foreach ($tb_hari as $result) {
          if ($id == $result->no) {
            $ind_hari_buka[] = $result->hari;
            $eng_hari_buka[] = $result->day;
          }
        }
      }
      }
     $indo = implode(", ", $ind_hari_buka);
     return $indo;
  }

  public function eng($id)
  {
    $tb_bengkel = $this->db->get_where('tb_bengkel',['id_bengkel' => $id])->result();
    $tb_hari = $this->db->get('tb_hari')->result();

    foreach ($tb_bengkel as $val) {
    
      $hari_buka = (explode(", ",$val->hari_kerja1));
      $ind_hari_buka = array();
      $eng_hari_buka = array();

      foreach ($hari_buka as $id) {
        foreach ($tb_hari as $result) {
          if ($id == $result->no) {
            $ind_hari_buka[] = $result->hari;
            $eng_hari_buka[] = $result->day;
          }
        }
      }
      }
     $indo = implode(", ", $ind_hari_buka);
     $eng = implode(", ", $eng_hari_buka);
     return $eng;
  }

  public function get_all_data_bengkel($id = null)
  {
    $this->db->select('tb_kecamatan.nama_kecamatan, tb_kelurahan.nama_kel, tb_bengkel.nama_bengkel, tb_bengkel.lat, tb_bengkel.long as lng, tb_bengkel.alamat_bengkel,tb_bengkel.no_hp, tb_bengkel.nama_pemilik, tb_bengkel.hari_kerja, tb_bengkel.jam_buka, tb_bengkel.jam_tutup, tb_bengkel.gambar_sampul'); 
        $this->db->from('tb_bengkel');
        $this->db->join('tb_kecamatan', 'tb_bengkel.id_kecamatan = tb_kecamatan.id');
        $this->db->join('tb_kelurahan', 'tb_bengkel.id_kelurahan = tb_kelurahan.id');
        $this->db->where('tb_bengkel.id_bengkel',$id);
        $query = $this->db->get();
        return $query->row_array();
  }

  public function get_search_bengkel($key = null)
  {
    $this->db->select('tb_bengkel.id_bengkel ,tb_kecamatan.nama_kecamatan, tb_kelurahan.nama_kel, tb_bengkel.nama_bengkel, tb_bengkel.lat, tb_bengkel.long as lng, tb_bengkel.alamat_bengkel,tb_bengkel.no_hp, tb_bengkel.nama_pemilik, tb_bengkel.hari_kerja, tb_bengkel.jam_buka, tb_bengkel.jam_tutup, tb_bengkel.gambar_sampul'); 
        $this->db->from('tb_bengkel');
        $this->db->join('tb_kecamatan', 'tb_bengkel.id_kecamatan = tb_kecamatan.id');
        $this->db->join('tb_kelurahan', 'tb_bengkel.id_kelurahan = tb_kelurahan.id');
        $this->db->like('tb_bengkel.nama_bengkel', $key, 'both'); 
        $this->db->or_like('tb_kecamatan.nama_kecamatan', $key, 'both');
        $this->db->or_like('tb_kelurahan.nama_kel', $key, 'both');
        $query = $this->db->get();
       return $query->result();
  }

  public function get_search_fasi($key)
  {
    $this->db->select('tb_bengkel.id_bengkel, tb_bengkel.nama_bengkel, tb_bengkel.lat, tb_bengkel.long as lng, tb_bengkel.alamat_bengkel,tb_bengkel.no_hp, tb_bengkel.nama_pemilik, tb_bengkel.hari_kerja, tb_bengkel.jam_buka, tb_bengkel.jam_tutup, tb_bengkel.gambar_sampul'); 
        $this->db->from('tb_fasilitas');
        $this->db->join('tb_bengkel', 'tb_bengkel.id_bengkel = tb_fasilitas.id_bengkel');
        $this->db->join('tb_fas', 'tb_fas.id_fas = tb_fasilitas.id_fas');
        $this->db->like('tb_fas.nama_fas', $key, 'both'); 
        $query = $this->db->get();
        return $query->result();
  }


  public function get_all_jumlah_gambar($id)
  {
    $this->db->select('*, COUNT(tb_gambar.id_bengkel) as total');
    $this->db->from('tb_gambar');
    $this->db->join('tb_bengkel', 'tb_bengkel.id_bengkel = tb_gambar.id_bengkel');
    $this->db->where('tb_gambar.id_bengkel',$id);
    $this->db->group_by('tb_gambar.id_bengkel'); 
    $query = $this->db->get();
    return $query->row_array();
  }

  public function get_all_jumlah_fasi($id)
  {
    $this->db->select('*, COUNT(tb_fasilitas.id_bengkel) as total');
    $this->db->from('tb_fasilitas');
    $this->db->join('tb_bengkel', 'tb_bengkel.id_bengkel = tb_fasilitas.id_bengkel');
    $this->db->join('tb_fas', 'tb_fas.id_fas = tb_fasilitas.id_fas');
    $this->db->group_by('tb_fasilitas.id_bengkel'); 
    $this->db->where('tb_fasilitas.id_bengkel',$id);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function getGambarWhere($id)
    {
      $this->db->select('*');
      $this->db->from('tb_gambar');
      $this->db->join('tb_bengkel', 'tb_bengkel.id_bengkel = tb_gambar.id_bengkel');
      $this->db->where('tb_gambar.id_bengkel', $id);
      $query = $this->db->get()->result();
      $results = array();
      $no =1;
      foreach ($query as $gam) {
            $results[]=array(
              'gambar_' => $gam->gambar
            );
          
      }
      return $results;
    }

    public function getFasiWhere($id)
    {
      $this->db->select('*');
      $this->db->from('tb_fas');
      $this->db->join('tb_fasilitas', 'tb_fas.id_fas = tb_fasilitas.id_fas');
      $this->db->where('tb_fasilitas.id_bengkel', $id);
      $query = $this->db->get()->result();
      $results = array();
      foreach ($query as $fas) {
            $results[]=array(
              'idfas_' => $fas->id_fas,
              'namafas_' => $fas->nama_fas,
              'iconfas_'=> $fas->icon
            );
      }
      return $results;
    }
  
  // ------------------------------------------------------------------------

}

/* End of file Mhs_model.php */
/* Location: ./application/models/Mhs_model.php */
