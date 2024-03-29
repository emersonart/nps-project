<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('load_template')) {
	function load_template($data, $template, $type = 'painel')
	{
		$ci = &get_instance();
		if(!isset($data['active_menu'])){
			$data['active_menu'] = '';
		}
		if (!isset($data['title'])) {
			$data['title'] = ENVIRONMENT != 'production' ? gethostbyname(gethostname()) : SITE_NAME;
		} else {
			$data['title'] = $data['title'] . " - " . SITE_NAME;
		}
		if (!isset($data['heading'])) {
			$data['heading'] = SITE_NAME;
		}
		switch ($type) {
			case 'site':


				break;

			default:
				$data['auth_user'] = $ci->session->admin;
				$ci->load->view('templates/panel/header', $data);
				$ci->load->view('panel/' . $template);
				$ci->load->view('templates/panel/footer');
				break;
		}
	}
}

if (!function_exists('ethernal_log')) {
	function ethernal_log($tipo, $msg, $valor = NULL, $instance = NULL)
	{
		if ($valor) {
			if (is_array($valor) || is_object($valor)) {
				try {
					$valor = json_encode((array) $valor);
				} catch (Exception $e) {
					$valor = json_encode(array_map('encodeUtf8', (array) $valor));
				}
			}
			$msg = $msg . ": " . $valor;
		}
		if ($instance) {
			$msg = $instance . " --> " . $msg;
		}

		log_message($tipo, $msg);
	}
}

if (!function_exists('set_active')) {
	function set_active($param, $bind = '')
	{
		$ci = &get_instance();

		if (strpos($ci->uri->uri_string(), $param) !== FALSE) {
			return 'active';
		} else {
			if ($bind && strpos($ci->uri->uri_string(), $bind) !== FALSE) {
				return 'active';
			}
		}
		return $ci->uri->uri_string();
	}
}

//set a message info-box
if (!function_exists('set_msg')) {
	function set_msg($msg = NULL, $tipo = 'dark', $icon = FALSE, $dismiss = TRUE)
	{
		$ci = &get_instance();
		$extra = $dis = '';
		if ($msg == NULL) {
			$ci->session->set_userdata('alert-eth', $msg);
		} else {
			if ($dismiss) {
				$extra = '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
				$dis = 'alert-dismissible';
			}
			if ($icon) {
				$icon = '<i class="aling-self-center fa ' . $icon . '"></i>';
			}
			$msg = '<div class="d-flex align-itens-center justify-content-between text-center alert ' . $dis . ' alert-' . $tipo . '" role="alert">' . $icon . "<div class='text-left'>" . $msg . "</div>" . $extra . '</div>';
			$ci->session->set_userdata('alert-eth', $msg);
		}
	}
}

//display a message
if (!function_exists('get_msg')) {
	function get_msg($destroy = TRUE)
	{
		$ci = &get_instance();
		$retorno = $ci->session->userdata('alert-eth');
		if ($destroy) {
			$ci->session->unset_userdata('alert-eth');
		}
		return $retorno;
	}
}

if (!function_exists('is_authenticated')) {
	function is_authenticated($admin = false)
	{
		$ci = &get_instance();
		$key = $admin ? 'admin' : 'user';
		if ($ci->session->userdata($key) && $ci->session->userdata($key)['logged']) {
			$dt = $ci->session->userdata($key);
			if(!isset($dt['last_login']) || date('Y-m-d',strtotime($dt['last_login'])) != date('Y-m-d')){
				$last_login = date('Y-m-d H:i:s');
				$ci->users->update($dt['id_user'],[
					'last_login' => $last_login
				]);
				$dt['last_login'] = $last_login;

				$ci->session->set_userdata($key,$dt);
			}
			return TRUE;
		}else if(get_cookie('nps_cookie_'.$key)){
			$logged = $ci->users->login(['cookie_user'=>get_cookie('nps_cookie_'.$key)],$admin,true);
			return $logged;
		}
		return FALSE;
	}
}
