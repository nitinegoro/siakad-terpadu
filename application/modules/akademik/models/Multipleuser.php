<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Multipleuser extends CI_Model {

	protected $ci;

	public function __construct()
	{
		parent::__construct();
		
		$this->ci = $ci =& get_instance();

		switch ($this->input->post('action')) 
		{
			case 'delete':
				$this->delete();
				break;
			case 'update':
				$this->update();
				break;
			default:
				redirect('akademik/user');
				break;
		}
	}


	private function update()
	{
		if(is_array($this->input->post('users')) != TRUE)
			redirect('akademik/user');

		$this->breadcrumbs->unshift(2, 'Sunting Pengguna', 'account');
		$this->page_title->push('User', 'Sunting Pengguna');

		if($this->input->post('set_update'))
		{
			foreach ($this->input->post('users') as $key => $value) 
			{
				$this->form_validation->set_rules("mail[{$key}]", 'E-Mail', 'trim|valid_email');
				$this->form_validation->set_rules("name[{$key}]", 'Nama Pengguna', 'trim|required');
				$this->form_validation->set_rules("role[{$key}]", 'Level Akses', 'trim|required');
			}			
		}

        if ($this->form_validation->run() == TRUE)
        {
        	foreach ($this->input->post('users') as $key => $value) 
        	{
				$data = array(
					'name' => $this->input->post('name')[$key], 
					'email' => $this->input->post('email')[$key],
					'active' => $this->input->post('active')[$key],
					'role_id' => $this->input->post('role')[$key]
				);

				$this->db->update('users', $data, array('user_id' => $value));
        	}

			$this->template->alert(
				' perubahan disimpan.', 
				array('type' => 'success','icon' => 'check')
			);

			redirect('akademik/user');
        } 

		$this->data = array(
			'title' => "Sunting Pengguna", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'roles' => $this->role->getall(),
		);

		foreach($this->input->post('users') as $key => $value)
			$this->data['users'][] = $this->ci->user->get($value);

		$this->template->view('users/multiple-edit-pengguna', $this->data);
	}


	private function delete()
	{
		foreach ($this->input->post('users') as $key => $value) 
		{
			$query = $this->db->query("DELETE FROM users WHERE user_id = ?", $value);
		}

		$this->template->alert(
			' Terhapus.', 
			array('type' => 'success','icon' => 'check')
		);

		redirect('akademik/user');
	}

}

/* End of file Multiple_user.php */
/* Location: ./application/modules/Akdemik/models/Multiple_user.php */