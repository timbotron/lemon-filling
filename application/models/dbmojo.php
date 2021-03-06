<?php

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

class Dbmojo extends CI_Model {


	function get_locales($id='all')
	{
		if($id=='all')
		{
			$sql = "SELECT (SELECT COUNT(terms_id) FROM terms) AS total_terms,
							COUNT(rosetta.rosetta_id) as defined_terms,
							locale.*
					FROM terms
					LEFT JOIN rosetta ON rosetta.terms_id=terms.terms_id
					RIGHT JOIN locale ON rosetta.locale_id=locale.locale_id
					GROUP BY rosetta.locale_id ORDER BY locale.locale_id";
			$sql = $this->db->query($sql);
			return $sql->result_array();
		}
		else
		{
			$sql = "SELECT (SELECT COUNT(terms_id) FROM terms) AS total_terms,
							COUNT(rosetta.rosetta_id) as defined_terms,
							locale.*
					FROM terms
					LEFT JOIN rosetta ON rosetta.terms_id=terms.terms_id
					RIGHT JOIN locale ON rosetta.locale_id=locale.locale_id
					WHERE locale.locale_id=? GROUP BY rosetta.locale_id ORDER BY locale.locale_id";
			$sql = $this->db->query($sql,array($id));
			return $sql->row_array();
		}
		

	}

	function get_localeterms($id)
	{
		$sql = "SELECT COUNT(locale_id) as the_count
				FROM rosetta
				WHERE locale_id =?";
		$sql = $this->db->query($sql,array($id));
		return $sql->row_array();
	}

	function get_first_locale()
	{
		$sql = "SELECT locale_id
				FROM locale
				ORDER BY locale_id LIMIT 1";
		$sql = $this->db->query($sql);
		return $sql->row_array();
	}

	function locale_insert()
	{
		$data = array(
               'value' => $this->input->post('value')
            );
		if(!$this->db->insert('locale',$data)) redirect('/error/badentry','refresh');
	}

	function locale_update($id)
	{
		$data = array(
               'value' => $this->input->post('value')
            );
		$this->db->where('locale_id', $id);
		if(!$this->db->update('locale',$data)) redirect('/error/badentry','refresh');
	}

	function locale_delete($id)
	{
		$this->db->trans_start();

		# First delete all terms in rosetta that are set to that locale_id
		$sql = "DELETE FROM rosetta WHERE locale_id=?";
		$sql = $this->db->query($sql,array($id));

		# Delete actual locale entry
		$sql = "DELETE FROM locale WHERE locale_id=?";
		$sql = $this->db->query($sql,array($id));

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE)
		{
		    return FALSE;
		} 
		else
		{
			return TRUE;
		}
	}

	function get_terms($page,$locale_id)
	{

		if($page=='all_terms')
		{
			$sql = "SELECT terms_id, terms_value, MAX( rosetta_value ) rosetta_value, rosetta_id
					FROM (
					 
					   SELECT T.terms_id, T.value terms_value, R.value rosetta_value, R.locale_id, R.rosetta_id
					   FROM terms T
					   LEFT JOIN rosetta R ON T.terms_id = R.terms_id
					   UNION
					   SELECT T.terms_id, T.value, '', ?, ''
					   FROM terms T
					)A
					WHERE locale_id = ?
					GROUP BY terms_value";
			$sql = $this->db->query($sql,array($locale_id,$locale_id));
		}
		else
		{

			$sql = "SELECT terms_value, MAX( rosetta_value ) rosetta_value, rosetta_id
					FROM (
					 
						SELECT T.value terms_value, T.terms_id, R.value rosetta_value, R.locale_id, R.rosetta_id
						FROM terms T
						LEFT JOIN rosetta R ON T.terms_id = R.terms_id
						UNION
						SELECT T.value, T.terms_id, '', ?, ''
						FROM terms T        
					 
					)A
					WHERE locale_id =? AND terms_id IN (SELECT terms_id FROM page_group INNER JOIN page ON page.page_id=page_group.page_id WHERE page.value=?)
					GROUP BY terms_value";
			$sql = $this->db->query($sql,array($locale_id,$locale_id,$page));
		}

		return $sql->result_array();
	
	}

	function terms_insert($locale_id,$term_key,$definition)
	{
		$this->db->trans_start();

		# 1) add term to terms

		$data = array(
               'value' => $term_key
            );
		$this->db->insert('terms',$data);
		$term_id= $this->db->insert_id();

		# 2) add definition to rosetta
		$data = array(
				'locale_id' => $locale_id,
				'terms_id' => $term_id,
				'value' => $definition
				);
		$this->db->insert('rosetta',$data);
		
		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE)
		{
		    return FALSE;
		} 
		else
		{
			return TRUE;
		}
	}

	function get_bulk_terms($def_locale,$locale_id)
	{
		$returnme['locale_terms'] = $this->get_terms('all_terms',$locale_id);
		$returnme['default_terms'] = $this->get_terms('all_terms',$def_locale);
		return $returnme;
	}

	function get_term($terms_id)
	{

		// Now get term
		$sql = "SELECT terms.value, COUNT( rosetta.rosetta_id ) AS the_count
				FROM terms
				INNER JOIN rosetta ON rosetta.terms_id = terms.terms_id
				WHERE terms.terms_id =?";
		$sql = $this->db->query($sql,array($terms_id));
		return $sql->row_array();

	}

	function get_all_terms()
	{
		$sql = $this->db->get('terms');
		return $sql->result_array();

	}

	function term_wlocale($terms_id)
	{
		$locale_id = $this->get_first_locale();

		$sql = "SELECT value
				FROM rosetta
				WHERE terms_id=? AND locale_id=?";
		$sql = $this->db->query($sql,array($terms_id,$locale_id['locale_id']));
		return $sql->row_array();
	}

	function term_delete($terms_id)
	{
		$this->db->trans_start();

		# First delete all terms in rosetta that are set to that terms_id
		$this->db->delete('rosetta',array('terms_id'=>$terms_id));

		# Delete actual term entry
		$this->db->delete('terms',array('terms_id'=>$terms_id));

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE)
		{
		    return FALSE;
		} 
		else
		{
			return TRUE;
		}
	}

	function update_rosetta($comboid,$content)
	{
		$returnme['status']='error';
		list($terms_id,$locale_id) = explode('_', $comboid);
		// First check and make sure there isn't a rosetta value for this yet, if so return it
		$sql = "SELECT rosetta_id, 
				COUNT(rosetta_id) as count 
				FROM rosetta 
				WHERE terms_id=? AND locale_id=?";
		$sql = $this->db->query($sql,array($terms_id,$locale_id));
		$result = $sql->row_array();

		// If new, do an insert on rosetta
		if($result['count']==0)
		{
			$data = array(
				'locale_id' => $locale_id,
				'terms_id' => $terms_id,
				'value' => $content
				);
			if($this->db->insert('rosetta',$data)) $returnme['status']='success';
		}
		else
		{
			// Else do an update
			$data = array(
				'locale_id' => $locale_id,
				'terms_id' => $terms_id,
				'value' => $content
				);
			$this->db->where('rosetta_id', $result['rosetta_id']);
			if($this->db->update('rosetta',$data)) $returnme['status']='success';			
		}
		return $returnme;

	}

	function get_pages($page_id='all')
	{
		if($page_id=='all')
		{
			$sql = $this->db->get('page');
			$results = $sql->result_array();
		}
		else
		{
			$sql = $this->db->get_where('page',array('page_id'=>$page_id));
			$results = $sql->row_array();
		}
		return $results;
	}

	function get_terms_for_page($page_id)
	{
		$sql = "SELECT terms.terms_id, terms.value
				FROM page_group
				INNER JOIN terms ON terms.terms_id = page_group.terms_id
				WHERE page_id =?";
		$sql = $this->db->query($sql,array($page_id));
		return $sql->result_array();
	}

	function pages_insert($page_name,$chosen_options)
	{
		// First insert page name to pages
		$this->db->trans_start();
		$this->db->insert('page',array('value'=>$page_name));

		// Get the page_id created
		$page_id= $this->db->insert_id();

		// foreach chosen_options, insert to page_group
		foreach($chosen_options as $terms_id)
		{
			$this->db->insert('page_group',array('page_id'=>$page_id,'terms_id'=>$terms_id));
		}

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE)
		{
		    return FALSE;
		} 
		else
		{
			return TRUE;
		}
	}

	function pages_delete($page_id)
	{
		$this->db->trans_start();

		# First delete all rows in page_group with that id
		$this->db->delete('page_group',array('page_id'=>$page_id));

		# Delete actual pages entry
		$this->db->delete('page',array('page_id'=>$page_id));

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE)
		{
		    return FALSE;
		} 
		else
		{
			return TRUE;
		}
	}



	
	
	function get_lookup_array($tablename,$defvalue=FALSE)
	{		
		//first getting column names
		$presql= $this->db->query("SHOW COLUMNS FROM $tablename");
		$thekey = $presql->row(0)->Field;
		$thevalue = $presql->row(1)->Field;
		//getting table keys and values
        $this->db->select()->from($tablename)->order_by($thevalue); //This might cause lag as it gets bigger, keep watch on
		$sql = $this->db->get();

		$results = $sql->result_array(); //I know it'll be more than 1 row returned, so no need to verify if rows returned > 0

		//looping through, making a new array and making the value in col1 the key, and value in col2 the value
		foreach ($results as $result)
		{
		$newresults[$result[$thekey]] = $result[$thevalue];
		}
		if($defvalue) $newresults = $defvalue + $newresults;
		return $newresults;	
	}
	

	

	
}
/* End of file dbmojo.php */
/* Location: ./system/application/models/dbmojo.php */
