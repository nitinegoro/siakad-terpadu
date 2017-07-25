<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plain extends Mobile_Mahasiswa 
{
	public $data;

	public $student;

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('mkrs', 'krs');

		$this->student = $this->session->userdata('account_id');
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

	public function tes($value='')
	{
		$response = json_decode('{"semester":"ganjil","thnakademik":"2016/2017","totalsks":6,"mk":{"24":{"selected":true},"25":{"selected":true}}}');

		echo "<pre>";

		print_r($response);

			foreach($response->mk as $key => $value) 
			{

				$krk[] = array(
					'student_id' => $this->student,
					'course_id' => $key,
					'years' => $response->thnakademik,
					'semester' => $response->semester,
					'verification' => '0'
				);
			}

			print_r($krk);
	}

	public function setkrs()
	{
		$response = json_decode(file_get_contents("php://input"));

		if( @$response->semester != '' AND @$response->thnakademik != '')
		{
			$config = array(
				'student' => $this->student,
				'semester' => $response->semester,
				'years' => $response->thnakademik,
			);

			$this->load->library('nilai', $config);

			if($response->totalsks >= $this->nilai->credit_sks())
			{
				$this->data = array(
					'status' => "failed",
					'message' => "Maaf! Anda hanya diperkenankan mengambil {$this->nilai->credit_sks()} SKS"
				);
			} else {
				$this->krs->create($response);

				$this->data = array(
					'status' => "success",
					'message' => "Berhasil! KRS anda berhasil disimpan."
				);
			}
		} else {
			$this->data = array(
				'status' => "failed",
				'message' => "Maaf! harap pilih Semester dan Tahun Ajaran terlebih dahulu"
			);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data));
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