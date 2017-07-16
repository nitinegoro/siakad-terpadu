<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define('MODULE_MAHASISWA', '1.0.2 <small>(Pre Release)</small>');

define('MODULE_AKADEMIK', '1.0.2 <small>(Pre Release)</small>');

define('MODULE_DOSEN', '1.0.1 <small>(Pre Release)</small>');

/**
* 
*/
class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

	}
}


/**
 * Extends Mahasiswa class
 *
 * @package default
 * @author 
 **/
class Mahasiswa extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('config','table','user_agent'));

		$this->load->model('maccount', 'account');

		$this->load->model('moption', 'option');

		$this->load->helper(array('menus','date','akademik'));
		
		date_default_timezone_set('Asia/Jakarta');

		if($this->session->has_userdata('is_login')==FALSE)
			redirect(site_url());
	}

	public function get_notif()
	{
		if($this->notifikasi())
		{
			$get = $this->notifikasi();

			$output = array(
				'status' => TRUE, 
				'messages' => $get->name . ' Telah memverifikasi KRS anda, untuk Semester ' . ucfirst($get->semester). '&nbsp;'.$get->years
			);

			$this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
	}

	/**
	 * Menampilkan Notifikasi yg belum terbaca
	 *
	 * @return Result dataa
	 **/
	private function notifikasi()
	{
		$this->db->join('users', 'plain_studies_callback.user_id = users.user_id', 'left');
		return $this->db->get_where(
			'plain_studies_callback', 
			array(
				'student_id' => $this->session->userdata('account_id'),
				'read' => '0'
			)
		)->result();
	}
}

/**
 * Extends Mahasiswa Mobile class
 *
 * @package default
 * @author Vicky Nitinegoro
 **/
class Mobile_Mahasiswa extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('config','table','user_agent'));

		$this->load->model('moption', 'option');

		$this->load->model('maccount','account');

		$this->load->helper(array('menus','date','akademik'));
		
		date_default_timezone_set('Asia/Jakarta');

		if($this->session->has_userdata('is_login')==FALSE)
			redirect(site_url("mobile/login"));
	}
}


/**
 * Extends Akademik class
 *
 * @package default
 * @author 
 **/
class Akademik extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('template','breadcrumbs','page_title','config','table','user_agent'));

		$this->load->helper(array('menus','date'));

		$this->load->model(array('krs_callback'));

		$this->load->js("assets/app/akademik/main.js");

		date_default_timezone_set('Asia/Jakarta');

		$this->breadcrumbs->unshift(0, 'Dashboard', 'akademik/main');

		if($this->session->has_userdata('admin_login')==FALSE)
			redirect(site_url());
	}
}

/**
 * Extends Dosen class
 *
 * @package default
 * @author 
 **/
class Dosen extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('template','breadcrumbs','page_title','config','table','user_agent'));

		$this->load->helper(array('menus','date'));

		$this->load->js("assets/app/dosen/main.js");

		date_default_timezone_set('Asia/Jakarta');

		$this->breadcrumbs->unshift(0, 'Dashboard', 'dosen/main');

		$this->account = $this->session->userdata('user_id');

		if($this->session->has_userdata('dosen_login')==FALSE)
			redirect(site_url());
	}
}





/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */