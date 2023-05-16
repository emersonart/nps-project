<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Answers_model extends MY_Model
{
	protected $table = 'answers';
	protected $primaryKey = 'id_answer';
	protected $fillable = [
		'value',
		'updated_at',
	];
	protected $alias = 'ans';


	public function __construct()
	{
		parent::__construct();
		$this->has_many = [
			'users' => array(
				'model' => 'Users_model',
				'alias' => 'user',
				'primary_key' => 'id_user',
				'foreign_key' => 'id_user',
				'relationship' => 'INNER'
			),
			'answers_types' => array(
				'model' => 'Answers_types_model',
				'alias' => 'typ',
				'primary_key' => 'id_type',
				'foreign_key' => 'id_type',
				'relationship' => 'INNER'
			)
		];
	}

	public function get_by_date_range($init_date, $end_date, $id_type = 1, $select = '*')
	{
		$this->db->select($select);
		$this->db->from($this->table . " " . $this->alias);
		$this->db->join('answers_types aty', 'aty.id_type = ' . $this->alias . '.id_type', 'inner');
		$this->db->join('users u', 'u.id_user = ' . $this->alias . ".id_user", 'inner');
		$this->db->join('companies co', 'co.id_company = ' . $this->alias . ".id_company", 'inner');
		$this->db->where("DATE(" . $this->alias . ".created_at) >=", "DATE('" . $init_date . "')", FALSE);
		$this->db->where("DATE(" . $this->alias . ".created_at) <=", "DATE('" . $end_date . "')", FALSE);
		$this->db->where($this->alias . ".id_type", $id_type);

		$query = $this->db->get();

		if ($query) {
			return $query->result_array();
		}

		return false;
	}

	public function get_average_by_date_range($init_date, $end_date, $id_type = 1, $select = '*', $round = true)
	{
		$results = $this->get_by_range($init_date, $end_date, $id_type, $select);
		$average = 0;
		if ($results) {
			$sum = 0;
			foreach ($results as $k => $v) {
				$sum += $v['value'];
			}
			$average = $sum / count($results);
		}

		return $round ? round($average) : $average;
	}
}
