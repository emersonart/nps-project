<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('enviar_email')){
	function enviar_email($values,$template = 'fale_conosco',$array_custom_from = false){
		$ci = &get_instance();
		$ci->load->library('email');
		if($array_custom_from){
			
			$config['useragent']        = 'PHPMailer';              // Mail engine switcher: 'CodeIgniter' or 'PHPMailer'
			$config['protocol']         = 'smtp';                   // 'mail', 'sendmail', or 'smtp'
			$config['mailpath']         = '/usr/sbin/sendmail';
			$config['smtp_host']        = '---';
			$config['smtp_auth']        = true;                     // Whether to use SMTP authentication, boolean TRUE/FALSE. If this option is omited or if it is NULL, then SMTP authentication is used when both $config['smtp_user'] and $config['smtp_pass'] are non-empty strings.

			$config['smtp_user']        = $array_custom_from['email'];
			$config['smtp_pass']        = $array_custom_from['password'];
			$config['smtp_port']        = '587';
			$config['smtp_timeout']     = 30;                       // (in seconds)
			$config['smtp_crypto']      = 'tls';                       // '' or 'tls' or 'ssl'
			$config['smtp_debug']       = 3;                        // PHPMailer's SMTP debug info level: 0 = off, 1 = commands, 2 = commands and data, 3 = as 2 plus connection status, 4 = low level data output. 
			$config['debug_output']     = 'mailer_log';                       // PHPMailer's SMTP debug output: 'html', 'echo', 'error_log' or user defined function with 
			$config['priority']         = 1;   
			$ci->email->initialize($config);
		}
		
		if($template != 'fale_conosco'){
			$ci->lang->load('information',$ci->config->config['languages'][(isset($values['lang']) ? $values['lang'] : 'pt-br')]);
		}
		
		if(isset($values['assunto'])){
			$subject = $values['assunto'];
		}else{
			if($template == 'newsletters_news'){
				$subject = lang('new_post_blog');
			}else{
				$subject = 'Contato via site';
			}
			
		}
		$values['assunto'] = $subject;
		if(!isset($values['dataehora'])){
			$values['dataehora'] = date('d/m/Y \à\s H:i');
		}
		$values['endereco_empresa'] = "---";
		
		$body = $ci->load->view('emails/' . $template, $values, true);
		if($array_custom_from){
			$returnpath = $array_custom_from['return_path'] ? $array_custom_from['return_path'] : NULL;
			$ci->email->from($array_custom_from['email'], $array_custom_from['nome'], $returnpath);
		}else{
			$ci->email->from(EMAIL_SITE, SITE_NAME);
		}
		
		if($template == 'fale_conosco' ){
			$ci->email->to('info@hennekamwines.com', 'Hennekam Wines');
			$ci->email->reply_to($values['email_send'],isset($values['nome']) ? $values['nome'] : 'Hennekam Wines');
		}else{
			$ci->email->to((isset($values['email']) ? $values['email'] : 'info@hennekamwines.com'), isset($values['nome']) ? $values['nome'] : 'Hennekam Wines');
		}

		if(isset($values['reply_to']) && is_array($values['reply_to'])){
			$ci->email->reply_to($values['reply_to']['email'],$values['reply_to']['name']);
		}

		if(isset($values['copy_to']) && is_array($values['copy_to'])){
			$ci->email->bcc($values['copy_to']);
		}
		if(isset($values['file']) && is_array($values['file'])){
			$ci->email->attach($values['file']['file'],'attachment',$values['file']['name']);
		}
		if(isset($values['files']) && is_array($values['files'])){
			foreach($values['files'] as $k => $file){
				$ci->email->attach($file['file'], 'attachment',$file['name']);
			}
			
		}
		
		$ci->email->subject($subject);
		$ci->email->message($body);
		$ci->email->charset = 'UTF-8';
		return $ci->email->send();
	}
}

if(!function_exists('mailer_log')){
		function mailer_log($msg,$tipo,$valor = NULL,$instance = NULL){
			if($valor){
				$msg = $msg.": ".$valor;
			}
			if($instance){
				$msg = $instance." -> ".$msg;
			}
			$msg = utf8_encode($msg);

			log_message('ETH',$msg);
		}
	}

