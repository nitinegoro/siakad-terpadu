<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Fungsi Untuk membuat PDF
 *
 * @author https://www.facebook.com/muh.azzain
 * @see https://github.com/dompdf/dompdf
 * @return PDFGenerator 
 **/

class Pdfgenerator
{
  	public function __construct() 
  	{
      	define('DOMPDF_ENABLE_AUTOLOAD', false);
      	
      	// loaded package via compoeser
      	require_once(FCPATH."./vendor/dompdf/dompdf/dompdf_config.inc.php");

      	// get Extends Class
      	$dompdf = new DOMPDF();

        // created Object Codeigniter
        $ci =& get_instance();
        $ci->dompdf = $dompdf;
  	}
}