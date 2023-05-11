<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
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
}
