<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Point extends Mobile_Mahasiswa 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('mpoint','point');
	}

	public function index()
	{
		$this->data = array(
			'title' => "Transkrip Nilai",
			'hasil' => $this->get_ipk()
		);

		$this->load->view('nilai/main-nilai', $this->data);
	}

    /**
     * Daftar Nilai (MK yang telah ditempuh Mahasiswa)
     *
     * @return Float (IPK)
     **/
	public function get_ipk()
	{
        $sks = 0;
        $bobot = 0;
        $ipk = 0;
        foreach($this->point->get() as $key => $value) :

        $sks += $value->sks;
        $bobot += $value->quality;

        $ipk = ($bobot / $sks);
        endforeach;

        return array(
        	'ipk' => $ipk, 
        	'bobot' => $bobot,
        	'sks' => $sks
        );
	}

	public function point_semester()
	{
		$this->data = array(
			'title' => "Hasil Studi"
		);

		$this->load->view('nilai/semester-nilai', $this->data);
	}

	public function khsdata()
	{
		$response = json_decode(file_get_contents("php://input"));

		if( @$response->semester != '' AND @$response->thnakademik != '')
		{
			$config = array(
				'student' => $this->session->userdata('account_id'),
				'semester' => $response->semester,
				'years' => $response->thnakademik,
			);

			$this->load->library('nilai', $config);

			$daftar_nilai = $this->point->semester($response->semester, $response->thnakademik);

			$sks = 0;
			foreach($daftar_nilai as $row)
				$sks += $row->sks;

			if( $daftar_nilai != FALSE ) 
			{
				$this->data = array(
					'status' => "success",
					'nilai' => $daftar_nilai,
					'ipk' => str_replace('.', ',', $this->nilai->getIp() ),
					'sks' => $sks
				);
			} else {
				$this->data = array(
					'status' => "failed"
				);
			}
		} else {
			$this->data = array(
				'status' => "zero request!"
			);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data));
	}
}

/* End of file Point.php */
/* Location: ./application/modules/mobile/controllers/Point.php */