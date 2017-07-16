<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends Akademik 
{
	public $data = array();

	public function __construct()
	{
		parent::__construct();

		$this->load->js("assets/app/akademik/setting.js");

		$this->load->model('moption', 'option');

		$this->breadcrumbs->unshift(1, 'Pengaturan', 'akademik/setting');
	}

	public function index()
	{
		$this->page_title->push('Pengaturan', 'Lain-lain');

		$this->data = array(
			'title' => "Lain-lain", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);

		$this->template->view('setting/main-setting', $this->data);
	}

	/**
	 * Update Option Setting
	 *
	 * @var string
	 **/
	public function save_update()
	{
		if(is_array($this->input->post('option')))
		{
	        foreach ($this->input->post('option') as $key => $value) 
	        {
	        	$this->option->update($key, $value);
	        }

			$this->template->alert(
				' Perubahan disimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		}

		redirect(site_url('akademik/setting'));
	}

}

/* End of file Setting.php */
/* Location: ./application/modules/Akademik/controllers/Setting.php */