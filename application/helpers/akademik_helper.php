<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if( ! function_exists('last_years') )
{
	function last_years($now_years = 0)
	{
		$year = explode('/', $now_years);

		$generate = ($year[0] -1) . '/' . ($year[1]-1);

		return $generate;
	}
}

if ( ! function_exists('tgl_indo'))
{
	function tgl_indo($tgl)
	{
		date_default_timezone_set('Asia/Jakarta');
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal.' '.$bulan.' '.$tahun;
	}
}

if ( ! function_exists('bulan'))
{
	function bulan($bln)
	{
		switch ($bln)
		{
			case 1:
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	}
}

if( ! function_exists('data_status') )
{
	function data_status($param = 'active')
	{
		switch ($param) {
			case 'ds_tetap':
				return 'Dosen Tetap';
				break;
			case 'ds_luar_biasa':
				return 'Dosen Luar Biasa';
				break;
			default:
				# code...
				break;
		}
	}
}
/* End of file akademik_helper.php */
/* Location: ./application/helpers/akademik_helper.php */