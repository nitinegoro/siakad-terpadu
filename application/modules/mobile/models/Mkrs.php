<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkrs extends CI_Model 
{
	public $student;

	public $default_semester;

	public function __construct()
	{
		parent::__construct();
		
		$this->student = $this->session->userdata('account_id');

		$this->default_semester = $this->db->get_where('tb_options', 
			array('option_name' => 'default_semester')
		)->row('option_value');

		$this->thn_akademik = $this->db->get_where('tb_options', 
			array('option_name' => 'default_thn_ajaran')
		)->row('option_value');
	}

	public function getPlain($years = '', $semester = '')
	{
		$this->db->join('course', 'plain_studies.course_id = course.course_id');

		$this->db->where('plain_studies.student_id', $this->student);

		$this->db->where('plain_studies.years', $years);

		$this->db->where('plain_studies.semester', $semester);

		return $this->db->get('plain_studies')->result();
	}	

	/**
	 * Get MK Plain
	 *
	 * @param Integer (student_id)
	 * @param String (ganjil/genap)
	 * @return Results MK
	 **/
	public function getMK()
	{
		$study_point = $this->db->query("SELECT course_id FROM study_point WHERE student_id = ?", $this->student);
		
		if($study_point->num_rows())
		{
			$mk_point = array();

			foreach ($study_point->result() as $row) 
				$mk_point[] = $row->course_id;

			$not_mk = join(',', $mk_point);

			if($study_point->row('concentration_id'))
			{
				$query = $this->db->query("SELECT * FROM course WHERE course_id NOT IN({$not_mk}) AND semester = ?", $this->default_semester);
			} else {
				$query = $this->db->query("SELECT * FROM course WHERE course_id NOT IN({$not_mk}) AND semester = ? AND concentration_id IN(0)", $this->default_semester);
			}
		} else {
			$query = $this->db->query("SELECT * FROM course");
		}

		return $query->result();
	}
}

/* End of file Mkrs.php */
/* Location: ./application/modules/mobile/models/Mkrs.php */