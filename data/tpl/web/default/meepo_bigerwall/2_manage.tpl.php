<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<script type="text/javascript" src="../addons/meepo_bigerwall/template/jquery-1.7.2.min.js"></script>
<script>
	function selectall(obj, name){
		$('input[name="'+name+'[]"]:checkbox').each(function() {
			$(this).attr("checked", $(obj).attr('checked') ? true : false);
		});
	}
</script>

<DIV id="new">
<style>
#new a{margin-left:10px;}
.btn-group{margin-top:5px;}
</style>
  
<A class="btn btn-primary btn-sm" href="<?php  echo '../app/'.$this->createMobileUrl('Index',array('rid'=>$id))?>" target="__blank"><i class="fa fa-edit"></i>查看上墙内容入口</A> 
<a class="btn btn-warning btn-sm" href="<?php  echo $this->createWebUrl('manage',array('type'=>'delete','del'=>'all','id'=>$id))?>" onclick="return confirm('清空所有墙内内容，将无法恢复，确认吗？');return false;"><i class="fa fa-times"></i>清空墙内内容</a>      

<a class="btn btn-warning btn-sm" href="<?php  echo $this->createWebUrl('manage',array('type'=>'delete','del'=>'allperson','id'=>$id))?>" onclick="return confirm('清空所有录入的人数，将无法恢复，确认吗？');return false;"><i class="fa fa-times"></i>清空录入的总人数</a>         

<a class="btn btn-warning btn-sm" href="<?php  echo $this->createWebUrl('manage',array('type'=>'reset','del'=>'yyy','id'=>$id))?>" onclick="return confirm('清空所有摇一摇数据，将无法恢复，确认吗？');return false;"><i class="fa fa-times"></i>重置摇一摇</a>
<a class="btn btn-warning btn-sm" href="<?php  echo $this->createWebUrl('manage',array('type'=>'delete','del'=>'yyy','id'=>$id))?>" onclick="return confirm('清空所有摇一摇数据，将无法恢复，确认吗？');return false;"><i class="fa fa-times"></i>清空摇一摇</a>
<a class="btn btn-warning btn-sm" href="<?php  echo $this->createWebUrl('manage',array('type'=>'reset','del'=>'vote','id'=>$id))?>" onclick="return confirm('清空所有投票票数数据，将无法恢复，确认吗？');return false;"><i class="fa fa-times"></i>重置投票数目</a>
<a class="btn btn-warning btn-sm" href="<?php  echo $this->createWebUrl('manage',array('type'=>'reset','del'=>'cj','id'=>$id))?>" onclick="return confirm('清空所有已经中奖人员，将无法恢复，确认吗？');return false;"><i class="fa fa-times"></i>重置抽奖结果</a></DIV><br><br>
<div class="navbar navbar-default navbar-static-top">
    <div class="container-fluid" style="background-color: rgb(238, 238, 238);padding:0px;margin:0px;">
    <div class="btn-group">
			<a type="button" class="btn <?php  if(!empty($op)) { ?>btn-success<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo $this->createWebUrl('manage', array('id' => $id, 'op' =>'list'))?>"><i class="fa fa-users"></i>人员列表</a></div>
	<div class="btn-group">
			<a type="button" class="btn <?php  if(empty($op) && $_GPC['isshow'] == 0) { ?>btn-success<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo $this->createWebUrl('manage', array('id' => $id, 'isshow' => 0))?>"><i class="fa fa-toggle-off"></i>上墙待审</a></div>
	<div class="btn-group">
			<a type="button" class="btn <?php  if(empty($op) && $_GPC['isshow'] == 1) { ?>btn-success<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo $this->createWebUrl('manage', array('id' => $id, 'isshow' => 1))?>"><i class="fa fa-toggle-on"></i>上墙已审</a>
	</div>
	

	<div class="btn-group">
			<a type="button" class="btn btn-default" href="<?php  echo $this->createWebUrl('signmanage', array('id' => $id, 'status' => 2))?>"><i class="fa fa-toggle-off"></i>签到待审</a>
	</div>
	<div class="btn-group">
			<a type="button" class="btn btn-default"  href="<?php  echo $this->createWebUrl('signmanage', array('id' => $id, 'status' => 1))?>"><i class="fa fa-toggle-on"></i>签到已审</a>
	</div>
	
	<div class="btn-group">
			<a type="button" class="btn <?php  if($operation == 'display') { ?>btn-success<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo $this->createWebUrl('Checkvote',array('id' => $id,'op' =>'display'))?>"><i class="fa fa-list"></i>投票列表</a>
	</div>
	<div class="btn-group">
			<a type="button" class="btn <?php  if(empty($vote['id']) && $operation == 'post') { ?>btn-success<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo $this->createWebUrl('Checkvote',array('id' => $id,'op' =>'post'))?>"><i class="fa fa-plus-square"></i>添加投票</a>
	</div>
	<?php  if(!empty($vote['id']) &&  $operation == 'post') { ?><div class="btn-group">
			<a type="button" class="btn btn-default" href="<?php  echo $this->createWebUrl('Checkvote',array('id' => $id,'op' =>'post','voteid'=>$vote['id']))?>"><i class="fa fa-edit"></i> 编辑投票</a></div><?php  } ?>

	<div class="btn-group">
			<a type="button" class="btn btn-default" href="<?php  echo $this->createWebUrl('awardmanage', array('id' => $id))?>"><i class="fa fa-gift"></i>抽奖管理</a>
    </div>
	<div class="btn-group">
			<a type="button" class="btn btn-default" href="<?php  echo $this->createWebUrl('awardlist', array('id' => $id))?>"><i class="fa fa-users"></i>中奖名单</a>
	</div>
	<div class="btn-group">
			<a type="button" class="btn btn-default" href="<?php  echo $this->createWebUrl('vote_person', array('id' => $id))?>"><i class="fa fa-users"></i>投票人员</a>
	</div>
	<div class="btn-group">
			<a type="button" class="btn btn-default" href="<?php  echo $this->createWebUrl('yyyres', array('id' => $id))?>"><i class="fa fa-users"></i>摇一摇名单</a>
	</div>
	<div class="btn-group">
			<a type="button" class="btn btn-default" href="<?php  echo $this->createWebUrl('blacklist', array('id' => $id))?>"><i class="fa fa-users"></i>粉丝黑名单</a>
	</div>
	<div class="btn-group">
			<a type="button" class="btn btn-default" href="<?php  echo $this->createWebUrl('modules_manage', array('id' => $id))?>"><i class="fa fa-list"></i>插件列表</a>
	</div>
	<div class="btn-group">
			<a type="button" class="btn btn-default"  href="<?php  echo $this->createWebUrl('signcheck',array('id'=>$id))?>"><i class="fa fa-toggle-off"></i>验证管理</a>
	</div>
	<div class="btn-group">
			<a type="button" class="btn btn-default"  href="<?php  echo $this->createWebUrl('mobileupload',array('id'=>$id))?>"><i class="fa fa-toggle-off"></i>导入列表</a>
	</div>
	<div class="btn-group">
			<a type="button" class="btn <?php  if($op == 'post' && $_GPC['do']=='mobileupload') { ?>btn-success<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo $this->createWebUrl('mobileupload',array('id' => $id,'op'=>'post'))?>"></i>导入文件</a>
   </div>
</div>
</div>
<div class="panel panel-danger">

	<div class="panel-heading">
	本次活动审核状态
	<br><br>
	<font color=red>1: 请自己留意 当前的活动状态 按需按时开启关闭审核 一定按照规则运作</font><br><br>
	<font color=red>2: 若是需要审核、请相关工作人员 认真负责严格把好审核关！</font>
	</div>
	<div class="panel-body">
		<form action="./index.php" method="get" class="form-horizontal" role="form">
			<input type="hidden" name="c" value="site" />
			<input type="hidden" name="a" value="entry" />
			<input type="hidden" name="m" value="meepo_bigerwall" />
			<input type="hidden" name="do" value="manage" />
            <input type="hidden" name="id" value="<?php  echo $id;?>" />
            <?php  if($op) { ?>
			 <input type="hidden" name="op" value="<?php  echo $op;?>" />
			<?php  } else { ?>
             <input type="hidden" name="isshow" value="<?php  echo $isshow;?>" />
			 <?php  } ?>
			<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 col-lg-4 control-label">本次活动当前审核状态</label>
			<div class="col-sm-9 col-lg-8">
				<label class="radio-inline">
					<input type="radio" name="isshowstatus" value="1" id="isshow_1" <?php  if($ridswall['isshow'] == '1') { ?>checked="true"<?php  } ?>> 是
				</label>
				<label class="radio-inline">
					<input type="radio" name="isshowstatus" value="2" id="isshow_0"  <?php  if($ridswall['isshow'] == '0') { ?>checked="true"<?php  } ?>>否
				</label>
			</div>
		    </div>
			<div class="form-group">
			<div class="col-sm-4 col-lg-2">

				<input  type="submit" value="修改" name="changeisshow" class="btn btn-danger btn-block" />
			    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			</div>
		    </div>

		</form>
	</div>
</div>
<div class="panel panel-default">

	<div class="panel-heading">筛选</div>
	<div class="panel-body">
		<form action="./index.php" method="get" class="form-horizontal" role="form">
			<input type="hidden" name="c" value="site" />
			<input type="hidden" name="a" value="entry" />
			<input type="hidden" name="m" value="meepo_bigerwall" />
			<input type="hidden" name="do" value="manage" />
            <input type="hidden" name="id" value="<?php  echo $id;?>" />
			<?php  if($op) { ?>
			 <input type="hidden" name="op" value="<?php  echo $op;?>" />
			<?php  } else { ?>
             <input type="hidden" name="isshow" value="<?php  echo $isshow;?>" />
			 <?php  } ?>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">粉丝昵称</label>
				<div class="col-xs-12 col-sm-8 col-lg-9">
					<input class="form-control" name="keyword" id="" type="text"  placeholder="请输入用户昵称">
				</div>
			</div>
			<div class="form-group">
				<div class=" col-xs-12 col-sm-2 col-lg-2">
					<input type="submit"  value="搜索" class="btn btn-success  btn-block" />
				</div>
			</div>

		</form>
	</div>
</div>
<div class="panel panel-warning">
	<div class="panel-heading">
		<?php  if(empty($op) && $_GPC['isshow'] == 0) { ?>待审核<?php  } ?>
		<?php  if(empty($op) && $_GPC['isshow'] == 1) { ?>已审核<?php  } ?>
		<?php  if(!empty($op)) { ?>人员列表<?php  } ?>
	</div>
	<?php  if(empty($op)) { ?>
	<div class="panel-body">
		<div class="main" id="table-list">
			<form action="" method="post" onsubmit="">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead class="navbar-inner">
						<tr>
						    
							<th style="width:10%;" class="row-first">选择</th>
							<th style="width:30%;">用户<i></i></th>
							<th class="row-hover" style="width:20%">消息<i></i></th>
							<th style="width:20%;">时间<i></i></th>
							<th style="width:20%;">操作</th>
						</tr>
						</thead>
						<tbody id="news">
						<?php  if(is_array($list)) { foreach($list as $row) { ?>
						<tr>
							<td class="row-first"><input type="checkbox" name="select[]" value="<?php  echo $row['id'];?>" /></td>
							<td class="row-hover">
								<img width="50" src="<?php  echo $row['avatar'];?>" class="avatar" />
								<div class="mainContent">
									<div class="nickname"><?php  echo $row['nickname'];?><?php  if($row['isblacklist']) { ?><span class="label label-danger">(黑名单)</span><?php  } ?></div>
								</div>
							</td>
							<td style="min-height:40px;max-height:100px;white-space: normal !important;"><?php  echo $row['content'];?></td>
							<td style="font-size:12px; color:#666;">
								<div style="margin-bottom:10px;"><?php  echo date('Y-m-d', $row['createtime']);?></div>
								<div><?php  echo date('H:i:s', $row['createtime']);?></div>
							</td>
							<td>
							 <a class="btn btn-danger" href="<?php  echo $this->createWebUrl('manage', array('id' => $id, 'isshow'=>$isshow, 'docon' =>'delete', 'news_id' =>$row['id']))?>" onclick="return confirm('删除将无法恢复，确认吗？');return false;">删除</a>
								<?php  if($row['isblacklist']==0) { ?>
								<a class="btn btn-primary" href="<?php  echo $this->createWebUrl('blacklist', array('id' => $id, 'isshow'=>$isshow, 'openid' => $row['openid'], 'switch' => 1))?>">添加黑名单</a>
								<?php  } else { ?>
								<a class="btn btn-danger" href="<?php  echo $this->createWebUrl('blacklist', array('id' => $id, 'isshow'=>$isshow, 'openid' => $row['openid'], 'switch' =>0))?>">移除黑名单</a>
								<?php  } ?>
							   
								
								
							</td>
						</tr>
						<?php  } } ?>
						</tbody>
					</table>
					
					<table class="table">
						<tr>
							<td style="width:50px;" class="row-first"><input type="checkbox" onclick="selectall(this, 'select');" /></td>
							<td colspan="4">
								<?php  if($_GPC['isshow'] == 0) { ?>
								<input type="submit" name="verify" value="审核" class="btn btn-success" />
								<?php  } ?>
								<input type="submit" name="delete" value="删除" class="btn btn-danger" />
								
								<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
								
							</td>
						</tr>
					</table>
					
					<?php  echo $pager;?>
				</div>
			</form>
		</div>
	</div>
</div>
<?php  } else { ?>
<div class="panel-body">
		<div class="main" id="table-list">
			<form action="" method="post" onsubmit="">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead class="navbar-inner">
						<tr>
						    <th style="width:25px;">选？</th>
							<th>ID</th>
							<th >用户<i></i></th>
							<th >性别</th>
							
							<th class="row-hover" >发送消息<i></i></th>
							<th >是否签到<i></i></th>
							<th >内定情况<i></i></th>
							<th>
							 
							</th>
						</tr>
						</thead>
						<tbody>
						<?php  if(is_array($list)) { foreach($list as $row) { ?>
						<tr>
						<td><input type="checkbox" name="messageid[]" value="<?php  echo $row['id'];?>" class=""></td>
							<td><?php  echo $row['id'];?></td>
							<td class="row-hover">
								<img width="50" src="<?php  echo $row['avatar'];?>" class="avatar" />
								<div class="mainContent">
									<div class="nickname"><?php  echo $row['nickname'];?></div>
								</div>
							</td>
							<td><?php  if($row['sex'] == '1') { ?>男<?php  } else if($row['sex'] == '2') { ?>女<?php  } else { ?>未知<?php  } ?></td>
							
							<td>
								<?php  echo $row['num'];?>条
							</td>
							<td>
								<?php  if($row['sign']==1) { ?>
								   <font color=red>已签到</font>
								<?php  } else { ?>
								   未签到
								<?php  } ?>
								
								
							</td>
							<td style="color:red"><?php  echo $row['cj'];?></td>
							<td>
							<?php  if($row['isblacklist']==0) { ?>
								<a class="btn btn-primary" href="<?php  echo $this->createWebUrl('blacklist', array('id' => $id, 'isshow'=>1, 'openid' => $row['openid'], 'switch' => 1,'op'=>'list'))?>">添加黑名单</a>
								<?php  } else { ?>
								<a class="btn btn-danger" href="<?php  echo $this->createWebUrl('blacklist', array('id' => $id, 'isshow'=>0, 'openid' => $row['openid'], 'switch' =>0,'op'=>'list'))?>">移除黑名单</a>
								<?php  } ?>
							</td>
						</tr>
						<?php  } } ?>
						<tr>
						<td><input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});"></td>
				        <td>
						<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
						<input type="submit" class="btn btn-success" name="download" value="导出所有数据" />
                         
                       </td>
					  
				       </tr>
						</tbody>
					</table>
					
					<?php  echo $pager;?>
				</div>
			</form>
		</div>
	</div>
</div>
<?php  } ?>
<script>
require(['jquery'], function($){
	//详细数据相关操作
	var tdIndex;
	$("#table-list thead").delegate("th", "mouseover", function(){
		if($(this).find("i").hasClass("")) {
			$("#table-list thead th").each(function() {
				if($(this).find("i").hasClass("icon-sort")) $(this).find("i").attr("class", "");
			});
			$("#table-list thead th").eq($(this).index()).find("i").addClass("icon-sort");
		}
	});
	$("#table-list thead th").click(function() {
		if($(this).find("i").length>0) {
			var a = $(this).find("i");
			if(a.hasClass("icon-sort") || a.hasClass("icon-caret-up")) { //递减排序
				/*
					数据处理代码位置
				*/
				$("#table-list thead th i").attr("class", "");
				a.addClass("icon-caret-down");
			} else if(a.hasClass("icon-caret-down")) { //递增排序
				/*
					数据处理代码位置
				*/
				$("#table-list thead th i").attr("class", "");
				a.addClass("icon-caret-up");
			}
			$("#table-list thead th,#table-list tbody:eq(0) td").removeClass("row-hover");
			$(this).addClass("row-hover");
			tdIndex = $(this).index();
			$("#table-list tbody:eq(0) tr").each(function() {
				$(this).find("td").eq(tdIndex).addClass("row-hover");
			});
		}
	});
});
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
