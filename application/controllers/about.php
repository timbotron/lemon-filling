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