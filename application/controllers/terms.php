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

class Terms extends CI_Controller {

	public function __construct()
       {
            parent::__construct();
            $this->load->helper(array('url','header','form'));
            $this->load->database();
			$this->load->model('Dbmojo');
			// $header['nav'] = make_nav('terms');
			// $this->load->view('header',$header);
            
            // Your own constructor code
       }
	public function index()
	{
		# $data['the_list']=$this->Dbmojo->get_terms('all');
		$first_locale = $this->Dbmojo->get_first_locale();
		redirect('/terms/view/'.$first_locale['locale_id'],'refresh');

		# $this->load->view('terms_index');
	}

	public function view($locale_id)
	{
		$header['nav'] = make_nav('terms');
		$footer['first_locale'] = $this->Dbmojo->get_first_locale();
		$this->load->view('header',$header);
		$data['the_list']=$this->Dbmojo->get_terms('all_terms',$locale_id);
		$data['locale_dropdown'] = $this->Dbmojo->get_lookup_array('locale');
		$this->load->view('terms_index',$data);
		$this->load->view('js_footer',$footer);
	}

	public function json_view($terms_id)
	{
		header("Content-type: text/json");
		$data = $this->Dbmojo->term_wlocale($terms_id);
		echo utf8_encode(json_encode($data));
	}

	public function add($locale_id)
	{
		$header['nav'] = make_nav('terms');
		$this->load->view('header',$header);
		$data['locale_dropdown'] = $this->Dbmojo->get_lookup_array('locale');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('term_key','Term Key','required|max_length[90]|alpha_dash');
		$this->form_validation->set_rules('rosetta_value','Value','required|max_length[19999]');
		$this->form_validation->set_error_delimiters('<div class="alert"><strong>Error</strong> ', '</div>');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('add_term',$data); //form validation failed
		}
		else
		{
			//form data ok, entering to db
					
			if($this->Dbmojo->terms_insert($locale_id,$this->input->post('term_key'),$this->input->post('rosetta_value')))
			{
				$this->load->view('success',array('message'=>'<strong>'.$this->input->post('term_key').'</strong> was added successfully.')); //added successfully, so tell user				
			}
			else redirect('/error/badentry','refresh');
			
		}
	}

	public function bulk_edit($locale_id)
	{
		$header['nav'] = make_nav('terms');
		$this->load->view('header',$header);
		$data['locale_dropdown'] = $this->Dbmojo->get_lookup_array('locale');
		$footer['first_locale'] = $this->Dbmojo->get_first_locale();
		$temp = array_keys($data['locale_dropdown']);
		sort($temp);
		$temp = reset($temp);

		$data['the_list']=$this->Dbmojo->get_bulk_terms($temp,$locale_id);
		$data['def_lang']=$temp;

		$this->load->view('terms_bulkedit',$data);
		$this->load->view('js_footer',$footer);


	}
	public function update()
	{
		$data = $this->Dbmojo->update_rosetta($this->input->post('id'),$this->input->post('content'));
		header("Content-type: text/json");
		echo utf8_encode(json_encode($data));
		//echo json_encode($_POST);
	}



	public function delete($terms_id,$verify='no')
	{
		$header['nav'] = make_nav('terms');
		$this->load->view('header',$header);
		$data['term']=$this->Dbmojo->get_term($terms_id);

		if ($verify == 'no')
		{
			$this->load->view('delete_term',$data); //form validation failed
		}
		else
		{
			//form data ok, entering to db
			if($this->Dbmojo->term_delete($terms_id))
			{
				$this->load->view('success',array('message'=>'<strong>'.$data['term']['value'].'</strong> was edited successfully.')); //added successfully, so tell user
			}
			else
			{
				redirect('/error/baddeletion','refresh');
			}
					
			;
		}		
	}



	





}

/* End of file terms.php */
/* Location: ./application/controllers/terms.php */