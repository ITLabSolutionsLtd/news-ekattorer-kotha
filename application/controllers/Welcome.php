<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function index()
	{
		$data = array();
		$data['content'] = $this->load->view('admin_pages/dashboard','',true);
		$this->load->view('include/admin_template',$data);
	}
	
}
