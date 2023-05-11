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
	}
}
