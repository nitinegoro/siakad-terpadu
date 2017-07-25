<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mstudent extends CI_Model 
{
	protected $ci;

	public function __construct()
	{
		parent::__construct();
		
		$this->ci = $ci =& get_instance();

		$this->load->model('moption', 'option');
	}


	public function getall($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->join('concentration', 'students.concentration_id = concentration.concentration_id', 'left');

		$this->db->join('students_parent', 'students.student_id = students_parent.student_id', 'left');

		$this->db->join('students_origin_school', 'students.student_id = students_origin_school.school_student_id', 'left');

		if($this->input->get('class') != '')
			$this->db->where('students.class', $this->input->get('class'));

		if($this->input->get('gender') != '')
			$this->db->where('students.gender', $this->input->get('gender'));

		if($this->input->get('registration') != '')
			$this->db->where('students.register_year', $this->input->get('registration'));

		if($this->input->get('query') != '')
			$this->db->like('students.npm', $this->input->get('query'))
					 ->or_like('students.name', $this->input->get('query'))
					 ->or_like('students.address', $this->input->get('query'));

		$this->db->order_by('students.student_id', 'desc');

		if($type == 'result')
		{
			return $this->db->get('students', $limit, $offset)->result();
		} else {
			return $this->db->get('students')->num_rows();
		}
	}

	/**
	 * Get All data
	 *
	 * @return Row
	 **/
	public function get($param = 0)
	{
		$this->db->join('concentration', 'students.concentration_id = concentration.concentration_id', 'left');

		$this->db->join('students_parent', 'students.student_id = students_parent.student_id', 'left');

		$this->db->join('students_origin_school', 'students.student_id = students_origin_school.school_student_id', 'left');

		$this->db->where('students.student_id', $param);

		return $this->db->get('students')->row();
	}

	/**
	 * Handle reate Mahasiswwa Model
	 *
	 * @var string
	 **/
	public function create()
	{
		$mahasiswa = array(
			'npm' => $this->input->post('npm'), 
			'name' => $this->input->post('name'),
			'gender' => $this->input->post('gender'),
			'place_of_birts' => $this->input->post('place_of_birts'),
			'birts' => $this->input->post('birts'),
			'city_id' => 0,
			'province_id' => 0,
			'address' => $this->input->post('address'),
			'photo' => '',
			'religion' => $this->input->post('religion'),
			'jobs' => $this->input->post('jobs'),
			'study' => $this->input->post('study'),
			'concentration_id' => $this->input->post('concentration'),
			'ladder' => $this->input->post('ladder'),
			'class' => $this->input->post('class'),
			'register_year' => $this->input->post('register_year'),
			'status' => 'active'
		);

		$this->db->insert('students', $mahasiswa);

		$student_id = $this->db->insert_id();

		$parents = array(
			'student_id' => $student_id,
			'father_name' => $this->input->post('father_name'),
			'mother_name' => $this->input->post('mother_name'),
			'parent_address' => $this->input->post('parent_address'),
			'city_id' => 0,
			'province_id' => 0,
			'phone_number' => $this->input->post('phone_number'),
			'father_jobs' => $this->input->post('father_jobs'),
			'mother_jobs' => $this->input->post('mother_jobs'),
			'revenue' => $this->input->post('revenue')
		);

		$this->db->insert('students_parent', $parents);

		$school = array(
			'school_student_id' => $student_id,
			'school_name' => $this->input->post('school_name'),
			'school_study' => $this->input->post('school_study'),
			'school_address' => $this->input->post('school_address'),
			'school_city_id' => 0,
			'school_province_id' => 0,
			'certificate_number' => $this->input->post('certificate_number'),
			'graduation_year' => $this->input->post('graduation_year'),
			'grade_value' => $this->input->post('grade_value')
		);

		$this->db->insert('students_origin_school', $school);

		$account = array(
			'account_student_id' => $student_id,
			'email' => '',
			'password' => password_hash($this->input->post('birts'), PASSWORD_DEFAULT),
			'forgot_key' => 0
		);
		$this->db->insert('students_accounts', $account);

		$point = array();
		foreach($this->course_one() as $row) 
		{
			$point[] = array(
				'student_id' => $student_id,
				'course_id' => $row->course_id,
				'lecture_id' => 0,
				'absent' => 0,
				'task' => 0,
				'midterms' => 0,
				'final' => 0,
				'point' => 0,
				'grade' => 0,
				'quality' => 0,
				'years' => $this->ci->option->get('default_thn_ajaran'),
				'semester' => 'ganjil'
			);
		}

		$this->db->insert_batch('study_point', $point);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data Mahasiswwa ditambahkan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	/**
	 * Ambil Mata Kuliah semester I
	 * Untuk dimasukkan ke ruang nilai pertama Mahasiswa
	 *
	 * @return Result MM
	 **/
	public function course_one()
	{
		$this->db->where_in('course_id', array(1, 2, 3, 4, 5, 6, 7, 8));
		return $this->db->get('course')->result();
	}

	public function update($param = 0)
	{
		$mahasiswa = array(
			'npm' => $this->input->post('npm'), 
			'name' => $this->input->post('name'),
			'gender' => $this->input->post('gender'),
			'place_of_birts' => $this->input->post('place_of_birts'),
			'birts' => $this->input->post('birts'),
			'address' => $this->input->post('address'),
			'photo' => '',
			'religion' => $this->input->post('religion'),
			'jobs' => $this->input->post('jobs'),
			'study' => $this->input->post('study'),
			'concentration_id' => $this->input->post('concentration'),
			'ladder' => $this->input->post('ladder'),
			'class' => $this->input->post('class'),
			'register_year' => $this->input->post('register_year'),
			'status' => $this->input->post('status')
		);

		$this->db->update('students', $mahasiswa, array('student_id' => $param));

		$parents = array(
			'father_name' => $this->input->post('father_name'),
			'mother_name' => $this->input->post('mother_name'),
			'parent_address' => $this->input->post('parent_address'),
			'phone_number' => $this->input->post('phone_number'),
			'father_jobs' => $this->input->post('father_jobs'),
			'mother_jobs' => $this->input->post('mother_jobs'),
			'revenue' => $this->input->post('revenue')
		);

		$this->db->update('students_parent', $parents, array('student_id' => $param));

		$school = array(
			'school_name' => $this->input->post('school_name'),
			'school_study' => $this->input->post('school_study'),
			'school_address' => $this->input->post('school_address'),
			'certificate_number' => $this->input->post('certificate_number'),
			'graduation_year' => $this->input->post('graduation_year'),
			'grade_value' => $this->input->post('grade_value')
		);

		$this->db->update('students_origin_school', $school, array('school_student_id' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data Mahasiswwa ditambahkan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	/**
	 * Delete All Data Mahasiswa
	 *
	 * @var string
	 **/
	public function delete($param = 0)
	{
		$this->db->delete('students', array('student_id' => $param));
		$this->db->delete('students_origin_school', array('school_student_id' => $param));
		$this->db->delete('students_parent', array('student_id' => $param));
		$this->db->delete('students_accounts', array('account_student_id' => $param));

		foreach($this->db->get_where('plain_studies', array('student_id' => $param))->result() as $row)
			$this->db->delete('callback_contents', array('plain_id' => $row->plain_id));

		$this->db->delete('study_point', array('student_id' => $param));
		$this->db->delete('plain_studies', array('student_id' => $param));
		$this->db->delete('plain_studies_callback', array('student_id' => $param));	
	}

	/**
	 * Multiple Delete Data Mahasiswa
	 *
	 * @return string
	 **/
	public function multiple_delete()
	{
		if(is_array($this->input->post('mhs')))
		{
			foreach ($this->input->post('mhs') as $key => $value) 
				$this->delete($value);

			$this->template->alert(
				' Data Mahasiswwa dihapus.', 
				array('type' => 'success','icon' => 'check')
			);	
		} 
	}
}

/* End of file Mstudent.php */
/* Location: ./application/modules/Akademik/models/Mstudent.php */