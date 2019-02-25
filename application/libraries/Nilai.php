<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistem Penilaian Mahasiswa STIE Pertiba
 *
 * @package Core Penilaian
 * @see https://github.com/nitinegoro/siakad-terpadu/tree/master/application/libraries
 * @since 2017 (V1.0.1)
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 **/

class Nilai
{
	/**
	 * Mahasiswa Key 
	 *
	 * @var Integer
	 **/
	private $student = 0;

	/**
	 * Semester
	 *
	 * @var string
	 **/
	private $semester = 'ganjil';

	/**
	 * Tahun Ajaran
	 *
	 * @var string
	 **/
	private $years;

	protected $ci;

	public function __construct($params)
	{
        $this->ci =& get_instance();

        $this->ci->load->helper('akademik');

        if(is_array($params))
        {
        	$this->initialize($params);
        } else {
        	show_error('Silahkan dinisiasikan properti mahasiswa, semester, dan tahun ajaran.');
        }
	}

	public function initialize($params)
	{
		foreach ($params as $key => $val)
		{
			if (property_exists($this, $key))
			{
				$this->$key = $val;
			}
		}

		return $this;
	}

	/**
	 * Get Query
	 *
	 * @access private
	 * @return Query
	 **/
	private function getQuery()
	{
		$query = $this->ci->db->query(
			"SELECT student_id, course_id, years,semester, absent, task, midterms, final, grade, point, quality FROM study_point
			WHERE student_id = ? AND years = ? AND semester = ?",
		array($this->student, $this->years, $this->semester));

		return $query;
	}

	/**
	 * Update nilai akhir
	 *
	 * @return Affected Rows
	 **/
	public function setFinal()
	{
		$final = array();

		foreach($this->getQuery()->result() as $row)
		{
			$final = ($row->absent * 15) / 100 + ($row->midterms * 30) / 100 + ($row->task * 10) / 100 + ($row->final * 45) / 100;

			$sks = $this->ci->db->query("SELECT sks FROM course WHERE course_id = ?", $row->course_id)->row('sks');

			$this->ci->db->update('study_point', 
				array('point' => $final, 'grade' => $this->setGrade($final), 'quality' => $this->setQuality($sks, $final) ), 
				array('course_id' => $row->course_id, 'student_id' => $this->student, 'years' => $this->years, 'semester' => $this->semester));
		}

		return $final;
	}


	/**
	 * Ubah Nilai Akhir menjadi Grade
	 *
	 * @param Integer (Nilai Akhir)
	 * @access private
	 * @return string
	 **/
	private function setGrade($final = 0)
	{
		if($final >= 80)
			return 'A';
		elseif ($final >= 70)
			return 'B';
		elseif ($final >= 60)
			return 'C';
		elseif ($final >= 40)
			return 'D';
		else
			return 'E';
		
	}

	/**
	 * Ubah Nilai Akhir menjadi Bobot Nilai
	 *
	 * @param Integer (Jumlah SKS)
	 * @param String (Grade)
	 * @access private
	 * @return Integer
	 **/
	private function setQuality($sks = 0, $final = 0)
	{
		if($this->setGrade($final) == 'A')
			return ($sks * 4);
		elseif ($this->setGrade($final) == 'B')
			return ($sks * 3);
		elseif ($this->setGrade($final) == 'C')
			return ($sks * 2);
		elseif ($this->setGrade($final) == 'D')
			return ($sks * 1);
		else
			return ($sks * 0);
	}

	/**
	 * Sum SKS Query
	 *
	 * @access private
	 * @return Query
	 **/
	private function _sum($field = 'sks')
	{
		$query = $this->ci->db->query(
			"SELECT SUM({$field}) as {$field} FROM course JOIN study_point ON course.course_id = study_point.course_id
			WHERE study_point.student_id = ? AND study_point.years = ? AND study_point.semester = ?",
		array($this->student, $this->years, $this->semester));

		return $query;
	}

	/**
	 * Mendapatkan Jumlah SKS
	 *
	 * @access public
	 * @return Integer (Jumlah SKS)
	 **/
	public function getSks()
	{
		$sks = 0;

		foreach ($this->_sum('sks')->result() as $row)  
			$sks = $row->sks;

		return $sks;
	}

	/**
	 * Mendapatkan Jumlah Bobot Nilai
	 *
	 * @access public
	 * @return Integer (Sum Bobot nilai)
	 **/
	public function getQuality()
	{
		$quality = 0;

		foreach ($this->_sum('quality')->result() as $row) 
			$quality = $row->quality;

		return $quality;
	}

	/**
	 * Mendapatkan Jumlah jumlah IPK
	 *
	 * @access public
	 * @return Integer (IPK)
	 **/
	public function getIp()
	{
		if($this->getQuality() != FALSE OR $this->getSks() != FALSE)
		{
			$ipk = $this->getQuality() / $this->getSks();

			$pembulatan = round($ipk, ceil($ipk));
		} else {
			$pembulatan = 0.0000;
		}

		return substr($pembulatan, 0, 5);
	}

	private function set_years()
	{
		$year = explode('/', $this->years);

		$generate = ($year[0] -1) . '/' . ($year[1]-1);

		if($this->semester == 'ganjil')
		{
			return $generate;
		} else {
			return $this->years;
		}
	}


	/**
	 * Mendapatkan Jumlah SKS Semester akan datang
	 *
	 * @access public
	 * @return Integer (Sum SKS)
	 **/
	public function credit_sks()
	{
		if($this->getIp() >= 3.00)
			return 24;
		elseif($this->getIp() >= 2.50)
			return 21;
		elseif($this->getIp() >= 2.00)
			return 18;
		elseif($this->getIp() >= 1.50)
			return 15;
		else 
			return 12;
	}
}

/* End of file Nilai.php */
/* Location: ./application/libraries/Nilai.php */
