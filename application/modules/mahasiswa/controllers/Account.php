<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Mahasiswa 
{
	public function __construct()
	{
		parent::__construct();

		$this->load->js(base_url('assets/app/mahasiswa/account.js'));

		$this->load->library(array('form_validation'));

		$this->load->model('mpoint', 'point');
	}

	public function index()
	{
		$totalsks = 0;
		$totalipk = 0;
		$bobot = 0;
		
		foreach($this->point->get() as $row)
		{
			$totalsks += $row->sks;
			$bobot += $row->quality;

			$totalipk = ($bobot / $totalsks);
		}

		$this->breadcrumbs->unshift(1, 'Akun', 'mahasiswa/account');
		$this->breadcrumbs->unshift(1, 'Profil', 'about');
		$this->page_title->push('Akun', 'profil');

		$this->data = array(
			'title' => 'Profil',
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->account->getAll($this->session->userdata('account_id')),
			'total_sks' => $totalsks,
			'total_ipk' => $totalipk
		);

		$this->template->view('account/index', $this->data);
	}

	/**
	 * Halaman Form Update Data Diri
	 *
	 * @return Form Data Diri page
	 **/
	public function self()
	{
		$this->breadcrumbs->unshift(1, 'Akun', 'mahasiswa/account');
		$this->breadcrumbs->unshift(1, 'Ubah Data Diri', 'about');
		$this->page_title->push('Akun', 'Ubah Data Diri');

		$this->data = array(
			'title' => 'Ubah Data Diri',
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->account->getAll($this->session->userdata('account_id')),
		);

		$this->template->view('account/update-data', $this->data);
	}

	/**
	 * handle Update Data Diri
	 *
	 * @return String
	 **/
	public function save_data()
	{
		$this->account->update_data();

		redirect('mahasiswa/account/self');
	}

	/**
	 * Get Setting Page
	 *
	 * @return Setting Page
	 **/
	public function setting()
	{
		$this->breadcrumbs->unshift(1, 'Akun', 'front/account');
		$this->breadcrumbs->unshift(2, 'Profil', 'about');
		$this->page_title->push('Akun', 'Pengaturan Login');

		$this->form_validation->set_rules('email', 'E-Mail', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('new_pass', 'Password Baru', 'trim|min_length[8]|max_length[12]');
		$this->form_validation->set_rules('repeat_pass', 'Ini', 'trim|matches[new_pass]');
		$this->form_validation->set_rules('old_pass', 'Password Lama', 'trim|required');


		$this->data = array(
			'title' => 'Pengaturan Login',
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),	
			'get' => $this->account->get($this->session->userdata('account_id'))
		);

		$this->template->view('account/setting', $this->data);
	}

	public function set($value='')
	{	
		$this->account->set($this->session->userdata('account_id'));

		redirect('mahasiswa/account/setting');
	}
}

/* End of file Account.php */
/* Location: ./application/modules/Mahasiswa/controllers/Account.php */