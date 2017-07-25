<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends Mahasiswa 
{
	public $data = array();

	public $thn_akademik;

	public $semester;

	public $student;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Jadwal Kuliah', 'mahasiswa/jadwal');

		$this->load->helper('akademik');

		$this->load->model('mjadwal','jadwal');

		$this->load->js(base_url("assets/app/mahasiswa/jadwal.js?v=1.0.1"));

		$this->thn_akademik = $this->input->get('thn_akademik');

		$this->semester = $this->input->get('semester');

		$this->student = $this->session->userdata('account_id');
	}

	public function index()
	{
		# code...
	}

	public function create()
	{
		$this->breadcrumbs->unshift(2, 'Penyusunan Jadwal', 'mahasiswa/jadwal/create');
		$this->page_title->push('Jadwal Kuliah', 'Penyusunan Jadwal Kuliah ');

		$this->form_validation->set_data($this->input->get());

		$this->form_validation->set_rules('thn_akademik', 'Tahun Akademik', 'trim|required');
		$this->form_validation->set_rules('semester', 'Semester', 'trim|required');

		$this->form_validation->run();
		
		$this->data = array(
			'title' => 'Penyusunan Jadwal Kuliah ',
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),	
			'mata-kuliah' => $this->jadwal->get_mk($this->thn_akademik, $this->semester)
		);

		$this->template->view('jadwal/susun-jadwal', $this->data);
	}

	/**
	 * Simpan Jadwal
	 *
	 * @param Integer (schedule_id)
	 * @return string (Flashdata)
	 **/
	public function save($param = 0)
	{
		$this->jadwal->save($param);

		redirect("mahasiswa/jadwal/create?{$this->input->server('QUERY_STRING')}");	
	}

	/**
	 * Reset Jadwal Mata Kuliah
	 *
	 * @param Integer (Result_id)
	 * @return String
	 **/
	public function reset($param = 0)
	{
		$this->jadwal->reset($param);
		redirect("mahasiswa/jadwal/create?{$this->input->server('QUERY_STRING')}");	
	}

	public function print_out()
	{
		$this->data = array(
			'title' => 'Penyusunan Jadwal Kuliah ',
			'get' => $this->account->getAll( $this->session->userdata('account_id') ),
			'mata_kuliah' => $this->jadwal->get_mk($this->thn_akademik, $this->semester)
		);

		$this->load->view('jadwal/print-jadwal', $this->data);
	}

	/**
	 * Menampilkan Jadwal by Mata Kuliah
	 *
	 * @param Integer (course_id)
	 * @return String
	 **/
	public function getschedule($param = 0)
	{
		if($this->jadwal->get_schedule($param))
		{
			$output = array(
				'status' => TRUE, 
			);

			$output['results'] = $this->jadwal->get_schedule($param);
		} else {
			$output = array(
				'status' => FALSE, 
			);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

}

/* End of file Jadwal.php */
/* Location: ./application/modules/mahasiswa/controllers/Jadwal.php */