<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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