<?php

defined('BASEPATH') or exit('No direct script access allowed');

class WebLoginBase_Controller extends CRM_Controller
{
	public $type;		// 彩票种类ID// Lottery category ID
	public $groupId;	// 玩法组ID// Game group ID
	public $played;		// 玩法ID// Game ID
	public $NO;			// 期号// Issue
	
	public $gameFanDian;

    public function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata($this->memberSessionName)) {
        	redirect(site_url('/user/logout'));
			exit('您没有登录');
		}

		try{
			if(!$this->member_session_model->get_row(array("uid"=>$this->user['uid'], "session_key"=>session_id()), "id desc", null, "isOnLine")){
				$this->session->unset_userdata($this->memberSessionName);
				redirect(site_url('/user/logout'));
				exit('您已经退出登录，请重新登录');
			}
		}catch(Exception $e){
			log_message('error', '[Class->WebLoginBase_Controller, Method->construct] : '.$e->getMessage() );
		}
    }

    public function getGameLastNo($type, $time = null){

		$type = intval($type);
		if($time === null) $time = $this->time;
		$kjTime = $this->getTypeFtime($type);
		$atime=date('H:i:s', $time);

		$return = $this->data_time_model->get_row(array("type"=>$type, "actionTime <= "=>$atime), "actionTime desc", null, "actionNo, actionTime");

		if(!$return){
			$return = $this->data_time_model->get_row(array("type"=>$type), "actionNo desc", null, "actionNo, actionTime");
			$time=$time-24*3600;
		}
		$types=$this->getTypes();
		if(($fun=$types[$type]['onGetNoed']) && method_exists($this, $fun)){
			$this->$fun($return['actionNo'], $return['actionTime'], $time);
		}
		return $return;
	}
	//获取延迟时间
	public function getTypeFtime($type){
		
		if($type){
			$Ftime = $this->type_model->get_value("data_ftime", array("id"=>$type));
		}
		if(!$Ftime) $Ftime = 0;
		return intval($Ftime);
	}

	public function getTypes(){
		if(isset($this->types)) return $this->types;

		$this->types = $this->type_model->get_object("id", array("isDelete"=>"0"), "sort asc");
		return $this->types;
	}

	private function setTimeNo(&$actionTime, &$time=null){
		$actionTime=wjStrFilter($actionTime);
		//if(preg_match('/^\d{4}/', $actionTime)) return;
		if(!$time) $time=$this->time;
		$actionTime=date('Y-m-d ', $time).$actionTime;
	}

	public function noHdCQSSC(&$actionNo, &$actionTime, $time=null){
		$actionNo = wjStrFilter($actionNo);
		$this->setTimeNo($actionTime, $time);
		if($actionNo==0||$actionNo==120){
			$actionNo=date('Ymd120', $time - 24*3600);
			$actionTime=date('Y-m-d 00:00', $time);
			//echo $actionTime;
		}else{
			$actionNo=date('Ymd', $time).substr(1000+$actionNo,1);
		}
		//var_dump($actionNo);exit;
	}
	
	public function onHdXjSsc(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		if($actionNo>=84){
			$actionNo=date('Ymd-'.$actionNo, $time - 24*3600);
		}else{
			$actionNo=date('Ymd-', $time).substr(1000+$actionNo,1);
		}
	}
	
	public function noHd(&$actionNo, &$actionTime, $time=null){
		//echo $actionNo;
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('Ymd', $time).substr(100+$actionNo,1);
	}
	
	public function noxHd(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		/*if($actionNo>180){
			$time-=24*3600;
		}*/
		$timea=intval(date('Hi',time()));
		if($timea>=0 && $timea <= 404){
			$time-=24*3600;
			$actionNo=date('Ymd', $time).substr(1000+$actionNo,1);
		}else{
			$actionNo=date('Ymd', $time).substr(1000+$actionNo,1);
		}
	}
	public function noxHdgd11x5(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		if($actionNo>84){
			$time-=24*3600;
		}
		
		$actionNo=date('ymd', $time).substr(100+$actionNo,1);
	}

	public function noxHdgdklsf(&$actionNo, &$actionTime, $time = null)
    {
        $this->setTimeNo($actionTime, $time);
        if ($actionNo > 84) {
            $time -= 24 * 3600;
        }
        $actionNo = date('Ymd', $time) . substr(100 + $actionNo, 1);
    }

	public function noxHdk3(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('ymd', $time).substr(1000+$actionNo,1);
	}
	public function no0Hdnc(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('ymd', $time).substr(1000+$actionNo,1);
	}
	public function no0Hdjc(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('Ymd', $time).substr(1000+$actionNo,1);
	}
/**
     * 新增 1.5 赛车
     */
	public function sy_JS_pk10(&$actionNo, &$actionTime, $time=null){
        $this->setTimeNo($actionTime, $time);
		$actionNo = 960*(strtotime(date('Y-m-d', $time))-strtotime('2004-09-19'))/3600/24+$actionNo+24902865+890919;
    }
    /**
     * 新增 1.5 时时彩
     */
    public function sy_JS_ssc(&$actionNo, &$actionTime, $time=null){
        
   $this->setTimeNo($actionTime, $time);
		$actionNo = 960*(strtotime(date('Y-m-d', $time))-strtotime('2004-09-19'))/3600/24+$actionNo+24902865+875871;

    }
	
	/**
     * 新增 澳洲5
     */
    public function sy_JS_ao5(&$actionNo, &$actionTime, $time=null){
        $this->setTimeNo($actionTime, $time);
        $actionNo=date('Ymd', $time).str_pad($actionNo,3,"0",STR_PAD_LEFT);

    }

    /**
     * 新增 5 六合彩
     */
    public function sy_JS_lhc(&$actionNo, &$actionTime, $time=null){
        $this->setTimeNo($actionTime, $time);
        $actionNo=date('Ymd', $time).str_pad($actionNo,3,"0",STR_PAD_LEFT);
    }
	/**
	* 六合彩
	*/
	/**
	* 六合彩
	*/
	
	public function no6Hd(&$actionNo,&$actionTime,$time=null){	
		$actionNo=null;
		$actionTime=null;
		if($time===null) $time=$this->time;
		$atime=date('Y-m-d 00:00:00', $time);
		$sql="select actionNo, lhcTime from {$this->prename}data_time where type=70 and lhcTime>? order by id asc";
		$data = $this->getRow($sql, $atime);
		$actionNo=$data['actionNo'];
		$actionTime=$data['lhcTime'];
    }

	public function no0Hdk3(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('md', $time).substr(100+$actionNo,1);
	}

	public function no0Hdf(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('Ymd-', $time).substr(10000+$actionNo,1);
	}
	
	public function pai3(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		//echo $actionTime,' ',date('Y-m-d H:i:s', $time);
		$actionNo=date('Yz', $time)-6;
		$actionNo=substr($actionNo,0,4).substr(substr($actionNo,4)+1000,1);
		if($actionTime >= date('Y-m-d H:i:s', $time)){
			
		}else{
			$actionTime=date('Y-m-d 18:30', $time);
		}
	}
	
	public function GXklsf(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('Yz', $time).substr(100+$actionNo,1)+100;
		$actionNo=substr($actionNo,0,4).substr(substr($actionNo,4)+100000,1);
	}
	
	public function BJpk10(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo = 179*(strtotime(date('Y-m-d', $time))-strtotime('2007-11-18'))/3600/24+$actionNo-1267-1273-1253;
	}
	public function Kuai8(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo = 179*(strtotime(date('Y-m-d', $time))-strtotime('2004-09-19'))/3600/24+$actionNo-1292*2-1274-702;
	}

	public static final function ifs(){
		$args=func_get_args();
		$numargs = func_num_args();
		for($i=0; $i<$numargs; $i++){
			if($args[$i]==='0' || $args[$i]) return $args[$i];
		}
	}

	/**
	 * 用户资金变动
	 *
	 * 请在一个事务里使用
	 */
	public function addCoin($log){
		if(!isset($log['uid'])) $log['uid']=$this->user['uid'];
		if(!isset($log['info'])) $log['info']='';
		if(!isset($log['coin'])) $log['coin']=0;
		if(!isset($log['type'])) $log['type']=0;
		if(!isset($log['fcoin'])) $log['fcoin']=0;
		if(!isset($log['extfield0'])) $log['extfield0']=0;
		if(!isset($log['extfield1'])) $log['extfield1']='';
		if(!isset($log['extfield2'])) $log['extfield2']='';
		
		$sql="call setCoin({$log['coin']}, {$log['fcoin']}, {$log['uid']}, {$log['liqType']}, {$log['type']}, '{$log['info']}', {$log['extfield0']}, '{$log['extfield1']}', '{$log['extfield2']}')";
		
		//echo $sql;exit;
		$this->common_ssc_model->run_sql($sql);
	}
}
