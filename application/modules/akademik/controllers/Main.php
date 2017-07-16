<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Akademik {

	public $data = array();

	public function __construct()
	{
		parent::__construct();

		$this->page_title->push('Dashboard', 'Halaman Utama');
		
		$this->load->model('mdashboard', 'dashboard');
	}

	public function index()
	{
		$this->data = array(
			'title' => "Dashboard", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);

		$this->template->view('dashboard', $this->data);
	}


	public function getchart()
	{
		$output = array(
			array('Tahun Masuk', 'Reguler', 'Pindahan', 'Telah Lulus'), 
		);

		for($tahun = 2011; $tahun <= date('Y'); $tahun++)
			$output[] = array(
				"$tahun",
				$this->dashboard->studentsByYear(TRUE, $tahun), 
				$this->dashboard->studentsByYear(FALSE, $tahun),
				$this->dashboard->studentsGoals($tahun)
		);

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}
}

/* End of file Main.php */
/* Location: ./application/modules/Akademik/controllers/Main.php */