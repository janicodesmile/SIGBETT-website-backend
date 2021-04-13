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

class Mhs_model extends CI_Model
{

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function get_all_data($id = null, $limit = 5, $offset = 0)
  {
    if ($id === null) {
      return $this->db->get('t_mhs', $limit, $offset)->result();
    } else {
      return $this->db->get_where('t_mhs', ['nim' => $id])->row_array();
    }
  }

  public function get_all_data_jur($jur = null, $limit = 5, $offset = 0)
  {
    if ($jur === null) {
      return $this->db->get('t_mhs', $limit, $offset)->result();
    } else {
      return $this->db->get_where('t_mhs', ['kd_prodi' => $jur])->result();
    }
  }
  public function get_jml_data_jur($jur)
  {
    return $this->db->get_where('t_mhs', ['kd_prodi' => $jur])->num_rows();
  }

  public function get_jml_data()
  {
    return $this->db->get('t_mhs')->num_rows();
  }

  public function tambah_mhs($data)
  {
    try {
      $this->db->insert('t_mhs', $data);
      $error = $this->db->error();
      if (!empty($error['code'])) {
        throw new Exception('Terjadi kesalahan: ' . $error['message']);
        return false;
      }
      return ['status' => true, 'data' => $this->db->affected_rows()];
    } catch (Exception $ex) {
      return ['status' => false, 'msg' => $ex->getMessage()];
    }
  }
  public function update_mhs($data, $id)
  {
    try {
      $this->db->update('t_mhs', $data, ['nim' => $id]);
      $error = $this->db->error();
      if (!empty($error['code'])) {
        throw new Exception('Terjadi kesalahan: ' . $error['message']);
        return false;
      }
      return ['status' => true, 'data' => $this->db->affected_rows()];
    } catch (Exception $ex) {
      return ['status' => false, 'msg' => $ex->getMessage()];
    }
  }
  public function hapusmahasiswa($id)
  {
    $this->db->delete('t_mhs', ['nim' => $id]);
    return $this->db->affected_rows();
  }
  // ------------------------------------------------------------------------

}

/* End of file Mhs_model.php */
/* Location: ./application/models/Mhs_model.php */
