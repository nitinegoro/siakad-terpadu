<?php 
/**
 * Sistem Informasi Akdemik STIE Pertiba
 *
 * @package Codeigniter - Template Siakad
 * @subpackage Helper
 * @see https://github.com/nitinegoro/siakad-terpadu/tree/master/application/helpers
 * @since 2017 (V1.0.1)
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 *
 *
 *
 * Untuk satu Cotroller dalam satu menu
 *
 * @param String (name Controller)
 * @return string (Active Menu)
 **/
if(!function_exists('active_link_controller'))
{
	function active_link_controller($controller)
	{
        $ci    =& get_instance();
        $class = $ci->router->fetch_class();

        return ($class == $controller) ? 'active open ' : NULL;
	}
} 

/**
 * Untuk satu Cotroller dan Method dalam satu menu
 *
 * @param String (name Controller)
 * @param String (name Method)
 * @return string (Active Menu)
 **/
if(!function_exists('active_link_method'))
{
	function active_link_method($controller, $class_controller = FALSE)
	{
        $ci    =& get_instance();
        $method = $ci->router->fetch_method();
        $class  = $ci->router->fetch_class();

        if($class_controller !== FALSE)
        	return ($method == $controller && $class == $class_controller) ? 'active' : NULL;
        
        return ($method == $controller) ? 'active' : NULL;
	}
} 

/**
 * Untuk beberapa Cotroller dalam satu hierarki menu
 *
 * @param Array
 * @return string (Active Menu)
 **/
if(!function_exists('active_link_multiple'))
{
    function active_link_multiple($controller)
    {
        $ci    =& get_instance();

        if(is_array($controller))
        {
            if (in_array($ci->router->fetch_class(), $controller))
                return 'active';
        } else {
            show_error('Masukkan beberapa nama Controller menggunakan array.', 200, 'Error menus helper');
            return FALSE;
        }
    }
}

