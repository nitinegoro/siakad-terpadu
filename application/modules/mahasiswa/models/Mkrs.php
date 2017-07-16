<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkrs extends CI_Model 
{
	public $thn_ajaran;

	public $semester;

	public function __construct()
	{
		parent::__construct();

		$this->thn_ajaran = (!$this->input->get('thn_ajaran')) ? $this->option->get('default_thn_ajaran') : $this->input->get('thn_ajaran');

		$this->semester = (!$this->input->get('semester')) ? $this->option->get('default_semester') : $this->input->get('semester');

		$this->student = $this->session->userdata('account_id');
	}


	private function getConcentration($param = 0)
	{
		$query = $this->db->query("SELECT concentration_id FROM students WHERE student_id = ?", $param);
		return $query->row('concentration_id');
	}

	/**
	 * Get MK Plain
	 *
	 * @param Integer (student_id)
	 * @param String (ganjil/genap)
	 * @return Results MK
	 **/
	public function getMk($param = 0, $semester = 'ganjil')
	{
		$study_point = $this->db->query("SELECT course_id FROM study_point WHERE student_id = ?", $param);
		
		if($study_point->num_rows())
		{
			$mk_point = array();

			foreach ($study_point->result() as $row) 
				$mk_point[] = $row->course_id;

			$not_mk = join(',', $mk_point);

			if($this->getConcentration($param))
			{
				$query = $this->db->query("SELECT * FROM course WHERE course_id NOT IN({$not_mk}) AND semester = ?", $semester);
			} else {
				$query = $this->db->query("SELECT * FROM course WHERE course_id NOT IN({$not_mk}) AND semester = ? AND concentration_id IN(0)", $semester);
			}
		} else {
			$query = $this->db->query("SELECT * FROM course");
		}

		return $query->result();
	}

	/**
	 * Get MK Update Plain
	 *
	 * @param Integer (student_id)
	 * @param String (ganjil/genap)
	 * @return Results MK
	 **/
	public function getMkupdate($param = 0, $semester = 'ganjil')
	{
		$study_point = $this->db->query("SELECT course_id FROM study_point WHERE student_id = ?", $param);
		
		if($study_point->num_rows())
		{
			$mk_point = array();
			$mk_plain = array();

			foreach ($study_point->result() as $row) 
				$mk_point[] = $row->course_id;

			foreach($this->getPlain( $this->thn_ajaran, $this->semester )->result() as $row)
				$mk_plain[] = $row->course_id;

			// generate to (1,2,3)
			$not_mk = join(',', $mk_point);
			$not_plain = join(',', $mk_plain);

			if($this->getConcentration($param))
			{
				$query = $this->db->query(
					"SELECT * FROM course 
					WHERE course_id NOT IN({$not_mk},{$not_plain}) AND semester = ?", $semester);
			} else {
				$query = $this->db->query(
					"SELECT * FROM course 
					WHERE course_id NOT IN({$not_mk},{$not_plain}) AND semester = ? AND concentration_id IN(0)", $semester);
			}
		} else {
			$query = $this->db->query("SELECT * FROM course");
		}

		return $query->result();
	}

	/**
	 * Get MK 
	 *
	 * @param Array
	 * @return Integer
	 **/
	public function count_sks()
	{
		if(count($this->session->userdata('mata-kuliah')) > 1)
		{
			$mk = join(',', $this->session->userdata('mata-kuliah'));
		} else {
			$mk = $this->session->userdata('mata-kuliah')[0];
		}

		$query = $this->db->query("SELECT SUM(sks) as sks FROM course WHERE course_id IN({$mk})");

		$sks = 0;
		foreach ($query->result() as $row) 
		{
			$sks = $row->sks;
		}
		return $sks;
	}

	public function last_semester($param = 0)
	{
		$query = $this->db->query("SELECT semester, years FROM study_point WHERE student_id = ? ORDER BY result_id DESC LIMIT 1", $param);
		return $query->row();
	}

	public function getPlain($years = '', $semester = '')
	{
		$this->db->join('course', 'plain_studies.course_id = course.course_id');

		$this->db->where('plain_studies.student_id', $this->session->userdata('account_id'));

		$this->db->where('plain_studies.years', $years);

		$this->db->where('plain_studies.semester', $semester);

		return $this->db->get('plain_studies');
	}

	/**
	 * Get Detail Course
	 *
	 * @param Integer (course_id)
	 * @return Row
	 **/
	public function getCourse($param = 0)
	{
		$query = $this->db->query("SELECT * FROM course WHERE course_id = ?", array($param));
		return $query->row();
	}

	/**
	 * Create KRS (Insert to plain studies)
	 *
	 * @return string
	 **/
	public function create()
	{
		$krk = array();

		$config = array(
			'student' => $this->student,
			'semester' => $this->semester,
			'years' => $this->thn_ajaran,
		);
		$this->load->library('nilai', $config);

		$sks = 0;

		if(is_array($this->input->post('mk')))
		{
			foreach($this->input->post('mk') as $key => $value) 
			{
				$course = $this->getCourse($value);
				$sks += $course->sks;

				if($sks >= $this->nilai->credit_sks())
					break;

				$krk[] = array(
					'student_id' => $this->student,
					'course_id' => $value,
					'years' => $this->input->post('thn_ajaran'),
					'semester' => $this->input->post('semester'),
					'verification' => '0'
				);
			}

			$this->db->insert_batch('plain_studies', $krk);

			$notif = array(
				'student_id' => $this->student,
				'user_id' => '0',
				'years' => $this->input->post('thn_ajaran'),
				'semester' => $this->input->post('semester'),
				'datetime' => date('Y-m-d H:i:s'),
				'read' => 2
			);

			$this->db->insert('plain_studies_callback', $notif);

			$this->template->alert(
				' KRS anda tersimpan, silahkan menunggu pemberitahuan dari bagian akademik', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'success','icon' => 'check')
			);
		}
	}

	/**
	 * Update Mata Kuliah dalam KRS
	 *
	 * @param Integer (plain_id)
	 * @return Strig
	 **/
	public function update($param = 0)
	{
		$query = $this->db->query("UPDATE plain_studies SET course_id = ? WHERE plain_id = ?", array($this->input->post('mk'), $param));

		if($this->db->affected_rows())
		{
			$last = $this->getCourse($this->input->post('last-mk'));
			$new = $this->getCourse($this->input->post('mk'));

			$this->template->alert(
				" anda mengganti mata kuliah <strong>{$last->course_name}</strong> dengan <strong>{$new->course_name}</strong>.", 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal mengganti mata kuliah.', 
				array('type' => 'warning','icon' => 'check')
			);
		}
	}

	/**
	 * Add Mata Kulia dalam KRS
	 *
	 * @return string
	 **/
	public function add()
	{
		$get = $this->getPlain(  $this->thn_ajaran, $this->semester )->result();
		
		$config = array(
			'student' => $this->session->userdata('account_id'),
			'semester' => ($get[0]->semester == 'ganjil') ? 'genap' : 'ganjil',
			'years' => $get[0]->years,
		);
		$this->load->library('nilai', $config);

		$sks_plain = 0;
		foreach($get as $row)
			$sks_plain += $row->sks;

		$krk = array();

		$jumlah = 0;

		if(is_array($this->input->post('mk')))
		{
			foreach ($this->input->post('mk') as $key => $value) 
			{
				$course = $this->getCourse($value);
				$jumlah += ($course->sks + $sks_plain);

				if($jumlah >= $this->nilai->credit_sks())
					break;

				$krk[] = array(
					'student_id' => $this->session->userdata('account_id'),
					'course_id' => $value,
					'lecturer_schedule_id' => '0',
					'years' => $get[0]->years,
					'semester' => $get[0]->semester,
					'verification' => '0'
				);		
			}

			if(count($krk) != FALSE)
			{
				$this->db->insert_batch('plain_studies', $krk);
				$this->template->alert(
					" penambahan disimpan.", 
					array('type' => 'success','icon' => 'check')
				);
			}

		} else {
			$this->template->alert(
				' Gagal menambahkan mata kuliah.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

}

/* End of file Mkrs.php */
/* Location: ./application/modules/Mahasiswa/models/Mkrs.php */