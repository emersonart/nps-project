<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_column_id_type_to_answers extends CI_Migration
{

	public function up()
	{
		$fields = array(
			'id_type' => [
				'type' => 'INT',
				'constraint' => 11,
				'default' => 1,
				'unsigned' => TRUE,
				'null' => false
			]
		);

		$this->dbforge->add_column('answers',$fields);
		$this->db->query('ALTER TABLE `answers` ADD CONSTRAINT `fk_ans_type` FOREIGN KEY (`id_type`) REFERENCES `answers_types` (`id_type`)');
	}

	public function down()
	{
		$this->db->query('ALTER TABLE `answers` DROP CONSTRAINT `fk_ans_type`');
	}
}
