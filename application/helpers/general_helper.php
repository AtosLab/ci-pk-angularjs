<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Content-Type: text/html; charset=utf-8');

	/**
	 * Get Client Ip Address
	 */
	function ip($outFormatAsLong=false){
		if (isset($HTTP_SERVER_VARS['HTTP_X_FORWARDED_FOR']))
			$ip = $HTTP_SERVER_VARS['HTTP_X_FORWARDED_FOR'];
		elseif (isset($HTTP_SERVER_VARS['HTTP_CLIENT_IP']))
			$ip = $HTTP_SERVER_VARS['HTTP_CLIENT_IP'];
		elseif (isset($HTTP_SERVER_VARS['REMOTE_ADDR']))
			$ip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
		elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		elseif (isset($_SERVER['HTTP_CLIENT_IP']))
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		elseif (isset($_SERVER['REMOTE_ADDR']))
			$ip = $_SERVER['REMOTE_ADDR'];
		else
			$ip = '0.0.0.0';
		if(strrpos(',',$ip)>=0){
			$ip = explode(',',$ip,2);
			$ip = current($ip);
		}
		return $outFormatAsLong ? ip2long($ip) : $ip;
	}
	/**
	 * Filter string
	 */
	function wjStrFilter($str,$pi_Def="",$pi_iType=1){

		if ($str)
			$str = trim($str);
		else
			return $pi_Def;
		// INT
		if ($pi_iType==0)
		{
			if (is_numeric($str))
				return $str;
			else
				return $pi_Def;
		}
	  
		// String
		if($str){
			$str=str_replace("chr(9)","&nbsp;",$str);
			$str=str_replace("chr(10)chr(13)","<br />",$str);
			$str=str_replace("chr(10)","<br />",$str);
			$str=str_replace("chr(13)","<br />",$str);
			$str=str_replace("chr(32)","&nbsp;",$str);
			$str=str_replace("chr(34)","&quot;",$str);
			$str=str_replace("chr(39)","&#39;",$str);
			$str=str_replace("script", "&#115cript",$str);
			$str=str_replace("&","&amp;",$str);
			$str=str_replace(";","&#59;",$str);
			$str=str_replace("'","&#39;",$str);
			$str=str_replace("<","&lt;",$str);
			$str=str_replace(">","&gt;",$str);
			$str=str_replace("#","&#40;",$str);
			$str=str_replace("*","&#42;",$str);
			$str=str_replace("--","&#45;&#45;",$str);
			
			$str=preg_replace("/insert/i", "",$str);
			$str=preg_replace("/update/i", "",$str);
			$str=preg_replace("/delete/i", "",$str);
			$str=preg_replace("/select/i", "",$str);
			$str=preg_replace("/drop/i", "",$str);
			$str=preg_replace("/load_file/i", "",$str);
			$str=preg_replace("/outfile/i", "",$str);
			$str=preg_replace("/into/i", "",$str);
			$str=preg_replace("/exec/i", "",$str);
			$str=preg_replace("/ssc_/i", "",$str);
			$str=preg_replace("/union/i", "",$str);
			$str=preg_replace("/%/i", "",$str);
			
			if (get_magic_quotes_gpc()){
				$str = str_replace("\\\"", "&quot;",$str);
				$str = str_replace("\\''", "&#039;",$str);
			}else{
				$str = addslashes($str);
				$str = str_replace("\"", "&quot;",$str);
				$str = str_replace("'", "&#039;",$str);
				
			}
		}
		return $str;
	}

	function getBrowser(){
		$flag=$_SERVER['HTTP_USER_AGENT'];
		$para=array();
		
		// 检查操作系统
		if(preg_match('/Windows[\d\. \w]*/',$flag, $match)) $para['os']=$match[0];
		
		if(preg_match('/Chrome\/[\d\.\w]*/',$flag, $match)){
			// 检查Chrome
			$para['browser']=$match[0];
		}elseif(preg_match('/Safari\/[\d\.\w]*/',$flag, $match)){
			// 检查Safari
			$para['browser']=$match[0];
		}elseif(preg_match('/MSIE [\d\.\w]*/',$flag, $match)){
			// IE
			$para['browser']=$match[0];
		}elseif(preg_match('/Opera\/[\d\.\w]*/',$flag, $match)){
			// opera
			$para['browser']=$match[0];
		}elseif(preg_match('/Firefox\/[\d\.\w]*/',$flag, $match)){
			// Firefox
			$para['browser']=$match[0];
		}elseif(preg_match('/OmniWeb\/(v*)([^\s|;]+)/i',$flag, $match)){
			//OmniWeb
			$para['browser']=$match[2];
		}elseif(preg_match('/Netscape([\d]*)\/([^\s]+)/i',$flag, $match)){
			//Netscape
			$para['browser']=$match[2];
		}elseif(preg_match('/Lynx\/([^\s]+)/i',$flag, $match)){
			//Lynx
			$para['browser']=$match[1];
		}elseif(preg_match('/360SE/i',$flag, $match)){
			//360SE
			$para['browser']='360安全浏览器';
		}elseif(preg_match('/SE 2.x/i',$flag, $match)) {
			//搜狗
			$para['browser']='搜狗浏览器';
		}else{
			$para['browser']='unkown';
		}
		//print_r($para);exit;
		return $para;
	}
?>