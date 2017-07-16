<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Jadwal Kuliah Crud Controller
 *
 * @package Bag. Akademik
 * @category Akademik or Super Admin
 * @see https://github.com/nitinegoro/siakad-terpadu
 * @author Vicky Nitinegoro
 **/

class Schedule extends Akademik 
{
	public $data;

	public $semester;

	public $thn_akademik;

	public function __construct()
	{
		parent::__construct();
		
		$this->breadcrumbs->unshift(1, 'Jadwal Kuliah', "akademik/schedule");

		$this->load->model('mschedule', 'schedule');

		$this->load->model(array());

		$this->load->js(base_url("assets/app/akademik/schedule.js"));

		$this->semester = $this->input->get('semester');

		$this->thn_akademik = $this->input->get('thn_akademik');
	}

	public function index()
	{
		$this->page_title->push('Jadwal Kuliah', 'Lihat Jadwal Perkuliahan');

		$this->breadcrumbs->unshift(2, 'Lihat Jadwal Kuliah', "akademik/schedule");

		$this->form_validation->set_data($this->input->get());

		$this->form_validation->set_rules('thn_akademik', 'Tahun Akademik', 'trim|required');
		$this->form_validation->set_rules('semester', 'Semester', 'trim|required');

		$this->form_validation->run();

		// set pagination
		$config = $this->template->pagination_list();

		$config['base_url'] = site_url(
			"akademik/schedule?per_page="
		);

		$config['per_page'] = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');
		$config['total_rows'] = $this->schedule->get_all(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Lihat Jadwal Perkuliahan", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'jadwal_kuliah' => $this->schedule->get_all($config['per_page'], $this->input->get('page')),
			'jumlah_jadwal' => $config['total_rows']
		);

		$this->template->view('schedule/data-jadwal-kuliah', $this->data);
	}

	public function create()
	{
		$this->page_title->push('Jadwal Kuliah', 'Buat Jadwal Baru');

		$this->breadcrumbs->unshift(2, 'Buat Jadwal Perkuliahan', "akademik/schedule/create");

		$this->form_validation->set_rules('semester', 'Semester', 'trim|required');
		$this->form_validation->set_rules('thn_akademik', 'Tahun Akademik', 'trim|required');
		$this->form_validation->set_rules('mk', 'Mata Kuliah', 'trim|required');
		$this->form_validation->set_rules('lecturer', 'Dosen', 'trim|required');
		$this->form_validation->set_rules('day', 'Hari', 'trim|required');
		$this->form_validation->set_rules('classroom', 'Ruangan', 'trim|required');

		if($this->form_validation->run() == TRUE)
		{
			$this->schedule->create();

			redirect('akademik/schedule/create');
		}

		$this->data = array(
			'title' => "Buat Jadwal Perkuliahan", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files()
		);

		$this->template->view('schedule/create-jadwal-kuliah', $this->data);
	}

	public function update($param = 0)
	{
		$this->page_title->push('Jadwal Kuliah', 'Sunting Jadwal Kuliah');

		$this->breadcrumbs->unshift(2, 'Sunting Jadwal Perkuliahan', "akademik/schedule/update");

		$this->form_validation->set_rules('semester', 'Semester', 'trim|required');
		$this->form_validation->set_rules('thn_akademik', 'Tahun Akademik', 'trim|required');
		$this->form_validation->set_rules('mk', 'Mata Kuliah', 'trim|required');
		$this->form_validation->set_rules('lecturer', 'Dosen', 'trim|required');
		$this->form_validation->set_rules('day', 'Hari', 'trim|required');
		$this->form_validation->set_rules('classroom', 'Ruangan', 'trim|required');

		if($this->form_validation->run() == TRUE)
		{
			$this->schedule->update($param);

			redirect("akademik/schedule/update/{$param}");
		}

		$this->data = array(
			'title' => "Sunting Jadwal Perkuliahan", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->schedule->get($param)
		);

		$this->template->view('schedule/update-jadwal-kuliah', $this->data);
	}

	public function delete($param = 0)
	{
		$this->schedule->delete($param);

		redirect("akademik/schedule?{$this->input->server('QUERY_STRING')}");
	}

	public function bulk_action()
	{
		switch ($this->input->post('action')) 
		{
			case 'delete':
				$this->schedule->multiple_delete();
				break;
			
			default:
				$this->template->alert(
					' Tidak ada aksi apapun.', 
					array('type' => 'warning','icon' => 'times')
				);
				break;
		}

		redirect("akademik/schedule?{$this->input->server('QUERY_STRING')}");
	}

	public function get_print()
	{
		$per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->data = array(
			'title' => "Jadwal Kuliah Semester ".ucfirst($this->schedule->semester)." Tahun Akademik ".$this->schedule->thn_akademik, 
			'jadwal_kuliah' => $this->schedule->get_all($per_page, $this->input->get('page')),
			'jumlah_jadwal' => $this->schedule->get_all(null, null, 'num')
		);

		$this->load->view('schedule/print-jadwal', $this->data);
	}

}

/* End of file Schedule.php */
/* Location: ./application/modules/akademik/controllers/Schedule.php */