<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkhs extends CI_Model {

	public function get($semester = 'ganjil', $thn_ajaran = '')
	{

		$query = $this->db->query(
			"SELECT study_point.*, course.* FROM study_point INNER JOIN course ON study_point.course_id = course.course_id
			WHERE study_point.student_id = ? AND study_point.semester = ? AND study_point.years = ?",
			array($this->session->userdata('account_id'), $semester, $thn_ajaran)
		);

		return $query->result();
	}

}

/* End of file Mkhs.php */
/* Location: ./application/modules/Mahasiswa/controllers/Mkhs.php */