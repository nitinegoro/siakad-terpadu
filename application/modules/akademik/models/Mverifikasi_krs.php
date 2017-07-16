<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mverifikasi_krs extends CI_Model 
{
	protected $ci;

	public $student;
	
	public function __construct()
	{
		parent::__construct();
		$this->ci = $ci =& get_instance();
	}

	public function get($student = '', $thn_ajaran = '', $semester = '')
	{
		$query = $this->db->query("SELECT students.*, plain_studies.*, course.* 
			FROM plain_studies JOIN course ON plain_studies.course_id = course.course_id 
			JOIN students ON plain_studies.student_id = students.student_id 
			WHERE students.npm = ? AND plain_studies.years = ? AND plain_studies.semester = ?", 
			array($student, $thn_ajaran, $semester)
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
	 * Get MK 
	 *
	 * @access private
	 * @param Array
	 * @return Integer
	 **/
	private function count_sks()
	{
		if(count($this->input->post('plain')) > 1)
		{
			$plain = join(',', $this->input->post('plain'));
		} else {
			$plain = $this->input->post('plain')[0];
		}

		$get_plain = $this->db->query("SELECT course_id FROM plain_studies WHERE plain_id IN({$plain})");

		if(count($get_plain->result()) > 1)
		{
			$mk_id[] = 0;
			foreach ($get_plain->result() as $key)
				$mk_id[] = $key->course_id;

			$mk = join(',', $mk_id);

		} else {
			$mk = $get_plain->row('course_id');
		}

		$query = $this->db->query("SELECT SUM(sks) as sks FROM course WHERE course_id IN({$mk})");

		$sks = 0;
		foreach ($query->result() as $row) 
			$sks = $row->sks;

		return $sks;
	}

	/**
	 * Get Set Verifikasi KRS
	 *
	 * @param String (Action POST)
	 * @return string
	 **/
	public function set($param = 0)
	{
		switch ($this->input->post('action')) 
		{
			case 'approve':
				$this->student = $param;
				$this->approve();
				break;
			case 'unapprove':
				$this->student = $param;
				$this->unapprove();
				break;
			case 'set_khs':
				$this->set_khs();
				break;
			case 'update_khs':
				$this->update_khs();
				break;
			default:
				$this->template->alert(
					' Gagal menyimpan data, tidak ada data mata kuliah yang dipilih.', 
					array('type' => 'warning','icon' => 'times')
				);
				break;
		}
	}

	/**
	 * Approve KRS Mahasiswa
	 *
	 * @access private
	 * @return string
	 **/
	private function approve()
	{
		if(is_array($this->input->post('plain')))
		{
			$this->db->update('plain_studies_callback', 
				array(
					'user_id' => $this->session->has_userdata('user_id'), 
					'read' => 0
				), 
				array('student_id' => $this->student)
			);

			$get_contents = $this->db->get_where('plain_studies_callback', array('student_id' => $this->student))->row();

			foreach ($this->input->post('plain') as $key => $value) 
			{
				$this->db->update('plain_studies',  
					array('verification' => 1),
					array('plain_id' => $value, 'student_id' => $this->student)
				);

				$where = array(
					'callback_id' => $get_contents->call_id, 
					'plain_id' => $value,
				);

				if($this->db->get_where('callback_contents', $where)->num_rows())
				{
					$this->db->update('callback_contents', array('verification' => 1), $where);
				} else {
					$plain = array(
						'callback_id' => $get_contents->call_id, 
						'plain_id' => $value,
						'verification' => 1
					);
					$this->db->insert('callback_contents', $plain);
				}
			}

			$this->template->alert(
				' Perubahan status disimpan.', 
				array('type' => 'success','icon' => 'check')
			);

		} else {
			$this->template->alert(
				' Gagal menyimpan data, tidak ada data mata kuliah yang dipilih.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	/**
	 * Unapprove KRS Mahasiswa
	 *
	 * @access private
	 * @return string
	 **/
	private function unapprove()
	{
		if(is_array($this->input->post('plain')))
		{
			$this->db->update('plain_studies_callback', 
				array(
					'user_id' => $this->session->has_userdata('user_id'), 
					'read' => 0
				), 
				array('student_id' => $this->student)
			);

			$get_contents = $this->db->get_where('plain_studies_callback', array('student_id' => $this->student))->row();

			foreach ($this->input->post('plain') as $key => $value) 
			{
				$this->db->update('plain_studies',  
					array('verification' => 0),
					array('plain_id' => $value, 'student_id' => $this->student)
				);

				$plain = array(
					'callback_id' => $get_contents->call_id, 
					'plain_id' => $value,
				);

				$this->db->update('callback_contents', array('verification' => 0), $plain);
			}

			$this->template->alert(
				' Perubahan status disimpan.', 
				array('type' => 'success','icon' => 'times')
			);

		} else {
			$this->template->alert(
				' Gagal menyimpan data, tidak ada data mata kuliah yang dipilih.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	/**
	 * Set KHS Mahasiswa
	 *
	 * @var string
	 **/
	private function set_khs()
	{
		$get_krs = $this->get($this->input->post('npm'), $this->input->post('years'), $this->input->post('semester'));

		$point = array();
		foreach($get_krs as $row) 
		{
			if($row->verification == FALSE)
				continue;

			$point[] = array(
				'student_id' => $this->input->post('student_id'),
				'course_id' => $row->course_id,
				'lecturer_schedule_id' => 0,
				'absent' => 0,
				'task' => 0,
				'midterms' => 0,
				'final' => 0,
				'point' => 0,
				'grade' => 0,
				'quality' => 0,
				'years' => $this->input->post('years'),
				'semester' => $this->input->post('semester') 
			);
		}

		$this->db->insert_batch('study_point', $point);

		$this->template->alert(
			' Data Mata Kuliah dipindahkan pada Studi Mahasiswa.', 
			array('type' => 'success','icon' => 'check')
		);
	}

	/**
	 * Update KHS dengan yang telah terverifikasi
	 *
	 * @return string
	 **/
	public function update_khs()
	{
		$get_krs = $this->get($this->input->post('npm'), $this->input->post('years'), $this->input->post('semester'));

		foreach($get_krs as $row) 
		{
			if($row->verification == FALSE)
			{
				if($this->validate_Khs_course($row->course_id))
					$this->db->delete('study_point', array('course_id' => $row->course_id, 'student_id' => $row->student_id));
				continue;
			}

			$point = array(
				'student_id' => $this->input->post('student_id'),
				'course_id' => $row->course_id,
				'lecturer_schedule_id' => 0,
				'absent' => 0,
				'task' => 0,
				'midterms' => 0,
				'final' => 0,
				'point' => 0,
				'grade' => 0,
				'quality' => 0,
				'years' => $this->input->post('years'),
				'semester' => $this->input->post('semester') 
			);

				if($this->validate_Khs_course($row->course_id))
				{
					$this->db->update('study_point', $point, array('course_id' => $row->course_id, 'student_id' => $row->student_id));
				} else {
					$this->db->insert('study_point', $point);
				}
		}

		$this->template->alert(
			' Data Studi Mahasiswa diganti.', 
			array('type' => 'success','icon' => 'check')
		);
	}

	/**
	 * Cek Data MK pada KHS
	 *
	 * @param Integer (course_id)
	 * @var string
	 **/
	private function validate_Khs_course($param = 0)
	{
		return $this->db->get_where(
			'study_point', 
			array(
				'course_id' => $param,
				'years' => $this->input->post('years'),
				'semester' => $this->input->post('semester')
			)
		)->row();
	}

	/**
	 * Cek Ketersediaan Mata Kuliah Pda study_point
	 *
	 * @return Bolean
	 **/
	public function validate_khs()
	{
		$query = $this->db->get_where('study_point', 
			array(
				'student_id' => $this->input->post('student_id'),
				'years' => $this->input->post('years'),
				'semester' => $this->input->post('semester')
			)
		);

		return $query->num_rows();
	}
}

/* End of file Verifikasi_krs.php */
/* Location: ./application/modules/Akademik/models/Verifikasi_krs.php */