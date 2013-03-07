<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct()
       {
            parent::__construct();
            $this->load->helper(array('url','header','form','format'));
            $this->load->database();
			$this->load->model('Dbmojo');
			$header['nav'] = make_nav('pages');
			$this->load->view('header',$header);
            
            // Your own constructor code
       }
	public function index()
	{
		$data['the_list']=$this->Dbmojo->get_pages('all');
		$first_locale = $this->Dbmojo->get_first_locale();

		$this->load->view('pages_index',$data);
	}

	public function add()
	{
		$all_terms = $this->Dbmojo->get_all_terms();
		$footer['first_locale'] = $this->Dbmojo->get_first_locale();
		$data['terms_dropdown'] = prep_terms_options($all_terms);

		$this->load->library('form_validation');
		$this->form_validation->set_rules('page_name','Page Name','required|max_length[90]|alpha_dash');
		$this->form_validation->set_error_delimiters('<div class="alert"><strong>Error</strong> ', '</div>');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('add_pages',$data); //form validation failed
			$this->load->view('js_footer',$footer);
		}
		else
		{
			//form data ok, entering to db
					
			if($this->Dbmojo->pages_insert($this->input->post('page_name'),$this->input->post('chosen_options')))
			{
				$this->load->view('success',array('message'=>'<strong>'.$this->input->post('page_name').'</strong> was added successfully.')); //added successfully, so tell user				
			}
			else redirect('/error/badentry','refresh');
			
		}
	}

	public function edit($page_name)
	{
		$all_terms = $this->Dbmojo->get_all_terms();
		$chosen_terms = $this->Dbmojo->get_terms_for_page($page_name);
		$footer['first_locale'] = $this->Dbmojo->get_first_locale();
		$data['terms_dropdown'] = prep_terms_options($all_terms);
		$data['chosen_terms_dropdown'] = prep_terms_options($chosen_terms);

		$this->load->library('form_validation');
		$this->form_validation->set_rules('page_name','Page Name','required|max_length[90]|alpha_dash');
		$this->form_validation->set_error_delimiters('<div class="alert"><strong>Error</strong> ', '</div>');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('edit_pages',$data); //form validation failed
			$this->load->view('js_footer',$footer);
		}
		else
		{
			//form data ok, entering to db
					
			if($this->Dbmojo->pages_update($this->input->post('page_name'),$this->input->post('chosen_options')))
			{
				$this->load->view('success',array('message'=>'<strong>'.$this->input->post('page_name').'</strong> was updated successfully.')); //added successfully, so tell user				
			}
			else redirect('/error/badentry','refresh');
			
		}
	}

	public function view($page_id)
	{
		$header['nav'] = make_nav('terms');
		$this->load->view('header',$header);
		$data['the_list']=$this->Dbmojo->get_terms('all_terms',$page_id);
		$data['locale_dropdown'] = $this->Dbmojo->get_lookup_array('locale');
		$this->load->view('terms_index',$data);
		$this->load->view('js_footer');
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

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */