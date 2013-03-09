<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
