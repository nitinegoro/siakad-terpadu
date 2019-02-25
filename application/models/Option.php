<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Option extends CI_Model {

	private $data = array();

	public function __construct()
	{
		parent::__construct();

	}

	/**
	 * Get data option
	 *
	 * @param String (option_name)
	 * @return string
	 **/
	public function get($value='')
	{
		if(is_string($value))
		{
			$query = $this->db->query("SELECT option_value FROM tb_options WHERE option_name = ?", array($value));

			if(!$query->num_rows())
				return false;

			return $query->row()->option_value;
		} else {
			return false;
		}
	}

	/**
	 * updating data option
	 *
	 * @param String (option_name)
	 * @return Boolean
	 **/
	public function update($name = '', $value = '')
	{
		if(is_string($name) OR $name != '')
		{
			$query = $this->db->query("UPDATE tb_options SET option_value = ? WHERE option_name = ?", array($value, $name));
			return $this->db->affected_rows();
		} else {
			return false;
		}
	}
}

/* End of file Option.php */
/* Location: ./application/models/Option.php */