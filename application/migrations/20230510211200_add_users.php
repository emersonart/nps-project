<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_users extends CI_Migration
{

	public function up()
	{
		$this->dbforge->add_field(array(
			'id_user' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			)
		));
		$this->dbforge->add_field('`created_at` timestamp NOT NULL DEFAULT current_timestamp()');
		$this->dbforge->add_field(array(
			'id_company' => array(
				'type' => 'int',
				'constraint' => 11,
				'unsigned' => TRUE,
				'null' => FALSE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			),
			'login' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			),
			'password' => array(
				'type' => 'TEXT',
				'null' => false
			),
			'active' => array(
				'type' => 'INT',
				'constraint' => 1,
				'default' => 1,
				'null' => false
			),
			'admin' => array(
				'type' => 'INT',
				'constraint' => 1,
				'default' => 0,
				'null' => false
			),
			'last_login' => array(
				'type' => 'DATETIME',
				'constraint' => 0,
				'null' => TRUE
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
		$this->dbforge->add_key('id_user', TRUE);
		$this->dbforge->create_table('users');
	}

	public function down()
	{
		$this->dbforge->drop_table('users');
	}
}
