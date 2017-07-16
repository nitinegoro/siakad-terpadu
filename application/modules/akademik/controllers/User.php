<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Akademik 
{
	public $data = array();

	public function __construct()
	{
		parent::__construct();

		$this->load->js("assets/app/akademik/user.js");

		$this->load->model('muser', 'user');

		$this->load->model('users_role', 'role');

		$this->breadcrumbs->unshift(1, 'User', 'akademik/user');
	}

	public function index()
	{
		$this->page_title->push('User', 'Data Pengguna Sistem');

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("akademik/user?per_page={$this->input->get('per_page')}&query={$this->input->get('query')}");
		$config['per_page'] = (!$this->input->get('per_page')) ? 10 : $this->input->get('per_page');
		$config['total_rows'] = $this->user->getall(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Data Pengguna Sistem", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'users' => $this->user->getall($config['per_page'], $this->input->get('page')) 
		);

		$this->template->view('users/all-users', $this->data);
	}

	/**
	 * Halaman Tambah Pengguna
	 *
	 * @return HTML Output
	 **/
	public function add()
	{
		$this->breadcrumbs->unshift(2, 'Tambah Pengguna', 'account');
		$this->page_title->push('User', 'Tambah Pengguna');

		$this->form_validation->set_rules('email', 'E-Mail', 'trim|valid_email');
		$this->form_validation->set_rules('name', 'Nama Pengguna', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_validate_username');
		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]|max_length[12]');
		$this->form_validation->set_rules('repeat_pass', 'Ini', 'trim|matches[password]');
		$this->form_validation->set_rules('role', 'Level Akses', 'trim|required');

        if ($this->form_validation->run() == TRUE)
        {
        	$this->user->create();
        	redirect(current_url(),'refresh');
        }

		$this->data = array(
			'title' => "Tambah Pengguna", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'roles' => $this->role->getall()
		);

		$this->template->view('users/add-pengguna', $this->data);
	}

	/**
	 * Halaman Update Pengguna
	 *
	 * @param Integer (user_id)
	 * @return HTML Output
	 **/
	public function update($param = 0)
	{
		$this->breadcrumbs->unshift(2, 'Sunting Pengguna', 'account');
		$this->page_title->push('User', 'Sunting Pengguna');

		$this->form_validation->set_rules('email', 'E-Mail', 'trim|valid_email');
		$this->form_validation->set_rules('name', 'Nama Pengguna', 'trim|required');
		$this->form_validation->set_rules('role', 'Level Akses', 'trim|required');

        if ($this->form_validation->run() == TRUE)
        {
        	$this->user->update($param);
        	redirect(current_url(),'refresh');
        }

		$this->data = array(
			'title' => "Sunting Pengguna", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'roles' => $this->role->getall(),
			'get' => $this->user->get($param)
		);

		$this->template->view('users/edit-pengguna', $this->data);
	}

	/**
	 * Handle Delete User
	 *
	 * @param Integer (user_id)
	 * @return string
	 **/
	public function delete($param = 0)
	{
		$this->user->delete($param);

		redirect('akademik/user');
	}

	/**
	 * Handle Multiple Action
	 *
	 * @return string
	 **/
	public function bulk_action()
	{
		$this->load->model('multipleuser');
		//redirect('akademik/user');
	}

	/**
	 * Halaman Edit login (username, dan password)
	 *
	 * @return HTML Output
	 **/
	public function account()
	{
		$this->breadcrumbs->unshift(2, 'Pengaturan Login', 'account');
		$this->page_title->push('User', 'Pengaturan Login');

		$this->form_validation->set_rules('email', 'E-Mail', 'trim|valid_email');
		$this->form_validation->set_rules('name', 'Nama Pengguna', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_validate_username');
		$this->form_validation->set_rules('new_pass', 'Password Baru', 'trim|min_length[8]|max_length[12]');
		$this->form_validation->set_rules('repeat_pass', 'Ini', 'trim|matches[new_pass]');
		$this->form_validation->set_rules('old_pass', 'Password Lama', 'trim|required|callback_validate_password');

        if ($this->form_validation->run() == TRUE)
        {
        	$this->user->user_login_update($this->session->has_userdata('user_id'));
        	redirect(current_url(),'refresh');
        }

		$this->data = array(
			'title' => "Pengaturan Login", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(), 
			'get' => $this->user->get($this->session->has_userdata('user_id'))
		);

		$this->template->view('users/my-akun', $this->data);
	}

	/**
	 * Cek ketersediaan username
	 *
	 * @return Boolean
	 **/
	public function validate_username()
	{
		if($this->user->username_check($this->session->has_userdata('user_id')) == TRUE)
		{
			$this->form_validation->set_message('validate_username', 'Maaf Username telah digunakan oleh Pengguna lain.');
			return false;
		} else {
			return true;
		}
	}

	/**
	 * Cek kebenaran password
	 *
	 * @return Boolean
	 **/
	public function validate_password()
	{
		$get = $this->user->get($this->session->has_userdata('user_id'));

		if(password_verify($this->input->post('old_pass'), $get->password))
		{
			return true;
		} else {
			$this->form_validation->set_message('validate_password', 'Password lama anda tidak cocok!');
			return false;
		}
	}
}

/* End of file User.php */
/* Location: ./application/modules/Akademik/controllers/User.php */