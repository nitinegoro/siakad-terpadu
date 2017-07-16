<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mentrypoint extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function get($npm = '', $semester = 'ganjil', $thn_ajaran = '')
	{
		$query = $this->db->query(
			"SELECT study_point.*, course.* FROM study_point INNER JOIN course ON study_point.course_id = course.course_id
			JOIN students ON study_point.student_id = students.student_id 
			WHERE students.npm = ? AND study_point.semester = ? AND study_point.years = ?",
			array($npm, $semester, $thn_ajaran)
		);

		return $query->result();
	}

	public function getStudent($student = '')
	{
		$query = $this->db->query("SELECT students.*, concentration.concentration_name FROM students
			LEFT JOIN concentration ON students.concentration_id = concentration.concentration_id 
			WHERE students.npm = ?", $student
		);

		if($query->num_rows()==FALSE)
			return FALSE;
		
		return $query->row();
	}

	/**
	 * Handle Update Nilai
	 *
	 * @param Integer (student_id)
	 * @return string
	 **/
	public function update($param  = 0)
	{
		if(is_array($this->input->post('point')))
		{
			foreach ($this->input->post('point') as $key => $value) 
			{
				$this->db->update('study_point', 
					array(
						'absent' => $value['absent'],
						'task' => $value['task'],
						'midterms' =>$value['midterms'],
						'final' => $value['final']
					),
					array(
						'student_id' => $param,
						'course_id' => $key,
						'years' => $this->input->post('years'),
						'semester' => $this->input->post('semester')
					)
				);
			}

			$this->template->alert(
				' Perubahan nilai disimpan.', 
				array('type' => 'success','icon' => 'check')
			);

		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}
}

/* End of file Mentrypoint.php */
/* Location: ./application/modules/Akademik/models/Mentrypoint.php */