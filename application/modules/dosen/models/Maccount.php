<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maccount extends CI_Model 
{
	public $userID;

	public function __construct()
	{
		parent::__construct();
		
		$this->userID = $this->session->userdata('dosen_id');
	}
	
	public function get()
	{
        $query = $this->db->query("
            SELECT lecturer.*, lecturer_accounts.email, lecturer_accounts.password  FROM lecturer 
            JOIN lecturer_accounts ON lecturer.lecturer_id = lecturer_accounts.lecturer_id WHERE lecturer.lecturer_id = ?", array($this->userID));

        return $query->row();
	}

	public function update()
	{
		$this->db->update('lecturer_accounts', array('email' => $this->input->post('email')), array('lecturer_id' => $this->userID));

		$password = password_hash($this->input->post('new_pass'), PASSWORD_DEFAULT);

		if( $this->input->post('new_pass') != '')
			$this->db->update('lecturer_accounts', array('password' => $password), array('lecturer_id' => $this->userID));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Perubahan tersimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal melakukan perubahan.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	/**
	 * Cek Dosen PA atau tidak
	 *
	 * @return Boolean
	 **/
	public function validate_pa()
	{
		$this->db->select('lecturer.lecturer_id');

		$this->db->where('lecturer.status', 'ds_tetap');
		$this->db->where('lecturer.lecturer_id', $this->userID);

		$this->db->join('lecturer', 'dosen_pa.lecturer_id = lecturer.lecturer_id', 'left');

		if( $this->db->get('dosen_pa')->num_rows() )
		{
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file Maccount.php */
/* Location: ./application/modules/dosen/models/Maccount.php */