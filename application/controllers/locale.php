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
    
class Locale extends CI_Controller {

	public function __construct()
       {
            parent::__construct();
            $this->load->helper(array('url','header'));
            $this->load->database();
			$this->load->model('Dbmojo');
			$header['nav'] = make_nav();
			$this->load->view('header',$header);
            
            // Your own constructor code
       }
	public function index()
	{
		$data['the_list']=$this->Dbmojo->get_locales('all');		
		$this->load->view('locale_index',$data);
	}

	public function add()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('value','Locale Value','required');
		$this->form_validation->set_error_delimiters('<div class="alert"><strong>Error</strong> ', '</div>');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('add_locale'); //form validation failed
		}
		else
		{
			//form data ok, entering to db
					
			$this->Dbmojo->locale_insert();
			$this->load->view('success',array('message'=>'<strong>'.$this->input->post('value').'</strong> was added successfully.')); //added successfully, so tell user
		}
	}

	public function edit($id)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('value','Locale Value','required');
		$this->form_validation->set_error_delimiters('<div class="alert"><strong>Error</strong> ', '</div>');
		$data['passed']=$this->Dbmojo->get_locales($id);
		$data['num_terms']=$this->Dbmojo->get_localeterms($id);

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('edit_locale',$data); //form validation failed
		}
		else
		{
			//form data ok, entering to db
					
			$this->Dbmojo->locale_update($id);
			$this->load->view('success',array('message'=>'<strong>'.$this->input->post('value').'</strong> was edited successfully.')); //added successfully, so tell user
		}
	}

	public function delete($id)
	{
		if($this->Dbmojo->locale_delete($id))
		{
			$this->load->view('success',array('message'=>'<strong>'.$this->input->post('value').'</strong> was deleted successfully.')); //added successfully, so tell user
		}
		else
		{
			redirect('/error/baddeletion','refresh');
		}
	}



	





}

/* End of file locale.php */
/* Location: ./application/controllers/locale.php */