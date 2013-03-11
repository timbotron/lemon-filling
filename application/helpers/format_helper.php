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
    
if ( ! function_exists('prep_terms_options'))
{
	function prep_terms_options($term_list)
	{
		$returnme = array();

		foreach($term_list as $row)
		{
			$returnme[$row['terms_id']] = $row['value'];
		}
		return $returnme;
	}

	function prep_json_terms($term_list)
	{
		$returnme = array();

		foreach($term_list as $row)
		{
			$returnme[$row['terms_value']]=$row['rosetta_value'];
		}
		return $returnme;
	}


	
	
}



/* End of file format_helper.php */
/* Location: ./application/helpers/format_helper.php */
