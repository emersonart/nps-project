<?php
defined('BASEPATH') or exit('No direct script access allowed');

class External extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$this->load->library('migration');
		// var_dump($this->migration->find_migrations());

		if (!$this->migration->latest()) {
			show_error($this->migration->error_string());
		}
		if(is_authenticated()){
			echo '1';
		}else{
			$this->load->view('external/login');
		}
	}

}
