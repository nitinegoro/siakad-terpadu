<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mschedule extends CI_Model 
{
	public $thn_akademik;

	public $semester;

	public $student;

	public function __construct()
	{
		parent::__construct();

		$this->thn_akademik = $this->db->get_where('tb_options', array('option_name' => 'default_thn_ajaran'))->row('option_value');

		$this->semester = $this->db->get_where('tb_options', array('option_name' => 'default_semester'))->row('option_value');

		$this->student = $this->session->userdata('account_id');
	}

	public function get()
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
	

}

/* End of file Mschedule.php */
/* Location: ./application/modules/mobile/models/Mschedule.php */