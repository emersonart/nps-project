<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Feed_company extends CI_Migration
{

	public function up()
	{
		$this->db->insert('companies', [
			'id_company' => 1,
			'name' => 'Ôbar Restaurante',
			'active' => 1
		]);
	}

	public function down()
	{
		$this->db->delete('companies', ['id_company' => 1]);
	}
}
