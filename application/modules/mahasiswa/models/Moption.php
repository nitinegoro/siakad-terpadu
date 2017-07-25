<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Moption extends CI_Model 
{

	public function get($param = '')
	{
		return $this->db->get_where('tb_options', array('option_name' => $param))->row('option_value');
	}	

	/**
	 * Menampilkan Notifikasi yg belum terbaca
	 *
	 * @return Result data
	 **/
	public function notifikasi()
	{
		$this->db->join('users', 'plain_studies_callback.user_id = users.user_id', 'left');
		return $this->db->get_where(
			'plain_studies_callback', 
			array(
				'student_id' => $this->session->userdata('account_id'),
				'read' => '0'
			)
		)->result();
	}

	/**
	 * Update Notifikasi Menjadi terbaca
	 *
	 * @return Boleaan
	 **/
	public function update_notifikasi()
	{
		$this->db->update(
			'plain_studies_callback', 
			array(
				'read' => 1
			),
			array(
				'student_id' => $this->session->userdata('account_id'),
				'semester' => $this->input->get('semester'),
				'years' => $this->input->get('thn_ajaran')
			)
		);
	}
}

/* End of file Moption.php */
/* Location: ./application/modules/Mahasiswa/models/Moption.php */