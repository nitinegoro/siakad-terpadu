<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Mobile_Mahasiswa 
{
	public $data;

	public function __construct()
	{
		parent::__construct();
		
	}
	
	public function index()
	{
		$this->data = array(
			'title' => "Halaman Utama"
		);
		$this->load->view('main', $this->data);
	}

	public function account()
	{
		$this->data = array(
			'title' => "Pengaturan Akun"
		);

        $this->form_validation->set_rules('email', 'E-Mail', 'trim|valid_email|required');
        $this->form_validation->set_rules('plama', 'Password Lama', 'trim|required');
		$this->form_validation->set_rules('pbaru', 'Password Baru', 'trim|min_length[8]|max_length[12]');
		$this->form_validation->set_rules('repeat', 'Ini', 'trim|matches[pbaru]');

		if ($this->form_validation->run() == TRUE) 
		{
			$this->account->set();

			redirect(current_url());
		} 

		$this->load->view('account/main-account', $this->data);
	}
}

/* End of file Main.php */
/* Location: ./application/modules/mobile/controllers/Main.php */