<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
	protected $admin;
	public function __construct()
	{
		parent::__construct();
		// $this->session->unset_userdata('user');
		$this->load->model('Answers_model','answers');
		$this->admin = $this->session->admin;
	}

	public function index(){
		$get_init_date = $this->input->get('init_date');
		$get_end_date = $this->input->get('end_date');
		
		// die();
		if($get_init_date && strpos($get_init_date,'/') !== false){
			list($gid,$gim,$giy) = explode('/',$get_init_date);
			$get_init_date = $giy."-".$gim."-".$gid;
		}
		if($get_end_date && strpos($get_end_date,'/') !== false){
			list($ged,$gem,$gey) = explode('/',$get_end_date);
			$get_end_date = $gey."-".$gem."-".$ged;
		}

		
		if($get_init_date && $get_end_date && strtotime($get_init_date) <= strtotime($get_end_date)){
			$dInit = new DateTime(date($get_init_date ));
			$dEnd = new DateTime(date($get_end_date));
			$diffDay = $dInit->diff($dEnd)->format('%a');

			

			$init_date = $dInit->format('Y-m-d');
			$end_date = $dEnd->format('Y-m-d');

		}else{
			$dEnd = new DateTime(date('Y-m-d'));
			$dInit = new DateTime($dEnd->format('Y-m-d'));
			$dInit->sub(new DateInterval('P7D'));
			$diffDay = 7;

			$init_date = $dInit->format('Y-m-d');
			$end_date = $dEnd->format('Y-m-d');
		}

		$dEndPast = new DateTime($init_date);
		$dEndPast->sub(new DateInterval('P1D'));

		$init_date_past = $dEndPast->format('Y-m-d');
		$dInitPast = new DateTime($init_date_past);
		$dInitPast->sub(new DateInterval('P'.($diffDay + 1).'D'));

		$past_init_date = $dInitPast->format('Y-m-d');
		$past_end_date = $dEndPast->format('Y-m-d');

		$select_answers = 'ans.*,typ.type,user.name';

		$users = $this->users->get_all([
			'where' => [
				'id_company' => $this->admin['id_company'],
				'admin' => 0
			]
		]);
		$answers = $this->answers->get_all([
			'select' => $select_answers,
			'order_by' => [
				'ans.id_answer' => 'desc'
			],
			'where' => [
				'ans.id_company' => $this->admin['id_company'],
				'DATE(ans.created_at) >='=>$init_date,
				'DATE(ans.created_at) <='=>$end_date,
				'ans.id_type' => 1
			],
			'get_related' => true
		]);
		$answers_past = $this->answers->get_all([
			'where' => [
				'ans.id_company' => $this->admin['id_company'],
				'DATE(ans.created_at) >='=>$past_init_date,
				'DATE(ans.created_at) <='=>$past_end_date,
				'ans.id_type' => 1
			]
		]);
		
		$answers_food = $this->answers->get_all([
			'select' => $select_answers,
			'order_by' => [
				'ans.id_answer' => 'desc'
			],
			'where' => [
				'ans.id_company' => $this->admin['id_company'],
				'DATE(ans.created_at) >='=>$init_date,
				'DATE(ans.created_at) <='=>$end_date,
				'ans.id_type' => 2
			],
			'get_related' => true
		]);

		$answers_food_past = $this->answers->get_all([
			'where' => [
				'ans.id_company' => $this->admin['id_company'],
				'DATE(ans.created_at) >='=>$past_init_date,
				'DATE(ans.created_at) <='=>$past_end_date,
				'ans.id_type' => 2
			]
		]);

		$answers = $answers ? $answers : [];
		$answers_past = $answers_past ? $answers_past : [];
		$answers_food = $answers_food ? $answers_food : [];
		$answers_food_past = $answers_food_past ? $answers_food_past : [];

		$answers_total = array_merge($answers,$answers_food);
		$answers_past_total = array_merge($answers_past,$answers_food_past);

		if($users){
			foreach($users as $k => $user){
				$ur_answers = $this->answers->get_all([
					'where' => [
						'ans.id_company' => $this->admin['id_company'],
						'ans.id_user' => $user['id_user'],
						'DATE(ans.created_at) >='=>$init_date,
						'DATE(ans.created_at) <='=>$end_date,
						'ans.id_type' => 1
					]
				]);

				$ur_answers = $ur_answers ? $ur_answers : [];
				$ur_answers_average = array_reduce($ur_answers,function ($carry,$item) {
					$carry += $item['value'];
					return $carry;
				} ,0);
				$ur_answers_average = $ur_answers_average ? round($ur_answers_average / count($ur_answers),1) : 0;
				$users[$k]['answers_average'] = $ur_answers_average;
				$users[$k]['answers'] = $ur_answers;

				$ur_answers_food = $this->answers->get_all([
					'where' => [
						'ans.id_company' => $this->admin['id_company'],
						'ans.id_user' => $user['id_user'],
						'DATE(ans.created_at) >='=>$init_date,
						'DATE(ans.created_at) <='=>$end_date,
						'ans.id_type' => 2
					]
				]);
				$ur_answers_food = $ur_answers_food ? $ur_answers_food : [];
				$ur_answers_food_average = array_reduce($ur_answers_food,function ($carry,$item){
					$carry += $item['value'];
					return $carry;
				} ,0);
				$ur_answers_food_average = $ur_answers_food_average ? round($ur_answers_food_average / count($ur_answers_food),1) : 0;
				$users[$k]['answers_food_average'] = $ur_answers_food_average;
				$users[$k]['answers_food'] = $ur_answers_food;
			}
		}
		

		$diff_percent = 0;

		if($answers_total && $answers_past_total){
			$orig = count($answers_past_total);
			$atual = count($answers_total);
			$diff_percent = round((($atual - $orig) / $orig) * 100,1);
		}

		$average = $average_past = $average_food = $average_food_past = 0;

		if($answers){
			$cAv = 0;
			foreach($answers as $k => $v){
				$cAv += $v['value'];
			}
			$average = round($cAv / count($answers),1);
		}
		if($answers_past){
			$cAv = 0;
			foreach($answers_past as $k => $v){
				$cAv += $v['value'];
			}
			$average_past = round($cAv / count($answers_past),1);
		}
	

		$diff_average_percent = 0;
		if($average_past > 0){
			$diff_average_percent = round(((($average - $average_past) / $average_past) * 100),1);
		}
		

		if($answers_food){
			$cAv = 0;
			foreach($answers_food as $k => $v){
				$cAv += $v['value'];
			}
			$average_food = round($cAv / count($answers_food),1);
		}
		if($answers_food_past){
			$cAv = 0;
			foreach($answers_food_past as $k => $v){
				$cAv += $v['value'];
			}
			$average_food_past = round($cAv / count($answers_food_past),1);
		}
		$diff_average_food_percent = 0;
		if($average_food_past > 0){
			$diff_average_food_percent = round(((($average_food - $average_food_past) / $average_food_past) * 100),1);
		}
		$answers_by_day = $answers_food_by_day = $answers_by_day_prev = $answers_food_by_day_prev = [];
		foreach($answers as $k => $v){
			$dt = date('Y-m-d',strtotime($v['created_at']));
			if(!isset($answers_by_day_prev[$dt])){
				$answers_by_day_prev[$dt] = 0;
			}
			$answers_by_day_prev[$dt] += 1;
			
		}
		foreach($answers_food as $k => $v){
			$dt = date('Y-m-d',strtotime($v['created_at']));
			if(!isset($answers_food_by_day_prev[$dt])){
				$answers_food_by_day_prev[$dt] = 0;
			}
			$answers_food_by_day_prev[$dt] += 1;
			
		}
		$unMount = true;
		$arrayLabelsLineChart = [];
		$curDate = $init_date;
		while($unMount){
			if(!in_array(date('d/m/Y',strtotime($curDate)),$arrayLabelsLineChart)){
				$arrayLabelsLineChart[] = date('d/m/Y',strtotime($curDate));
				if(isset($answers_by_day_prev[$curDate])){
					$answers_by_day[] = $answers_by_day_prev[$curDate];
				}else{
					$answers_by_day[] = 0;
				}
				if(isset($answers_food_by_day_prev[$curDate])){
					$answers_food_by_day[] = $answers_food_by_day_prev[$curDate];
				}else{
					$answers_food_by_day[] = 0;
				}
				if(strtotime($curDate) < strtotime($end_date)){
					$curDate = date('Y-m-d',strtotime($curDate." + 1 day"));
				}else{
					$unMount = false;
				}
				
			}
		}



		$data = [
			'users' => $users ? $users : [],
			'answers' => $answers ? $answers : [],
			'answers_past' => $answers_past ? $answers_past : [],
			'answers_food' => $answers_food ? $answers_food : [],
			'answers_food_past' => $answers_food_past ? $answers_food_past : [],
			'answers_total' => $answers_total,
			'answers_past_total'=> $answers_past_total,
			'init_date' => $init_date,
			'end_date' => $end_date,
			'init_past_date' => $past_init_date,
			'end_past_date' => $past_end_date,
			'title' => 'Painel administrativo',
			'diffDays' => $diffDay,
			'diffCountAnswers' => $diff_percent,
			'average' => $average,
			'average_past' => $average_past,
			'diffCountAveragePast' => $diff_average_percent,
			'diffCountAverageFoodPast' => $diff_average_food_percent,
			'average_food' => $average_food,
			'average_food_past' => $average_food_past,
			'answers_by_day' => $answers_by_day,
			'answers_food_by_day' => $answers_food_by_day,
			'arrayLabelsLineChart' => $arrayLabelsLineChart
		];

		load_template($data,'dashboard','panel');
	}

	
}
