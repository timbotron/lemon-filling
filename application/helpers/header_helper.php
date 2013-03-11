<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
	Copyright 2013, Tim Habersack / http://tim.hithlonde.com / tim@hithlonde.com

	This file is part of Lemon-filling.

    Lemon-filling is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Lemon-filling is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Lemon-filling.  If not, see <http://www.gnu.org/licenses/>.

*/
    
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
