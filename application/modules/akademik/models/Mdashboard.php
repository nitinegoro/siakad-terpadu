<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdashboard extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		
	}

	/**
	 * Get Count Data Mahasiswa
	 *
	 * @param String (Status Mahasiswa)
	 * @return Integer (total Mahasiswa)
	 **/
	public function students($status = 0)
	{
		
	}

	/**
	 * Hitung Data Mahasiswa untuk Bar Chart
	 *
	 * @param Boolean (typical mahasiswa reguler or transisi
	 * @param year 
	 * @return Integer
	 **/
	public function studentsByYear($typical = FALSE, $year = '')
	{
		if($typical == FALSE)
		{
			return $this->db->like('npm', 'P')
							->where_in('register_year', $year)
					 		->get('students')->num_rows();
		} else {
			return $this->db->not_like('npm', '%P%')
							->where_in('register_year', $year)
					 		->get('students')->num_rows();
		}
	}

	/**
	 * Hitung Mahasiswa yang telah lulus
	 *
	 * @param tahun masuk
	 * @return Integer
	 **/
	public function studentsGoals($years = 0)
	{
		$students = $this->db->select('student_id, register_year')
							 ->where_in('register_year', $years)
							 ->where('status', 'graduation')
							 ->get('students');

/*		foreach($students->result() as $row)
			$student_id[] = $row->student_id;

		$point_study = $this->db->select('study_point.*, course.*')
								->join('course', 'study_point.course_id = course.course_id')
								->where_in('study_point.student_id', $student_id)
								->get('study_point');

		$sks_per_student = 0;
		foreach($point_study->result() as $row)
		{
			if($sks_per_student >= 53)
				continue;

			$sks_per_student += $row->sks;


		}*/

		return $students->num_rows();

	}
	

}

/* End of file Mdashboard.php */
/* Location: ./application/modules/Akademik/models/Mdashboard.php */