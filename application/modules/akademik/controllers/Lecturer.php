<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dosen Crud Controller
 *
 * @package Bag. Akademik
 * @category Akademik or Super Admin
 * @see https://github.com/nitinegoro/siakad-terpadu
 * @author Vicky Nitinegoro
 **/

class Lecturer extends Akademik 
{
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('akademik'));

		$this->breadcrumbs->unshift(1, 'Master', "akademik/lecturer");

		$this->load->model('mlecturer', 'lecturer');

		//$this->load->model(array('ex_course'));

		$this->load->js(base_url("assets/app/akademik/lecturer.js"));
	}

	public function index()
	{
		$this->page_title->push('Master', 'Data Dosen');

		$this->breadcrumbs->unshift(2, 'Data Dosen', "akademik/lecturer");

		$field = array(
			$this->input->get('per_page'),
			$this->input->get('status'),
			$this->input->get('query')
		);

		// set pagination
		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("akademik/lecturer?per_page={$field[0]}&status={$field[1]}&query={$field[0]}");

		$config['per_page'] = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');
		$config['total_rows'] = $this->lecturer->get_all(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Data Dosen", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'daftar_dosen' => $this->lecturer->get_all($config['per_page'], $this->input->get('page')),
			'jumlah_dosen' => $config['total_rows']
		);

		$this->template->view('master/data-dosen', $this->data);
	}

	public function add()
	{
		$this->page_title->push('Master', 'Tambah Dosen Baru');

		$this->breadcrumbs->unshift(2, 'Data Dosen', "akademik/lecturer");

		$this->form_validation->set_rules('lecturer_code', 'Kode Dosen', 'trim|required|callback_validate_dscode');
		$this->form_validation->set_rules('nidn', 'NIDN', 'trim');
		$this->form_validation->set_rules('name', 'Nama Lengkap', 'trim');
		$this->form_validation->set_rules('address', 'Alamat', 'trim');
		$this->form_validation->set_rules('phone', 'Nomor Telepon', 'trim');
		$this->form_validation->set_rules('status', 'Status Dosen', 'trim|required');

		if($this->form_validation->run() == TRUE)
		{
			$this->lecturer->create();

			redirect('akademik/lecturer/add');
		}

		$this->data = array(
			'title' => "Data Dosen", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);

		$this->template->view('master/add-dosen', $this->data);
	}

	public function update($param = 0)
	{
		$this->page_title->push('Master', 'Update Data Dosen');

		$this->breadcrumbs->unshift(2, 'Data Dosen', "akademik/lecturer");

		$this->form_validation->set_rules('lecturer_code', 'Kode Dosen', 'trim|required');
		$this->form_validation->set_rules('nidn', 'NIDN', 'trim');
		$this->form_validation->set_rules('name', 'Nama Lengkap', 'trim');
		$this->form_validation->set_rules('address', 'Alamat', 'trim');
		$this->form_validation->set_rules('phone', 'Nomor Telepon', 'trim');
		$this->form_validation->set_rules('status', 'Status Dosen', 'trim|required');

		if($this->form_validation->run() == TRUE)
		{
			$this->lecturer->update($param);

			redirect("akademik/lecturer/update/{$param}");
		}

		$this->data = array(
			'title' => "Update Data Dosen", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->lecturer->get($param)
		);

		$this->template->view('master/update-dosen', $this->data);
	}

	public function delete($param = 0)
	{
		$this->lecturer->delete($param);

		redirect("akademik/lecturer");
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
				$this->lecturer->multiple_delete();
				break;
			
			default:
				$this->template->alert(
					' Tidak ada aksi apapun.', 
					array('type' => 'warning','icon' => 'times')
				);
				break;
		}

		redirect('akademik/lecturer');
	}

	/**
	 * Halaman Print Out Data Dosen
	 *
	 * @return string
	 **/
	public function get_print()
	{
		$per_page = ($this->input->get('per_page') != '') ? $this->input->get('per_page') : 20;

		$this->data = array(
			'title' => "Data Dosen", 
			'data_dosen' => $this->lecturer->get_all($per_page, $this->input->get('page')) ,
			'jumlah_dosen' => $this->lecturer->get_all(null, null, 'num')
		);

		$this->load->view('master/print-dosen', $this->data);
	}

	/**
	 * Cek Validasi Kode Dosen
	 *
	 * @return Bolean
	 **/
	public function validate_dscode()
	{
		if($this->lecturer->check_code() == TRUE)
		{
			$this->form_validation->set_message('validate_dscode', 'Maaf! Kode Dosen telah digunakan.');
			return false;
		} else {
			return true;
		}
	}
}

/* End of file Lecturer.php */
/* Location: ./application/modules/akademik/controllers/Lecturer.php */