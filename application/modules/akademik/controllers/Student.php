<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends Akademik 
{
	public $data;
	
	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('akademik'));

		$this->load->model('mstudent', 'student');
		
		$this->load->model('ex_student');

		$this->breadcrumbs->unshift(1, 'Mahasiswa', "akademik/student");

		$this->load->js(base_url("assets/app/akademik/student.js"));
	}

	public function index()
	{
		$this->page_title->push('Mahasiswa', 'Data Mahasiswa');

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
			"akademik/student?per_page={$field[0]}&class={$field[1]}&gender={$field[2]}&registration={$field[3]}&query={$field[4]}"
		);

		$config['per_page'] = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');
		$config['total_rows'] = $this->student->getall(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Data Mahasiswa", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'data_mahasiswa' => $this->student->getall($config['per_page'], $this->input->get('page')) ,
			'jumlah_mahasiswa' => $this->student->getall(null, null, 'num')
		);

		$this->template->view('student/data-mahasiswa', $this->data);
	}

	/**
	 * Halaman Print
	 *
	 * @return string
	 **/
	public function print_data()
	{
		$per_page = ($this->input->get('per_page') != '') ? $this->input->get('per_page') : 20;

		$this->data = array(
			'title' => "Data Mahasiswa", 
			'data_mahasiswa' => $this->student->getall($per_page, $this->input->get('page')) ,
			'jumlah_mahasiswa' => $this->student->getall(null, null, 'num')
		);

		$this->load->view('student/print-data-mahasiswa', $this->data);
	}

	public function add()
	{
		$this->page_title->push('Mahasiswa', 'Tambah data Mahasiswa');

		$this->breadcrumbs->unshift(2, 'Tambah Data', "akademik/student/add");

		$this->data = array(
			'title' => "Tambah data Mahasiswa", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);

		$this->template->view('student/add-mahasiswa', $this->data);
	}

	/**
	 * Handle Create Mahasiswa
	 *
	 * @return string
	 **/
	public function create()
	{
		$this->student->create();

		redirect('akademik/student/add');
	}


	/**
	 * Halaman Detail Mahasiswa
	 *
	 * @param Integet (student_id)
	 * @var string
	 **/
	public function get($param = 0)
	{
		if($this->student->get($param) == FALSE)
			show_404();

		$this->page_title->push('Mahasiswa', 'Lihat data Mahasiswa');

		$this->breadcrumbs->unshift(2, 'Lihat Data', "akademik/student/add");

		$this->data = array(
			'title' => "Lihat data Mahasiswa", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->student->get($param)
		);

		$this->template->view('student/detail-mahasiswa', $this->data);
	}

	/**
	 * Halaman Update Mahasiswa
	 *
	 * @var string
	 **/
	public function update($param = 0)
	{
		if($this->student->get($param) == FALSE)
			show_404();

		$this->page_title->push('Mahasiswa', 'Update data Mahasiswa');

		$this->breadcrumbs->unshift(2, 'Update Data', "akademik/student/add");

		$this->data = array(
			'title' => "Update data Mahasiswa", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->student->get($param)
		);

		$this->template->view('student/update-mahasiswa', $this->data);
	}

	/**
	 * handle Update Data Mahasswa
	 *
	 * @return string
	 **/
	public function set_update($param = 0)
	{
		$this->student->update($param);

		redirect("akademik/student/update/{$param}");
	}

	/**
	 * handle Delete Data Mahasiswa
	 *
	 * @var string
	 **/
	public function delete($param = 0)
	{
		$this->student->delete($param);

		$this->template->alert(
			' Data Mahasiswwa dihapus.', 
			array('type' => 'success','icon' => 'check')
		);	

		redirect('akademik/student');
	}

	/**
	 * Handle Multiple Action
	 *
	 * @return string
	 **/
	public function bulk_action()
	{
		switch ($this->input->post('action')) 
		{
			case 'delete':
				$this->student->multiple_delete();
				break;
			
			default:
				$this->template->alert(
					' Tidak ada aksi apapun.', 
					array('type' => 'warning','icon' => 'times')
				);
				break;
		}

		redirect('akademik/student');
	}

	/**
	 * Get halaman Import Data
	 *
	 * @return string
	 **/
	public function import()
	{
		$this->page_title->push('Mahasiswa', 'Import data Mahasiswa');

		$this->breadcrumbs->unshift(2, 'Import Data', "akademik/student/add");

		$this->data = array(
			'title' => "Import data Mahasiswa", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);

		$this->template->view('student/import-mahasiswa', $this->data);
	}

	/**
	 * Handle Import Data Excel
	 *
	 * @return string
	 **/
	public function set_import()
	{
		$this->ex_student->set();
	}

	/**
	 * Get Attachment Excel Export
	 *
	 * @return void
	 **/
	public function get_export()
	{
		$data = $this->student->getall($this->input->get('per_page'), $this->input->get('page'));

		$this->ex_student->get($data);
	}
}

/* End of file Student.php */
/* Location: ./application/modules/Akademik/controllers/Student.php */