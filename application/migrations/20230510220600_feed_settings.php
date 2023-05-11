<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Feed_settings extends CI_Migration
{

	public function up()
	{
		$this->db->insert('settings', [
			'id_setting' => 'installed',
			'value' => '1',
		]);
	}

	public function down()
	{
		$this->db->delete('settings', ['id_setting' => 'installed']);
	}
}
