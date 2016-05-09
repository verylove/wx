<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php  if($operation == 'display') { ?>
  <style>
    .template .item{position:relative;display:block;float:left;border:1px #ddd solid;border-radius:5px;background-color:#fff;padding:5px;width:190px;margin:0 20px 20px 0; overflow:hidden;}
    .template .title{margin:5px auto;line-height:2em;}
    .template .title a{text-decoration:none;}
    .template .item img{width:178px;height:270px; cursor:pointer;}
    .template .active.item-style img, .template .item-style:hover img{width:178px;height:270px;border:3px #009cd6 solid;padding:1px; }
    .template .title .fa{display:none}
    .template .active .fa.fa-check{display:inline-block;position:absolute;bottom:33px;right:6px;color:#FFF;background:#009CD6;padding:5px;font-size:14px;border-radius:0 0 6px 0;}
    .template .fa.fa-times{cursor:pointer;display:inline-block;position:absolute;top:10px;right:6px;color:#D9534F;background:#ffffff;padding:5px;font-size:14px;text-decoration:none;}
    .template .fa.fa-times:hover{color:red;}
    .template .item-bg{width:100%; height:342px; background:#000; position:absolute; z-index:1; opacity:0.5; margin:-5px 0 0 -5px;}
    .template .item-build-div1{position:absolute; z-index:2; margin:-5px 10px 0 5px; width:168px;}
    .template .item-build-div2{text-align:center; line-height:30px; padding-top:150px;}
  </style>
  <div class="clearfix template">
    <div class="panel panel-default">
      <nav role="navigation" class="navbar navbar-default navbar-static-top" style="margin-bottom:0;">
        <div class="container-fluid">
          <div class="navbar-header">
            <a href="javascript:;" class="navbar-brand">模板选择</a>
          </div>
          <ul class="nav navbar-nav nav-btns">
            <li <?php  if(empty($_GPC['type']) || $_GPC['type'] == 'all') { ?> class="active" <?php  } ?>>
              <a href="<?php  echo $this->createWebUrl('templates', array('op' => 'display','rid' => $rid,'type' => 'all'))?>">全部</a>
            </li>
            
          </ul>
          <div class="navbar-header" style="float:right;">
               <a href="<?php  echo $this->createWebUrl('index', array('rid' => $rid))?>" class="navbar-brand"  style="color:red">活动中心</a> 
          </div>
          <div class="navbar-header" style="float:right;">
               <a href="<?php  echo $this->createWebUrl('templates', array('op' => 'post','rid' => $rid))?>" class="navbar-brand"  >添加风格   </a>
          </div>
        </div>
      </nav>
      <div class="panel-body">
        <?php  if(is_array($templates)) { foreach($templates as $item) { ?>
            <div class="item item-style">
              <a class="fa fa-times"  onclick="if(!confirm('删除后将不可恢复,确定删除吗?')) return false;" title="删除风格" href="<?php  echo $this->createWebUrl('templates', array('op' => 'delete','rid' => $rid,'id' => $item['id'],'stylename' => $item['name']))?>"></a>
              <div class="title">
                <div style="overflow:hidden; height:28px;"><?php  echo $item['title'];?> (<?php  echo $item['name'];?>)</div>
                <a href="<?php  echo $this->createWebUrl('templates', array('op' => 'post','id' => $item['id'],'stylename' => $item['name']))?>">
                  <img src="<?php  if(!empty($item['thumb'])) { ?><?php  echo toimage($item['thumb'])?><?php  } else { ?>../addons/fm_photosvote/template/mobile/templates/<?php  echo $item['name'];?>/preview.jpg<?php  } ?>" class="img-rounded" />
                </a>
                <span class="fa fa-check"></span>
              </div>
              <div class="btn-group  btn-group-justified">
                <a href="<?php  echo $this->createWebUrl('templates', array('op' => 'post','rid' => $rid,'id' => $item['id'],'stylename' => $item['name']))?>" class="btn btn-default btn-xs">编辑</a>
                <!--<a href="javascript:;" onclick="preview('<?php  echo $item['name'];?>', '<?php  echo $rid;?>');return false;" class="btn btn-default btn-xs">预览</a>-->
              </div>
            </div>
        <?php  } } ?>
        <div class="item item-style">
             
              <div class="title">
                <div style="overflow:hidden; height:28px;"></div>
                <a href="<?php  echo $this->createWebUrl('templates', array('op' => 'post'))?>" title="添加新模板">
                  <img src="../addons/fm_photosvote/template/mobile/img/jia.png" class="img-rounded" />
                </a>
                <span class="fa fa-check"></span>

                <div style="overflow:hidden; height:22px;"></div>
              </div>
            </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    require(['bootstrap'],function($){
      $('.item .item-build-btn').popover();
    });
    //预览风格时,预览的是默认微站的导航链接和快捷操作
    function preview(stylename, rid) {
      require(['jquery', 'util'], function($, u){
        var content = '<iframe width="320" scrolling="yes" height="480" frameborder="0" src="about:blank"></iframe>';
        var footer =
            '     <a href="<?php  echo $this->createWebUrl('templates', array('op' => 'default'))?>templatesname=' + stylename + 'rid' + rid + '" class="btn btn-primary">设为默认模板</a>' +
            '     <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>';
        var dialog = u.dialog('预览模板', content, footer);
        dialog.find('iframe').on('load', function(){
          $('a', this.contentWindow.document.body).each(function(){
            var href = $(this).attr('href');
            if(href && href[0] != '#') {
              var arr = href.split(/#/g);
              var url = arr[0];
              if(url.slice(-1) != '&') {
                url += '&';
              }
              if(url.indexOf('?') != -1) {
                url += ('s=' + styleid);
              }
              if(arr[1]) {
                url += ('#' + arr[1]);
              }
              if (url.substr(0, 10) == 'javascript' || url.indexOf('?') == -1) {
                url = url.substr(0, url.lastIndexOf('&'));
              }
              $(this).attr('href', url);
            }
          });
        });
        var url = '../app/<?php  echo murl('home')?>&s=' + styleid;
        dialog.find('iframe').attr('src', url);
        dialog.find('.modal-dialog').css({'width': '322px'});
        dialog.find('.modal-body').css({'padding': '0', 'height': '480px'});
        dialog.modal('show');
      });
    }
  </script>
<?php  } else if($operation == 'post') { ?>
  <div class="clearfix">
  <form class="form-horizontal form" action="" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">
      <nav role="navigation" class="navbar navbar-default navbar-static-top" style="margin-bottom:0;">
          <div class="container-fluid">
            <div class="navbar-header">
              <a href="javascript:;" class="navbar-brand"><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>模板</a>
            </div>
            <div class="navbar-header" style="float:right;">
                 <a href="<?php  echo $this->createWebUrl('templates', array('op' => 'display','rid' => $rid))?>" class="navbar-brand"  >模板选择</a> 
            </div>
          </div>
        </nav>
      <div class="panel-body">
          <input type="hidden" name="id" value="<?php  echo $item['id'];?>">
          <?php  if(!empty($item['name'])) { ?>
            <div class="form-group">
              <label class="col-xs-12 col-sm-1 col-md-1 control-label"></label>
              <div class="col-sm-11 col-xs-12">
                <label>
                  <p>当前模板 (<span style="color:red"> <?php  echo $item['name'];?> </span>) 位置：</p>
                  <?php  if(is_array($files)) { foreach($files as $mid => $file) { ?>
                    <?php  $name = getnames($file) ?>
                     <p><?php  echo $name;?> :  <span style="color:green"><?php  echo '/addons/fm_photosvote/template/mobile/templates/' . $item['name'] . '/' . $file?>;</span><span class="label label-error"></span></p>
                    
                  <?php  } } ?>
                </label>
              </div>
            </div>
          <?php  } ?>
          <div class="form-group">
            <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">模板标识</label>
            <div class="col-sm-8 col-xs-12">
              <input type="text" class="form-control" placeholder="必须输入模板名称，格式为 字母（不区分大小写）+ 数字(同时包含字母和数字),且以英文开头，不能出现中文、中文字符" name="stylename" <?php  if(!empty($item['name'])) { ?>readonly="readonly"<?php  } ?> value="<?php  echo $item['name'];?>">
            
            </div>
          </div>

          <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
              <label>
             必须输入模板名称，格式为 字母（不区分大小写）、数字,且以英文开头，不能出现中文、中文字符，模板名称不可更改
              </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">模板标题</label>
            <div class="col-sm-8 col-xs-12">
              <input type="text" class="form-control" placeholder="" name="title" value="<?php  echo $item['title'];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">模板作者</label>
            <div class="col-sm-8 col-xs-12">
              <input type="text" class="form-control" id="writer" name="author" value="<?php  echo $item['author'];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">模板版本</label>
            <div class="col-sm-8 col-xs-12">
              <input type="text" class="form-control" id="writer" name="version" value="<?php  echo $item['version'];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">模板预览图</label>
            <div class="col-sm-8 col-xs-12">
              <?php  echo tpl_form_field_image('thumb', $item['thumb'])?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
              <label>
              预览图面（图片建议尺寸：145像素 * 225像素）
              </label>
            </div>
          </div>

          <div class="form-group">
            <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">简介</label>
            <div class="col-sm-8 col-xs-12">
              <textarea class="form-control" name="description" rows="5"><?php  echo $item['description'];?></textarea>
            </div>
          </div>

         
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
        <input name="submit" type="submit" value="提交" class="btn btn-primary col-lg-1">
        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
      </div>
    </div>
  </form>
  </div>
<?php  } else if($operation == 'designer') { ?>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
