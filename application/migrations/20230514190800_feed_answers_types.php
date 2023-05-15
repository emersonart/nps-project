<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Feed_answers_types extends CI_Migration
{
	public function up()
	{
		$defaults = array(
			[
				'id_type' => 1,
				'type'=> 'Atendimento',
			],
			[
				'id_type' => 2,
				'type'=> 'Comida',
			],

		);
		foreach ($defaults as $k => $u) {
			$this->db->insert('answers_types', $u);
		}
	}

	public function down()
	{
		$defaults = array(
			[
				'id_type' => 1,
				'type'=> 'Atendimento',
			],
			[
				'id_type' => 2,
				'type'=> 'Comida',
			],

		);
		foreach ($defaults as $k => $u) {
			$this->db->delete('answers_types', ['id_type' => $u['id_type']]);
		}
	}
}
