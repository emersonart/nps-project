<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{
	protected $admin;
	protected $allowed_fields;
	public function __construct()
	{
		parent::__construct();
		// $this->session->unset_userdata('user');
		$this->load->model('Answers_model','answers');
		$this->admin = $this->session->admin;
		$this->allowed_fields = [
			'name',
			'active',
			'id_company',
			'login',
			'password',
			'admin'
		];
		// die(d($this->session));
	}

	public function index(){
		$users_bd = $this->users->get_all([
			'select' => '*',
			'where' => [
				'id_company' => $this->admin['id_company'],
			]
		]);

		$users = $users_bd ? $users_bd : [];
		foreach($users as $k => $u){
			$average_service = $this->answers->get_all([
				'select' => 'AVG(value) average',
				'where' => [
					'ans.id_company' => $this->admin['id_company'],
					'ans.id_user' => $u['id_user'],
					'ans.id_type' => 1
				],
				'group_by' => 'ans.id_user'
			]);
			$average_service = $average_service ? round($average_service[0]['average'],1) : 0;
			$users[$k]['average_service'] = $average_service;
			$average_food = $this->answers->get_all([
				'select' => 'AVG(value) average',
				'where' => [
					'ans.id_company' => $this->admin['id_company'],
					'ans.id_user' => $u['id_user'],
					'ans.id_type' => 2
				],
				'group_by' => 'ans.id_user'
			]);
			$average_food = $average_food ? round($average_food[0]['average'],1) : 0;
			$users[$k]['average_food'] = $average_food;
		}
		$data=  [
			'title' => 'Usuários',
			'heading' => 'Usuários',
			'users' => $users,
			'active_menu' => 'panel/users'
		];

		load_template($data,'users/index','panel');
	}

	public function validate_login($value,$id_user){
		$u = $this->users->get_all([
			'where' => [
				'user.login' => $value,
				'user.id_user <>' => $id_user
			]
		]);

		if($u){
			$this->form_validation->set_message('validate_login', 'Login já utilizado');
			return false;
		}

		return true;
	}

	public function store(){
		$this->form_validation->set_rules('login','Login','trim|required|min_length[5]|max_length[18]|is_unique[users.id_user]');
		$this->form_validation->set_rules('name','Nome','trim|required|min_length[4]');
		$this->form_validation->set_rules('active','Ativo','trim|required|numeric|in_list[0,1]');
		$this->form_validation->set_rules('admin','Administrador','trim|required|numeric|in_list[0,1]');
		$this->form_validation->set_rules('password','Senha','trim|required|min_length[6]');
	
		
		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors(),'warning');
			}
		}else{
			$payload = $this->input->post();

			$payload['password'] = password_hash(md5($payload['password']),PASSWORD_DEFAULT);
			

			foreach($payload as $k => $v){
				if(!in_array($k,$this->allowed_fields)){
					unset($payload[$k]);
				}
			}

			$insert = $this->users->insert($payload);

			if($insert){
				set_msg('Usuário alterado com sucesso','success');
				redirect('panel/users');
			}else{
				set_msg('Usuário não foi atualizado','danger');
			}
		}
		$data = [
			'title' => 'Cadastrar novo usuário',
			'heading' => 'Cadastrar novo usuário',
			'active_menu' => 'panel/users/store'
		];
		load_template($data,'users/store','panel');
	}

	public function delete($id_user){
		$user = $this->users->getById($id_user);
		if(!$user){
			set_msg('Usuário não encontrado','danger');
			redirect('panel/users');
		}
		if($id_user == $this->admin['id_user']){
			set_msg('Ação não permitida','danger');
			redirect('panel/users');
		}

		if($this->users->delete($id_user)){
			set_msg('Usuário excluído com sucesso','success');
		}else{
			set_msg('Usuário não foi excluído ou já está excluído','danger');
		}

		redirect('panel/users');
	}

	public function edit($id_user){
		$user = $this->users->getById($id_user);
		if(!$user){
			set_msg('Usuário não encontrado','danger');
			redirect('panel/users');
		}
		if($this->input->post()&& $this->input->post()['password']){
			$password_sended = true;
		}else{
			$password_sended = false;
		}
		$this->form_validation->set_rules('login','Login','trim|required|min_length[5]|max_length[18]|callback_validate_login['.$id_user.']');
		$this->form_validation->set_rules('name','Nome','trim|required|min_length[4]');
		$this->form_validation->set_rules('active','Ativo','trim|required|numeric|in_list[0,1]');
		if($password_sended){
			$this->form_validation->set_rules('password','Senha','trim|required|min_length[6]');
		}
		
		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors(),'warning');
			}
		}else{
			$payload = $this->input->post();
			if(!$password_sended){
				if(isset($payload['password'])){
					unset($payload['password']);
				}
			}else{
				$payload['password'] = password_hash(md5($payload['password']),PASSWORD_DEFAULT);
			}

			foreach($payload as $k => $v){
				if(!in_array($k,$this->allowed_fields)){
					unset($payload[$k]);
				}
			}

			$updated = $this->users->update($id_user,$payload);

			if($updated){
				set_msg('Usuário alterado com sucesso','success');
				redirect('panel/users');
			}else{
				set_msg('Usuário não foi atualizado','danger');
			}
		}
		$data = [
			'title' => 'Editar #'.$id_user.": ".$user['name'],
			'heading' => 'Editar #'.$id_user.": ".$user['name'],
			'user' => $user,
			'active_menu' => 'panel/users/edit'
		];
		load_template($data,'users/edit','panel');
	}
}
