<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticated_check 
{
	public function verify(){
		$ci =& get_instance();
		$allow = $this->verifyRoute();
		ethernal_log('ETH','ALLOW',($allow ? '(1)' : '(0)'),__METHOD__);
		if($allow){

			if(ENVIRONMENT === 'development'){
				$infos = [
					'id_user' => 1,
					'name' => 'Administrador',
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
			// ethernal_log('ETH','Verficando rota panel via ip',json_encode([$ci->uri->segments[1],(isset($ci->uri->segments[2]) ? '1' : '0'),$ci->uri->segments[2]]),__METHOD__);
			if(isset($ci->uri->segments[1])){
				if($ci->uri->segments[1] == 'panel'){
					return true;
				}
				if(isset($ci->uri->segments[2])){
					if($ci->uri->segments[2] == 'panel'){
						return true;
					}
				}

				return in_array('panel',$ci->uri->segments);
				
			}
			return false;
		}else{
			ethernal_log('ETH','Verficando rota panel via URL','',__METHOD__);
			return (isset($ci->uri->segments[1]) && $ci->uri->segments[1] == 'panel');
		}
	}

}
