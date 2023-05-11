<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticated_check 
{
	public function verify(){
		$ci =& get_instance();
		if((isset($ci->uri->segments[1]) && $ci->uri->segments[1] == 'painel')){

			if(ENVIRONMENT === 'development'){
				$infos = [
					'id_user' => 1,
					'name' => 'Adminsitrador',
					'logged' => true
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
					redirect('login');
				}
				
			}
    }
	}

}
