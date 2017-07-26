<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends Mobile_Mahasiswa 
{
	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('mnews', 'news');

		$this->load->library(array('template'));
	}

	public function index()
	{
		$this->data = array(
			'title' => "Pengumuman"
		);

		$this->load->view('other/main-news', $this->data);
	}

	public function get($param = 0)
	{
		$this->data = array(
			'title' => "Detail Pengumuman"
		);

		$this->load->view('other/detail-news', $this->data);
	}

	public function data()
	{
		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("mobile/news?per_page={$this->input->get('per_page')}");

		$config['per_page'] = (!$this->input->get('per_page')) ?  5 : $this->input->get('per_page');
		$config['total_rows'] = $this->news->get_all(null, null, 'num');

		$this->pagination->initialize($config);
		
		$results = array();

		foreach ($this->news->get_all($config['per_page'], $this->input->get('page')) as $row) 
			$results[] = array(
				'ID' => $row->ID,
				'title' => $row->title,
				'image' => $row->image,
				'date' => $row->date
			);

		$this->data = array(
			'status' => 'success',
			'results' => $results,
		);

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data));
	}
}

/* End of file News.php */
/* Location: ./application/modules/mobile/controllers/News.php */