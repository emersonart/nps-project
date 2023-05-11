<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_companies extends CI_Migration
{

	public function up()
	{
		$this->dbforge->add_field(array(
			'id_company' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			)
		));
		$this->dbforge->add_field('`created_at` timestamp NOT NULL DEFAULT current_timestamp()');
		$this->dbforge->add_field(array(
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			),
			'active' => array(
				'type' => 'INT',
				'constraint' => 1,
				'default' => 1,
				'null' => false
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
		$this->dbforge->add_key('id_company', TRUE);
		$this->dbforge->create_table('companies');
	}

	public function down()
	{
		$this->dbforge->drop_table('companies');
	}
}
