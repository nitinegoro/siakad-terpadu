<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plain extends Mobile_Mahasiswa 
{
	public $data;

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('mkrs', 'krs');
	}

	public function index()
	{
		$this->data = array(
			'title' => "Kartu Rencana Studi"
		);
		$this->load->view('krs/main-krs', $this->data);
	}

	public function create()
	{
		$this->data = array(
			'title' => "Susun Kartu Rencana Studi"
		);
		$this->load->view('krs/susun-krs', $this->data);
	}

	public function setkrs()
	{
		$response = json_decode(file_get_contents("php://input"));

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function getmk()
	{
		$this->data = array(
			'status' => 'success',
			'results' => $this->krs->getMK()
		);

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data));
	}

	public function getplain()
	{
		$response = json_decode(file_get_contents("php://input"));

		if( @$response->semester != '' AND @$response->thnakademik != '')
		{
			$result = $this->krs->getPlain($response->thnakademik, $response->semester );

			if( $result != FALSE)
			{
				$totalSks = 0;
				foreach ($result as $row) 
					$totalSks += $row->sks;
				
				$this->data = array(
					'status' => "success",
					'results' => $result,
					'totalSks' => $totalSks 
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

/* End of file Plain.php */
/* Location: ./application/modules/mobile/controllers/Plain.php */