<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ex_course extends CI_Model 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('Excel/PHPExcel'));
	}

	/**
	 * Export Data Mata Kuliah ke Excel
	 *
	 * @param Array (Mata Kuliah Result)
	 * @return Attachment excel
	 **/
	public function get()
	{
		$objPHPExcel = new PHPExcel();

		$worksheet = $objPHPExcel->createSheet(0);

	    for ($cell='A'; $cell <= 'G'; $cell++)
	    {
	        $worksheet->getStyle($cell.'1')->getFont()->setBold(true);
	    }

	    $worksheet->getStyle('A1:G1')->applyFromArray(
	    	array(
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        ),
		        'borders' => array(
		            'allborders' => array(
		                'style' => PHPExcel_Style_Border::BORDER_THIN,
		                'color' => array('rgb' => '000000')
		            )
		        ),
		        'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'F2F2F2')
		        )
	    	)
	    );

		// Header dokumen
		 $worksheet->setCellValue('A1', 'NO.')
		 		   ->setCellValue('B1', 'Kode MK')
		 		   ->setCellValue('C1', 'Mata Kuliah')
		 		   ->setCellValue('D1', 'Mata Kuliah (Asing)')
		 		   ->setCellValue('E1', 'Jumlah SKS')
		 		   ->setCellValue('F1', 'Semester')
		 		   ->setCellValue('G1', 'Konsentrasi');

		$this->db->join('concentration', 'course.concentration_id = concentration.concentration_id', 'left');
		$row_cell = 2;
		foreach($this->db->get('course')->result() as $key => $value)
		{
			 $worksheet->setCellValue('A'.$row_cell, ++$key)
			 		   ->setCellValue('B'.$row_cell, $value->course_code)
			 		   ->setCellValue('C'.$row_cell, $value->course_name)
			 		   ->setCellValue('D'.$row_cell, $value->course_name_english)
			 		   ->setCellValue('E'.$row_cell, $value->sks)
			 		   ->setCellValue('F'.$row_cell, ucfirst($value->semester))
			 		   ->setCellValue('G'.$row_cell, $value->concentration_name);
			$row_cell++;
		}

		// Sheet Title
		$worksheet->setTitle("DATA MATA KULIAH");

		$objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');\
        header('Content-Disposition: attachment; filename="DATA-MATA-KULIAH.xlsx"');
        $objWriter->save("php://output");
	}
}

/* End of file Ex_course.php */
/* Location: ./application/modules/Akademik/models/Ex_course.php */