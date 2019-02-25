<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi_krs extends Akademik 
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

		$this->load->model('mverifikasi_krs', 'verifikasi');

		$this->load->model(array('krs_callback'));

		$this->breadcrumbs->unshift(1, 'Verifikasi KRS', 'akademik/verifikasi_krs');

		$this->load->js(base_url("assets/app/akademik/verifikasi.js"));

		$this->page_title->push('Verifikasi KRS', 'Cari KRS Mahasiswa');
	}

	public function index()
	{
		$this->form_validation->set_data($this->input->get());

		$this->form_validation->set_rules('npm', 'NPM', 'trim|required');
		$this->form_validation->set_rules('thn_ajaran', 'Tahun Ajaran', 'trim|required');
		$this->form_validation->set_rules('semester', 'Semester', 'trim|required');

		$this->form_validation->run();

		$this->data = array(
			'title' => "Verifikasi KRS", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->verifikasi->getStudent($this->npm),
			'data_krs' => $this->verifikasi->get($this->npm, $this->thn_ajaran, $this->semester),
		);

		$last_semester = ($this->semester == 'ganjil') ? 'genap' : 'ganjil';
		$cek_last_semester = $this->verifikasi->get($this->npm, $this->thn_ajaran, $last_semester);

		$config = array(
			'student' => (isset($this->data['get']->student_id)) ? $this->data['get']->student_id : 0,
			'semester' => (!$cek_last_semester) ? $this->input->get('semester') : $last_semester,
			'years' => $this->thn_ajaran,
		);
		$this->load->library('nilai', $config);

		$this->template->view('verifikasi_krs/cari-krs', $this->data);
	}

	/**
	 * Handle Action Verifikasi
	 *
	 * @return Callback
	 **/
	public function set_action($param = 0)
	{
		$this->verifikasi->set($param);

		redirect("akademik/verifikasi_krs?{$this->input->post('query_string')}");
	}

	/**
	 * Cek KHS Mahasiswa
	 *
	 * @return string
	 **/
	public function cekkhs()
	{
		$validate = $this->verifikasi->validate_khs();

		if($validate == FALSE)
		{
			$this->data = array(
				'status' => 'OK',
				'message' =>  "Jadikan Mata Kuliah yang terverifikasi menjadi KHS Semester "  . ucfirst($this->input->post('semester')) . ' - ' . $this->input->post('years') . " ?"
			);
		} else {
			$this->data = array(
				'status' => 'ERROR',
				'message' => "KHS pada semester " . ucfirst($this->input->post('semester')) . " - " . $this->input->post('years') . " sudah tersedia, apakah anda ingin menggantinya dengan Mata Kuliah yang terverifikasi ?"
			);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data));
	}

	/**
	 * Get halaman Print
	 *
	 * @return string
	 **/
	public function getprint()
	{
		$this->data = array(
			'title' => "KARTU RENCANA STUDI (KRS)", 
			'get' => $this->verifikasi->getStudent($this->npm),
			'data_krs' => $this->verifikasi->get($this->npm, $this->thn_ajaran, $this->semester),
		);

		$config = array(
			'student' => (isset($this->data['get']->student_id)) ? $this->data['get']->student_id : 0,
			'semester' => ($this->semester == 'ganjil') ? 'genap' : 'ganjil',
			'years' => $this->thn_ajaran,
		);
		$this->load->library('nilai', $config);

		$this->load->view('verifikasi_krs/print-krs', $this->data);
	}

}

/* End of file Verifikasi_krs.php */
/* Location: ./application/modules/Akademik/controllers/Verifikasi_krs.php */