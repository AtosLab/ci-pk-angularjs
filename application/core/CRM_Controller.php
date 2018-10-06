<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CRM_Controller extends CI_Controller
{
	public $user;
	public $time;
	public $memberSessionName = 'member-session-name';

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->helper('url');

        $this->load->model('member_session_model');
        $this->load->model('members_model');
        $this->load->model('guestmembers_model');
        $this->load->model('member_bank_model');
        $this->load->model('bank_list_model');
        $this->load->model('report_model');
        $this->load->model('guestbets_model');
        $this->load->model('bets_model');
        $this->load->model('type_model')	;
        $this->load->model('data_time_model');
        $this->load->model('common_ssc_model');
        $this->load->model('member_cash_model');
        $this->load->model('order_model');
        $this->load->model('member_recharge_model');
        
        try{
        	$this->time=intval($_SERVER['REQUEST_TIME']);
        	
			if($this->session->userdata($this->memberSessionName)) {
				$this->user = unserialize($this->session->userdata($this->memberSessionName));
				$this->updateSessionTime();
			}
			if(isset($this->user) && $this->user['uid']){
				if(!$this->input->cookie('token')){
					$token = base64_encode(crypt(session_id(), $this->user['username']).md5($this->user['updateTime']));
					$cookie = array(
	                        'name'   => 'token',
	                        'value'  => $token,                            
	                        'expire' => 0,
	                        'path' => '/'
	                    );
					$this->input->set_cookie($cookie);
				}
			}else{
				if($this->input->cookie('token')){
					$cookie = array(
                        'name'   => 'token',
                        'value'  => NULL,                            
                        'expire' => 0,
                        'path' => '/'
                    );
					$this->input->set_cookie($cookie);
				}
			}
		}catch(Exception $e){
			log_message('error', '[Class->CRM_Controller, Method->Construct] : '.$e->getMessage() );
		}

		if($this->config->item('isset_settings') != "true"){
			$sql="select * from ssc_params";
			$list = $this->common_ssc_model->get_data_sql($sql);
			foreach ($list as $item) {
				$this->config->set_item($item['name'], $item['value']);
			}
			$this->config->set_item('isset_settings', "true");
		}
    }

    public function updateSessionTime(){
    	$obj = array("accessTime" => $this->time);
    	$this->member_session_model->update(array("id"=>$this->user['sessionId']), $obj);
	}

	public function unset_all_session() {
	    $user_data = $this->session->all_userdata();

	    foreach ($user_data as $key => $value) {
	        $this->session->unset_userdata($key);
    	}
	}

	/**
	 * View Template
	 */
	public function loadLandingTemplate($current_view) 
	{
	    $this->load->view('layout/common');
		$this->load->view('layout/header/header1');
		$this->load->view('layout/navbar/navbar1');
		$this->load->view('layout/login_dialog/login1');
		$this->load->view($current_view);
		$this->load->view('layout/footer');
	    return NULL;
	}
	public function loadUserTemplate($current_view) 
	{
	    $this->load->view('layout/common');
		$this->load->view('layout/navbar/navbar2');
		$this->load->view('user/'.$current_view);
		$this->load->view('layout/footer');
	    return NULL;
	}
	public function loadHomeTemplate($current_view, $login = null) 
	{
		//Get user data
		$session = unserialize($this->session->userdata($this->memberSessionName));
		$view_data['user'] = $this->members_model->get_row(array("username"=>$session['username']));

	    $this->load->view('layout/common');
		$this->load->view('layout/header/header2', $view_data);
		$this->load->view('layout/navbar/navbar1');
		
		if($login){
			$this->load->view('layout/login_dialog/login2', $view_data);
		}
		$this->load->view($current_view);
		$this->load->view('layout/footer');
	    return NULL;
	}

	public function loadUserManagementTemplate($current_view, $others = null) 
	{
		//Get user data
		$session = unserialize($this->session->userdata($this->memberSessionName));
		$view_data['user'] = $this->members_model->get_row(array("username"=>$session['username']));

	    $this->load->view('layout/common');
		$this->load->view('layout/header/header2', $view_data);
		$this->load->view('layout/navbar/navbar1');

		$this->load->view('layout/personal_center', $view_data);

		if($others)
			$view_data['others'] = $others;
		$this->load->view('personal_management/'.$current_view, $view_data);
		$this->load->view('layout/footer');
	    return NULL;
	}

	public function loadLotteryTemplate($current_view, $others = null) 
	{
		//Get user data
		$session = unserialize($this->session->userdata($this->memberSessionName));
		$view_data['user'] = $this->members_model->get_row(array("username"=>$session['username']));

	    $this->load->view('layout/common');
		$this->load->view('layout/header/header2', $view_data);
		$this->load->view('layout/navbar/navbar1');

		$this->load->view('layout/game_board', $view_data);

		// if($others)
		// 	$view_data['others'] = $others;
		// $this->load->view('personal_management/'.$current_view, $view_data);
		$this->load->view('layout/footer');
	    return NULL;
	}
}