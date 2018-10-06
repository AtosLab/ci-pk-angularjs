<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personal_center extends WebLoginBase_Controller {

	public function __construct()
    {
        parent::__construct();
    }

    public function index()
	{
		redirect(site_url('/personal_center/user_info'));
	}
	public function user_info()
	{
		$this->loadUserManagementTemplate('user_info');
	}
	public function sequrity_setting()
	{
		if($this->user['coinPassword'])
			$others['hasFundPwd'] = true;
		else
			$others['hasFundPwd'] = false;
		$this->loadUserManagementTemplate('sequrity_setting', $others);
	}
	public function notice()
	{
		$this->loadUserManagementTemplate('sequrity_setting');
	}

	public function trans_out()
	{
		$pagenum = intval($this->input->post('page'));
		$pagesize = intval($this->input->post('rows'));
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');
		$state = intval($this->input->post('status'));

		if(!$pagenum){$pagenum=1;}
		if(!$pagesize){$pagesize=30;}
		$limit['page_size'] = $pagesize;
		$limit['offset'] = ($pagenum - 1) * $pagesize;
		
		$sql = "";
		if($startDate){
			$startDate=strtotime($this->input->post('startDate'));
			$sql=" and c.actionTime >={$startDate} ";
		}
		if($endDate){
			$endDate=strtotime($endDate.' 23:59:59');
			$sql.=" and c.actionTime <= {$endDate} ";
		}
		//充值订单状态：0申请，1手动到账,2自动到账,3充值失败,9管理员充值
		if(is_null($this->input->post('status'))){$state=5;}
		if($state==0 || $state==3){
			$sql.=" and c.state in(0,3) ";
		}elseif($state==1){
			$sql.=" and c.state=1 ";
		}elseif($state==2 || $state==4){
			$sql.=" and c.state in(2,4) ";
		}else{
			$sql.=" and c.state < 5 ";
		}
		$sql="select b.name bankName, c.*, u.username userAccount, u.gudongId, u.zparentId, u.parentId, d.countname from ssc_bank_list b, ssc_member_cash c, ssc_members u, ssc_member_bank d where b.isDelete=0 and c.isDelete=0 and u.uid={$this->user['uid']} {$sql} and c.bankId=b.id and c.uid=u.uid and u.uid=d.uid order by c.id desc ";
		//echo $sql;
		$list = $this->common_ssc_model->get_page_sql($sql, $limit);
		//提现状态：0已到帐, 1用户申请，2已取消，3已支付，4提现失败，0确认到帐, 5后台删除
		//$stateName=array('已到帐','申请中','已取消','已支付','已失败','已删除');

		$allarr=array();
		$allarr['data']=array();
		$allarr['totalCount']=0;
		$allarr['otherData']=null;
		if($list){
			$listarr=array();
			foreach($list['data'] as $var){
				$listarr['id']=intval($var['id']);
				$listarr['userId']=intval($var['uid']);
				$listarr['applyMoney']=floatval($var['amount']);
				$listarr['orderNo']=date("YmdHis",$var['actionTime']).$var['uid'];
				$listarr['applyTime']=date("Y-m-d H:i:s",$var['actionTime']);
				$listarr['reason']=$var['bankName'].'尾号'.substr($var['account'],-4);
				$listarr['checkStatus']=intval($var['state']);
				$listarr['bankName']=$var['bankName'];
				$listarr['bankCard']=$var['account'];
				$listarr['bankAccount']=$var['username'];
				array_push($allarr['data'], $listarr);
			}
			$allarr['totalCount']=$list['total'];
		}

		$arrCheckStatus = array(
			"0" => '提现成功',
			"1" => '申请中',
			"2" =>'提现失败',
			"3" =>'提现成功',
			"4" =>'提现失败',
			"5" =>'撤销'
		);
		$allarr['arrCheckStatus'] = $arrCheckStatus;
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			echo json_encode($allarr);
		}
		else
		{
			$this->loadUserManagementTemplate('trans_out', $allarr);
		}
		/*{"data":[{"id":288658,"userId":67473,"account":"","userName":"","dlId":3,"dlName":"dl01","accountMoney":0.0,"rechMoney":20.0,"orderNo":"10161220222206972992","addTime":"2016-12-20 22:22:07","status":2,"rechTime":"2016-12-20 22:22:07","remark":"通过闪付充值20.0元","channel":55,"operator":null,"operatorTime":null,"rechType":"onlinePayment","rechName":"在线支付","payeeName":null,"payee":"610208","payeeInfo":null,"payeeBankName":null,"actualMoney":20.0,"updateTime":"2016-12-20 22:24:34","thirdOrderNo":null,"rechLevel":"0","rebateMoney":0.0,"thirdChannel":"57","statDate":"2016-12-20 22:24:34","onlineType":7}],"totalCount":2,"otherData":null}*/
	}

	public function trans_in()
	{
		$pagenum = intval($this->input->post('page'));
		$pagesize = intval($this->input->post('rows'));
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');
		$state = intval($this->input->post('status'));

		if(!$pagenum){$pagenum=1;}
		if(!$pagesize){$pagesize=30;}
		$limit['page_size'] = $pagesize;
		$limit['offset'] = ($pagenum - 1) * $pagesize;

		$sql = "";
		if($startDate){
			$startDate=strtotime($this->input->post('startDate'));
			$sql=" and actionTime >={$startDate} ";
		}
		if($endDate){
			$endDate=strtotime($endDate.' 23:59:59');
			$sql.=" and actionTime <= {$endDate} ";
		}
		//充值订单状态：0申请，1手动到账,2自动到账,3充值失败,9管理员充值
		if($state==0 && !is_null($this->input->post('status'))){
			$sql.=" and state=0 ";
		}elseif($state==1){
			$sql.=" and state in(1,2,9) ";
		}elseif($state==3){
			$sql.=" and state=3 ";
		}

		$sql=$sql.' order by id desc';

		$sql = "select * from ssc_member_recharge where isDelete=0 and amount>0 and uid={$this->user['uid']} {$sql}";
		$list = $this->common_ssc_model->get_page_sql($sql, $limit);

		$allarr=array();
		$allarr['data']=array();
		$allarr['totalCount']=0;
		$allarr['otherData']=null;
		if($list){
			$listarr=array();
			foreach($list['data'] as $var){
				$listarr['id']=intval($var['id']);
				$listarr['userId']=intval($var['uid']);
				$listarr['userName']=$var['username'];
				/*$listarr['dlId']=null; //代理
				$listarr['zdlId']=null;//总代理*/
				$listarr['accountMoney']=0;
				$listarr['rechMoney']=floatval($var['amount']);
				$listarr['orderNo']=$this->ifs($var['rechargeId'], '管理员充值');
				$listarr['addTime']=date("Y-m-d H:i:s",$var['actionTime']);
				$listarr['status']=$var['state'];
				$listarr['rechTime']=date("Y-m-d H:i:s",$var['actionTime']);
				$listarr['remark']=$var['info'];
				$listarr['rechName']=$var['info'];
				if($var['rechType']){
				$listarr['rechType']=$var['rechType'];
				}elseif($var['info']=='系统充值'){
				$listarr['rechType']='adminAddMoney';
				}else{
				$listarr['rechType']='onlinePayment';
				}
				array_push($allarr['data'], $listarr);
			}
			$allarr['totalCount']=$list['total'];
		}

		$arrRechStatus = array(
			"0" => '处理中',
			"1" => '充值成功',
			"2" => '充值成功',
			"3" => '充值失败',
			"4" => '充值失败',
			"9" => '充值成功'
		);
		$allarr['arrRechStatus'] = $arrRechStatus;
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			echo json_encode($allarr);
		}
		else
		{
			$this->loadUserManagementTemplate('trans_in', $allarr);
		}

		/*{"data":[{"id":288658,"userId":67473,"account":"","userName":"","dlId":3,"dlName":"dl01","accountMoney":0.0,"rechMoney":20.0,"orderNo":"10161220222206972992","addTime":"2016-12-20 22:22:07","status":2,"rechTime":"2016-12-20 22:22:07","remark":"通过闪付充值20.0元","channel":55,"operator":null,"operatorTime":null,"rechType":"onlinePayment","rechName":"在线支付","payeeName":null,"payee":"610208","payeeInfo":null,"payeeBankName":null,"actualMoney":20.0,"updateTime":"2016-12-20 22:24:34","thirdOrderNo":null,"rechLevel":"0","rebateMoney":0.0,"thirdChannel":"57","statDate":"2016-12-20 22:24:34","onlineType":7}],"totalCount":2,"otherData":null}*/
	}

	public function deposit()
	{
		$others['rechTypeMap'] = $this->getUserRechCfg();
		$others['rechTypeList'] = $others['rechTypeMap']['weixinOnline'];

		$this->loadUserManagementTemplate('deposit', $others);
	}
	public final function getRechId(){
		$rechargeId = date('YmdHis').mt_rand(1000,9999);

		if($this->common_ssc_model->get_value_sql("id", "select id from ssc_member_recharge where rechargeId=$rechargeId")){
			getRechId();
		}else{
			return $rechargeId;
		}
	}
	public function onlinePaydo() 
	{
		//$this->freshSession();
		if($this->user['uid']){
			$rechargeId = $this->getRechId();
			$bankid = $this->input->post("payId");
			$uid = $this->user['uid'];
			$amount = floatval($this->input->post('amount'));
			$time = date('Y-m-d H:i:s', time());
			$rechId = $this->input->post('rechId');


			//var_dump($_REQUEST);
			//exit;

			if($amount && $uid && $rechargeId){
				$insertObj = array();
				$insertObj['order_number'] = $rechargeId;
				$insertObj['username'] = $uid;
				$insertObj['recharge_amount'] = $amount;
				$insertObj['state'] = '0';
				$insertObj['time'] = $time;
				
				if($this->order_model->insert($insertObj)) {
					$para=array();
					$para['mBankId']=intval($bankid);
					$para['amount']=floatval($amount);
					$para['rechargeId']=$rechargeId;
					$para['actionTime']=$this->time;
					$para['uid']=$this->user['uid'];
					$para['username']=$this->user['username'];
					$para['actionIP']=ip(true);
					if($rechId==287 || $bankid=='ZHIFUBAO'){
					$para['info']='支付宝扫码充值';
					}elseif($rechId==286 || $bankid=='WEIXIN'){
					$para['info']='新宝微信扫码充值';
					}else{
					$para['info']='用户在线充值';
					}

					if($this->member_recharge_model->insert($para)) {
						if($bankid==1 || $bankid==2){
							$url='?MerBillNo='.$rechargeId.'&bankid='.$bankid.'&uid='.$uid.'&Amount='.$amount;
							header("Location: http://www.38000a.com/pay/zfb.html".$url); 
						}else{
							$pay_type='0002';//新宝微信
							$url='?pay_type='.$pay_type.'&order_no='.$rechargeId.'&amount='.$amount;
							header("Location: http://www.38000a.com/pay/wx.html".$url); 			
						}
						echo json_encode('success');
					}else{
						echo json_encode('充值订单生成出错');
						exit;
					}		
				}else{
				echo json_encode('操作错误');
				exit;	
				}
			}
		}
		echo json_encode('操作错误');
	}

	/**
	 * 提现申请
	 */
	public function withdraw()
	{
		$others['user'] = $this->members_model->get_row(array("uid"=>$this->user['uid']));
		$sql = "SELECT b.account, b.countname, bl.name  FROM ssc_member_bank b 
				left join ssc_bank_list bl on b.bankId = bl.id
				where b.uid = {$this->user['uid']} and bl.isDelete = 0 and b.enable = 1 ";
		$others['bankinfo'] = $this->common_ssc_model->get_row_sql($sql);

		$this->loadUserManagementTemplate('withdraw', $others);
	}
	public function withdrawdo()
	{
		if ($this->input->server('REQUEST_METHOD') != 'POST'){
			echo json_encode("hhhhhhh"); exit;
			echo json_encode('参数出错'); exit;
		}

		$para['amount'] = $this->input->post('applymoney');
		$para['coinpwd'] = $this->input->post('cpassword');

		$bank = $this->common_ssc_model->get_row_sql("select username,account,bankId from ssc_member_bank where uid={$this->user['uid']} limit 1");

		$para['username'] = $bank['username'];
		$para['account'] = $bank['account'];
		$para['bankId'] = $bank['bankId'];

		if(!ctype_digit($para['amount'])){echo json_encode('提现金额包含非法字符'); exit; } //throw new Exception('提现金额包含非法字符');
		if($para['amount'] <= 0){ echo json_encode('提现金额只能为正整数');exit;} //throw new Exception("提现金额只能为正整数");
		if($para['amount'] > $this->user['coin']){echo json_encode('提款金额大于可用余额，无法提款'); exit;} //throw new Exception("提款金额大于可用余额，无法提款");
		if($this->user['coin']<=0){echo json_encode('可用余额为零，无法提款');exit;} //throw new Exception("可用余额为零，无法提款");
		
		//提示时间检查
		$baseTime=strtotime(date('Y-m-d ',$this->time).'06:00');
		$fromTime=strtotime(date('Y-m-d ',$this->time).$this->config->item('cashFromTime').':00');
		$toTime=strtotime(date('Y-m-d ',$this->time).$this->config->item('cashToTime').':00');
		if($toTime<$baseTime) $toTime +=24*3600;

		if($this->time < $fromTime || $this->time > $toTime ){
			echo json_encode("提现时间：从".$this->config->item('cashFromTime')."到".$this->config->item('cashToTime')); 
			exit;
		} 
		//throw new Exception("提现时间：从".$this->settings['cashFromTime']."到".$this->settings['cashToTime']);

		//消费判断
		$cashAmout=0;
		$rechargeAmount=0;
		$rechargeTime=strtotime('00:00')-2*24*3600;
		if($this->config->item('cashMinAmount')){
			$cashMinAmount = $this->config->item('cashMinAmount')/100;

			$gRs = $this->common_ssc_model->get_row_sql("select sum(case when rechargeAmount > 0 then rechargeAmount else amount end) as rechargeAmount from ssc_member_recharge where  uid={$this->user['uid']} and state in (1,2,9) and isDelete=0 and rechargeTime>=".$rechargeTime);
			if($gRs){
				$rechargeAmount=$gRs["rechargeAmount"]*$cashMinAmount;
			}
			if($rechargeAmount){
				//消费总额
				//throw new Exception("消费满".$this->settings['cashMinAmount']."%才能提现");
			}
		}//消费判断结束

		try{
			if($this->user['coinPassword']!=md5($para['coinpwd'])){echo json_encode('提款密码不正确');exit;} //throw new Exception('提款密码不正确');
			unset($para['coinpwd']);
			
			if($this->user['coin']<$para['amount']){echo json_encode('你帐户资金不足');exit;} //throw new Exception('你帐户资金不足');
		
			// 查询最大提现次数与已经提现次数
			$time=strtotime(date('Y-m-d', $this->time));
			/*if($times=$this->getValue("select count(*) from {$this->prename}member_cash where actionTime>=$time and uid=?", $this->user['uid'])){
				if($times>=5) throw new Exception('对不起，今天你提现次数已达到最大限额，请明天再来');
			}*/
			
			// 插入提现请求表
			$para['actionTime']=$this->time;
			$para['uid']=$this->user['uid'];

			$id = $this->member_cash_model->insert($para);
			if(!$id){
				echo json_encode('提交提现请求出错');exit;
			}
			
			// 流动资金
			$this->addCoin(array(
				'coin'=>0-$para['amount'],
				'fcoin'=>$para['amount'],
				'uid'=>$para['uid'],
				'liqType'=>106,
				'info'=>"提现[$id]资金冻结",
				'extfield0'=>$id
			));

			echo json_encode('success');
			exit;
			//return '申请提现成功，请等待客服人员审核';
		}catch(Exception $e){
			echo json_encode('error');
		}

	}

	public function card_manager()
	{
		if(!$this->user['coinPassword'])
		{
			echo "<script>alert('Set CoinPassword'); </script>";
			redirect(site_url('/personal_center/sequrity_setting'));
			return;
		}

		$bank = $this->member_bank_model->get_row(array("uid"=>$this->user['uid']));
		if($bank && $bank['account'])
		{
			$bankName = $this->bank_list_model->get_row(array("id"=>$bank['bankId']));
			if($bankName && $bankName['name'])
			{
				$others['bankname'] = $bankName['name'];
				$others['countname'] = $bank['countname'];
				$others['username'] = $bank['username'];
				$others['account'] = $bank['account'];
				$this->loadUserManagementTemplate('card_manage_show', $others);
				return;
			}
		}

		if(!$this->user['name'])
			$others['hasFullname'] = false;
		else
			$others['hasFullname'] = true;

		$others['bank_list'] = $this->bank_list_model->get_data(array("isDelete"=>"0"), "sort asc");

		$this->loadUserManagementTemplate('card_manager', $others);


	}
	public function daily_record()
	{
		$gameId = intval($this->input->post('gameId'));
		$pagenum = intval($this->input->post('page'));
		$pagesize = intval($this->input->post('rows'));
		$settled = $this->input->post('settled');

		$arrWhere = array();

		if(!$pagenum){$pagenum=1;}
		if(!$pagesize){$pagesize=30;}
		$limit['page_size'] = $pagesize;
		$limit['offset'] = ($pagenum - 1) * $pagesize;

		if(!$settled){$settled='true';}
		if($gameId){
			$arrWhere['type'] = $gameId;
		}
		if($settled == 'false'){
			$arrWhere['lotteryNo'] = '';
		}elseif($settled == 'true'){
			$arrWhere['lotteryNo != '] = '';
		}else{
			$arrWhere['lotteryNo != '] = '';
		}

		$datestr = strtotime('00:00');
		if($settled == 'true'){
			$arrWhere['actionTime >= '] = $datestr;
		}

		if($this->user['testFlag'] == 1){
			$list = $this->guestbets_model->get_page(array("uid"=>$this->user['uid'], "isDelete"=>"0"), "id desc", $limit);
		}else{
			$list = $this->bets_model->get_page(array("uid"=>$this->user['uid'], "isDelete"=>"0"), "id desc", $limit);
		}
		$allarr=array();
		$allarr['data']=null;
		$allarr['totalCount']=0;
		$allarr['otherData']=null;

		$dataarr=array();
		$dataarr['id']=null;
		$dataarr['userId']=null;
		$dataarr['userName']=null;
		/* $dataarr['dlId']=null;
		$dataarr['zdlId']=null; */
		$dataarr['playId']=null;
		$dataarr['playCateId']=null;
		$dataarr['odds']=null;
		$dataarr['rebate']=0;
		$dataarr['addTime']=null;
		$dataarr['turnNum']=null;
		$dataarr['gameId']=null;
		$dataarr['status']=0; //0为未结明细,1为已结明细
		$dataarr['rebateMoney']=0;
		$dataarr['orderNo']=null;
		$dataarr['lotteryNo']=null;
		$dataarr['remark']='';
		$dataarr['openTime']=null;
		$listarr['testFlag']=$this->user['testFlag'];
		$dataarr['multiple']=1;
		$dataarr['betInfo']='';
		$dataarr['money']=0; //投注金额
		$dataarr['resultMoney']=0;

		$allarr['otherData']=array();
		$allarr['otherData']['totalRebateMoney']=0;
		$allarr['otherData']['totalResultMoney']=0;
		$allarr['otherData']['totalBetMoney']=0;

		if($list['data']){
			$allarr['data']=array();
			foreach($list['data'] as $key => $var){ 
				$dataarr['id']=intval($var['id']);
				$dataarr['userId']=intval($var['uid']);
				$dataarr['userName']=$var['username'];
				/* $dataarr['dlId']=null; //代理
				$dataarr['zdlId']=null;//总代理 */
				$dataarr['playId']=intval($var['playedId']);
				$dataarr['playCateId']=intval($var['playedGroup']);
				$dataarr['odds']=floatval($var['odds']);
				$dataarr['rebate']=floatval($var['rebate']);
				$dataarr['addTime']=date("Y-m-d H:i:s",$var['actionTime']);
				$dataarr['turnNum']=$var['actionNo'];
				$dataarr['gameId']=intval($var['type']);
				if($var['betInfo'] !=''){
						$dataarr['betInfo']=$var['betInfo'];
						$tzmoney=$var['money'] * $var['totalNums'];
						$dataarr['multiple']=$var['totalNums'];
				}else{
						$tzmoney=$var['money'];
				}

				if($settled=='true'){
					//已结算明细
					$dataarr['status']=1;
					$dataarr['money']=floatval($tzmoney);
					$dataarr['rebateMoney']=$tzmoney*$var['rebate']; //已退水金额
					$allarr['otherData']['totalRebateMoney']+=floatval(sprintf("%.2f",$tzmoney*$var['rebate'])); //退水总计
					$dataarr['resultMoney']=floatval(sprintf("%.2f",$var['bonus']-$tzmoney+$tzmoney*$var['rebate'])); //未结明细为可赢金额//已结明细为赢亏结果包括退水

				}else{
					//未结算明细
					$dataarr['status']=0;	
					$dataarr['money']=floatval($tzmoney);
					$dataarr['resultMoney']=floatval(sprintf("%.2f",$var['money']*$var['odds']-$tzmoney+$tzmoney*$var['rebate']));//未结明细可赢额金包括退水//已结明细结果包括退水
					
				}

				$dataarr['orderNo']=$var['wjorderId'];
				$dataarr['lotteryNo']=$var['lotteryNo'];
				$dataarr['remark']=$var['lotteryNo'];
				$lastNo= $this->getGameLastNo($var['type'], (isset($var['time']) ? $var['time'] : NULL) );
				$dataarr['openTime']=date("Y-m-d H:i:s",$var['kjTime']);
				$dataarr['testFlag']=$this->user['testFlag'];//测试用户为1
				array_push($allarr['data'],$dataarr);

				$allarr['otherData']['totalResultMoney']+=$dataarr['resultMoney'];
				$allarr['otherData']['totalBetMoney']+=$tzmoney;
			}
			$allarr['totalCount']=$list['total'];
		}

		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			echo json_encode($allarr);
		}
		else
		{
			$this->loadUserManagementTemplate('daily_record', $allarr);
		}
	}
	public function week_record()
	{
		$pagenum = intval($this->input->post('page'));
		$pagesize = intval($this->input->post('rows'));
		//$elemet = $this->input->post('elemet');
		//$settled = $this->input->post('settled');
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');

		if(!$pagenum){
			$pagenum = 1;
		}
		if(!$pagesize){
			$pagesize = 7;
		}
		$limit['page_size'] = $pagesize;
		$limit['offset'] = ($pagenum - 1) * $pagesize;

		$arrWhere = array();

		if(!$startDate || !$endDate)
		{
			// 需要提前的天数
			$diffDay = 0;
			// 报表是凌晨4点统计，如果当前小时数是5点前，需要额外再提前一天
			if(intval(date("H")) < 5) {
				$diffDay++;
			}
			$startDate = date('Y-m-d', strtotime('-'.($diffDay+6).' day', time()));
			$endDate = date('Y-m-d', strtotime('-'.($diffDay).' day', time()));
		}
		if($startDate && $endDate){
			$startDate = date("Y-m-d", strtotime($startDate));
			$endDate = date("Y-m-d", strtotime($endDate));
			$arrWhere['date >= '] = $startDate;
			$arrWhere['date <= '] = $endDate;
		}
		/*$datestr=time()-24*3600;
		if($endDate>$datestr){
			exit;
		}*/
		$arrWhere['uid'] = $this->user['uid'];
		$list = $this->report_model->get_page($arrWhere, "id desc", $limit);
		//$list = $this->getPage("select * from {$this->prename}report where uid={$this->user['uid']} {$sql}",$pagenum,$pagesize);

		$allarr = array();
		$allarr['data']=array();
		$allarr['totalCount']=0;
		$allarr['otherData']=null;

		$dataarr=array();
		$dataarr['id']=null;
		$dataarr['gameId']=null;
		$dataarr['userId']=null;
		$dataarr['userName']=null;
		$dataarr['statDate']=null;
		$dataarr['betCount']=null;
		$dataarr['betMoney']=null;
		$dataarr['reward']=null;
		$dataarr['rewardRebate']=null;
		$dataarr['rebateMoney']=null;
		$dataarr['rewardDouble']=null;
		$dataarr['rebateMoneyDouble']=null;
		$dataarr['rewardRebateDouble']=null;
		$dataarr['betMoneyDouble']=null;

		if(isset($list['data']) && $list['data']){
			$allarr['data']=array();
			foreach($list['data'] as $key => $var){ 
				$dataarr=array();
				$dataarr['id']=null;
				$dataarr['gameId']=null;
				$dataarr['userId']=intval($var['uid']);
				$dataarr['userName']=$var['username'];
				$dataarr['statDate']=$var['date'];
				$dataarr['betCount']=intval($var['betCount']);
				//$dataarr['betMoney']=floatval($var['betAmount']);
				$dataarr['reward']=floatval($var['zjAmount']);
				$dataarr['rewardRebate']=floatval($var['zjAmount'] + $var['rebateMoney'] - $var['betAmount']);
				/*$dataarr['rebateMoney']=floatval($var['rebateMoney']);
				$dataarr['rewardDouble']=floatval($var['zjAmount'] + $var['rebateMoney'] - $var['betAmount']);*/
				$dataarr['rebateMoneyDouble']=floatval($var['rebateMoney']);
				$dataarr['rewardRebateDouble']=floatval($var['zjAmount'] + $var['rebateMoney'] - $var['betAmount']);
				$dataarr['betMoneyDouble']=floatval($var['betAmount']);

				array_push($allarr['data'],$dataarr);
			}
			$allarr['totalCount']=$list['total'];
		}
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			echo json_encode($allarr);
		}
		else
		{
			$dataMap = array();
			foreach ($allarr['data'] as $data) {
				$date = explode(' ', $data['statDate']);
				$dataMap[$date[0]] = $data;
			}

			$dataList = array();
			$allBetCount = 0;
			$allRewardRebate = 0.0;
			$subDate = date('Y-m-d', strtotime('-'.($diffDay - 1).' day', time()));
			for ($i = 0; $i < 7; $i++) {
				$subDate = date('Y-m-d', strtotime('-1 day', strtotime ( $subDate )));
				$date = $subDate;
				$obj = isset($dataMap[$date]) ? $dataMap[$date] : NULL;
				if($obj) {
					$allBetCount += $obj['betCount'];
					$allRewardRebate += $obj['rewardRebate'];
					array_push($dataList, array("statDate"=> $date, "week"=> date('l', strtotime($subDate)), "betCount"=> $obj['betCount'], "rewardRebate"=> $obj['rewardRebate']));
				}
				else {
					array_push($dataList, array("statDate"=> $date, "week"=> date('l', strtotime($subDate)), "betCount"=> 0, "rewardRebate"=> 0));
				}
			}
			$others['allBetCount'] = $allBetCount;
			$others['allRewardRebate'] = number_format($allRewardRebate, 2, '.', '');
			$others['weekRecordList'] = $dataList;
			$this->loadUserManagementTemplate('week_record', $others);
		}
		/*{"data":[{"id":null,"gameId":null,"userId":67473,"dlId":null,"dlName":null,"zdlId":null,"zdlName":null,"userName":"","statDate":"2016-12-20 星期二","betCount":10,"betMoney":16.0,"reward":-2.47,"rewardRebate":-2.39,"rebateMoney":0.08,"userCount":null,"fullName":null,"rewardDouble":-2.47,"rebateMoneyDouble":0.08,"rewardRebateDouble":-2.39,"betMoneyDouble":16.0}],"totalCount":1,"otherData":null}*/
		
	}

	public function setPasswddo(){

		$opwd = $this->input->post('OldLoginPwd');

		if(!$opwd) { echo json_encode('原密码不能为空'); exit;}
		if(strlen($opwd)<6) { echo json_encode('原密码至少6位');exit;}
		if(!$npwd=$this->input->post('NewLoginPwd')) { echo json_encode('密码不能为空');exit;}
		if(strlen($npwd)<6) { echo json_encode('密码至少6位');exit;}
		
		$user = $this->members_model->get_row(array("uid"=>$this->user['uid']));
		if(!$user)
		{
			echo json_encode('原密码不正确');exit;
		}
		$pwd = $user['password'];
		
		$opwd=md5($opwd);
		if($opwd!=$pwd) { echo json_encode('原密码不正确');exit;}
		
		if($this->members_model->update(array("uid"=>$this->user['uid']), array("password"=>md5($npwd))))
		{
			$this->user['password'] = md5($npwd);
			$this->session->set_userdata($this->memberSessionName, serialize($this->user));
			echo json_encode('success'); exit;
		}

		echo json_encode('修改密码失败');
	}

	public function setCoinPwddo(){

		if($this->user['coinPassword']){
			$opwd = $this->input->post('oldFundPwd');

			if(!$opwd) { echo json_encode('原提款密码不能为空'); exit;}
	        if(strlen($opwd)<6) { echo json_encode('原提款密码至少6位');exit;}
	        if(!$npwd = $this->input->post('newFundPwd')) { echo json_encode('提款密码不能为空');exit;}
	        if(strlen($npwd)<6) { echo json_encode('提款密码至少6位');exit;}
	        
	        $pwd = $this->members_model->get_row(array("uid"=>$this->user['uid']));
	        if(!$pwd)
			{
				echo json_encode('原密码不正确');exit;
			}

            if($opwd && md5($opwd)!=$pwd['coinPassword']) { echo json_encode('原提款密码不正确');exit;}
            $npwd=md5($npwd);
            if($npwd==$pwd['password']) { echo json_encode('提款密码与登录密码不能一样');exit;}
            
            if($this->members_model->update(array("uid"=>$this->user['uid']), array("coinPassword"=>$npwd)))
			{
				$this->user['coinPassword'] = $npwd;
				$this->session->set_userdata($this->memberSessionName, serialize($this->user));
				echo json_encode('success'); exit;
			}
	        echo json_encode('修改提款密码失败');
		}
		else{

			if($this->user['uid']){
				$loginpwd = md5($this->input->post('loginPwd'));
				$coinpwd = md5($this->input->post('newFundPwd'));
				if($loginpwd != $this->user['password']){
					echo json_encode('登陆密码输入错误');
					exit;
				}
				if(strlen($coinpwd) != 32){
					echo json_encode('提款密码输入错误');
					exit;
				}
				if($loginpwd == $coinpwd){
					echo json_encode('登陆密码和提款密码不能相同');
					exit;
				}
				if($this->members_model->update(array("uid"=>$this->user['uid']), array("coinPassword"=>$coinpwd)))
				{
					$this->user['coinPassword'] = $coinpwd;
					$this->session->set_userdata($this->memberSessionName, serialize($this->user));
					echo json_encode('success'); exit;
				}
		        echo json_encode('修改提款密码失败');
			}
		}        
    }

    public final function setFullNamedo(){

		$fullName = $this->input->post('fullName');

		if (!preg_match("/^\p{Han}{2,5}+$/u", $fullName))
	    {
	        echo json_encode("请输入真实姓名[2~5个汉字]"); exit;
	    }

		if($this->user['uid'] && $fullName){
			$user = $this->members_model->get_row(array("uid"=>$this->user['uid']));
			if(!$user['name']) {
				if($this->members_model->update(array("uid"=>$this->user['uid']), array("name"=>$fullName))) {
					$this->user['name'] = $fullName;
					$this->session->set_userdata($this->memberSessionName, serialize($this->user));
					echo json_encode('success');
					exit;
				}else{
					echo json_encode('操作失败');
					exit;
				}
			}else{
				echo json_encode('您已添加过真实姓名,如需修改请联系客服');
				exit;
			}
		}
		echo json_encode('操作失败'); exit;
	}

	public final function bindBankdo(){

		$bankId = $this->input->post('bankId');
		$cardNo = $this->input->post('cardNo');
		$subAddress = $this->input->post('subAddress');

		if($this->user['uid']){
			$res_bank = $this->member_bank_model->get_row(array("uid"=>$this->user['uid']));
			if($res_bank && $res_bank['uid']) {
				echo json_encode('您已绑定银行卡,如需修改请联系客服');
				exit;
			}
			
			$user = $this->members_model->get_row(array("uid"=>$this->user['uid']));
			$username = $user['name'];
			$userbank=array(
				'uid'=>$this->user['uid'],
				'username'=>$username,
				'bankId'=>$bankId,
				'account'=>$cardNo,
				'countname'=>$subAddress
			);
					
			if(!$username || !$bankId || !$cardNo || !$subAddress){
					echo json_encode('填写错误');
					exit;
			}
			try{
				if($this->member_bank_model->insert($userbank)) {
					$this->members_model->update(array("uid"=>$this->user['uid']), array("name"=>$username));
					echo json_encode('success');
					exit;
				}else{
					echo json_encode('绑定失败');
					exit;
				}
		
			}catch(Exception $e){
				echo json_encode($e); exit;
			}

		}
	}

	public function getUserRechCfg()
	{
		$param_cfg = json_decode($this->config->item('PARAM_CFG'));
		$rechTypeList = $param_cfg->rech_type;

		/*if (!$rechTypeList || $rechTypeList.length == 0)
		{
			echo json_encode(''); return;
		}*/
		//var_dump($res->rech_levels[0]->name); exit;
		//var_dump($res->rech_type[0]->name); exit;
		//var_dump($res->rech_bank[0]->name); exit;
		$rechTypeCfgArray = array();
		foreach ($rechTypeList as $item) {
			if($item->open == 0) { // 0-kai 1-
				array_push($rechTypeCfgArray, $item->value);
			}
		}

		$result = $this->common_ssc_model->get_data_sql("select account as payee, payeeName, address, qrCode, onlineType, domain, name as rechName, id, rechType from ssc_sysadmin_bank where enable=1");
		
		//echo json_encode($list);
		/*[{"payee":"","payeeName":"在线支付","address":"","qrCode":null,"onlineType":4,"domain":null,"rechName":"在线支付","id":56,"rechType":"onlinePayment"},{"payee":"123456@163.com","payeeName":"有限公司","address":"转账成功在提交入款订单","qrCode":"/images/148067647052.png","onlineType":null,"domain":null,"rechName":"支付宝支付","id":62,"rechType":"alipay"},{"payee":"","payeeName":"闪付1","address":"","qrCode":null,"onlineType":2,"domain":null,"rechName":"在线支付","id":40,"rechType":"onlinePayment"}]*/

		$onlineData = array(); // 在线充值源数据
		$otherData = array(); // 非在线充值源数据
		
		foreach ($result as $obj) {
			if(!in_array($obj['rechType'], $rechTypeCfgArray))
				continue;
			if($obj['rechType'] == "onlinePayment"){
				array_push($onlineData, $obj);
			} else {
				array_push($otherData, $obj);
			}

		}
		
		/** 处理在线充值数据 start bf[1], sf[2], ht[3/5], htwx[4] */
		$sort = array(1, 3, 5, 4, 2, 6); // 显示顺序：宝付[1]/汇通[3/5]/微信汇通[4]/闪付[2]/支付宝-闪付[6]
		usort($onlineData, function ($a, $b) use ($sort) {
		    $pos_a = array_search($a['onlineType'], $sort);
		    $pos_b = array_search($b['onlineType'], $sort);
		    return $pos_a - $pos_b;
		});
		
		$bankOnlinePayList = [];
		$weixinOnlinePayList = [];
		$alipayOnlineList = [];
		foreach ($onlineData as $obj) {
			// 闪付,银行在线支付
			if($obj['onlineType'] == 2) {
				array_push($bankOnlinePayList, array("id"=> $obj['id'], "order"=> (count($bankOnlinePayList) + 1), "onlineType"=> $obj['onlineType'], "domain"=> $obj['domain']));
			}
			else if($obj['onlineType'] == 4) {
				array_push($weixinOnlinePayList, array("id"=> $obj['id'], "order"=> (count($weixinOnlinePayList) + 1), "onlineType"=> $obj['onlineType'], "payCode"=> 'WEIXIN', "domain"=> $obj['domain']));
			}
			else if ($obj['onlineType'] == 6) {
				array_push($alipayOnlineList, array("id"=> $obj['id'], "order"=> (count($alipayOnlineList) + 1), "onlineType"=> $obj['onlineType'], "payCode"=> '758', "domain"=> $obj['domain']));
			}
			else if ($obj['onlineType'] == 7) {// 微信在线支付 - 闪付
				array_push($weixinOnlinePayList, array("id"=> $obj['id'], "order"=> (count($weixinOnlinePayList) + 1), "onlineType"=> $obj['onlineType'], "payCode"=> '57', "domain"=> $obj['domain']));
			}
			else if ($obj['onlineType'] == 9) { // 智付微信
				array_push($weixinOnlinePayList, array("id"=> $obj['id'], "order"=> (count($weixinOnlinePayList) + 1), "onlineType"=> $obj['onlineType'], "payCode"=> '2', "domain"=> $obj['domain']));
			}
			else if ($obj['onlineType'] == 12) { // 乐盈微信
				array_push($weixinOnlinePayList, array("id"=> $obj['id'], "order"=> (count($weixinOnlinePayList) + 1), "onlineType"=> $obj['onlineType'], "payCode"=> 'wx', "domain"=> $obj['domain']));
			}
			else if ($obj['onlineType'] == 14) { // 久付微信
				array_push($weixinOnlinePayList, array("id"=> $obj['id'], "order"=> (count($weixinOnlinePayList) + 1), "onlineType"=> $obj['onlineType'], "payCode"=> 'wx', "domain"=> $obj['domain']));
			}
			else if ($obj['onlineType'] == 16) {
				array_push($alipayOnlineList, array("id"=> $obj['id'], "order"=> (count($alipayOnlineList) + 1), "onlineType"=> $obj['onlineType'], "payCode"=> '992', "domain"=> $obj['domain']));
			}
			else if ($obj['onlineType'] == 10) {
				array_push($alipayOnlineList, array("id"=> $obj['id'], "order"=> (count($alipayOnlineList) + 1), "onlineType"=> $obj['onlineType'], "payCode"=> 'ZHIFUBAO', "domain"=> $obj['domain']));
			}
			else {
				array_push($bankOnlinePayList, array("id"=> $obj['id'], "order"=> (count($bankOnlinePayList) + 1), "onlineType"=> $obj['onlineType'], "domain"=> $obj['domain']));
			}
		}
		
		$rechTypeMap['bankOnline'] = $bankOnlinePayList;
		$rechTypeMap['weixinOnline'] = $weixinOnlinePayList;
		$rechTypeMap['alipayOnline'] = $alipayOnlineList;
		
		/** 处理在线充值数据 end */
		
		
		/** 处理非在线充值数据 start */
		foreach ($otherData as $obj) {
			$list = $rechTypeMap[$obj['rechType']] || array();
			array_push($list, $obj);
			$rechTypeMap[$obj['rechType']] = $list;
		}
		/** 处理非在线充值数据 end */
		
		return $rechTypeMap;
	}
}