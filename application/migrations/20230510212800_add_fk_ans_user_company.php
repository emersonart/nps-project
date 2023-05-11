<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_fk_ans_user_company extends CI_Migration
{

	public function up()
	{
		$this->db->query('ALTER TABLE `answers` ADD CONSTRAINT `fk_ans_company` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id_company`)');
		$this->db->query('ALTER TABLE `answers` ADD CONSTRAINT `fk_ans_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)');

	}

	public function down()
	{
		$this->db->query('ALTER TABLE `answers` DROP CONSTRAINT `fk_ans_company`');
		$this->db->query('ALTER TABLE `answers` DROP CONSTRAINT `fk_ans_user`');
	}
}
