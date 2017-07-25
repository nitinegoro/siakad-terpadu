<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Mata Kuliah Crud Controller
 *
 * @package Bag. Akademik
 * @category Akademik or Super Admin
 * @see https://github.com/nitinegoro/siakad-terpadu
 * @author Vicky Nitinegoro
 **/

class Course extends Akademik 
{
	public $data;

	public function __construct()
	{
		parent::__construct();
		
		$this->breadcrumbs->unshift(1, 'Master', "akademik/course");

		$this->load->model('mcourse', 'course');

		$this->load->model(array('ex_course'));

		$this->load->js(base_url("assets/app/akademik/master.js"));
	}

	public function index()
	{
		$this->page_title->push('Master', 'Data Mata Kuliah');

		$this->breadcrumbs->unshift(2, 'Data Mata Kuliah', "akademik/course");

		$field = array(
			$this->input->get('per_page'),
			$this->input->get('concentration'),
			$this->input->get('query')
		);

		// set pagination
		$config = $this->template->pagination_list();

		$config['base_url'] = site_url(
			"akademik/course?per_page={$field[0]}&concentration={$field[1]}&query={$field[2]}"
		);

		$config['per_page'] = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');
		$config['total_rows'] = $this->course->get_all(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Data Mata Kuliah", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'daftar_mata_kuliah' => $this->course->get_all($config['per_page'], $this->input->get('page')),
			'jumlah_mk' => $config['total_rows']
		);

		$this->template->view('master/data-mata-kuliah', $this->data);
	}

	public function add()
	{
		$this->page_title->push('Master', 'Tambah Mata Kuliah');

		$this->breadcrumbs->unshift(2, 'Data Mata Kuliah', "akademik/course");

		$this->form_validation->set_rules('course_code', 'Kode MK', 'trim|required|callback_validate_mk');
		$this->form_validation->set_rules('course_name', 'Mata Kuliah', 'trim|required');
		$this->form_validation->set_rules('course_name_english', 'Mata Kuliah (Asing)', 'trim');
		$this->form_validation->set_rules('sks', 'Jumlah SKS', 'trim|required');
		$this->form_validation->set_rules('semester', 'Semester', 'trim|required');
		$this->form_validation->set_rules('concentration', 'Konsentrasi', 'trim');

		if($this->form_validation->run() == TRUE)
		{
			$this->course->create();

			redirect('akademik/course/add');
		}

		$this->data = array(
			'title' => "Tambah Mata Kuliah", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files()
		);

		$this->template->view('master/add-mata-kuliah', $this->data);
	}


	/**
	 * Cek Validasi MK
	 *
	 * @return Bolean
	 **/
	public function validate_mk()
	{
		if($this->course->check_mk() == TRUE)
		{
			$this->form_validation->set_message('validate_mk', 'Maaf! Kode MK telah digunakan.');
			return false;
		} else {
			return true;
		}
	}

	public function update($param = 0)
	{
		$this->page_title->push('Master', 'Sunting Mata Kuliah');

		$this->breadcrumbs->unshift(2, 'Data Mata Kuliah', "akademik/course");

		$this->form_validation->set_rules('course_code', 'Kode MK', 'trim|required');
		$this->form_validation->set_rules('course_name', 'Mata Kuliah', 'trim|required');
		$this->form_validation->set_rules('course_name_english', 'Mata Kuliah (Asing)', 'trim');
		$this->form_validation->set_rules('sks', 'Jumlah SKS', 'trim|required');
		$this->form_validation->set_rules('semester', 'Semester', 'trim|required');
		$this->form_validation->set_rules('concentration', 'Konsentrasi', 'trim');

		if($this->form_validation->run() == TRUE)
		{
			$this->course->update($param);

			redirect("akademik/course/update/{$param}");
		}

		$this->data = array(
			'title' => "Sunting Mata Kuliah", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->course->get($param)
		);

		$this->template->view('master/update-mata-kuliah', $this->data);
	}

	public function delete($param = 0)
	{
		$this->course->delete($param);

		redirect('akademik/course');
	}

	/**
	 * Multiple Action
	 *
	 * @return string
	 **/
	public function bulk_action()
	{
		switch ($this->input->post('action')) 
		{
			case 'delete':
				$this->course->multiple_delete();
				break;
			
			default:
				$this->template->alert(
					' Tidak ada aksi apapun.', 
					array('type' => 'warning','icon' => 'times')
				);
				break;
		}

		redirect('akademik/course');
	}

	/**
	 * Halaman Print Out Mata Kuliah
	 *
	 * @return string
	 **/
	public function get_print()
	{
		$per_page = ($this->input->get('per_page') != '') ? $this->input->get('per_page') : 20;

		$this->data = array(
			'title' => "Data Mata Kuliah", 
			'data_mk' => $this->course->get_all($per_page, $this->input->get('page')) ,
			'jumlah_mk' => $this->course->get_all(null, null, 'num')
		);

		$this->load->view('master/print-mata-kuliah', $this->data);
	}

	/**
	 * Get Download Export
	 *
	 * @return Attachment
	 **/
	public function get_export()
	{
		$this->ex_course->get();
	}
}

/* End of file Course.php */
/* Location: ./application/modules/Akademik/controllers/Course.php */