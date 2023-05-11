<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Companies_model extends MY_Model
{
	protected $table = 'companies';
	protected $primaryKey = 'id_company';
	protected $fillable = [
		'name',
		'active',
		'updated_at',
	];
	protected $alias = 'comp';


	public function __construct()
	{
		parent::__construct();
	}
}
