<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ex_point extends CI_Model 
{
	protected $ci;

	public function __construct()
	{
		parent::__construct();
		$this->ci = $ci =& get_instance();
		// load library
		$this->load->library(array('Excel/PHPExcel', 'upload'));
		$this->load->model('moption', 'option');
		ini_set('max_execution_time', 3000); 
	}


	/**
	 * Set Import Data Nilai From Excel
	 *
	 * @package  PHPExcel
	 * @see Documentation (https://github.com/PHPOffice/PHPExcel/wiki)
	 * @return string
	 **/
	public function set()
	{
		$config['upload_path'] = 'assets/excel';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']  = '5120';
		
		$this->upload->initialize($config);
		
		if ( ! $this->upload->do_upload('file_excel')) 
		{
			$output = array('status' => 'ERROR', 'message' => $this->upload->display_errors('<span>','</span>'));
		} else {

			$file_excel = "./assets/excel/{$this->upload->file_name}";

			// Identifikasi File Excel Reader
			try {

				$excelReader = new PHPExcel_Reader_Excel2007();

            	$loadExcel = $excelReader->load($file_excel);	

            	$sheet = $loadExcel->getActiveSheet()->toArray(null, true, true ,true);
		        // Loops Excel data reader

		        foreach ($sheet as $key => $value) 
		        {
		        	// Mulai Dari Baris ketiga
		        	if($key > 2)
		        	{
		        		if($this->cek_point($value['B'], $this->get_course_id($value['G']), $value['E'], $value['F']))
		        			continue;

		        		if($this->get_student_id($value['B']) == FALSE)
		        			continue;

		        		if($this->get_course_id($value['G']) == FALSE)
		        			continue;

						if(is_numeric($value['E']))
						{
							$semester = (($value['E'] % 2) == 0 ) ? 'genap' : 'ganjil';
						} else {
							$potong = substr($value['E'], 4, 8);
							$semester = (($potong % 2) == 0 ) ? 'genap' : 'ganjil';
						}
		        		$data_nilai = array(
		        			'student_id' => $this->get_student_id($value['B']), 
		        			'course_id' => $this->get_course_id($value['G']),
		        			'lecturer_schedule_id' => 0,
		        			'absent' => $value['J'],
		        			'task' => $value['K'],
		        			'midterms' => $value['L'],
		        			'final' => $value['M'],
		        			'point' => $value['N'],
		        			'grade' => (!$value['O']) ? 'E' : $value['O'],
		        			'quality' => $value['P'],
		        			'years' => $value['F'],
		        			'semester' => strtolower($semester)
		        		);

		        		$this->db->insert('study_point', $data_nilai);

		        	// End Baris ketiga
		        	}
		        // End Loop
		        }

		        unlink("./assets/excel/{$this->upload->file_name}");

				$output = array(
					'status' => 'OK', 
					'message' => ' Data Nilai berhasil diimport.'
				);
			} catch (Exception $e) {
				$output = array(
					'status' => 'ERROR', 
					'message' => 'Error loading file "'.pathinfo($file_excel,PATHINFO_BASENAME).'": '.$e->getMessage()
				);
			}
		}

		echo json_encode($output);
	}
	

	/**
	 * Cek Data Point
	 *
	 * @param String (NPM)
	 * @param Integer (course_id)
	 * @param String (Semester)
	 * @param String (years)
	 * @access private
	 * @return Boolean
	 **/
	private function cek_point($npm = '', $course = '', $semester = '', $years = '')
	{
		$student = $this->db->get_where('students', array('npm' => $npm))->row('student_id');

		$query = $this->db->get_where(
			'study_point', 
			array(
				'student_id' => $student, 
				'course_id' => $course,
				'semester' => $semester,
				'years' => $years
			)
		);

		if($query->num_rows())
			return TRUE;
		else 
			return FALSE;
	}

	/**
	 * Ambil student_id berdasarkan NPM
	 *
	 * @param String (NPM)
	 * @return Integer
	 **/
	private function get_student_id($param = '')
	{
		return $this->db->get_where('students', array('npm' => $param))->row('student_id');
	}

	/**
	 * Ambil course_id berdasarkan Kode MK
	 *
	 * @param String (Kode MK)
	 * @return Integer
	 **/
	private function get_course_id($param = '')
	{
		return $this->db->get_where('course', array('course_code' => $param))->row('course_id');
	}

}

/* End of file Ex_point.php */
/* Location: ./application/modules/Akademik/models/Ex_point.php */