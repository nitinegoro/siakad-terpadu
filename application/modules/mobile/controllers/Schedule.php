<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends Mobile_Mahasiswa 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('mschedule', 'schedule');
	}

	public function index()
	{
		$this->data = array(
			'title' => "Jadwal Kuliah"
		);

		$this->load->view('jadwal/main-jadwal', $this->data);
	}

	public function getschedule()
	{
		$schedule = $this->schedule->get();

		if( $schedule )
		{
			$this->data = array(
				'status' => 'success',
				'schedule' => $schedule
			);
		} else {
			$this->data = array('status' => 'failed');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data));
	}

}

/* End of file Schedule.php */
/* Location: ./application/modules/mobile/controllers/Schedule.php */