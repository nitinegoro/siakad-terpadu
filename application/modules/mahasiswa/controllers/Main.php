<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Mahasiswa 
{
	public $data = array();

	public function __construct()
	{
		parent::__construct();
		//$this->load->js(base_url('assets/app/inventori.js'));

		$this->load->model('mpoint', 'point');
	}

	public function index()
	{
		$totalsks = 0;
		$totalipk = 0;
		$bobot = 0;
		
		foreach($this->point->get() as $row)
		{
			$totalsks += $row->sks;
			$bobot += $row->quality;

			$totalipk = ($bobot / $totalsks);
		}

		$this->page_title->push('Home', 'Halaman Utama');

		$this->data = array(
			'title' => 'Sistem Informasi Akademik',
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),	
			'total_sks' => $totalsks,
			'total_ipk' => $totalipk	
		);

		$this->template->view('v-main', $this->data);
	}

}

/* End of file Main.php */
/* Location: ./application/modules/Mahasiswa/controllers/Main.php */