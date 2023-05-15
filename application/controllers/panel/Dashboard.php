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
		if($this->input->get('init_date') && $this->input->get('end_date') && strtotime($this->input->get('init_date')) <= strtotime($this->input->get('end_date'))){
			$dInit = new DateTime(date($this->input->get('init_date') ));
			$dEnd = new DateTime(date($this->input->get('end_date')));
			$diffDay = $dInit->diff($dEnd)->format('%a');

			

			$init_date = $dInit->format('Y-m-d');
			$end_date = $dEnd->format('Y-m-d');

		}else{
			$dEnd = new DateTime(date('Y-m-d'));
			$dInit = new DateTime($dEnd->format('Y-m-d'));
			$dInit->sub(new DateInterval('P30D'));
			$diffDay = 30;

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



		$users = $this->users->get_all([
			'where' => [
				'id_company' => $this->admin['id_company'],
				'admin' => 0
			]
		]);
		$answers = $this->answers->get_all([
			'where' => [
				'ans.id_company' => $this->admin['id_company'],
				'DATE(ans.created_at) >='=>$init_date,
				'DATE(ans.created_at) <='=>$end_date,
				'ans.id_type' => 1
			]
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
			'where' => [
				'ans.id_company' => $this->admin['id_company'],
				'DATE(ans.created_at) >='=>$init_date,
				'DATE(ans.created_at) <='=>$end_date,
				'ans.id_type' => 2
			]
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
				$users[$k]['answers'] = $this->answers->get_all([
					'where' => [
						'ans.id_company' => $this->admin['id_company'],
						'ans.id_user' => $user['id_user'],
						'DATE(ans.created_at) >='=>$init_date,
						'DATE(ans.created_at) <='=>$end_date,
					]
				]);
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
