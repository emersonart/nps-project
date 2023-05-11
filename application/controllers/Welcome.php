<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		// $this->load->view('welcome_message');
		load_template(['sysurl'=>$this->sysUrl],'home','panel');
	}

	public function test()
	{
		$this->load->library('migration');
		// var_dump($this->migration->find_migrations());

		if (!$this->migration->latest()) {
			show_error($this->migration->error_string());
		}

		var_dump($this->migration->latest());
	}
}
