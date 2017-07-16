<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_role extends CI_Model {

	public function getall()
	{
		$query = $this->db->query("SELECT * FROM users_role");

		return $query->result();
	}

}

/* End of file Users_role.php */
/* Location: ./application/modules/Akademik/models/Users_role.php */