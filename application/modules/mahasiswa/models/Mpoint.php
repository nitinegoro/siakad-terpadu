<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpoint extends CI_Model 
{
	public $student;

	public function __construct()
	{
		parent::__construct();
		$this->student = $this->session->userdata('account_id');
	}

	public function get()
	{
		$this->db->join('course', 'study_point.course_id = course.course_id', 'left');
		$this->db->where_not_in('study_point.grade', 'E');
		$this->db->where('student_id', $this->student);
		return $this->db->get('study_point')->result();
	}

}

/* End of file Mpoint.php */
/* Location: ./application/modules/Mahasiswa/models/Mpoint.php */