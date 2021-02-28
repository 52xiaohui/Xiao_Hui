<?php include_once 'lib/data.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
<meta name="description" content="<?php echo $pay_config['describe'];?>">
<link rel="shortcut icon" href="https://q1.qlogo.cn/g?b=qq&nk=<?php echo $pay_config['qq'];?>&s=100">
<meta itemprop="image" content="https://q1.qlogo.cn/g?b=qq&nk=<?php echo $pay_config['qq'];?>&s=100">
<link rel="stylesheet" type="text/css" href="https://vkceyugu.cdn.bspapp.com/VKCEYUGU-xiaohui666/36945c20-4cbb-11eb-bdc1-8bd33eb6adaa.css" />
<script src="https://cdn.bootcdn.net/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
</head>
<body>
<div class="web">
	<div class="container">
		<!--头部信息-->
		<header class="header">
		    <div class="header-logo">
			    <div class="portrait"><img src="https://q1.qlogo.cn/g?b=qq&nk=<?php echo $pay_config['qq'];?>&s=640" alt="<?php echo $pay_config['title'];?>"></div>
				<div class="synopsis">
				    <?php echo $pay_config['name'];?>
					<div class="des">
<div id="shi_jian"></div>
<h3>做一条有梦想的咸鱼</h3></div>
				</div>
			</div>
			<div class="header-default">
			    <form action="./query.php?action=pay" method="post">
				    <div class="group">
					    <label>打赏金额</label>
						<input type="text" name="money" value="1" required>
					</div>
					<div class="group">
					    <label>大侠称呼</label>
						<input type="text" name="name" value="匿名" required>
					</div>
					<div class="group">
					    <label>大侠留言</label>
						<input type="text" name="des" value="加油 ♥" required>
					</div>
					<button type="submit" id="submit">立即打赏</button>

				</form>

		</header>
		
	</div>
	<div class="footer">
	    <p><a href="http://beian.miit.gov.cn" target="_blank" rel="nofollow">湘ICP备18022737号-1</a>&nbsp;技术：<a href="https://wpa.qq.com/msgrd?v=3&uin=3255819212&site=qq&menu=yes" target="_blank">Xiao_Hui</a></p>
		<p>Copyright © 2020 Xiao_Hui</p>
	</div>
</div>
    <script src="https://www.layuicdn.com/layui/layui.js"></script>
<script>
$('#submit').click(function (){
	var money = $("input[name=money]").val();
	var reg = /^[0-9]*[0-9](.[0-9]{0,2})?$/;
	if (!reg.test(money)||money == 0){
		alert("请输入正确赏金");
		return false;
	}
	if (money > 1000){
		alert("赏金不能大于1000噢");
		return false;
	}
	return true;
});
</script>
   <script>
        window.onload=function(){
            var go_time=new Date("2021/6/25 00:00:00");
            //  countdown：倒计时
                 function  countdown(){
                var now_time=new Date();
                var alltime =go_time.getTime() -now_time.getTime ();  //总的时间（毫秒）
               var haoscend =alltime%1000;  //毫秒
                //console.log(haoscend);
                var scend = parseInt ((alltime/1000)%60  ) ;  //秒
                //console.log(scend);
                var minute =parseInt((alltime/1000/60)%60  ) ;  //  分钟
               // console.log(minute);
                var hour =parseInt((alltime/1000/60/60)%24 ) ;   //小时
               // console.log(hour);
                var day=parseInt((alltime/1000/60/60/24)%30);   //天数
               // console.log(day);
                var month=parseInt((alltime/1000/60/60/24/30)%12); //月
               // console.log(month);
                var btime=document.getElementById("block");
                var time1=document.getElementById("shi_jian");
                time1.innerHTML ="距离中考还有："+month+"月"+day+"天"+hour+"时"+minute +"分"+scend +"秒"+(haoscend<10 ?"00"+haoscend :haoscend <100?"0"+haoscend :haoscend );
                setTimeout (countdown ,1);  //不加括号
            }
           countdown ();
        }

    </script>

</body>
</html>