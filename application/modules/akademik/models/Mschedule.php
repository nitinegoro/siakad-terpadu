<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Jadwal Kuliah Crud Model
 *
 * @package Bag. Akademik
 * @category Akademik or Super Admin
 * @see https://github.com/nitinegoro/siakad-terpadu
 * @author Vicky Nitinegoro
 **/

class Mschedule extends CI_Model 
{
	public $data;

	public $session_start;

	public $session_end;

	public $semester;

	public $thn_akademik;

	public function __construct()
	{
		parent::__construct();

		$this->session_start = $this->input->post('session_start')[0].":".$this->input->post('session_start')[1]." ".$this->input->post('session_start')[2];

		$this->session_end = $this->input->post('session_end')[0].":".$this->input->post('session_end')[1]." ".$this->input->post('session_end')[2];

		$this->semester = $this->input->get('semester');

		$this->thn_akademik = $this->input->get('thn_akademik');

		$this->data = array(
			'course_id' => $this->input->post('mk'),
			'lecturer_id' => $this->input->post('lecturer'),
			'classroom_id' => $this->input->post('classroom'),
			'day' => $this->input->post('day'),
			'session_start' => $this->session_start,
			'session_end' => $this->session_end,
			'years' => $this->input->post('thn_akademik'),
			'semester' => $this->input->post('semester') 
		);
	}

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->select('lecturer_schedule.*, classroom.class_name, course.course_code, course.course_name, course.course_name_english, course.sks, lecturer.lecturer_code, lecturer.name');

		$this->db->join('course', 'lecturer_schedule.course_id = course.course_id', 'left');

		$this->db->join('lecturer', 'lecturer_schedule.lecturer_id = lecturer.lecturer_id', 'left');

		$this->db->join('classroom', 'lecturer_schedule.classroom_id = classroom.classroom_id', 'left');

		$this->db->where('lecturer_schedule.semester', $this->semester)
				 ->where('lecturer_schedule.years', $this->thn_akademik);

		$this->db->order_by('course.course_name', 'asc');

		if($type == 'result')
		{
			return $this->db->get('lecturer_schedule', $limit, $offset)->result();
		} else {
			return $this->db->get('lecturer_schedule')->num_rows();
		}
	}

	public function get($param = 0)
	{
		$this->db->select('lecturer_schedule.*, classroom.class_name, course.course_code, course.course_name, course.course_name_english, course.sks, lecturer.lecturer_code, lecturer.name');

		$this->db->join('course', 'lecturer_schedule.course_id = course.course_id', 'left');

		$this->db->join('lecturer', 'lecturer_schedule.lecturer_id = lecturer.lecturer_id', 'left');

		$this->db->join('classroom', 'lecturer_schedule.classroom_id = classroom.classroom_id', 'left');

		$this->db->where('lecturer_schedule.lecturer_schedule_id', $param);

		return $this->db->get('lecturer_schedule')->row();
	}

	public function create()
	{
		if($this->valid_schedule() != TRUE AND $this->valid_time() != TRUE) 
		{
			$this->db->insert('lecturer_schedule', $this->data);

			$this->template->alert(
				' Jadwal kuliah ditambahkan.', 
				array('type' => 'success','icon' => 'check')
			);
		}   else {
			$this->template->alert(
				' Maaf! Waktu dan Ruangan Bentrok atau sudah tersedia.', 
				array('type' => 'warning','icon' => 'times')
			);
		}	
	}

	public function update($param = 0)
	{
		if($this->valid_time($param) != TRUE) {
			$this->db->update('lecturer_schedule', $this->data, array('lecturer_schedule_id' => $param));

			$this->template->alert(
				' Perubahan disimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Maaf! Waktu dan Ruangan Bentrok atau sudah tersedia.', 
				array('type' => 'warning','icon' => 'times')
			);
		}	
	}

	public function delete($param = 0)
	{
		$this->db->delete('lecturer_schedule', array('lecturer_schedule_id' => $param));

		if($this->db->affected_rows()) 
		{
			$this->template->alert(
				' Jadwal terhapus.', 
				array('type' => 'success','icon' => 'check')
			);
		}   else {
			$this->template->alert(
				' Gagal! saat menghapus data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}	
	}

	public function multiple_delete()
	{
		if(is_array($this->input->post('schedules')))
		{
			foreach ($this->input->post('schedules') as $key => $value) 
				$this->db->delete('lecturer_schedule', array('lecturer_schedule_id' => $value));

			$this->template->alert(
				' Jadwal terhapus.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Tidak ada data yang dipilih.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	/**
	 * Check Jadwal Sebelum Simpan
	 *
	 * @param Array POST data
	 * @return Integer (Boleaan)
	 **/
	public function valid_schedule()
	{
		return $this->db->get_where('lecturer_schedule', $this->data)->num_rows();
	}

	/**
	 * Check Jadwal Sebelum Simpan
	 * Check dengan waktu
	 *
	 * @param Integer (leturer_schedule_id)
	 * @param Array POST data
	 * @return Integer (Boleaan)
	 **/
	public function valid_time($param = 0)
	{
		if($param == FALSE) 
		{
			return $this->db->get_where('lecturer_schedule', 
				array(
					'day' => $this->input->post('day'),
					'session_start' => $this->session_start,
					'session_end' => $this->session_end,
					'classroom_id' => $this->input->post('classroom'),
					'years' => $this->input->post('thn_akademik'),
					'semester' => $this->input->post('semester') 
				)
			)->num_rows();
		} else {
			return $this->db->get_where('lecturer_schedule', 
				array(
					'day' => $this->input->post('day'),
					'session_start' => $this->session_start,
					'session_end' => $this->session_end,
					'classroom_id' => $this->input->post('classroom'),
					'years' => $this->input->post('thn_akademik'),
					'semester' => $this->input->post('semester'),
					'lecturer_schedule_id != ' => $param
				)
			)->num_rows();
		}
	}

}

/* End of file Mschedule.php */
/* Location: ./application/modules/akademik/models/Mschedule.php */