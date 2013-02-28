<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('make_nav'))
{
	function make_nav($current_area='locale')
	{
		$pages = array('locale','terms','pages','about');
		$output = '<ul class="nav">'."\n";

		foreach($pages as $element)
		{
			if($element==$current_area) $output.='<li class="active"><a href="'.site_url($element)."\">".ucfirst($element)."</a></li>\n";
			else $output.='<li><a href="'.site_url($element)."\">".ucfirst($element)."</a></li>\n";
		}
		$output .= "</ul>\n";
		return $output;
	}


	
	
}



/* End of file header_helper.php */
/* Location: ./application/helpers/header_helper.php */
