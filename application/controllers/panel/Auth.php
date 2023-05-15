<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->session->unset_userdata('user');
	}

	public function index()
	{
		$this->form_validation->set_rules('login', 'Login', 'trim|required');
		$this->form_validation->set_rules('password', 'Senha', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			if (validation_errors()) {
				set_msg(validation_errors(), 'warning');
			}
		} else {
			$payload = $this->input->post();
			$login = $this->users->login($payload,true);
			if ($login) {
				redirect('/panel/dashboard');
			}
			set_msg('Login e/ou senhas inválidos', 'danger');
		}
		$this->load->view('panel/login',['title'=>'Acessar area restrita']);
	}

	public function logout(){
		$this->session->unset_userdata('admin');
		set_cookie('nps_cookie_admin','',time() - (10 * 365 * 24 * 60 * 60));
		set_msg('Deslogado com sucesso', 'success');
		redirect('/panel/login');
	}
}
