<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model 
{
	public $account;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->account = $this->session->userdata('user_id');
	}

}


/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */