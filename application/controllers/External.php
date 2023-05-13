<?php
defined('BASEPATH') or exit('No direct script access allowed');

class External extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->session->unset_userdata('user');
	}

	protected function output_json($data){
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($data));
	}

	public function logout(){
		$this->session->unset_userdata('user');
		set_cookie('nps_cookie_user','',time() - (10 * 365 * 24 * 60 * 60));
		redirect('/');
	}

	public function answer(){
		$this->load->model('Answers_model','answers');
		$json_return = [
			'error' => 1,
			'msg'=>'Não possível registrar sua avaliação!'
		];
		if($this->input->is_ajax_request()){
			if(is_authenticated()){
				$this->form_validation->set_rules('answer','Avaliação','trim|required|is_numeric|greater_than[0]|less_than[6]');
				if($this->form_validation->run() == FALSE){
					$json_return['error'] = 2;
					$json_return['msg'] = validation_errors();
				}else{
					$payload = $this->input->post();
					$data = [
						'id_user' => $this->session->user['id_user'],
						'id_company' => $this->session->user['id_company'],
						'value' => $payload['answer']
					];

					$completed = $this->answers->insert($data);
					if($completed){
						$json_return = [
							'error' => false,
							'msg' => 'Obrigado pela sua avaliação!'
						];
					}else{
						$json_return['error'] = 3;
					}
				}
			}else{
				$json_return['error'] = 4;
			}
		}else{
			$json_return['error'] = 5;
		}
		$this->output_json($json_return);
	}

	public function index(){
		$this->load->library('migration');
		// var_dump($this->migration->find_migrations());

		if (!$this->migration->latest()) {
			show_error($this->migration->error_string());
		}
		if(is_authenticated()){
			
			$this->load->view('external/nps',['title'=>'Avalie o atendimento']);
		}else{
			$this->form_validation->set_rules('login','Login','trim|required');
			$this->form_validation->set_rules('password','Senha','trim|required');
			if($this->form_validation->run() == FALSE){
				if(validation_errors()){
					set_msg(validation_errors(),'warning');
				}
			}else{
				$payload = $this->input->post();
				$login = $this->users->login($payload);
				if($login){
					redirect('/');
				}
				set_msg('Login e/ou senhas inválidos','danger');
			}
			$this->load->view('external/login',['title'=>'NPS: Iniciar sessão']);
		}
	}

}
