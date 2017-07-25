<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Muser extends CI_Model {

	public function create()
	{
		$data = array(
			'name' => $this->input->post('name'), 
			'username' => $this->input->post('username'),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'email' => $this->input->post('email'),
			'forgot_key' => '0',
			'active' => '0',
			'role_id' => $this->input->post('role')
		);

		$this->db->insert('users', $data);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Pengguna ditambahkan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function getall($limit = 10, $offset = 0, $type = 'result')
	{
		$this->db->select('users.user_id, users.name, users.username, users.password, users.email, users_role.role_name, users_role.role ');

		$this->db->join('users_role', 'users.role_id = users_role.role_id', 'left');

		if($this->input->get('query') != '')
			$this->db->like('users.name', $this->input->get('query'))
					 ->or_like('users.email', $this->input->get('query'))
					 ->or_like('users_role.role_name', $this->input->get('query'));

		if($type == 'result')
		{
			return $this->db->get('users', $limit, $offset)->result();
		} else {
			return $this->db->get('users')->num_rows();
		}
	}

	public function get($param = 0)
	{
		$query = $this->db->query(
			"SELECT users.user_id, users.name, users.username, users.password, users.email, users_role.role_name, users_role.role, users_role.role_id, users.active
			FROM users JOIN users_role ON users.role_id = users_role.role_id WHERE users.user_id = ?", array( $param )
		);

		return $query->row();
	}

	public function update($param = 0)
	{
		$data = array(
			'name' => $this->input->post('name'), 
			'email' => $this->input->post('email'),
			'active' => $this->input->post('active'),
			'role_id' => $this->input->post('role')
		);

		$this->db->update('users', $data, array('user_id' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' perubahan disimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function delete($param = 0)
	{
		$query = $this->db->query("DELETE FROM users WHERE user_id = ?", $param);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Terhapus.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menghapus data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	/**
	 * Check Ketersediaan username 
	 * Demi mencegah duplikat username
	 *
	 * @param Integer (user_id)
	 * @return Integer (num_rows)
	 **/
	public function username_check($param = 0)
	{
		$query = $this->db->query("SELECT username FROM users WHERE username IN(?) AND user_id != ?", array($this->input->post('username'), $param));

		return $query->num_rows();
	}

	/**
	 * Handle Update Pengaturan Login
	 *
	 * @param Integer (role_id)
	 * @return string
	 **/
	public function user_login_update($param = 0)
	{
		$get = $this->get($this->session->has_userdata('user_id'));

		$data = array(
			'name' => $this->input->post('name'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),  
		);

		if($this->input->post('new_pass') != '')
			$data['password'] = password_hash($this->input->post('new_pass'), PASSWORD_DEFAULT);

		$this->db->update('users', $data, array('user_id' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Perubahan tersimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal melakukan perubahan.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

}

/* End of file Muser.php */
/* Location: ./application/modules/Akademik/models/Muser.php */