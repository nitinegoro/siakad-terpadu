<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_guide extends Mahasiswa 
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
		$this->breadcrumbs->unshift(1, 'Panduan Sistem', 'mahasiswa/user_guide');
		
		$this->page_title->push('Panduan Sistem', 'Pengantar');

		$this->data = array(
			'title' => 'Pengantar',
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),	
		);

		$this->template->view('userguide/index', $this->data);
	}

	public function read($param = '')
	{
		$this->breadcrumbs->unshift(1, 'Panduan Sistem', 'mahasiswa/user_guide');
		switch ( $param ) 
		{
			case 'penyusunan-krs':

				$this->breadcrumbs->unshift(2, 'Penyusunan KRS', 'mahasiswa/user_guide/read');

				$this->page_title->push('Panduan Sistem', 'Penyusunan KRS');

				$this->data = array(
					'title' => 'Panduan Penyusunan KRS',
					'breadcrumb' => $this->breadcrumbs->show(),
					'page_title' => $this->page_title->show(),
					'js' => $this->load->get_js_files(),	
				);

				$this->template->view('userguide/susun-krs', $this->data);

				break;

			case 'hasil-studi':

				$this->breadcrumbs->unshift(2, 'Kartu Hasil Studi', 'mahasiswa/user_guide/read');

				$this->page_title->push('Panduan Sistem', 'Kartu Hasil Studi');

				$this->data = array(
					'title' => 'Kartu Hasil Studi',
					'breadcrumb' => $this->breadcrumbs->show(),
					'page_title' => $this->page_title->show(),
					'js' => $this->load->get_js_files(),	
				);

				$this->template->view('userguide/hasil-studi', $this->data);

				break;
			case 'change-password':

				$this->breadcrumbs->unshift(2, 'Ganti Password atau lupa Password', 'mahasiswa/user_guide/read');

				$this->page_title->push('Panduan Sistem', 'Ganti Password atau lupa Password');

				$this->data = array(
					'title' => 'Ganti Password atau lupa Password',
					'breadcrumb' => $this->breadcrumbs->show(),
					'page_title' => $this->page_title->show(),
					'js' => $this->load->get_js_files(),	
				);

				$this->template->view('userguide/change-password', $this->data);

				break;
			default:
				show_404();
				break;
		}
	}

}

/* End of file User_guide.php */
/* Location: ./application/modules/Mahasiswa/controllers/User_guide.php */