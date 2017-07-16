<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter User Friendly Url
 *
 * Library Codeigniter Untuk membuat URL cantik
 *
 * @package     CodeIgniter
 * @author      Vicky Nitinegoro 
 * @copyright   Copyright (c) 2016 Vicky Nitinegoro 
 * @link        https://www.facebook.com/muh.azzain
 * @subpackage  Libraries
 *
 */

class Slug
{
	/**
	 * String inisiasi
	 *
	 * @var string
	 **/
	private $title = '';
	/**
	 * replace sesuai yang anda inginkan dash atau underscore
	 *
	 * @var string
	 **/
	public $replacement = 'dash'; 


	function __construct()
	{
		$CI =& get_instance();
		$CI->load->helper(array('url', 'text', 'string'));
	}

	/**
	 * Membuat url
	 *
	 * @param   string $string string yang akan dijadikan url
	 * @param   string $replacement pilihan replace anda
	 * @return  string
	 */
	public function create_slug($string)
	{
		$string = strtolower(url_title(convert_accented_characters($string), $this->replacement));
		return reduce_multiples($string, $this->_GetReplace(), TRUE);
	}

	/**
	 * Membuat url
	 *
	 * @param   string $string string yang akan dijadikan url
	 * @param   string $replacement pilihan replace anda
	 * @return  string
	 */
	public function clean_html($string)
	{
		$string = strtolower(url_title(convert_accented_characters($string), ' '));
		return reduce_multiples($string, $this->_GetReplace(), TRUE);
	}

	/**
	 * Ganti replace space / symbol character
	 *
	 * @return string
	 */
	private function _GetReplace()
	{
		return ($this->replacement === 'dash') ? '-' : '_';
	}
}


/* End of file Slug.php */
/* Location: ./application/modules/front/libraries/Slug.php */