<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mnews extends CI_Model {

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->order_by('date', 'desc');

		if($type == 'result')
		{
			return $this->db->get('news', $limit, $offset)->result();
		} else {
			return $this->db->get('news')->num_rows();
		}
	}

}

/* End of file Mnews.php */
/* Location: ./application/modules/mobile/models/Mnews.php */