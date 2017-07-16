<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Point extends Mahasiswa 
{
	public $data = array();

	public $student;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('akademik');

		$this->load->model('mpoint', 'point');

		$this->student = $this->session->userdata('account_id');
	}

	public function index()
	{
		$this->breadcrumbs->unshift(1, 'Transkrip Nilai', 'krs');
		$this->page_title->push('Transkrip Nilai', 'Transkrip Nilai Sementara');

		$this->data = array(
			'title' => 'Transkrip Nilai Sementara',
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->point->get()	
		);	

		$this->template->view('transkrip/index', $this->data);
	}

	/**
	 * Halaman Print transkrip Nilai
	 *
	 * @return Prin Out
	 **/
	public function get_print()
	{
		$this->data = array(
			'title' => "Transkrip Nilai", 
			'get' => $this->account->getAll( $this->session->userdata('account_id') ),
			'daftar_nilai' => $this->point->get(),
		);

		$this->load->view('transkrip/print-transkrip', $this->data);
	}

}

/* End of file Point.php */
/* Location: ./application/modules/Mahasiswa/controllers/Point.php */