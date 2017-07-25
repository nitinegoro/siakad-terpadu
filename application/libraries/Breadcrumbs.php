<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// inspired from the source >> https://github.com/nobuti/Codeigniter-breadcrumbs
class Breadcrumbs {

    protected $CI;

    private $breadcrumbs = array();

    private $_open 			= '<ol class="breadcrumb hidden-xs">';
	private	$_close			= '</ol>';
	private	$_el_open 		= '<li>';
	private	$_el_close 		= '</li>';
	private	$_el_first 		= '<i class="fa fa-home"></i>';
	private	$_el_last_open 	= '<li class="active">';

    public function __construct()
    {	
		$this->CI =& get_instance();
    }


    public function array_sorter($key)
    {
        return function ($a, $b) use ($key)
        {
            return strnatcmp($a[$key], $b[$key]);
        };
    }


    public function push($id, $page, $url)
    {
		if (!$page OR !$url) return;

		$url = site_url($url);

		$this->breadcrumbs[$url] = array('id' => $id, 'page' => $page, 'href' => $url);
	}


	public function unshift($id, $page, $url)
	{
		if (!$page OR !$url) return;

		$url = site_url($url);

		array_unshift($this->breadcrumbs, array('id' => $id, 'page' => $page, 'href' => $url));
	}


	public function show()
	{
		if ($this->breadcrumbs)
        {
			$output = $this->_open ."\n";

            usort($this->breadcrumbs, $this->array_sorter('id'));

			foreach ($this->breadcrumbs as $key => $value)
            {
				$keys = array_keys($this->breadcrumbs);

                if (reset($keys) == $key)
                {
					$output.= "\t\t\t". $this->_el_open .'<a href="'. $value['href'] .'">'. $this->_el_first .' '. $value['page'] .'</a> '. $this->_el_close ."\n";
				}
                elseif (end($keys) == $key)
                {
					$output.= "\t\t\t". $this->_el_last_open . $value['page'] . $this->_el_close ."\n";
				}
                else
                {
					$output.= "\t\t\t". $this->_el_open .'<a href="'. $value['href'] .'">'. $value['page'] .'</a> '. $this->_el_close ."\n";
				}
            }

			return $output. "\t\t\t". $this->_close ."\n";
		}

		return NULL;
	}

}
