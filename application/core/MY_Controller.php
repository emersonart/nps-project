<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public $localIp;
	public $sysUrl;
	public function __construct()
	{
		parent::__construct();
		$this->localIp = gethostbyname(gethostname());
		$this->sysUrl = (ENVIRONMENT != 'production' ? $this->localIp.'/'.basename(dirname(set_realpath(APPPATH))) : $this->input->server('HTTP_HOST'));
	}
}
