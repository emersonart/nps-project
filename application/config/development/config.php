<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config['base_path_name'] = basename(dirname(realpath(APPPATH)));
$config['base_url'] = filter_var($_SERVER['HTTP_HOST'], FILTER_VALIDATE_IP) ? 'http://'.$_SERVER['HTTP_HOST'].'/'.$config['base_path_name'] : 'http://npsproject.dev.local/';

$config['index_page'] = '';
