<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_fk_user_company extends CI_Migration
{

	public function up()
	{
		$this->db->query('ALTER TABLE `users` ADD CONSTRAINT `fk_use_company` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id_company`)');

	}

	public function down()
	{
		$this->db->query('ALTER TABLE `users` DROP CONSTRAINT `fk_use_company`');
	}
}
