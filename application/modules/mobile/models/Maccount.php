<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maccount extends CI_Model 
{
	public $student;

	public function __construct()
	{
		parent::__construct();
		
		$this->student = $this->session->userdata('account_id');
	}

	public function get()
	{
		$this->db->join('concentration', 'students.concentration_id = concentration.concentration_id', 'left');

		$this->db->join('students_parent', 'students.student_id = students_parent.student_id', 'left');

		$this->db->join('students_origin_school', 'students.student_id = students_origin_school.school_student_id', 'left');

		$this->db->join('students_accounts', 'students.student_id = students_accounts.account_student_id', 'left');

		$this->db->where('students.student_id', $this->student);

		return $this->db->get('students')->row();
	}

	
	public function getaccount()
	{
		return $this->db->get_where('students_accounts', array('account_student_id' => $this->student))->row();
	}

	public function set()
	{
		$get = $this->getaccount();

		$new_pass = password_hash($this->input->post('pbaru'), PASSWORD_DEFAULT);

		if(password_verify($this->input->post('plama'), $get->password ))
		{
			$this->db->update(
				'students_accounts', 
				array(
					'email' => $this->input->post('email'), 
					'password' => (!$this->input->post('pbaru')) ? $get->password : $new_pass 
				), 
				array('account_id' => $get->account_id) 
			);

		} 
	}
}

/* End of file Maccount.php */
/* Location: ./application/modules/mobile/models/Maccount.php */