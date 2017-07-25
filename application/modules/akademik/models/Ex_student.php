<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ex_student extends CI_Model 
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
	 * Set Import Data Mahasiswa From Excel
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
		        	if($key > 3)
		        	{
		        		if($value['B'] == FALSE OR $this->getNpm($value['B'])) 
		        			continue;

		        		$pecahkan_ttl = explode(',', $value['J']);

		        		//$date = new DateTime($pecahkan_ttl[1]);

		        		$concen = (strtolower($value['E'])=='pemasaran') ? 1 : 2;
		        		// Data Mahasiswa
						$mahasiswa = array(
							'npm' => $value['B'], 
							'name' => $value['C'],
							'gender' => strtolower($value['I']),
							'place_of_birts' => (is_array($pecahkan_ttl)) ? $pecahkan_ttl[0] : '',
							'birts' => '',
							'city_id' => 0,
							'province_id' => 0,
							'address' => $value['M'],
							'photo' => '',
							'religion' => strtolower($value['K']),
							'jobs' => $value['L'],
							'study' => $value['D'],
							'concentration_id' => (!$value['E']) ? 0 : $concen,
							'ladder' => ucfirst($value['F']),
							'class' => strtolower($value['G']),
							'register_year' => $value['H'],
							'status' => 'active'
						);
						$this->db->insert('students', $mahasiswa);

						$student_id = $this->db->insert_id();

						// Data Orang Tua
						$parents = array(
							'student_id' => $student_id,
							'father_name' => $value['T'],
							'mother_name' => $value['V'],
							'parent_address' => $value['X'],
							'city_id' => 0,
							'province_id' => 0,
							'phone_number' => $value['Y'],
							'father_jobs' => $value['U'],
							'mother_jobs' => $value['W'],
							'revenue' => $value['Z']
						);
						$this->db->insert('students_parent', $parents);

						// Data Sekolah Asal
						$school = array(
							'school_student_id' => $student_id,
							'school_name' => $value['N'],
							'school_study' => $value['O'],
							'school_address' => $value['P'],
							'school_city_id' => 0,
							'school_province_id' => 0,
							'certificate_number' => $value['S'],
							'graduation_year' => $value['Q'],
							'grade_value' => $value['R']
						);
						$this->db->insert('students_origin_school', $school);

						// Data Accounts
						$account = array(
							'account_student_id' => $student_id,
							'email' => '',
							'password' => password_hash($value['B'], PASSWORD_DEFAULT),
							'forgot_key' => 0
						);
						$this->db->insert('students_accounts', $account);

						// Data Semester Awal
						// Persiapan Studi semester awal
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

						//$this->db->insert_batch('study_point', $point);

		        	// End Baris ketiga
		        	}
		        // End Loop
		        }

		        unlink("./assets/excel/{$this->upload->file_name}");

				$output = array(
					'status' => 'OK', 
					'message' => ' Data Mahasiswa berhasil diimport.'
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

	/**
	 * Cek Validasi NPM Mahasiswa
	 *
	 * @param String = npm 
	 * @return Boolean
	 **/
	public function getNpm($param = 0)
	{
		$query = $this->db->query("SELECT npm FROM students WHERE npm = ?", $param);
		if($query->num_rows())
		{
			return TRUE;
		} else {
			return FALSE;
		}
	}


	/**
	 * Export Data Mahasiswa ke Excel
	 *
	 * @param Array (Mahasiswa Result)
	 * @return Attachment excel
	 **/
	public function get(Array $mahasiswa)
	{
		$objPHPExcel = new PHPExcel();

		$worksheet = $objPHPExcel->createSheet(0);

	    for ($cell='A'; $cell <= 'Z'; $cell++)
	    {
	        $worksheet->getStyle($cell.'1')->getFont()->setBold(true);
	        $worksheet->getStyle($cell.'2')->getFont()->setBold(true);
	        $worksheet->getStyle($cell.'3')->getFont()->setBold(true);
	    }

	    $worksheet->getStyle('A1:Z3')->applyFromArray(
	    	array(
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        ),
		        'borders' => array(
		            'allborders' => array(
		                'style' => PHPExcel_Style_Border::BORDER_THIN,
		                'color' => array('rgb' => '000000')
		            )
		        )
	    	)
	    );

	    $worksheet->getStyle('A1:M3')->applyFromArray(
	    	array(
		        'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'F2F2F2')
		        )
	    	)
	    );

	    $worksheet->getStyle('N1:S3')->applyFromArray(
	    	array(
		        'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'DDEBF7')
		        )
	    	)
	    );

	    $worksheet->getStyle('T1:Z3')->applyFromArray(
	    	array(
		        'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'FFF2CC')
		        )
	    	)
	    );

		// Header dokumen
		 $worksheet->setCellValue('A1', 'NO.')
		 		   ->mergeCells('A1:A3')
				   ->setCellValue('B1', 'IDENTITAS MAHASISWA')
				   ->mergeCells('B1:M2')
				   ->setCellValue('B3', 'NPM')
				   ->setCellValue('C3', 'NAMA LENGKAP')
				   ->setCellValue('D3', 'JURUSAN')
				   ->setCellValue('E3', 'KONSENTRASI')
				   ->setCellValue('F3', 'JENJANG')
				   ->setCellValue('G3', 'KELAS')
				   ->setCellValue('H3', 'TAHUN MASUK')
				   ->setCellValue('I3', 'JENIS KELAMIN')
				   ->setCellValue('J3', 'TEMPAT, TANGGAL LAHIR')
				   ->setCellValue('K3', 'AGAMA')
				   ->setCellValue('L3', 'PEKERJAAN')
				   ->setCellValue('M3', 'ALAMAT')
				   ->setCellValue('N1', 'INFORMASI ASAL SEKOLAH')
				   ->mergeCells('N1:S2')
				   ->setCellValue('N3', 'NAMA SEKOLAH')
				   ->setCellValue('O3', 'JURUSAN')
				   ->setCellValue('P3', 'ALAMAT SEKOLAH')
				   ->setCellValue('Q3', 'TAHUN LULUS')
				   ->setCellValue('R3', 'NILAI KELULUSAN')
				   ->setCellValue('S3', 'NOMOR IJAZAH')
				   ->setCellValue('T1', 'IDENTITAS ORANG TUA')
				   ->mergeCells('T1:Z1')
				   ->setCellValue('T2', 'AYAH')
				   ->mergeCells('T2:U2')
				   ->setCellValue('T3', 'NAMA')
				   ->setCellValue('U3', 'PEKERJAAN')
				   ->setCellValue('V2', 'IBU')
				   ->mergeCells('V2:W2')
				   ->setCellValue('V3', 'NAMA')
				   ->setCellValue('W3', 'PEKERJAAN')
				   ->setCellValue('X2', 'ALAMAT')
				   ->mergeCells('X2:X3')
				   ->setCellValue('Y2', 'NOMOR TELEPON')
				   ->mergeCells('Y2:Y3')
				   ->setCellValue('Z2', 'KISARAN PENDAPATAN')
				   ->mergeCells('Z2:Z3');

		$row_cell = 4;

		foreach ($mahasiswa as $key =>  $value) 
		{
			$date = new DateTime($value->birts);

			$worksheet->setCellValue('A'.$row_cell, ++$key)
					  ->setCellValue('B'.$row_cell, $value->npm)
					  ->setCellValue('C'.$row_cell, $value->name)
					  ->setCellValue('D'.$row_cell, $value->study)
					  ->setCellValue('E'.$row_cell, $value->concentration_name)
					  ->setCellValue('F'.$row_cell, $value->ladder)
					  ->setCellValue('G'.$row_cell, $value->class)
					  ->setCellValue('H'.$row_cell, $value->register_year)
					  ->setCellValue('I'.$row_cell, ucfirst($value->gender))
					  ->setCellValue('J'.$row_cell, ucfirst($value->place_of_birts) . ' , ' . $date->format('d/m/Y'))
					  ->setCellValue('K'.$row_cell, ucfirst($value->religion))
					  ->setCellValue('L'.$row_cell, $value->jobs)
					  ->setCellValue('M'.$row_cell, $value->address)
					  ->setCellValue('N'.$row_cell, $value->school_name)
					  ->setCellValue('O'.$row_cell, $value->school_study)
					  ->setCellValue('P'.$row_cell, $value->school_address)
					  ->setCellValue('Q'.$row_cell, $value->graduation_year)
					  ->setCellValue('R'.$row_cell, $value->grade_value)
					  ->setCellValue('S'.$row_cell, $value->certificate_number)
					  ->setCellValue('T'.$row_cell, $value->father_name)
					  ->setCellValue('U'.$row_cell, $value->father_jobs)
					  ->setCellValue('V'.$row_cell, $value->mother_name)
					  ->setCellValue('W'.$row_cell, $value->mother_jobs)
					  ->setCellValue('X'.$row_cell, $value->parent_address)
					  ->setCellValue('Y'.$row_cell, $value->phone_number)
					  ->setCellValue('Z'.$row_cell, $value->revenue);

			$row_cell++;
		}

		// Sheet Title
		$worksheet->setTitle("DATA MAHASISWA");

		$objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');\
        header('Content-Disposition: attachment; filename="DATA-MAHASISWA.xlsx"');
        $objWriter->save("php://output");
	}
}

/* End of file Ex_student.php */
/* Location: ./application/modules/Akademik/models/Ex_student.php */