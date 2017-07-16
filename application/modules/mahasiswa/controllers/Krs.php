<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Krs extends Mahasiswa 
{
	public $data = array();

	public $thn_ajaran;

	public $semester;

	public $student;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('akademik');
		$this->load->model('mkrs','krs');
		$this->load->js(base_url("assets/app/mahasiswa/susun-krs.js?v=1.0.1"));

		$this->thn_ajaran = (!$this->input->get('thn_ajaran')) ? $this->option->get('default_thn_ajaran') : $this->input->get('thn_ajaran');
		$this->semester = (!$this->input->get('semester')) ? $this->option->get('default_semester') : $this->input->get('semester');

		$this->student = $this->session->userdata('account_id');
	}

	public function index()
	{
		$this->breadcrumbs->unshift(1, 'KRS', 'krs');
		$this->page_title->push('KRS', 'Penyusunan Kartu Rencana Studi');

		$this->data = array(
			'title' => 'Penyusunan Kartu Rencana Studi ',
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),	
			'get' => $this->krs->getPlain($this->thn_ajaran, $this->semester)->result()
		);

		if($this->data['get'] == TRUE)
			$this->template->view('krs/my-krs', $this->data);
		else
			$this->template->view('krs/index', $this->data);
	}


	/**
	 * Halaman Lihat KRS
	 *
	 * @return string
	 **/
	public function view()
	{
		$this->breadcrumbs->unshift(1, 'KRS', 'krs');
		$this->page_title->push('KRS', 'Lhat Kartu Rencana Studi');

		$this->data = array(
			'title' => 'Lihat Kartu Rencana Studi',
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),	
			'daftar_krs' => $this->krs->getPlain($this->thn_ajaran, $this->semester )->result()
		);

		$this->template->view('krs/lihat-krs', $this->data);
	}


	/**
	 * Set to session KRS 
	 *
	 * @return Object
	 **/
	public function set()
	{
		$set_krs = array(
			'set-krs' => TRUE,
			'thn_ajaran' => $this->input->post('thn_ajaran'),
			'semester' => $this->input->post('semester'),
			'mata-kuliah' => $this->input->post('mk')
		);

		$this->session->set_userdata( $set_krs );

		$config = array(
			'student' => $this->session->userdata('account_id'),
			'semester' => ($this->input->post('semester') == 'ganjil') ? 'genap' : 'ganjil',
			'years' => $this->input->post('thn_ajaran'),
		);
		$this->load->library('nilai', $config);

		$this->data = array(
			'status' => 'OK',
			'total_mk' => count($this->session->userdata('mata-kuliah')),
			'total_sks' => $this->krs->count_sks(),
			'max_sks' => $this->nilai->credit_sks()
		);

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data));
	}

	/**
	 * Get course where not in point study 
	 *
	 * @return String (JSON)
	 **/
	public function getmk()
	{
		$MK = array();

		$last_semester = $this->krs->last_semester($this->session->userdata('account_id'))->semester;

		if($this->input->post('semester') != '' AND $this->input->post('semester') != $last_semester AND $last_semester != FALSE)
		{
			$this->data = array(
				'status' => 'OK', 
				'results' => array()
			);

			foreach($this->krs->getmk($this->session->userdata('account_id'), $this->input->post('semester')) as $row)
				$this->data['results'][] = $row;
			
		} else {
			if($this->input->post('semester') != '')
			{
				$this->data = array(
					'status' => "ERROR", 
					'message' => "Mata kuliah tidak tersedia pada semester " . ucfirst($this->input->post('semester'))
				);
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data));
	}

	public function create()
	{
		$this->krs->create();

		redirect('mahasiswa/krs');
	}

	public function getmkupdate()
	{
		$get = $this->krs->getPlain( $this->thn_ajaran, $this->semester )->result();

		$MK = array();

		if($this->krs->getmkupdate($this->session->userdata('account_id'), $get[0]->semester))
		{
			$this->data = array(
				'status' => 'OK',
				'results' => $this->krs->getmkupdate($this->session->userdata('account_id'), $get[0]->semester)
			);
			
		} else {
			$this->data = array(
				'status' => "ERROR", 
				'message' => "Mata kuliah pengganti tidak tersedia."
			);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data));
	}

	public function update($param = 0)
	{
		$this->krs->update($param);
		redirect('mahasiswa/krs');
	}

	public function getadd()
	{
		$get = $this->krs->getPlain( $this->thn_ajaran, $this->semester )->result();

		$config = array(
			'student' => $this->session->userdata('account_id'),
			'semester' => ($get[0]->semester == 'ganjil') ? 'genap' : 'ganjil',
			'years' => $get[0]->years,
		);
		$this->load->library('nilai', $config);

		$sks_plain = 0;
		foreach($get as $row)
			$sks_plain += $row->sks;

		if($sks_plain >= $this->nilai->credit_sks())
		{
			$this->data = array(
				'status' => 'ERROR',
				'message' => "Anda hanya diperkenankan mengambil {$this->nilai->credit_sks()} SKS",
				'max_sks' => $this->nilai->credit_sks()
			);
		} else {
			$this->data = array(
				'status' => 'OK',
				'total_mk' => count($get),
				'total_sks' => $sks_plain,
				'max_sks' => $this->nilai->credit_sks(),
				'results' => $this->krs->getmkupdate($this->session->userdata('account_id'), $get[0]->semester)
			);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data));
	}

	public function add()
	{
		$this->krs->add();
		redirect('mahasiswa/krs');
	}

	public function ceksks()
	{
		$get = $this->krs->getPlain( $this->thn_ajaran, $this->semester )->result();
		
		$config = array(
			'student' => $this->session->userdata('account_id'),
			'semester' => ($get[0]->semester == 'ganjil') ? 'genap' : 'ganjil',
			'years' => $get[0]->years,
		);
		$this->load->library('nilai', $config);

		$akan_ditambah = 0;

		$sks_plain = 0;
		foreach($get as $row)
			$sks_plain += $row->sks;

		if(is_array($this->input->post('mk')))
		{
			foreach ($this->input->post('mk') as $key => $value) 
			{
				$course = $this->krs->getCourse($value);
				$akan_ditambah += $course->sks;
			}

			$jumlah = $akan_ditambah + $sks_plain;

			if($jumlah >= $this->nilai->credit_sks())
			{
				$this->data = array(
					'status' => 'ERROR',
					'message' => "Anda hanya diperkenankan mengambil {$this->nilai->credit_sks()} SKS",
					'max_sks' => $this->nilai->credit_sks()				
				);
			} else {
				$this->data = array(
					'status' => 'OK',
				);
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data));
	}


	/**
	 * Get halaman Print
	 *
	 * @return string
	 **/
	public function get_print()
	{
		$this->data = array(
			'title' => "KARTU RENCANA STUDI (KRS)", 
			'get' => $this->account->getAll( $this->session->userdata('account_id') ),
			'data_krs' => $this->krs->getPlain(  $this->thn_ajaran, $this->semester )->result(),
		);

		$config = array(
			'student' => (isset($this->data['get']->student_id)) ? $this->data['get']->student_id : 0,
			'semester' => ($this->data['data_krs'][0]->semester == 'ganjil') ? 'genap' : 'ganjil',
			'years' => $this->data['data_krs'][0]->years,
		);
		$this->load->library('nilai', $config);

		$this->load->view('krs/print-krs', $this->data);
	}

}

/* End of file Krs.php */
/* Location: ./application/modules/Mahasiswa/controllers/Krs.php */