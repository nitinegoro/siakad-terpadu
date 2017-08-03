<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembimbing extends Dosen 
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

		$this->semester = $this->input->get('semester');

		$this->load->model('mpembimbing', 'pa');

		$this->load->helper(array('akademik'));

		$this->load->js(base_url("assets/app/akademik/verifikasi.js"));
		
		$this->breadcrumbs->unshift(0, 'Pembimbing Akademik', "dosen/pembimbing");	
	}

	public function index()
	{
		$this->page_title->push('Pembimbing Akademik', 'Data Mahasiswa PA');

		$field = array(
			$this->input->get('per_page'),
			$this->input->get('class'),
			$this->input->get('gender'),
			$this->input->get('registration'),
			$this->input->get('query')
		);

		// set pagination
		$config = $this->template->pagination_list();

		$config['base_url'] = site_url(
			"dosen/pembimbing?per_page={$field[0]}&class={$field[1]}&gender={$field[2]}&registration={$field[3]}&query={$field[4]}"
		);

		$config['per_page'] = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');
		$config['total_rows'] = $this->pa->get_mahasiswa(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Data Mahasiswa PA", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'data_mahasiswa' => $this->pa->get_mahasiswa($config['per_page'], $this->input->get('page')) ,
			'jumlah_mahasiswa' => $this->pa->get_mahasiswa(null, null, 'num')
		);

		$this->template->view('pembimbing/data-mahasiswa', $this->data);
	}

	public function getmhs($param = 0)
	{
		$this->page_title->push('Pembimbing Akademik', 'Data Mahasiswa PA');

		$this->data = array(
			'title' => "Detail Mahasiswa", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->pa->getmhs($param, 'student_id')
		);

		$this->template->view('pembimbing/detail-mhs', $this->data);
	}

	public function krs($param = 0)
	{
		$this->page_title->push('Pembimbing Akademik', 'Data Mahasiswa PA');
		
		$this->form_validation->set_data($this->input->get());

		$this->form_validation->set_rules('npm', 'NPM', 'trim|required');
		$this->form_validation->set_rules('thn_ajaran', 'Tahun Ajaran', 'trim|required');
		$this->form_validation->set_rules('semester', 'Semester', 'trim|required');

		$this->form_validation->run();

		$this->data = array(
			'title' => "Detail Mahasiswa", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->pa->getmhs($this->npm, 'npm'),
			'daftar_krs' => $this->pa->getkrs($this->input->get('npm'), $this->thn_ajaran, $this->semester)
		);

		$last_semester = ($this->semester == 'ganjil') ? 'genap' : 'ganjil';
		$cek_last_semester = $this->pa->getPlain($this->npm, $this->thn_ajaran, $last_semester);

		$config = array(
			'student' => (isset($this->data['get']->student_id)) ? $this->data['get']->student_id : 0,
			'semester' => (!$cek_last_semester) ? $this->input->get('semester') : $last_semester,
			'years' => $this->thn_ajaran,
		);
		$this->load->library('nilai', $config);

		$this->template->view('pembimbing/get-krs', $this->data);
	}

	public function setkrs($param = '')
	{
		$this->pa->setKrs($param);

		redirect("dosen/pembimbing?{$this->input->server('QUERY_STRING')}",'refresh');
	}
}

/* End of file Pembimbing.php */
/* Location: ./application/modules/dosen/controllers/Pembimbing.php */