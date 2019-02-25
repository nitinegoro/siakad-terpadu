<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (isset($header))
{
    echo $header;
}

if (isset($navbar))
{
    echo $navbar;
}

if (isset($left_sidebar))
{
    echo $left_sidebar;
}

if (isset($content))
{
    echo $content;
}
/*
if (isset($right_sidebar))
{
    echo $right_sidebar;
}*/

if (isset($footer))
{
    echo $footer;
}



/* End of file template.php */
/* Location: ./application/modules/Akademik/views/_template/template.php */