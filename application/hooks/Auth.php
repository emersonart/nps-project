<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticated_check 
{
	public function verify(){
		$ci =& get_instance();
		if($this->verifyRoute()){

			if(ENVIRONMENT === 'development'){
				$infos = [
					'id_user' => 1,
					'name' => 'Adminsitrador',
					'logged' => true,
					'id_company' => 1
				];
				$ci->session->set_userdata('admin',$infos);
			}
			if(!is_authenticated(TRUE)){
				if(
					(isset($ci->uri->segments[2]) && $ci->uri->segments[2] == 'login') || 
					(isset($ci->uri->segments[1]) && $ci->uri->segments[1] == 'login') ||
					(isset($ci->uri->segments[2]) && $ci->uri->segments[2] == 'admin' &&
					isset($ci->uri->segments[3]) && in_array($ci->uri->segments[3],['backup_sql','get_backup_file']))
				){
					
				}else{
					redirect('panel/login');
				}
				
			}
    }
	}

	protected function verifyRoute(){
		$ci =& get_instance();

		$fromIp = filter_var($_SERVER['HTTP_HOST'], FILTER_VALIDATE_IP);
		if($fromIp){
			ethernal_log('ETH','Verficando rota panel via ip','',__METHOD__);
			return isset($ci->uri->segments[1]) && isset($ci->uri->segments[2]) && $ci->uri->segments[2] == 'panel';
		}else{
			ethernal_log('ETH','Verficando rota panel via URL','',__METHOD__);
			return (isset($ci->uri->segments[1]) && $ci->uri->segments[1] == 'panel');
		}
	}

}
