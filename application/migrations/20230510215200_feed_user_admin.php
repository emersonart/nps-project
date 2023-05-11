<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Feed_user_admin extends CI_Migration
{

	public function up()
	{
		$this->db->insert('users', [
			'id_user' => 1,
			'name' => 'Administrador',
			'id_company' => 1,
			'active' => 1,
			'admin' => 1,
			'password' => password_hash(md5('123456'), PASSWORD_DEFAULT)
		]);
	}

	public function down()
	{
		$this->db->delete('users', ['id_user' => 1]);
	}
}
