<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembimbing extends Dosen 
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('mpembimbing', 'pa');
		
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
			'title' => "Pengaturan Akun", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'data_mahasiswa' => $this->pa->get_mahasiswa($config['per_page'], $this->input->get('page')) ,
			'jumlah_mahasiswa' => $this->pa->get_mahasiswa(null, null, 'num')
		);

		$this->template->view('pembimbing/data-mahasiswa', $this->data);
	}

}

/* End of file Pembimbing.php */
/* Location: ./application/modules/dosen/controllers/Pembimbing.php */