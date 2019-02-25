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

	public function semester($semester = 'ganjil', $thn_ajaran = '')
	{

		$query = $this->db->query(
			"SELECT study_point.*, course.* FROM study_point INNER JOIN course ON study_point.course_id = course.course_id
			WHERE study_point.student_id = ? AND study_point.semester = ? AND study_point.years = ?",
			array($this->session->userdata('account_id'), $semester, $thn_ajaran)
		);

		return $query->result();
	}
}

/* End of file Mpoint.php */
/* Location: ./application/modules/mobile/models/Mpoint.php */