<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings_model extends MY_Model
{
	protected $table = 'settings';
	protected $primaryKey = 'id_setting';
	protected $fillable = [
		'key',
		'value',
		'updated_at'
	];
	protected $alias = 'st';


	public function __construct()
	{
		parent::__construct();
	}
}
