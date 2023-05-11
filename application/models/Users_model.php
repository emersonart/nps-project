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

	public function login($data,$admin = false){
		if(!isset($data['login']) || !isset($data['password'])){
			return false;
		}
		$results = $this->get_all([
			'where' => [
				'user.admin' => $admin ? '1' : '0',
				'user.login' => $data['login']
			]
			]);
		if($results){
			$result = $results[0];
			if(password_verify(md5($data['password']),$result['password'])){
				unset($result['password']);
				if($admin){
					$key = 'admin';
				}else{
					$key = 'user';
				}

				$this->session->set_userdata($key,[
					'logged' => true,
					'name' => $result['name'],
					'id_company' => $result['id_company'],
					'id_user' => $result['id_user']
				]);

				return TRUE;
			}
		}

		return false;
	}
}
