<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CRM_Controller {

	private $vcodeSessionName = 'ssc_vcode_session_name';

	public function __construct()
    {
        parent::__construct();
    }

    /**
	 * 用户登录页面 User Login Page
	 */
	public final function login(){
		$this->loadUserTemplate('login');
	}

    /**
	 * 用户登录页面 User Login Action
	 */
	public final function logindo(){
		$username = wjStrFilter($this->input->post_get('txt_login_user'));
        $password = wjStrFilter($this->input->post_get('txt_login_password'));

        if(!ctype_alnum($username)) { 
        	echo json_encode('用户名包含非法字符,请重新登陆'); return;
        }
		
		if(!$username){
			echo json_encode('请输入用户名'); return;
		}
		if(!$password){
			echo json_encode('不允许空密码登录'); return;
		}

    	$user = $this->members_model->get_row(array("isDelete"=>0, "admin"=>0, "username"=> $username));

		if(!$user){
			echo json_encode('用户名或密码不正确'); return; 
		}
		if(md5($password)!=$user['password']){
			echo json_encode('密码不正确'); return;
		}
		if(!$user['enable']){
			echo json_encode('您的帐号系统检测涉嫌违规操作已被暂时冻结，如有疑问请联系在线客服！'); return;
		}
		
		$this->reset_session($user);

		echo json_encode("success");
		return;
	}
	/**
	 * 用户登出操作 User Logout
	 */
	public final function logout(){
		$this->unset_all_session();
		if($this->user['uid']){
			$obj = array("isOnLine" => 0);
			$where = array("uid" => $this->user['uid'], "session_key"=> session_id());
    		$this->member_session_model->update($where, $obj);
		}
		redirect(site_url('/landing'));
		exit;
	}
	/**
	 * Reset Session
	 */
	public function reset_session($user)
	{
		$this->unset_all_session();

		$this->session->set_userdata("tanchu", "1");
		$session = array(
			'uid'=>$user['uid'],
			'username'=>$user['username'],
			'session_key'=>session_id(),
			'loginTime'=>$this->time,
			'accessTime'=>$this->time,
			'loginIP'=>ip(true)
		);
		$session =array_merge($session, getBrowser());

		$user['sessionId'] = $this->member_session_model->insert($session);

		$this->session->set_userdata($this->memberSessionName, serialize($user));
		$updatetime=date('Y-m-d H:i:s', $this->time);

		$this->members_model->update(array("uid"=>$user['uid']), array("updateTime"=>$updatetime));	
		// 把别人踢下线
		$this->member_session_model->update(array("uid"=>$user['uid'], "id < "=>$user['sessionId']), array("isOnLine"=>0));
	}
	
	/**
	 * User Regist Page
	 */
	public final function regist(){
		$this->loadUserTemplate('regist');
	}
	/**
	 * User regist action
	 */
	public final function registered(){
		if(!$this->input->post()) {
			echo json_encode('提交数据出错，请重新操作'); return;
		}

		//表单过滤
		$lid = intval($this->input->post('lid'));
		$parentId = intval($this->input->post('parentId'));
		$user = wjStrFilter($this->input->post('txt_regist_user'));
		$qq = wjStrFilter($this->input->post('qq'));
		$daliuser = $this->input->post['daliuser'];
		$vcode = wjStrFilter($this->input->post('vcode'));
		$password = $this->input->post('txt_regist_password');

		//if($vcode != $_SESSION[$this->vcodeSessionName]) {
		//	echo json_encode('验证码不正确。'); return;
		//}

		//清空验证码session
	    //$_SESSION[$this->vcodeSessionName]="";

		if(!ctype_alnum($user)) {
			echo json_encode('用户名包含非法字符'); return;
		}
		if(strlen($password)<6) {
			echo json_encode('密码不能小于6位'); return;
		}
		if(strlen($password)>20) { 
			echo json_encode('密码不能大于20位'); return;
		}
		if(!ctype_digit($qq)) {
			echo json_encode('QQ包含非法字符'); return;
		}
		if($daliuser){
			$parentinfo = $this->members_model->get_row(array("username"=>$daliuser));
			if(!$parentinfo) {
				echo json_encode('您输入的推荐人不存在。'); return;
			}
			$dali=10;
		}	
		if($lid && $parentId){
			$linkData = $this->links_model->get_row(array("lid"=>$lid));

			if(!$this->input->post('lid')) $para['lid']=$lid;
			if(!$linkData) { 
				echo json_encode('不存在此注册链接。'); return;
			}
			if(!$parentId) {
				echo json_encode('链接错误'); return;
			}
			$parentinfo = $this->members_model->get_row(array("uid"=>$parentId));
			if($linkData['type'] >= $parentinfo['type']) {
				echo json_encode('链接错误'); return;
			}
		}else{
			$linkData['type']=0;
			$linkData['fanDian']=0;
		}
		$para=array(
			'username'=>$user,
			'type'=>$linkData['type'],
			'password'=>md5($password),
			'fanDian'=>$linkData['fanDian'],
			'coin'=>0,
			'qq'=>$qq,
			'regIP'=>ip(true),
			'regTime'=>$this->time
			);
			
		if (isset($dali) && $dali==10){
			//推荐人
			$para['parentId']=$parentinfo['uid'];
			if ($parentinfo['zparentId']) {
				$para['zparentId']=$parentinfo['zparentId'];
			}else {
			    $para['zparentId']=$parentinfo['parentId'];
			}
			$para['gudongId']=$parentinfo['parentId'];
		}elseif($linkData['type']==0 && isset($parentinfo['type']) && $parentinfo['type']==1){
			//添加会员
			$para['parentId']=$parentId;
			$para['zparentId']=$parentinfo['zparentId'];
			$para['gudongId']=$parentinfo['gudongId'];
		}elseif(isset($parentinfo['type']) && $parentinfo['type']==2){
			$para['zparentId']=$parentId;
			$para['gudongId']=$parentinfo['gudongId'];
		}elseif(isset($parentinfo['type']) && $parentinfo['type']==3){
			$para['gudongId']=$parentId;
		}
		$lasttime=$this->time-24*3600;
		$regcount = $this->members_model->get_row(array("regIP"=>ip2long(ip(true)), "regTime > "=>$lasttime), null, null, "count(*) as ncount");

		if($regcount['ncount'] >= 3) {
			echo json_encode('同一IP 24小时内只能注册三次'); return;
		}

		if(!isset($para['nickname'])) $para['nickname']='未设昵称';
		if(!isset($para['name'])) $para['name']='';
		if(!isset($para['email'])) $para['email']='';
		if(!isset($para['phone'])) $para['phone']='';
		if(!isset($para['conCommStatus'])) $para['conCommStatus']=0;
		if(!isset($para['lossCommStatus'])) $para['lossCommStatus']=0;
		if(!isset($para['care'])) $para['care']='';
		//$this->beginTransaction();

		try{
			if($this->members_model->get_row(array("username"=>$para['username']), null, null, "username")) {
				echo json_encode('用户"'.$para['username'].'"已经存在'); return;
			}
			$id = $this->members_model->insert($para);
			if($id){
				//$this->commit();
				$user_data = $this->members_model->get_row(array("username"=>$para['username']));
				$this->reset_session($user_data);
				echo json_encode('注册成功');
				return;
			}else{
				echo json_encode('注册失败'); return;
			}	
		}catch(Exception $e){
			//$this->rollBack();
			echo json_encode($e); return;
		}
	}

	/**
	 * 用户登录检查 DAVID 
	 */
	public final function guestlogindo(){
		if($this->user['uid']){
			echo '您已登陆';
			exit;
		}
	    $username=wjStrFilter($this->input->post('username'));
        $password=wjStrFilter($this->input->post('password'));
		if($username==$password && $username=='!guest!'){
			$password=md5($password);
		}else{
			echo '登陆错误';
			exit;
		}
		$username='guest_'.$this->time;
		$para=array(
		'username'=>$username,
		'nickname'=>$username,
		'name'=>$username,
		'password'=>$password,
		'regTime'=>$this->time,
		'updateTime'=>date('Y-m-d H:i:s',$this->time),
		'regIP'=>self::ip(true),
		'coin'=>2000,
		'testFlag'=>1,
		);

		$id = $this->guestmembers_model->insert($para);
		if(!$id){
			echo '登陆失败';
			exit;
		}
		$user = $this->guestmembers_model->get_row(array("username"=>$username, "isDelete"=>"0", "admin"=>"0"));
		$sql="select * from {$this->prename}guestmembers where isDelete=0 and admin=0 and username=? limit 0,1";
		if(!$user){
			echo '登陆失败';
			exit;
		}
		$session=array(
			'uid'=>$user['uid'],
			'username'=>$user['username'],
			'session_key'=>session_id(),
			'loginTime'=>$this->time,
			'accessTime'=>$this->time,
			'loginIP'=>ip(true)
		);
		
		$session=array_merge($session, getBrowser());
		
		$user['sessionId'] = $this->member_session_model->insert($session);

		$this->session->set_userdata($this->memberSessionName, serialize($user));
		$updatetime=date('Y-m-d H:i:s', $this->time);

		echo 'ok';
	}
}
