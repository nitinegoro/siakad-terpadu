<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_model 
{
	public $thn_akademik;

	public $semester;

	public $account;

	public function __construct()
	{
		parent::__construct();

		$this->load->library('penilaian');

		$this->thn_akademik = $this->input->get('thn_akademik');

		$this->semester = $this->input->get('semester');

		$this->account = $this->session->userdata('user_id');
	}
	
	public function get($thn_akademik = '', $semester = '')
	{
		$this->db->select('lecturer_schedule.*, classroom.class_name, course.course_code, course.course_name, course.course_name_english, course.sks, lecturer.lecturer_code, lecturer.name');

		$this->db->join('course', 'lecturer_schedule.course_id = course.course_id', 'left');

		$this->db->join('lecturer', 'lecturer_schedule.lecturer_id = lecturer.lecturer_id', 'left');

		$this->db->join('classroom', 'lecturer_schedule.classroom_id = classroom.classroom_id', 'left');

		$this->db->where('lecturer_schedule.semester', $this->semester)
				 ->where('lecturer_schedule.years', $this->thn_akademik)
				 ->where('lecturer_schedule.lecturer_id', $this->account );

		$this->db->order_by('course.course_name', 'asc');

		return $this->db->get('lecturer_schedule')->result();
	}

	public function row($param = 0)
	{
		$this->db->select('lecturer_schedule.*, classroom.class_name, course.course_code, course.course_name, course.course_name_english, course.sks, lecturer.lecturer_code, lecturer.name');

		$this->db->join('course', 'lecturer_schedule.course_id = course.course_id', 'left');

		$this->db->join('lecturer', 'lecturer_schedule.lecturer_id = lecturer.lecturer_id', 'left');

		$this->db->join('classroom', 'lecturer_schedule.classroom_id = classroom.classroom_id', 'left');

		$this->db->where('lecturer_schedule.lecturer_schedule_id', $param );

		return $this->db->get('lecturer_schedule')->row();
	}

	public function get_nilai_mhs($param = 0)
	{
		$query = $this->db->query(
			"SELECT study_point.*, students.npm, students.name, course.sks FROM study_point RIGHT JOIN students ON study_point.student_id = students.student_id 
			INNER JOIN course ON study_point.course_id = course.course_id
			WHERE study_point.schedule_id = ?",
			array($param)
		);

		return $query->result();
	}


	/**
	 * Handle Update Nilai
	 *
	 * @param Integer (student_id)
	 * @return string
	 **/
	public function entry_nilai()
	{
		if(is_array($this->input->post('point')))
		{
			foreach ($this->input->post('point') as $key => $value) 
			{
				$nilai = array(
					'absent' => $value['absent'],
					'task' => $value['task'],
					'midterms' =>$value['midterms'],
					'final' => $value['final'],
					'sks' => $value['sks']
				);
				$this->penilaian->initialize($nilai);

				$this->db->update('study_point', 
					array(
						'absent' => $value['absent'],
						'task' => $value['task'],
						'midterms' =>$value['midterms'],
						'final' => $value['final'],
						'point' => $this->penilaian->getPoint(),
						'grade' => $this->penilaian->getGrade(),
						'quality' => $this->penilaian->getQuality()
					),
					array(
						'result_id' => $key,
					)
				);
			}

			$this->template->alert(
				' Perubahan nilai disimpan.', 
				array('type' => 'success','icon' => 'check')
			);

		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}
}

/* End of file Schedule.php */
/* Location: ./application/modules/Dosen/models/Schedule.php */