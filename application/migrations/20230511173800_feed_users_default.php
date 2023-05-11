<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Feed_users_default extends CI_Migration
{
	public function up()
	{
		$users_default = array(
			[
				'id_user' => 2,
				'login'=> 'tablet1',
				'name' => 'Tablet 1',
				'id_company' => 1,
				'active' => 1,
				'admin' => 0,
				'password' => password_hash(md5('tablet1'), PASSWORD_DEFAULT)
			],
			[
				'id_user' => 3,
				'login'=> 'tablet2',
				'name' => 'Tablet 2',
				'id_company' => 1,
				'active' => 1,
				'admin' => 0,
				'password' => password_hash(md5('tablet2'), PASSWORD_DEFAULT)
			],
			[
				'id_user' => 4,
				'login'=> 'tablet3',
				'name' => 'Tablet 3',
				'id_company' => 1,
				'active' => 1,
				'admin' => 0,
				'password' => password_hash(md5('tablet3'), PASSWORD_DEFAULT)
			],
			[
				'id_user' => 5,
				'login'=> 'tablet4',
				'name' => 'Tablet 4',
				'id_company' => 1,
				'active' => 1,
				'admin' => 0,
				'password' => password_hash(md5('tablet4'), PASSWORD_DEFAULT)
			]
		);
		foreach ($users_default as $k => $u) {
			$this->db->insert('users', $u);
		}
	}

	public function down()
	{
		foreach ($this->users_default as $k => $u) {
			$this->db->delete('users', ['id_user' => $u['id_user']]);
		}
	}
}
