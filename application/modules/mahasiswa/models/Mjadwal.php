<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mjadwal extends CI_Model 
{
	public $thn_akademik;

	public $semester;

	public $student;

	public function __construct()
	{
		parent::__construct();

		$this->thn_akademik = $this->input->get('thn_akademik');

		$this->semester = $this->input->get('semester');

		$this->student = $this->session->userdata('account_id');
	}

	/**
	 * Simpan Jadwal
	 *
	 * @param Integer (schedule_id)
	 * @return string (Flashdata)
	 **/
	public function save($param = 0)
	{
		if($this->quata_check($param) == TRUE)
		{
			$this->db->update('study_point', 
				array('schedule_id' => $this->input->post('schedule')),
				array(
					'course_id' => $this->input->post('course'),
					'semester' => $this->semester,
					'years' => $this->thn_akademik,
					'student_id' => $this->student
				)
			);

			$this->template->alert(
				' Jadwal berhasil disimpan.', 
				array('type' => 'success','icon' => 'check')
			);	
		} else {
			$this->template->alert(
				' Maaf! Ruangan yang anda pilih penuh, silahkan pilih Jadwal dan Ruangan lainnya.', 
				array('type' => 'warning','icon' => 'warning')
			);
		}
	}

	/**
	 * Reset Jadwal Mata Kuliah
	 *
	 * @param Integer (Result_id)
	 * @return String
	 **/
	public function reset($param = 0)
	{
		$this->db->update('study_point', array('schedule_id' => 0), array('result_id' => $param));

		$this->template->alert(
			' Jadwal berhasil disimpan.', 
			array('type' => 'success','icon' => 'check')
		);	
	}

	public function get_mk()
	{
		$this->db->join('lecturer_schedule', 'study_point.schedule_id = lecturer_schedule.lecturer_schedule_id', 'left');

		$this->db->join('lecturer', 'lecturer_schedule.lecturer_id = lecturer.lecturer_id', 'left');

		$this->db->join('course', 'study_point.course_id = course.course_id', 'left');

		$this->db->join('classroom', 'lecturer_schedule.classroom_id = classroom.classroom_id', 'left');

		$this->db->where('study_point.years', $this->thn_akademik)
				 ->where('study_point.semester', $this->semester)
				 ->where('study_point.student_id', $this->student);

		return $this->db->get('study_point')->result();
	}

	/**
	 * Menampilkan Jadwal by Mata Kuliah
	 *
	 * @param Integer (course_id)
	 * @return String
	 **/
	public function get_schedule($param = 0)
	{
		$this->db->join('course', 'lecturer_schedule.course_id = course.course_id', 'left');

		$this->db->join('lecturer', 'lecturer_schedule.lecturer_id = lecturer.lecturer_id', 'left');

		$this->db->join('classroom', 'lecturer_schedule.classroom_id = classroom.classroom_id', 'left');

		$this->db->where('lecturer_schedule.course_id', $param );

		$this->db->where('lecturer_schedule.semester', $this->semester);

		$this->db->where('lecturer_schedule.years', $this->thn_akademik);

		return $this->db->get('lecturer_schedule')->result();
	}

	/**
	 * Get Schedule Detail
	 *
	 * @param Integer (schedule_id)
	 * @return Array
	 **/
	public function get($param = 0)
	{
		$this->db->join('classroom', 'lecturer_schedule.classroom_id = classroom.classroom_id', 'left');
		return $this->db->get_where('lecturer_schedule', array('lecturer_schedule.lecturer_schedule_id' => $param))->row();
	}
	
	/**
	 * Check Quata Mahasiswa pada jadwal
	 *
	 * @param Integer (schedule_id)
	 * @return Boolean
	 **/
	public function quata_check($param = 0)
	{
		$schedule = $this->get($param);

		$mahasiswa = $this->db->get_where('study_point', array('schedule_id' => $param))->num_rows();

		if($mahasiswa > $schedule->students_limit)
			return FALSE;
		else 
			return TRUE;
	}
}

/* End of file Mjadwal.php */
/* Location: ./application/modules/mahasiswa/models/Mjadwal.php */