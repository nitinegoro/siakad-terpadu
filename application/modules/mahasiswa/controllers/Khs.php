<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Khs extends Mahasiswa 
{
	public $thn_ajaran;

	public $semester;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mkhs', 'khs');

		$this->thn_ajaran = $this->input->get('thn_ajaran');

		$this->semester = $this->input->get('semester');

		$this->load->helper('akademik');

		$this->load->js(base_url("assets/app/mahasiswa/lihat-khs.js?v=1.0.1"));
	}

	public function index()
	{
		$this->breadcrumbs->unshift(1, 'KHS', 'khs');
		$this->page_title->push('KHS', 'Kartu Hasil Studi');

		$this->data = array(
			'title' => 'Kartu Hasil Studi',
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'daftar_nilai' => $this->khs->get($this->semester, $this->thn_ajaran)
		);

		if($this->input->get('semester') != '' AND $this->input->get('thn_ajaran') != '')
		{
			$config = array(
				'student' => $this->session->userdata('account_id'),
				'semester' => $this->semester,
				'years' => $this->thn_ajaran,
			);

			$this->load->library('nilai', $config);
		}

		$this->template->view('khs/index', $this->data);
	}

	/**
	 * Menampilkan Halaman Print
	 *
	 * @return Print Output
	 **/
	public function getprint()
	{
		$data = array(
			'title' => "Kartu Hasil Studi (KHS)", 
			'get' => $this->account->getAll( $this->session->userdata('account_id') ),
			'daftar_nilai' => $this->khs->get($this->semester, $this->thn_ajaran)
		);

		$config = array(
			'student' => $this->session->userdata('account_id'),
			'semester' => $this->semester,
			'years' => $this->thn_ajaran,
		);

		$this->load->library('nilai', $config);

		$this->load->view('khs/print_khs', $data);
	}

	/**
	 * Halaman Print Ujian
	 *
	 * @return Print Output
	 **/
	public function print_ujian($value='')
	{
		$data = array(
			'title' => "Kartu Ujian Akhir Semester (UAS)", 
			'get' => $this->account->getAll( $this->session->userdata('account_id') ),
			'daftar_nilai' => $this->khs->get($this->semester, $this->thn_ajaran)
		);

		$config = array(
			'student' => $this->session->userdata('account_id'),
			'semester' => $this->semester,
			'years' => $this->thn_ajaran,
		);

		$this->load->library('nilai', $config);

		$this->load->view('khs/print_ujian', $data);
	}

}

/* End of file Khs.php */
/* Location: ./application/modules/Mahasiswa/controllers/Khs.php */