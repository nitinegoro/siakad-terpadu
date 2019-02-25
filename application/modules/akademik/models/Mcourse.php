<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Mata Kuliah Crud Model
 *
 * @package Bag. Akademik
 * @category Akademik or Super Admin
 * @see https://github.com/nitinegoro/siakad-terpadu
 * @author Vicky Nitinegoro
 **/

class Mcourse extends CI_Model 
{

	public function __construct()
	{
		parent::__construct();

	}	

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->join('concentration', 'course.concentration_id = concentration.concentration_id', 'left');

		if($this->input->get('semester') != '')
			$this->db->where('course.semester', $this->input->get('semester'));

		if($this->input->get('concentration') != '')
			$this->db->where('course.concentration_id', $this->input->get('concentration'));

		if($this->input->get('query') != '')
			$this->db->like('course.course_code', $this->input->get('query'))
					 ->or_like('course.course_name', $this->input->get('query'))
					 ->or_like('course.course_name_english', $this->input->get('query'));

		$this->db->order_by('course.course_id', 'desc');

		if($type == 'result')
		{
			return $this->db->get('course', $limit, $offset)->result();
		} else {
			return $this->db->get('course')->num_rows();
		}
	}

	public function get($param = 0)
	{
		$this->db->join('concentration', 'course.concentration_id = concentration.concentration_id', 'left');

		$this->db->where('course.course_id', $param);

		return $this->db->get('course')->row();
	}

	public function create()
	{
		$mata_kuliah = array(
			'course_code' => $this->input->post('course_code'), 
			'requirement_course' => '0',
			'course_name' => $this->input->post('course_name'),
			'course_name_english' => $this->input->post('course_name_english'),
			'sks' => $this->input->post('sks'),
			'semester' => $this->input->post('semester'),
			'concentration_id' => $this->input->post('concentration')
		);

		$this->db->insert('course', $mata_kuliah);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Mata Kuliah ditambahkan.', 
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
		$mata_kuliah = array(
			'course_code' => $this->input->post('course_code'), 
			'requirement_course' => '0',
			'course_name' => $this->input->post('course_name'),
			'course_name_english' => $this->input->post('course_name_english'),
			'sks' => $this->input->post('sks'),
			'semester' => $this->input->post('semester'),
			'concentration_id' => $this->input->post('concentration')
		);

		$this->db->update('course', $mata_kuliah, array('course_id' => $param));

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
		$this->db->delete('course', array('course_id' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Mata Kuliah dihapus.', 
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
		if(is_array($this->input->post('mk')))
		{
			foreach ($this->input->post('mk') as $key => $value) 
			{
				$this->db->delete('course', array('course_id' => $value));
			}

			if($this->db->affected_rows())
			{
				$this->template->alert(
					' Mata Kuliah dihapus.', 
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

	public function get_requirement($param = 0)
	{
		return $this->db->get_where('course', array('requirement_course' => $param))->row('course_name');
	}

	/**
	 * Cek Validasi MK
	 *
	 * @return Bolean
	 **/
	public function check_mk()
	{
		$this->db->where('course_code', $this->input->post('course_code'));

		return $this->db->get('course')->num_rows();
	}
}

/* End of file Mcourse.php */
/* Location: ./application/modules/Akademik/models/Mcourse.php */