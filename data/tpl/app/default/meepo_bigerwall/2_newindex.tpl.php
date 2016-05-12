<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head><meta charset="utf-8">
		<title>微现场</title>
		<link rel="stylesheet" href="<?php echo MEEPO;?>common/css/common.css" />
		<link rel="stylesheet" href="<?php echo MEEPO;?>common/css/header.css" />
		<link rel="stylesheet" href="<?php echo MEEPO;?>common/css/footer.css" />
		<link rel="stylesheet" href="<?php echo MEEPO;?>common/css/layer.css" />
		<link rel="stylesheet" href="<?php echo MEEPO;?>common/css/tooltips.css" />
		<?php  if(empty($ridwall['bgimg'])) { ?>
		<link id="skincss" rel="stylesheet" href="<?php echo MEEPO;?>/skin/css/<?php  echo $style;?>" />
		<?php  } ?>
		<script src="<?php echo MEEPO;?>common/js/jquery-1.8.3.min.js" ></script>
		<script>
			window.onresize = function () { 
				$('#wrap').height($(window).height());
				$('#wrap').width($(window).width());
			};//窗口大小改变
		</script>
		<script src="<?php echo MEEPO;?>common/js/jquery.tooltipster.min.js" ></script>
		<script src="<?php echo MEEPO;?>common/js/head.js"></script>
		<script src="<?php echo MEEPO;?>common/js/chromeTip.js"></script>
		<script src="<?php echo MEEPO;?>common/js/init.js"></script>
		<?php  if($ridwall['cjshow']==1) { ?>
		<script src="<?php echo MEEPO;?>common/js/cj.js"></script>
		<?php  } ?>
		<?php  if($ridwall['tpshow']==1) { ?>
		<script src="<?php echo MEEPO;?>common/js/vote.js"></script>
		<?php  } ?>
		<?php  if($ridwall['ddpshow']==1) { ?>
		<script src="<?php echo MEEPO;?>common/js/ddp.js"></script>
		<?php  } ?>
		<script src="<?php echo MEEPO;?>common/js/tiptool.js"></script>
		<script src="<?php echo MEEPO;?>qd/signwall.js" /></script>
		<script type="text/javascript">
		var ws_config = {
			updateTime     : 0,
			autoCheckTime  : <?php  echo intval($ridwall['refreshtime'])?>,  
			sayTaskTime    : <?php  echo intval($ridwall['saytasktime'])?>
		}
		var ws_say={
			index:0,
			indexMax:0, 
			indexDetail:0,
			page:3,
			runkey:0, 
			news:"",
			list:""
		}
		var t = null; //显示留言墙
		var voteTimer = null;
		<?php  if($ridwall['followagain']==1) { ?>
		var followagain = true;
		<?php  } else { ?>
		var followagain = false;
		<?php  } ?>
		var INIT = "<?php  echo $this->createMobileUrl('init',array('rid'=>$rid))?>";
		var GETMORE2 = "<?php  echo $this->createMobileUrl('getmore2',array('rid'=>$rid))?>";
		var GETMOREPOLLSIGN = "<?php  echo $this->createMobileUrl('getmorepollsign',array('rid'=>$rid))?>";
		var GETMOREPOLL = "<?php  echo $this->createMobileUrl('getmorepoll',array('rid'=>$rid))?>";
		var LUCKTAGLIST = "<?php  echo $this->createMobileUrl('lucktaglist',array('rid'=>$rid))?>";
		var HADLUCKUSER = "<?php  echo $this->createMobileUrl('hadluckuser',array('rid'=>$rid))?>";
		var CJREADY = "<?php  echo $this->createMobileUrl('cjready',array('rid'=>$rid))?>";
		var LUCKCONTENT = "<?php  echo $this->createMobileUrl('luckcontent',array('rid'=>$rid))?>";
		var LUCKUSERLIST = "<?php  echo $this->createMobileUrl('luckuserlist',array('rid'=>$rid))?>";
		var REMOVELUCKUSER = "<?php  echo $this->createMobileUrl('removeluckuser',array('rid'=>$rid))?>";
		var RESET = "<?php  echo $this->createMobileUrl('reset',array('rid'=>$rid))?>";
		var SAVELUCKUSER = "<?php  echo $this->createMobileUrl('saveluckuser',array('rid'=>$rid))?>";
		var CJIMGURL = <?php  if(empty($ridwall['cjimgurl'])) { ?>"<?php echo MEEPO;?>common/images/lotteryDefault.png"<?php  } else { ?>"<?php  echo $_W['attachurl'];?><?php  echo $ridwall['cjimgurl'];?>"<?php  } ?>;
		var GETVOTE = "<?php  echo $this->createMobileUrl('getvote',array('rid'=>$rid))?>";
		var VOTESUM = "<?php  echo $this->createMobileUrl('votesum',array('rid'=>$rid))?>";
		var VOTECONTENT = "<?php  echo $ridwall['votetitle'];?>";

		var PAIRMANREADY = "<?php  echo $this->createMobileUrl('pairmanready',array('rid'=>$rid))?>";
		var PAIRWOMANREADY = "<?php  echo $this->createMobileUrl('pairwomanready',array('rid'=>$rid))?>";
 
 
        var HEADMSG = "<?php  echo $this->createMobileUrl('headmsg',array('rid'=>$rid))?>";
		var defaultshow = "<?php  echo intval($ridwall['defaultshow'])?>";
		var voterefreshtime = "<?php  echo $ridwall['voterefreshtime']?>";
		var account_name = "<?php  echo $_W['account']['name'];?>";

		var SIGNTOTAL = '<?php  echo $signtotal;?>';
		var rotate_rid = "<?php  echo $rid;?>";
		var weid = "<?php  echo $_W['uniacid'];?>";
		var weburl = "<?php  echo $_W['siteroot'];?>";
			function init(){
				initSay();
				initSignin();
				startTask(); 
				changeWall(defaultshow);
				initimg();
				$(".loader").hide("slow");
			}
			function checkData(){
				<?php  if($ridwall['qdqshow']) { ?>
				   $("#countP").html($("#signcheckTime").val() + "人签到<br>" + $("#checkTime").val() + "条发言");
				<?php  } else { ?>
				   $("#countP").html($("#checkTime").val() + "条发言");
				<?php  } ?>
				if(isCheck==1){
					$.getJSON(GETMORE2+"&num="+$("#checkTime").val()+"&signnum="+$("#signcheckTime").val()+"&rid="+rotate_rid+"&jsoncallback="+new Date().getTime(), function(msg){
						if(msg.hadsign==1 || msg.hadsay==1){
							
							if(msg.hadsay==1){
							$("#sayUpdateTime").val(msg.time);
							}
							if(msg.hadsign==1){
							$("#signUpdateTime").val(msg.time2);
							}
							isCheck=0 
							
							updateData(msg.hadsign,msg.hadsay);
						}
					});
				}
			}

		</script>
		<link rel="stylesheet" href="<?php echo MEEPO;?>qd/animate.css" />
		<link rel="stylesheet" href="<?php echo MEEPO;?>qd/qd.css" />
		<link rel="stylesheet" href="<?php echo MEEPO;?>skin/skinSelect.css" />
	    <script src="<?php echo MEEPO;?>skin/skinCheck.js" ></script>
		<link rel="stylesheet" href="<?php echo MEEPO;?>liuyan/liuyan.css" />
		<link rel="stylesheet" href="<?php echo MEEPO;?>cj/cj.css" />
		<link rel="stylesheet" href="<?php echo MEEPO;?>tp/tp.css" />
		<link rel="stylesheet" href="<?php echo MEEPO;?>ddp/ddp.css" />
		
<?php  if(!empty($ridwall['bgimg'])) { ?>
		<style >
		
		body{background-image: url('<?php  echo $_W['attachurl'];?><?php  echo $ridwall['bgimg'];?>');}
		.avatar{border-radius: 50%; -webkit-border-radius: 50%; -moz-border-radius: 50%;}
		.contIcon{background: url(<?php echo MEEPO;?>skin/images/defaultConIconsV1.0.png) no-repeat;}
		.theResult{background: url(<?php echo MEEPO;?>skin/images/defaultResultV1.0.png) no-repeat center 1px;}
		.pairPerson{background-image: url(<?php echo MEEPO;?>skin/images/defaultPairV1.0.png);}
		.colorStyle{color: <?php  echo $ridwall['fontcolor'];?>}
		.colorOne{color: <?php  echo $ridwall['fontcolor'];?>}
		.borderStyle .play{border-color: rgba(255, 255, 255, 0.35);}
		.borderStyle .animation .play{border-color: #fff;}
		.borderStyle li{border-color: rgba(255, 255, 255, 0.8);}
		.borderStyle .msgFor{border-bottom-color:  rgba(255, 255, 255, 0.7);}
		.btnStyle{color: #e4652e; border-color: #d3b902; background: #ffea53; box-shadow: 0 2px 2px 0 #fff4a8 inset; -weibit-box-shadow: 0 2px 2px 0 #fff4a8 inset; -moz-box-shadow: 0 2px 2px 0 #fff4a8 inset;}
		.menuStyle a{border-color: rgba(255, 255, 255, 0.35); background: url(<?php echo MEEPO;?>skin/images/defaultIconsV1.0.png) no-repeat;}
		#yyy {background: url(<?php echo MEEPO;?>skin/images/icons8e0e.png) no-repeat !important;background-position: -2px -82px !important;}
		</style>
		<?php  } ?>
	</head>
	<body onLoad="init()" style="
margin: 0;
padding: 0;
height: 100%;
width: 100%;
background-repeat: no-repeat;
background-size: cover;
overflow: hidden;
font-family: Microsoft YaHei, Helvitica, Verdana, Tohoma, Arial, san-serif;">
		<input id="checkTime" type="hidden" value="<?php  echo $walltotal;?>" />
        <input id="signcheckTime" type="hidden" value="<?php  echo $signtotal;?>" />
		<input id="signUpdateTime" type="hidden" value="0" />
		<input id="sayUpdateTime" type="hidden" value="0" />
		<input type="hidden" value='<?php  echo time();?>' id="tanmutime"/>
		<div id="wrap" class="wrapBg">
			<div id="whole">
			<div class="loader">Loading...</div>
				
				<div class="header clearfix">
					<div style="float:left"  id="goto">
					  <span style="display:block;margin-top:10px"><img id="logurl" name="home.logurl" src="<?php  if(empty($ridwall['toplogo'])) { ?><?php echo MEEPO;?>common/images/logoV1.0.png<?php  } else { ?><?php  echo $_W['attachurl'];?><?php  echo $ridwall['toplogo'];?><?php  } ?>"  src="" /></span>
					 
					</div>
					<div class="wordScroll">
						<div class="scrollBox colorStyle">
							<ul>
							<p id="title"></p>
							</ul>
						</div>
						<div class="num colorStyle">
							<p><span id="countP" style="font-size: 15px;"></span></p>
						</div>
					</div>
					<div class="QRcode" >
					<img id="wscode" name="home.qrurl" src="<?php  echo $_W['attachurl'];?><?php  echo $ridwall['erweima'];?>" height=100px width=100px  class="bottom-code" />
					</div>
				</div>
			    <div class="pop" id="pop-code">
				  <a class="pop-close" href="javascript:;"></a>
				  <div class="pop-code">
					<p>
					  <span><img src="<?php  echo $_W['attachurl'];?><?php  echo $ridwall['erweima'];?>" ></span>
					  <small>微信扫一扫，发送<b><?php  echo $keyword;?></b>即可参与</small>
					</p>
				  </div>
				</div>
				<div id="container">
					
<div id="skinSelect" class="contBox skinSelect clearfix">
	<div class="skinMenu">
		<h3>大屏幕风格</h3>
		<p><img src="<?php echo MEEPO;?>common/images/skinIcon.png" /></p>
		<ul>
			<li class="cur"><a href="javascript:void(0)" onclick="showShinBox('all',this)">所有风格</a></li>
		</ul>
	</div>
	<div class="skinBox" id="all">
		<ul>
			<li <?php  if($style=='defaultV1.0.css') { ?>class="check"<?php  } ?>><img type="1" src="<?php echo MEEPO;?>skin/images/defaultV1.0.jpg" cssfile="defaultV1.0.css" />
				<p><span>默认风格</span></p>
			</li>
			<li <?php  if($style=='LanternFestival_1') { ?>class="check"<?php  } ?>><img type="1" src="<?php echo MEEPO;?>skin/images/LanternFestival_1V1.0.jpg" cssfile="LanternFestival_1.css" />
				<p><span>元宵节</span></p>
			</li>
			<li <?php  if($style=='SpringFestival_1.css') { ?>class="check"<?php  } ?>><img type="1" src="<?php echo MEEPO;?>skin/images/SpringFestival_1V1.0.jpg" cssfile="SpringFestival_1.css" />
				<p><span>春节1</span></p>
			</li>
			<li <?php  if($style=='SpringFestival_2.css') { ?>class="check"<?php  } ?>><img type="1" src="<?php echo MEEPO;?>skin/images/SpringFestival_2V1.0.jpg" cssfile="SpringFestival_2.css" />
				<p><span>春节2</span></p>
			</li>
			<li <?php  if($style=='SpringFestival_3.css') { ?>class="check"<?php  } ?>><img type="1" src="<?php echo MEEPO;?>skin/images/SpringFestival_3V1.0.jpg" cssfile="SpringFestival_3.css" />
				<p><span>春节3</span></p>
			</li>
			<li <?php  if($style=='Valentine_1.css') { ?>class="check"<?php  } ?>><img type="1" src="<?php echo MEEPO;?>skin/images/Valentine_1V1.0.jpg" cssfile="Valentine_1.css" />
				<p><span>情人节1</span></p>
			</li>
			<li <?php  if($style=='Valentine_2.css') { ?>class="check"<?php  } ?>><img type="1" src="<?php echo MEEPO;?>skin/images/Valentine_2V1.0.jpg" cssfile="Valentine_2.css" />
				<p><span>情人节2</span></p>
			</li>
			<li <?php  if($style=='Valentine_3.css') { ?>class="check"<?php  } ?>><img type="1" src="<?php echo MEEPO;?>skin/images/Valentine_3V1.0.jpg" cssfile="Valentine_3.css" />
				<p><span>情人节3</span></p>
			</li>
			<li <?php  if($style=='colorRed_1.css') { ?>class="check"<?php  } ?>><img type="1" src="<?php echo MEEPO;?>skin/images/colorRed_1V1.0.jpg" cssfile="colorRed_1.css" />
				<p><span>红色</span></p>
			</li>
			<li <?php  if($style=='colorBluishViolet_1.css') { ?>class="check"<?php  } ?>><img type="1" src="<?php echo MEEPO;?>skin/images/colorBluishViolet_1V1.0.jpg" cssfile="colorBluishViolet_1.css" />
				<p><span>蓝色</span></p>
			</li>
			<li <?php  if($style=='colorClaret_1.css') { ?>class="check"<?php  } ?>><img type="1" src="<?php echo MEEPO;?>skin/images/colorClaret_1V1.0.jpg" cssfile="colorClaret_1.css" />
				<p><span>紫红色</span></p>
			</li>
			<li <?php  if($style=='Christmas_1.css') { ?>class="check"<?php  } ?>><img type="1" src="<?php echo MEEPO;?>skin/images/Christmas_1V1.0.jpg" cssfile="Christmas_1.css" />
				<p><span>圣诞节</span></p>
			</li>
			<li <?php  if($style=='christmasblue.css') { ?>class="check"<?php  } ?>><img type="1" src="<?php echo MEEPO;?>skin/images/christmasbluebg.jpg" cssfile="christmasblue.css" />
				<p><span>圣诞blue</span></p>
			</li>
			<li <?php  if($style=='christmasred.css') { ?>class="check"<?php  } ?>><img type="1" src="<?php echo MEEPO;?>skin/images/christmasred.jpg" cssfile="christmasred.css" />
				<p><span>圣诞red</span></p>
			</li>
			<li <?php  if($style=='loveheart1.css') { ?>class="check"<?php  } ?>><img type="1" src="<?php echo MEEPO;?>skin/images/loveheart1.jpg" cssfile="loveheart1.css" />
				<p><span>罗曼蒂克1</span></p>
			</li>
			<li <?php  if($style=='loveheart2.css') { ?>class="check"<?php  } ?>><img type="1" src="<?php echo MEEPO;?>skin/images/loveheart2.jpg" cssfile="loveheart2.css" />
				<p><span>罗曼蒂克2</span></p>
			</li>
		</ul>
	</div>
	<div class="skinBox" id="holiday">
		<ul>
			<li class="check"><img src="<?php echo MEEPO;?>skin/images/defaultV1.0.jpg" fontcss="" menucss=""  btncss=""  btntxtcss="" spancss="" />
				<p><span>免费</span></p>
			</li>
			<li><img src="<?php echo MEEPO;?>skin/images/defaultV1.0.jpg" fontcss="" menucss=""  btncss=""  btntxtcss="" spancss="" />
				<p><span>免费</span></p>
			</li>
			<li><img src="<?php echo MEEPO;?>skin/images/defaultV1.0.jpg" fontcss="" menucss=""  btncss=""  btntxtcss="" spancss="" />
				<p><span>免费</span></p>
			</li>
			<li><img src="<?php echo MEEPO;?>skin/images/defaultV1.0.jpg" fontcss="" menucss=""  btncss=""  btntxtcss="" spancss="" />
				<p><span>免费</span></p>
			</li>
		</ul>
	</div>
	<div class="skinBox" id="free">
		<ul>
			<li class="check"><img src="<?php echo MEEPO;?>skin/images/defaultV1.0.jpg" fontcss="" menucss=""  btncss=""  btntxtcss="" spancss="" />
				<p><span>免费</span></p>
			</li>
			<li><img src="<?php echo MEEPO;?>skin/images/defaultV1.0.jpg" fontcss="" menucss=""  btncss=""  btntxtcss="" spancss="" />
				<p><span>免费</span></p>
			</li>
			<li><img src="<?php echo MEEPO;?>skin/images/defaultV1.0.jpg" fontcss="" menucss=""  btncss=""  btntxtcss="" spancss="" />
				<p><span>免费</span></p>
			</li>
			<li><img src="<?php echo MEEPO;?>skin/images/defaultV1.0.jpg" fontcss="" menucss=""  btncss=""  btntxtcss="" spancss="" />
				<p><span>免费</span></p>
			</li>
		</ul>
	</div>
</div>
<script type="text/javascript" src="<?php echo MEEPO;?>skin/skinCheck.js"></script>
					
					<div id="siginWall" class="contBox siginWall borderStyle">
						<ul  id="signlist">
						<?php  if(is_array($signusers)) { foreach($signusers as $row) { ?>
						
					    			<li id="<?php  echo $row['openid'];?>" class="user-had">
					    				<div class="play">
	<input type="hidden" name="p<?php  echo $row['sex'];?>" value="<?php  if(!$row['cjstatu']) { ?><?php  echo $row['nickname'];?>|<?php  echo $row['sex'];?>|<?php  echo $row['avatar'];?>|<?php  echo $row['openid'];?><?php  } else { ?><?php  echo $row['nickname'];?>|<?php  echo $row['sex'];?>|<?php  echo $row['avatar'];?>|<?php  echo $row['openid'];?>|<?php  echo $row['cjstatu'];?><?php  } ?>">
											<div class="avatar"><img src="<?php  echo $row['avatar'];?>" /><p><?php  echo $row['nickname'];?></p></div>
											<div class="siginWords">
												<i class="leftside"></i>
												    <p> <?php  echo $row['content'];?> </p>
											</div>
										</div>
									</li>
									
                       <?php  } } ?>
						</ul>
					</div>
				
	<div id="msgWall" class="contBox msgWall borderStyle">
		<ul id="saylist"></ul>
	</div>
	
	<div id="msgDetail" class="contBox msgDetail">
		<ul id="sayDetailList"></ul>
	</div>
	
	<div class="contBox lotteryWall clearfix" id="lotteryWall">
						<div class="lotteryBox">
							<div class="lotteryTit clearfix colorStyle">
								<span class="contIcon" id="luckTitle">现场抽奖</span>
								<p>参加抽奖人数<em id="may_num">0</em></p>
							</div>
							<dl class="lotteryPerson colorStyle">
								<dt><img src="<?php echo MEEPO;?>common/images/lotteryDefault.png" id="luck_img"/></dt>
								<dd id="luck_name"></dd>
							</dl>
							<table width="472" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td align="left">
										<p>
											<select name="luckTag" id="tagid" class="selStyle sel180" onchange="changeLuck(this.value);">
											<option value='-1'>--请选择奖项--</option>
											</select>
										</p>
										<div id="num_input" style="display:none">
											<p id="prizeName"><input type="text" id="comment"  placeholder="抽奖前请备注奖品" class="txtStyle txt180"  maxlength="7"/></p>
											<p class="colorOne" id="prizeNum">
												一次抽取               
												<select id="num" name="" class="selStyle sel80">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="10">10</option>
													<option value="11">11</option>
													<option value="12">12</option>
													<option value="13">13</option>
													<option value="14">14</option>
													<option value="15">15</option>
													<option value="16">16</option>
													<option value="17">17</option>
													<option value="18">18</option>
													<option value="19">19</option>
													<option value="20">20</option>
													<option value="30">30</option>
													<option value="40">40</option>
													<option value="50">50</option>
													<option value="60">60</option>
													<option value="70">70</option>
													<option value="80">80</option>
													<option value="90">90</option>
													<option value="100">100</option>
													<option value="200">200</option>
												</select>
												人
											</p>
										</div>
									</td>
									<td align="right">
										<p id="tag_flag">
											<input type="button" id="startBtn" class="btnStyle btn255" onclick="startBtn();" value="开始抽奖"/>
											<input type="button"  style="display:none" id="endBtn" value="结束抽奖" class="btnStyle btn255" onclick="endBtn();"/>
										</p>
										<p id="num_flag" style="display:none">
											<input type="button" id="startNum" value="开始抽奖" class="btnStyle btn255" onclick="start();"/>
											<input type="button"  id="endNum" value="结束抽奖" class="btnStyle btn255" onclick="stop();"/>
										</p>
									</td>
							</table>
						</div>
						<input type="hidden" id="luckid" value="">
						<input type="hidden" id="luckname" value="">
						<input type="hidden" id="tagExclude" value="">
						<input type="hidden" id="tagNum" value="">
						<input type="hidden" id="numExclude" value="">
						<div class="lotteryResult theResult">
							<div class="lotteryCont">
								<h3 class="clearfix"><p>获奖人数<em id="lucknum">0</em></p>获奖名单</h3>
								<div class="lotterys">
									<div class="lotteryInfo">
										<span>序号</span>
										<span class="dot">获奖人</span>
										<span>奖项</span></li>
									</div>
									<div class="lotteryName">
										<div class="lotteryDefault">
										点击按钮，开始抽奖吧！
										</div>
										<ul id="luck_index">
										<p id="lotteryName"></p>
										</ul>
									</div>
									<div class="lotteryBtn"><input type="button" id="newLuckButton" value="重新抽奖" class="btnStyle btn90" onclick="javascript:reset();"/></div><!--showLayer(4)-->
								</div>
							</div>
						</div>
					</div>
					
	<div class="contBox voteWall" id="voteWall">
		<div class="voteTit clearfix">
			<div class="voteTxt clearfix" style="width:640px">
				<h3 id="content"></h3>
				<p>微信关注“<?php  echo $_W['account']['name'];?>”，发送“<?php  echo $ridwall['tp_keyword'];?>”即可参与投票</p>
			</div>
			<div class="voteType">
				<div class="voteNum">共<span id="sum" style="color:red;">0</span>人参与投票</div>
				
			</div>
		</div>
		<div class="voteResult clearfix" style="height:316px;">
			<ul id="vote">
			</ul>
			<ul id="vote1">
			</ul>
		</div>
		<div class="voteNote">
			<p>注：<span class="color pink"></span>票数第一<span class="color blue"></span>票数第二<span class="color green"></span>票数第三</p>
		</div>
	</div>
	
	<div class="contBox tanmuWall" id="voteWall" style="display:none">
		<div id="danmuarea">
		    <div id="danmu" style="width: 100%; position: absolute; left: 0px; top: 0px; height: 100%; z-index: 100; color: rgb(255, 255, 255); font-family: SimHei; font-size: 30px; overflow: hidden;">
			<div class="timer71452"></div>
			</div>
        </div>
	</div>
	 					
					<div id="pairWall" class="contBox pairWall clearfix">
						<div class="pairBox">
							<div class="pairTit clearfix colorStyle">
								<span class="contIcon">缘分对对碰</span>
								<p>参加配对人数<em id='pairyuan'>89</em></p>
							</div>
							<div class="pairPerson clearfix colorStyle">
								<dl class="left">
									<dt><img id="man" src="<?php echo MEEPO;?>common/images/pairDefault.png" /></dt>
									<dd><span class="contIcon">***</span></dd>
								</dl>
								<dl class="right">
									<dt><img  src="<?php echo MEEPO;?>common/images/pairDefault.png" /></dt>
									<dd><span class="contIcon">***</span></dd>
								</dl>
							</div>
							<div class="pairBtn">
							<input type="button" id="pairstartBtn1" value="为Ta求缘分" class="btnStyle btn255" onclick="pairstartBtn1();"/>
							<input type="button" style="display:none" id="pairendBtn1" value="停止" class="btnStyle btn255" onclick="pairendBtn1();"/>
							
							</div>
						</div>
						<div class="pairResult theResult">
							<div class="pairCont">
								<h3 class="clearfix"><p>配对组数<span id="ccou">0</span></p>配对名单</h3>
								<div class="pairings">
									<div class="pairInfo">
										<span>配对序号</span>
										<span class="dot">配对的微信昵称</span></li>
									</div>
									<div class="pairName">
										<div class="pairDefault">点击按钮，开始配对吧！</div>
										<ul id="pairlist">
										</ul>
									</div>
									<div class="lotteryBtn"><input type="button" id="btnret" onclick="btnret();" value="重新配对" class="btnStyle btn90" /></div>
								</div>
							</div>
						</div>
					</div>
					
	                
					
				</div>
				
				<div id="tabMenu" class="footer clearfix">
					<div class="btnIcon btnMenu menuStyle">
					<?php  if(empty($ridwall['bgimg'])) { ?>
					<a href="javascript:void(0)" title="更换风格，快捷键“F”" data-class="skinSelect" class="btnSkinSel tooltipstered tooltip"></a>
					<?php  } ?>
						<?php  if($ridwall['qdqshow']) { ?>
						<a href="javascript:void(0)" title="签到墙，快捷键“Q”" data-class = "siginWall" class="btnCheckIn tooltipstered tooltip" ></a>
						<?php  } ?>
						<a href="javascript:void(0)" title="上墙留言，快捷键“M”" data-class = "msgWall" class="btnTheWall tooltipstered tooltip" ></a>
						<?php  if($ridwall['cjshow']) { ?>
						<a href="javascript:void(0)" title="抽奖，快捷键“C”"  data-class="lotteryWall" class="btnLottery tooltipstered tooltip"></a>
						<?php  } ?>
						<?php  if($ridwall['tpshow']) { ?>
						<a href="javascript:void(0)" title="投票，快捷键“T”"  data-class="voteWall" class="btnVote tooltipstered tooltip"></a>
						<?php  } ?>
						<?php  if($ridwall['ddpshow']) { ?>
						<a href="javascript:void(0)" title="对对碰，快捷键“D”" data-class="pairWall" class="btnPair tooltipstered tooltip"></a>
						<?php  } ?>
						
                        <?php  if($ridwall['danmushow']) { ?>
						<a href="javascript:void(0)"  title="弹幕，快捷键“N”"  data-class="tanmuWall" class="btnTanmu tooltipstered tooltip" target="_blank"></a>
						<?php  } ?>
						<?php  if($ridwall['yyyshow']) { ?>
						<a href="<?php  echo $this->createMobileUrl('yyy',array('rid'=>$rid))?>" data-class="msgWall" class="btnLottery tooltipstered tooltip" target="_blank" title="摇一摇，快捷键“Y”" id="yyy"></a>
						<?php  } ?>
						<?php  if(!empty($modules)) { ?>
						 <?php  if(is_array($modules)) { foreach($modules as $row) { ?>
						 <a href="<?php  echo $row['modules_url'];?>" data-class="msgWall" class="btnLottery tooltipstered tooltip" target="_blank" title="<?php  echo $row['name'];?>" id="modules<?php  echo $row['id'];?>"></a>
						 <style type="text/css">
						 <?php  if(!empty($row['bg'])) { ?>
						 #modules<?php  echo $row['id'];?>{background: url(<?php  echo $_W['attachurl'];?><?php  echo $row['bg'];?>) no-repeat !important;}
						 <?php  } else { ?>
						 #modules<?php  echo $row['id'];?>{ 
						 background: url(../addons/meepo_bigerwall/template/mobile/newmobile/skin/images/icons8e0e.png) no-repeat !important;
                         background-position: -2px -82px !important;
						 }
						
						 <?php  } ?>
						 </style>
						 <?php  } } ?>
						<?php  } ?>
						<?php  if($ridwall['webopen']) { ?>
						<a href="<?php  echo $this->createMobileUrl('manage',array('rid'=>$rid))?>" data-class="msgWall" class="btnLottery tooltipstered tooltip" target="_blank" title="管理" id="manage"></a>
						<style>
						#manage {
background: url(../addons/meepo_bigerwall/template/mobile/newmobile/skin/images/icons8e0e.png) no-repeat !important;
background-position: -2px -242px !important;
}
						</style>
						<?php  } ?>
						<a href="javascript:void(0)" title="全屏" data-class="fullWall" class="btnFull tooltipstered tooltip" onClick="fullScreen(document.documentElement)"></a>
					</div>
					<div class="btnIcon btnAct menuStyle">
						<a href="javascript:void(0)" title="开始页" class="btnOldest tooltip" onClick="wallPage('min')"></a>
						<a href="javascript:void(0)" title="上一页" class="btnPrev tooltip" onClick="wallPage('last')"></a>
						<a href="javascript:void(0)" title="开始/暂停" class="btnPause tooltip"  id="but_play" onClick="wallPage('play')"></a>
						
						<a href="javascript:void(0)" title="下一页" class="btnNext tooltip" onClick="wallPage('next')"></a>
						<a href="javascript:void(0)" title="最后页" class="btnNewest tooltip" onClick="wallPage('max')"></a>
					</div>
					
				</div>							
				
				
			</div>
			<div style="position: absolute;bottom: 0;z-index: 1;
height:20px;line-height:20px;text-align:center;width:100%">@<?php  echo $ridwall['votepower'];?>版权所有</div>	
		</div>
		
		<div class="layerStyle layer360" id="layer1">
			<h3><span class="layerClose" onclick="closeLayer(this)"></span>温馨提示</h3>
			<div class="layerTxt">亲，您还没有选择奖项，请先选择奖项，再开始抽奖！</div>
			<div class="layerBtn">
				<input type="button" id="" value="确定" class="btnTxt btnSure" onclick="closeLayer(this)"/>
				<input type="button" id="" value="取消" class="btnTxt btnSure" onclick="closeLayer(this)"/>
			</div>
		</div>
		
		<div class="layerStyle layer360" id="layer2">
			<h3><span class="layerClose" onclick="closeLayer(this)"></span>温馨提示</h3>
			<div class="layerTxt">亲，确定删除中奖者吗？删除后将不可恢复此记录！</div>
			<div class="layerBtn">
				<input type="button" id="" value="确定" class="btnTxt btnSure" onclick="closeLayer(this)"/>
				<input type="button" id="" value="取消" class="btnTxt btnSure" onclick="closeLayer(this)"/>
			</div>
		</div>
		
		<div class="layerStyle layer360" id="layer3">
			<h3><span class="layerClose" onclick="closeLayer(this)"></span>温馨提示</h3>
			<div class="layerTxt">亲，当前奖项已经抽满人数，不能再进行抽奖！</div>
			<div class="layerBtn">
				<input type="button" id="" value="返回" class="btnTxt btnSure" onclick="closeLayer(this)"/>
			</div>
		</div>
		
		<div class="layerStyle layer360" id="layer4">
			<h3><span class="layerClose" onclick="closeLayer(this)"></span>温馨提示</h3>
			<div class="layerTxt">亲，重置抽奖用户会重新放入奖池，确定要重置吗？</div>
			<div class="layerBtn">
				<input type="button" id="" value="确定" class="btnTxt btnSure" onclick="closeLayer(this)"/>
				<input type="button" id="" value="取消" class="btnTxt btnSure" onclick="closeLayer(this)"/>
			</div>
		</div>
		<div class="layerStyle layer360" id="layer6">
			<h3><span class="layerClose" onclick="closeLayer(this)"></span>温馨提示</h3>
			<div class="layerTxt">可抽奖人数为0！不能再进行抽奖</div>
			<div class="layerBtn">
				<input type="button" id="" value="返回" class="btnTxt btnSure" onclick="closeLayer(this)"/>
			</div>
		</div>
	  <div class="layerStyle layer360" id="layer7">
			<h3><span class="layerClose" onclick="closeLayer(this)"></span>温馨提示</h3>
			<div class="layerTxt">全部人数已经抽奖完毕！</div>
			<div class="layerBtn">
				<input type="button" id="" value="确定" class="btnTxt btnSure" onclick="closeLayer(this)"/>
			</div>
		</div>
		
		<div class="layerStyle layer360" id="diagpeng">
			<h3><span class="layerClose"></span>温馨提示</h3>
			<div class="layerTxt txtCenter">亲，确定要拆散这对有缘人？</div>
			<div class="layerBtn">
				<input type="button" id="" value="确定" class="btnTxt btnSure" />
				<input type="button" id="" value="取消"  class="btnTxt btnSure"  onclick="closeLayer(this)" />
			</div>
		</div>	
				
		<div class="layerStyle layer360" id="clearall">
			<h3><span class="layerClose"></span>温馨提示</h3>
			<div class="layerTxt txtCenter">亲，确定要全部清空么?</div>
			<div class="layerBtn">
				<input type="button" id="" value="确定" class="btnTxt btnSure" />
				<input type="button" id="" value="取消"  class="btnTxt btnSure"  onclick="closeLayer(this)" />
			</div>
		</div>	
			
	<div class="layerStyle layer360" id="clearpeng1">
		<h3><span class="layerClose"></span>温馨提示</h3>
		<div class="layerTxt txtCenter">亲，确定要全部清空么?</div>
		<div class="layerBtn">
			<input type="button" id="" value="确定" class="btnTxt btnSure" />
			<input type="button" id="" value="取消"  class="btnTxt btnSure"  onclick="closeLayer(this)" />
		</div>
	</div>	
						
		<div class="layerStyle layer360" id="clearhudong">
			<h3><span class="layerClose"></span>温馨提示</h3>
			<div class="layerTxt txtCenter">亲，确定要全部清空么?</div>
			<div class="layerBtn">
				<input type="button" id="" value="确定" class="btnTxt btnSure" />
				<input type="button" id="" value="取消"  class="btnTxt btnSure"  onclick="closeLayer(this)" />
			</div>
		</div>	
		
		<div class="layerStyle layer360" id="clearhudong1">
			<h3><span class="layerClose"></span>温馨提示</h3>
			<div class="layerTxt txtCenter">亲，确定要清除该项么?</div>
			<div class="layerBtn">
				<input type="button" id="" value="确定" class="btnTxt btnSure" />
				<input type="button" id="" value="取消"  class="btnTxt btnSure"  onclick="closeLayer(this)" />
			</div>
		</div>
		
		<div class="chromeTip">
			为了更好展现微现场功能，让您获得更好的用户体验，建议您使用<a href="http://www.google.cn/intl/zh-CN/chrome/browser/"  target="_blank">谷歌浏览器</a>。<a class="chromeBtn"  href="http://www.google.cn/intl/zh-CN/chrome/browser/"  target="_blank"></a>
			<span class="closeIcon"></span>
		</div>
<script type="text/javascript">
$(function(){
  $(document).keydown(function (event)
    {    
           

          <?php  if($ridwall['yyyshow']) { ?>
            if(event.keyCode == 89){
				window.open("<?php  echo $this->createMobileUrl('yyy',array('rid'=>$rid))?>");
			}
	       <?php  } ?>
           
    });  
$(".pop-close,.bottom-code").click(function() { $("#pop-code").fadeToggle(); });
});
</script>
<?php  if($ridwall['danmushow']) { ?>
<script src="<?php echo MEEPO;?>tanmu/assets/js/jquery.danmu.js"></script>
<script>
(function(){
$("#danmu").danmu({
	left:0,
	top:0,
	height:"100%",
	width:"100%",
    speed:<?php  echo $ridwall['danmutime']*1000;?>,
    opacity:1,
    font_size_small:20,
    font_size_big:30,
    top_botton_danmu_time:6000
}
  );
})(jQuery);	
function tanmuQuerywall() {
  $.get("<?php  echo $this->createMobileUrl('getover',array('rid'=>$rid))?>&checktime="+$('#tanmutime').val()+"&time="+$('#danmu').data("nowtime"),function(dataall,status){
	 var dataall = JSON.parse(dataall);
	 if(dataall != null){
		 var danmu_from_sql= dataall.data; 
		 if(danmu_from_sql != undefined){
			 for (var i=0;i<danmu_from_sql.length;i++){
			   
			  $('#danmu').danmu("add_danmu",danmu_from_sql[i]);
			 }
			 $('#tanmutime').val(dataall.maxtime);
			 
		 }
	 }
    });
  starter();
  $(".loader").hide("slow");
  setTimeout("send_danmu()",2000);
}
function starter(){
  $('#danmu').danmu('danmu_start');
}
function send_danmu() {
	$.get("<?php  echo $this->createMobileUrl('getover',array('rid'=>$rid))?>&checktime="+$('#tanmutime').val()+"&time="+$('#danmu').data("nowtime"),function(dataall,status){
       var dataall = JSON.parse(dataall);
	   if(dataall != null){
		   var danmu_from_sql= dataall.data; 
		   if(danmu_from_sql != undefined){
			   for (var i=0;i<danmu_from_sql.length;i++){
				  
				  $('#danmu').danmu("add_danmu",danmu_from_sql[i]);
			   }
			   $('#tanmutime').val(dataall.maxtime);
		   }
	    }
  });
  if(t==null){
		t=setInterval("send_danmu()",2000);
  }
}
</script>

<style>
.tanmuWall {
width: 914px;
height: 544px;
background: rgba(255, 255, 255, 0.25);
overflow: hidden;
cursor: default;
position: absolute;
top: 0;
left: 35px;
z-index: 1;
display: none;
}
#danmuarea {
position: relative;	
width:914px;
height: 544px;	
margin-left: auto;
margin-right: auto;
}
.ctr {
font-size: 1em;
line-height: 2em;
}
</style>
<?php  } ?>				
</body>
</html>