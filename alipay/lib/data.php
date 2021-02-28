<?php
include_once 'service.class.php';
include_once 'query.class.php';
include_once 'config.php';
$domain = RealUrl();
if($_REQUEST['action'] == "serve"){   
    $json = Query($pay_config['appid'],$pay_config['private_key'],$_POST['gid'],$_POST['name'],$_POST['des']);
    echo json_encode($json,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}

//发起订单
function Service($appid,$private,$payAmount,$orderDes,$OrderID,$notify=''){
	$aliPay = new AlipayService();
	$aliPay->setAppid($appid);
	$aliPay->setNotifyUrl($notify);
	$aliPay->setRsaPrivateKey($private);
	$aliPay->setTotalFee($payAmount);
	$aliPay->setOutTradeNo($OrderID);
	$aliPay->setOrderName('收银台');
	$result = $aliPay->doPay();
	$value = $result['alipay_trade_precreate_response'];
	return $value;
}
//查询订单状态
function Query($appid,$private,$outTradeNo,$name,$des){
	$aliPay = new AlipayQuery();
	$aliPay->setAppid($appid);
	$aliPay->setRsaPrivateKey($private);
	$aliPay->setOutTradeNo($outTradeNo);
	$result = $aliPay->doQuery();
	$data = $result['alipay_trade_query_response'];	
	if($data['trade_status'] == 'TRADE_SUCCESS'){
	    session_start();
        if($_SESSION[$outTradeNo]==""&&!file_exists("lib/danhao/".$outTradeNo)){
            file_put_contents('danhao/'.$outTradeNo, '');
    	    file_put_contents("jilu.txt", urldecode($name)."----".$data['total_amount']."----".urldecode($des)."----".$data['send_pay_date']."\r\n", FILE_APPEND);
            $_SESSION[$outTradeNo]=1;
        }
		$value = array('code'=>200,'msg'=>'支付成功');
	}else{
		$value = array('code'=>202,'msg'=>'未知状态');
	}
	return $value;
}
//获取当前域名
function RealUrl(){
	static $real_url = NULL;   
	if ($real_url !== NULL){return $real_url;}
	$real_url  = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
	$real_url .= $_SERVER["SERVER_NAME"];
	$real_url .= in_array($_SERVER['SERVER_PORT'], array(80, 443)) ? '/' : ':' . $_SERVER['SERVER_PORT'];
	return $real_url;
}

?>