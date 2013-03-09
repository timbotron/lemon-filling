<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct()
       {
            parent::__construct();
            $this->load->helper(array('url','header','form','format'));
            $this->load->database();
			$this->load->model('Dbmojo');
            
            // Your own constructor code
       }
	public function index()
	{
		$header['nav'] = make_nav('pages');
		$this->load->view('header',$header);
		$data['the_list']=$this->Dbmojo->get_pages('all');
		$footer['first_locale'] = $this->Dbmojo->get_first_locale();

		$this->load->view('pages_index',$data);
		$this->load->view('js_footer',$footer);
	}


	public function add()
	{
		$header['nav'] = make_nav('pages');
		$this->load->view('header',$header);
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

	public function edit($page_id)
	{
		$header['nav'] = make_nav('pages');
		$this->load->view('header',$header);
		$all_terms = $this->Dbmojo->get_all_terms();
		$chosen_terms = $this->Dbmojo->get_terms_for_page($page_id);
		$footer['first_locale'] = $this->Dbmojo->get_first_locale();
		$data['terms_dropdown'] = prep_terms_options($all_terms);
		$data['chosen_terms_dropdown'] = prep_terms_options($chosen_terms);
		$data['page_info'] = $this->Dbmojo->get_pages($page_id);
		$data['terms_dropdown'] = array_diff($data['terms_dropdown'], $data['chosen_terms_dropdown']);

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
					
			if($this->Dbmojo->pages_insert($this->input->post('page_name'),$this->input->post('chosen_options')) AND $this->Dbmojo->pages_delete($page_id))
			{
				$this->load->view('success',array('message'=>'<strong>'.$this->input->post('page_name').'</strong> was updated successfully.')); //added successfully, so tell user				
			}
			else redirect('/error/badentry','refresh');
			
		}
	}


	public function delete($page_id)
	{
		$header['nav'] = make_nav('pages');
		$this->load->view('header',$header);
		//form data ok, entering to db
		if($this->Dbmojo->pages_delete($page_id))
		{
			$this->load->view('success',array('message'=>'the page was deleted successfully.')); //deleted successfully, so tell user
		}
		else
		{
			redirect('/error/baddeletion','refresh');
		}					
				
	}

	public function json($page_name,$locale_id)
	{
		header("Content-type: text/json");
		$data = $this->Dbmojo->get_terms($page_name,$locale_id);
		$data = prep_json_terms($data);
		echo utf8_encode(json_encode($data));
	}


}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */