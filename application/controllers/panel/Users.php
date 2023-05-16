<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{
	protected $admin;
	public function __construct()
	{
		parent::__construct();
		// $this->session->unset_userdata('user');
		$this->load->model('Answers_model','answers');
		$this->admin = $this->session->admin;
	}

	public function index(){
		$users_bd = $this->users->get_all([
			'select' => '*',
			'where' => [
				'id_company' => $this->admin['id_company'],
			]
		]);

		$users = $users_bd ? $users_bd : [];

		foreach($users as $k => $user){

		}

		d($users);
	}
}
