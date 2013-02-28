<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	public function __construct()
       {
            parent::__construct();
             $this->load->helper(array('url','header','form'));
            $this->load->database();
			$this->load->model('Dbmojo');
			$header['nav'] = make_nav('about');
			$this->load->view('header',$header);
            
       }
	public function index()
	{
		$this->load->view('the_about');
	}
		
		


	
	
	
}

/* End of file about.php */
/* Location: ./application/controllers/about.php */