<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends MY_Model
{
	protected $table = 'users';
	protected $primaryKey = 'id_user';
	protected $fillable = [
		'name',
		'id_company',
		'password',
		'login',
		'admin',
		'active',
		'updated_at',
		'last_login'
	];
	protected $alias = 'user';


	public function __construct()
	{
		parent::__construct();
	}

	public function login($data,$admin = false,$from_cookie = false){
		if(!isset($data['login']) || !isset($data['password'])){
			if(!$from_cookie){
				ethernal_log('ETH','não enviado login ou senha');
				return false;
			}
			
		}
		
		if($from_cookie){
			$payload = [
				'where' => [
					'user.admin' => $admin ? '1' : '0',
					'md5(user.id_user)' => $data['cookie_user']
				]
			];
		}else{
			$password = md5($data['password']);
			$payload = [
				'where' => [
					'user.admin' => $admin ? '1' : '0',
					'user.login' => $data['login']
				]
			];
		}
		$results = $this->get_all($payload);
		if($results){
			$result = $results[0];

			if($from_cookie || password_verify($password,$result['password'])){
				set_cookie('nps_cookie_'.($admin ? 'admin' : 'user'),md5($result['id_user']),time() + (10 * 365 * 24 * 60 * 60));

				$last_login = date('Y-m-d H:i:s');
				$this->update($result['id_user'],[
					'last_login' => $last_login
				]);
				// unset($result['password']);
				if($admin){
					$key = 'admin';
				}else{
					$key = 'user';
				}

				$this->session->set_userdata($key,[
					'logged' => true,
					'name' => $result['name'],
					'id_company' => $result['id_company'],
					'id_user' => $result['id_user'],
					'last_login' => $last_login
				]);

				return TRUE;
			}else{
				ethernal_log('ETH','senha inválida',json_encode(['senha_enviada'=>md5($data['password']),'senha_banco'=>$result['password']]));
			}
		}else{
			ethernal_log('ETH','Não encontrado');
		}

		return false;
	}
}
