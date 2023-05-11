<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['base_url'] = filter_var($_SERVER['HTTP_HOST'], FILTER_VALIDATE_IP) ? 'http://'.$_SERVER['HTTP_HOST'].'/'.basename(dirname(realpath(APPPATH))) : 'http://npsproject.dev.local/';

$config['index_page'] = '';
