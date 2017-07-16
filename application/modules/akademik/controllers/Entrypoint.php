<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entrypoint extends Akademik 
{
	public $data = array();

	public $npm;

	public $thn_ajaran;

	public $semester;

	public function __construct()
	{
		parent::__construct();

		$this->npm = (!$this->input->get('npm')) ? '-' : $this->input->get('npm');

		$this->thn_ajaran = $this->input->get('thn_ajaran');

		$this->load->helper(array('akademik'));

		$this->semester = $this->input->get('semester');

		$this->load->model('mentrypoint', 'entrypoint');

		$this->load->model(array('ex_point'));

		$this->breadcrumbs->unshift(1, 'Entry Nilai', "akademik/entrypoint?{$this->input->server('QUERY_STRING')}");

		$this->load->js(base_url("assets/app/akademik/entrypoint.js"));
	}

	public function index()
	{
		$this->page_title->push('Entry Nilai', 'Cari KHS Mahasiswa');

		$this->form_validation->set_data($this->input->get());

		$this->form_validation->set_rules('npm', 'NPM', 'trim|required');
		$this->form_validation->set_rules('thn_ajaran', 'Tahun Ajaran', 'trim|required');
		$this->form_validation->set_rules('semester', 'Semester', 'trim|required');

		$this->form_validation->run();

		$this->data = array(
			'title' => "Entry Nilai", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->entrypoint->getStudent($this->npm),
			'daftar_nilai' => $this->entrypoint->get($this->npm, $this->semester, $this->thn_ajaran)
		);

		$config = array(
			'student' => (isset($this->data['get']->student_id)) ? $this->data['get']->student_id : 0,
			'semester' => $this->semester,
			'years' => $this->thn_ajaran,
		);
		$this->load->library('nilai', $config);

		$this->nilai->setFinal();

		$this->template->view('entry_point/cari-khs', $this->data);
	}


	/**
	 * Set Update Nilai KHS
	 *
	 * @param Integer (student_id)
	 * @return string
	 **/
	public function set($param = 0)
	{
		$this->entrypoint->update($param);
	
		$config = array(
			'student' => $param,
			'semester' => $this->semester,
			'years' => $this->thn_ajaran,
		);
		$this->load->library('nilai', $config);

		$this->nilai->setFinal();

		redirect("akademik/entrypoint/?{$this->input->server('QUERY_STRING')}");
	}

	/**
	 * Get Halaman Print KHS
	 *
	 * @return string (HTML Outpu)
	 **/
	public function getprint($param = 0)
	{
		$config = array(
			'student' => $param,
			'semester' => $this->semester,
			'years' => $this->thn_ajaran,
		);
		$this->load->library('nilai', $config);

		$this->data = array(
			'title' => "KARTU HASIL STUDI (KHS)", 
			'get' => $this->entrypoint->getStudent($this->npm),
			'daftar_nilai' => $this->entrypoint->get($this->npm, $this->semester, $this->thn_ajaran)
		);

		$this->load->view('entry_point/print-khs.php', $this->data, FALSE);
	}

	/**
	 * Import Data Nilai
	 *
	 * @return string
	 **/
	public function import()
	{
		$this->page_title->push('Import Nilai', 'Import Nilai Mahasiswa');

		$this->data = array(
			'title' => "Import Nilai", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);

		$this->template->view('entry_point/import-nilai', $this->data);
	}

	/**
	 * Handle Upload import data Nilai
	 *
	 * @return String
	 **/
	public function save_import()
	{
		$this->ex_point->set();
	}

}

/* End of file Entrypoint.php */
/* Location: ./application/modules/Akademik/controllers/Entrypoint.php */