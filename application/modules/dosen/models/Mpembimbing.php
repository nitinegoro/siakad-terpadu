<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpembimbing extends CI_Model 
{
	public $userID;

	public $student;

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

	/**
	 * Get Data Mhs
	 *
	 * @return Row
	 **/
	public function getmhs($param = 0, $fieldset= 'student_id')
	{
		$this->db->join('concentration', 'students.concentration_id = concentration.concentration_id', 'left');

		if($fieldset == 'student_id') 
		{
			$this->db->join('students_parent', 'students.student_id = students_parent.student_id', 'left');

			$this->db->join('students_origin_school', 'students.student_id = students_origin_school.school_student_id', 'left');

			$this->db->where('students.student_id', $param);
		} else {
			$this->db->where('students.npm', $param);
		}

		$this->db->where('students.dosen_pa', $this->userID);

		return $this->db->get('students')->row();
	}

	public function getkrs($student = '', $thn_ajaran = '', $semester = '')
	{
		$query = $this->db->query("SELECT students.*, plain_studies.*, course.* 
			FROM plain_studies JOIN course ON plain_studies.course_id = course.course_id 
			JOIN students ON plain_studies.student_id = students.student_id 
			WHERE students.npm = ? AND plain_studies.years = ? AND plain_studies.semester = ?", 
			array($student, $thn_ajaran, $semester)
		);
		return $query->result();
	}

	public function getPlain($student = '', $thn_ajaran = '', $semester = '')
	{
		$query = $this->db->query("SELECT students.*, plain_studies.*, course.* 
			FROM plain_studies JOIN course ON plain_studies.course_id = course.course_id 
			JOIN students ON plain_studies.student_id = students.student_id 
			WHERE students.npm = ? AND plain_studies.years = ? AND plain_studies.semester = ?", 
			array($student, $thn_ajaran, $semester)
		);
		return $query->result();
	}

	/**
	 * Get Set Verifikasi KRS
	 *
	 * @param String (Action POST)
	 * @return string
	 **/
	public function setKrs($param = 0)
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
			case 'simpan':
				$this->set_khs($param);
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
			$get_contents = $this->db->get_where('plain_studies_callback', array('student_id' => $this->student))->row();

			foreach ($this->input->post('plain') as $key => $value) 
			{
				$this->db->update('plain_studies',  
					array('verification' => 1),
					array('plain_id' => $value, 'student_id' => $this->student)
				);
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
	private function set_khs($param)
	{
		$get_krs = $this->getPlain($this->input->post('npm'), $this->input->post('years'), $this->input->post('semester'));

		foreach($get_krs as $row) 
		{
			if($row->verification == FALSE)
			{
				if($this->validate_Khs_course($row->course_id))
					$this->db->delete('study_point', array('course_id' => $row->course_id, 'student_id' => $row->student_id));
				continue;
			}

			$point = array(
				'student_id' => $param,
				'course_id' => $row->course_id,
				'schedule_id' => 0,
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
			' Data Mata Kuliah dipindahkan pada Studi Mahasiswa.', 
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

/* End of file Mpembimbing.php */
/* Location: ./application/modules/dosen/models/Mpembimbing.php */