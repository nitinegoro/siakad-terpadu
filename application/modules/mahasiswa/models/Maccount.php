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

	public function getAll($param = 0)
	{
		$this->db->join('concentration', 'students.concentration_id = concentration.concentration_id', 'left');

		$this->db->join('students_parent', 'students.student_id = students_parent.student_id', 'left');

		$this->db->join('students_origin_school', 'students.student_id = students_origin_school.school_student_id', 'left');

		$this->db->where('students.student_id', $param);

		return $this->db->get('students')->row();
	}

	public function get($param = 0)
	{
		return $this->db->get_where('students_accounts', array('account_student_id' => $param))->row();
	}

	public function set($param = 0)
	{
		$get = $this->get($param);

		$new_pass = password_hash($this->input->post('new_pass'), PASSWORD_DEFAULT);

		if(password_verify($this->input->post('old_pass'), $get->password ))
		{
			$this->db->update(
				'students_accounts', 
				array(
					'email' => $this->input->post('email'), 
					'password' => (!$this->input->post('new_pass')) ? $get->password : $new_pass 
				), 
				array('account_id' => $get->account_id) 
			);

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

		} else {
			$this->template->alert(
				' Gagal melakukan perubahan, password yang anda masukkan salah.', 
				array('type' => 'warning','icon' => 'times')
			);	
		}
	}

	public function update_data()
	{
		$mahasiswa = array(
			'gender' => $this->input->post('gender'),
			'place_of_birts' => $this->input->post('place_of_birts'),
			'birts' => $this->input->post('birts'),
			'address' => $this->input->post('address'),
			'photo' => '',
			'religion' => $this->input->post('religion'),
			'jobs' => $this->input->post('jobs'),
		);

		$this->db->update('students', $mahasiswa, array('student_id' => $this->student));

		$parents = array(
			'father_name' => $this->input->post('father_name'),
			'mother_name' => $this->input->post('mother_name'),
			'parent_address' => $this->input->post('parent_address'),
			'phone_number' => $this->input->post('phone_number'),
			'father_jobs' => $this->input->post('father_jobs'),
			'mother_jobs' => $this->input->post('mother_jobs'),
			'revenue' => $this->input->post('revenue')
		);

		$this->db->update('students_parent', $parents, array('student_id' => $this->student));

		$school = array(
			'school_name' => $this->input->post('school_name'),
			'school_study' => $this->input->post('school_study'),
			'school_address' => $this->input->post('school_address'),
			'certificate_number' => $this->input->post('certificate_number'),
			'graduation_year' => $this->input->post('graduation_year'),
			'grade_value' => $this->input->post('grade_value')
		);

		$this->db->update('students_origin_school', $school, array('school_student_id' => $this->student));

		$this->template->alert(
			' Perubahan tersimpan.', 
			array('type' => 'success','icon' => 'check')
		);
	}

}

/* End of file Maccount.php */
/* Location: ./application/modules/Mahasiswa/models/Maccount.php */