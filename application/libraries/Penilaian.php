<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian
{
	protected $ci;

	public $absent;

	public $midterms;

	public $task;

	public $final;

	public $sks;

/*	public function __construct($params)
	{
        $this->ci =& get_instance();

        if(is_array($params))
        {
        	$this->initialize($params);
        } else {
        	show_error('Silahkan dinisiasikan properti absent, midterms, task, point.');
        }
	}*/

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
	 * Update nilai akhir
	 *
	 * @param Integer (absen, midterms, task, point)
	 * @return Affected Rows
	 **/
	public function getPoint()
	{
		$point = (($this->absent * 15) / 100 ) + (($this->midterms * 30) / 100) + (($this->task * 10) / 100) + (($this->final * 45) / 100);

		return $point;
	}


	/**
	 * Ubah Nilai Akhir menjadi Grade
	 *
	 * @param Integer (Nilai Akhir)
	 * @access public
	 * @return string
	 **/
	public function getGrade()
	{
		if($this->getPoint() >= 80)
			return 'A';
		elseif ($this->getPoint() >= 70)
			return 'B';
		elseif ($this->getPoint() >= 60)
			return 'C';
		elseif ($this->getPoint() >= 40)
			return 'D';
		else
			return 'E';
		
	}

	/**
	 * Ubah Nilai Akhir menjadi Bobot Nilai
	 *
	 * @param Integer (Jumlah SKS)
	 * @param String (Grade)
	 * @access public
	 * @return Integer
	 **/
	public function getQuality()
	{
		if($this->getGrade() == 'A')
			return ($this->sks * 4);
		elseif ($this->getGrade() == 'B')
			return ($this->sks * 3);
		elseif ($this->getGrade() == 'C')
			return ($this->sks * 2);
		elseif ($this->getGrade() == 'D')
			return ($this->sks * 1);
		else
			return ($this->sks * 0);
	}

}

/* End of file Penilaian.php */
/* Location: ./application/libraries/Penilaian.php */
