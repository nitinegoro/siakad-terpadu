<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dosen Crud Model
 *
 * @package Bag. Akademik
 * @category Akademik or Super Admin
 * @see https://github.com/nitinegoro/siakad-terpadu
 * @author Vicky Nitinegoro
 **/

class Mlecturer extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();

	}	

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		if($this->input->get('status') != '')
			$this->db->where('status', $this->input->get('status'));

		if($this->input->get('query') != '')
			$this->db->like('lecturer_code', $this->input->get('query'))
					 ->or_like('name', $this->input->get('query'));

		$this->db->order_by('lecturer_id', 'desc');

		if($type == 'result')
		{
			return $this->db->get('lecturer', $limit, $offset)->result();
		} else {
			return $this->db->get('lecturer')->num_rows();
		}
	}

	public function get($param = '')
	{
		return $this->db->get_where('lecturer', array('lecturer_id' => $param))->row();
	}
	
	public function create()
	{
		$lecturer = array(
			'lecturer_code' => $this->input->post('lecturer_code'),
			'nidn' => $this->input->post('nidn'),
			'name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'phone' => $this->input->post('phone'),
			'status' => $this->input->post('status') 
		);

		$this->db->insert('lecturer', $lecturer);

		$account = array(
			'lecturer_id' => $this->db->insert_id(),
			'email' => '',
			'password' => password_hash($this->input->post('lecturer_code'), PASSWORD_DEFAULT) 
		);

		$this->db->insert('lecturer_accounts', $account);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data Dosen ditambahkan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function update($param = 0)
	{
		$lecturer = array(
			'lecturer_code' => $this->input->post('lecturer_code'),
			'nidn' => $this->input->post('nidn'),
			'name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'phone' => $this->input->post('phone'),
			'status' => $this->input->post('status') 
		);

		$this->db->update('lecturer', $lecturer, array('lecturer_id' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Perubahan disimpan.', 
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
		$this->db->delete('lecturer', array('lecturer_id' => $param));
		$this->db->delete('lecturer_accounts', array('lecturer_id' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Dosen terhapus.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menghapus data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function multiple_delete()
	{
		if(is_array($this->input->post('lecturer')))
		{
			foreach ($this->input->post('lecturer') as $key => $value) 
			{
				$this->db->delete('lecturer', array('lecturer_id' => $value));
				$this->db->delete('lecturer_accounts', array('lecturer_id' => $value));
			}

			if($this->db->affected_rows())
			{
				$this->template->alert(
					' Dosen terpilih dihapus.', 
					array('type' => 'success','icon' => 'check')
				);
			} else {
				$this->template->alert(
					' Gagal menghapus data.', 
					array('type' => 'warning','icon' => 'times')
				);
			}
		}
	}

	/**
	 * Cek Validasi Kode Dosen
	 *
	 * @return Bolean
	 **/
	public function check_code()
	{
		$this->db->where('lecturer_code', $this->input->post('lecturer_code'));

		return $this->db->get('lecturer')->num_rows();
	}
}

/* End of file Mlecturer.php */
/* Location: ./application/modules/akademik/models/Mlecturer.php */