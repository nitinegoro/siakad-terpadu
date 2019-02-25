<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Dosen 
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('maccount', 'account');
	
		$this->breadcrumbs->unshift(0, 'Akun', "dosen/account");	
	}

	public function index()
	{
		$this->page_title->push('Akun Saya', 'Pengaturan Akun');

		$this->form_validation->set_rules('email', 'E-Mail', 'trim|valid_email');
		$this->form_validation->set_rules('new_pass', 'Password Baru', 'trim|min_length[8]|max_length[12]');
		$this->form_validation->set_rules('repeat_pass', 'Ini', 'trim|matches[new_pass]');
		$this->form_validation->set_rules('old_pass', 'Password Lama', 'trim|required|callback_validate_password');

        if ($this->form_validation->run() == TRUE)
        {
        	$this->account->update();
        	redirect(current_url(), 'refresh');
        }

		$this->data = array(
			'title' => "Pengaturan Akun", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->account->get()
		);

		$this->template->view('pengaturan-akun', $this->data);
	}

	/**
	 * Cek kebenaran password
	 *
	 * @return Boolean
	 **/
	public function validate_password()
	{
		$get = $this->account->get();

		if(password_verify($this->input->post('old_pass'), $get->password))
		{
			return true;
		} else {
			$this->form_validation->set_message('validate_password', 'Password lama anda tidak cocok!');
			return false;
		}
	}
}

/* End of file Account.php */
/* Location: ./application/modules/dosen/controllers/Account.php */