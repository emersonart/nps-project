<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_settings extends CI_Migration
{

	public function up()
	{
		$this->dbforge->add_field(array(
			'id_setting' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE,
			)
		));
		$this->dbforge->add_field('`created_at` timestamp NOT NULL DEFAULT current_timestamp()');
		$this->dbforge->add_field(array(
			'value' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			)
		));
		$this->dbforge->add_field('`updated_at` datetime NULL DEFAULT NULL ON UPDATE current_timestamp');
		$this->dbforge->add_field(array(
			'deleted_at' => array(
				'type' => 'DATETIME',
				'constraint' => 0,
				'null' => TRUE
			)
		));
		$this->dbforge->add_key('id_setting', TRUE);
		$this->dbforge->create_table('settings');
		
	}

	public function down()
	{
		$this->dbforge->drop_table('settings');
	}
}
