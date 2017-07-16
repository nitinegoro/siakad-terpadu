<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
		$this->data = array(
			'title' => "Login - Sistem Informasi Akademik STIE Pertiba", 
		);

		$this->load->view('login', $this->data);
	}

	public function auth()
	{
		if( $this->input->post() )
		{
	        $npm = $this->input->post('usernpm');
	        $password = $this->input->post('pass');

	        // get data account
	        $account = $this->_get_account($npm);

	        if (password_verify($password, $account->password)) 
	        {
	        	$this->_set_account_login($account);

	        	$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => "success")));
	        } else {
		        $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => "failed")));
	        }
	    } else {
	    	$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => "zero")));
	    }
	}

	/**
	 * Take a data student account
	 *
	 * @param Integer (NPM)
	 * @access private
	 * @return Object
	 **/
	private function _get_account($param = 0)
	{
		// get query prepare statmennts
		$query = $this->db->query("
			SELECT students.npm, students_accounts.* FROM students_accounts 
			LEFT JOIN students ON students.student_id = students_accounts.account_student_id  WHERE students.npm = ?"
			, array($param));

		if($query->num_rows() == 1)
		{
			return $query->row();
		} else {
			// hilangkan error object
			return (Object) array('password' => '');
		}
	}

	/**
	 * Handle login verification
	 *
	 * @param String
	 * @access private
	 * @return void 
	 **/
	private function _set_account_login($account)
	{
        // set session data
        $account_session = array(
        	'is_login' => TRUE,
        	'account_id' => $account->account_student_id,
        	'account' => $account
        );	
       $this->session->set_userdata( $account_session );
	}

	/**
	 * Sign Out 
	 *
	 * @return Void (destroy session)
	 **/
	public function signout()
	{
		$this->session->sess_destroy();
		redirect(site_url('mobile/login?from_url'.$this->input->get('from_url')));
	}
}

/* End of file Login.php */
/* Location: ./application/modules/mobile/controllers/Login.php */