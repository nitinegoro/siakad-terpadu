<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpembimbing extends CI_Model 
{
	public $userID;

	public function __construct()
	{
		parent::__construct();
		
		$this->userID = $this->session->userdata('dosen_id');
	}
	
	public function get_mahasiswa($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->select('students.student_id, students.npm, students.name, students.gender, students.class, students.register_year, concentration.concentration_name');

		$this->db->join('concentration', 'students.concentration_id = concentration.concentration_id', 'left');

		if($this->input->get('class') != '')
			$this->db->where('students.class', $this->input->get('class'));

		if($this->input->get('gender') != '')
			$this->db->where('students.gender', $this->input->get('gender'));

		if($this->input->get('registration') != '')
			$this->db->where('students.register_year', $this->input->get('registration'));

		if($this->input->get('query') != '')
			$this->db->like('students.npm', $this->input->get('query'))
					 ->or_like('students.name', $this->input->get('query'));

		$this->db->where('students.dosen_pa', $this->userID);

		$this->db->order_by('students.student_id', 'desc');

		if($type == 'result')
		{
			return $this->db->get('students', $limit, $offset)->result();
		} else {
			return $this->db->get('students')->num_rows();
		}
	}
}

/* End of file Mpembimbing.php */
/* Location: ./application/modules/dosen/models/Mpembimbing.php */