<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Krs_callback extends CI_Model 
{

	public function getPlain($status = '0')
	{
		$this->db->join('students', 'plain_studies_callback.student_id = students.student_id', 'left');

		$this->db->where('plain_studies_callback.read', $status);

		$this->db->where_in('plain_studies_callback.user_id', 0);

		return $this->db->get('plain_studies_callback')->result();
	}

	public function get($param = 0)
	{
		$query = $this->db->query(
			"SELECT plain_studies_callback.*, students.npm, students.name, students.photo FROM plain_studies_callback
			JOIN students ON plain_studies_callback.student_id = students.student_id
			JOIN users ON plain_studies_callback.user_id = users.user_id
			WHERE students.student_id = ?", array($param)
		);

		return $query->row();
	}

	public function get_contents($param = 0)
	{
		$query = $this->db->query(
			"SELECT callback_contents.*, plain_studies_callback.* FROM callback_contents
			JOIN plain_studies_callback ON plain_studies_callback.call_id = callback_contents.callback_id
			WHERE plain_studies_callback.student_id = ?", array( $param )
		);

		return $query->result();
	}
}

/* End of file Krs_callback.php */
/* Location: ./application/modules/Akademik/models/Krs_callback.php */