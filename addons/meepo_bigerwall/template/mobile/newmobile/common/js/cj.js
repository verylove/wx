var tagList ="" ;
var numList ="" ;
var buttonurl;
 var cj_per= new Array(); 

function progressLuckBar(){
	cj_ready();
	if($("#tagid option").length==1){
	   jQuery.ajax({
			url:LUCKTAGLIST,
	    	type:"post",
	    	success:function(data){
	    		var data = JSON.parse(data);
	    		var idx=1;
	    		var color;
				
	    		if(data.luckMap.tagList!=''){
					
		    		$.each(data.luckMap.tagList,function(i,val){
		    			$("#tagid").append('<option value='+val.id+'>'+val.tag_name+'</option>');
		    			idx++;
		    		})
	    		}
				
	    		if(data.luckMap.map!=''){
		    		if(data.luckMap.map.num_tag==1){
		    	    	$("#tagid").append("<option value='0'>按人数抽奖</option>");
		    		}
		    		
		    		 
		    		var title=data.luckMap.map.name;
		    		 title=title.length>5?title.substring(0,5):title;
		    		 $("#luckTitle").text(title);
		             $("#luck_img").attr("src",((data.luckMap.map.imgurl)!=''&&(data.luckMap.map.imgurl)!=null)?data.luckMap.map.imgurl:"../addons/meepo_bigerwall/template/mobile/newmobile/common/images/lotteryDefault.png");
		    		 $("#luckid").val(data.luckMap.map.id);
		    		 
					 $("#tagExclude").val(data.luckMap.map.tag_exclude);
					 $("#numExclude").val(data.luckMap.map.num_exclude);
	    	}
	    	}
	    });
	}
 
    var signNum = cj_per.length;
    $("#may_num").html(signNum);
    $("#lucknum").text(0);
    
   
	$.post(HADLUCKUSER,function(data){
	    var data = JSON.parse(data);
		 
        if(data.map.tagList.length>0){
           //按奖项
        	for(var i=0;i<data.map.tagList.length;i++){
        		tagList+=data.map.tagList[i].openid+",";
        	}
			
        }
        if(data.map.numList.length>0){
			//按人数
        	for(var i=0;i<data.map.numList.length;i++){
        		numList+=data.map.numList[i].openid+",";
        	}
			
        }
        })

		 
 
 
  getCurrentInfo();
  
}
function cj_ready() {
		
		   cj_per= new Array(); 
			$.getJSON(CJREADY,{},function(json){
			if(json){
				 $.each(json, function(i,v){
					cj_per.push(new Array(v));
				});
			}	   
		   });
}

function getCurrentInfo(){
	cj_ready();
	var option = $("#tagid option:selected").val();
	if(option>-1){
	var luckid = $("#luckid").val();
	$.post(LUCKCONTENT,{"luckid":luckid,"luckTag.id":option},function(data){
		    var data = JSON.parse(data);
			var signNum = cj_per.length;
		    var joinNum = signNum;
		  
		    $("#luckname").val(data.map.luck_name);
		    $("#tagNum").val(data.map.tagNum);
			
		    if(option==0){
		    	var numExclude = $("#numExclude").val();
		    	if(numExclude==1){
				    joinNum = parseInt(signNum)-parseInt(data.map.num==undefined?0:data.map.num);
				    $("#may_num").html(joinNum>0?joinNum:0);
		    	}else{
		    		 $("#may_num").html(joinNum>0?joinNum:0);
		    	}
		    }
		    if(option>0){
		    	var tagExclude = $("#tagExclude").val();
		    	if(tagExclude==1){
				    joinNum = parseInt(signNum)-parseInt(data.map.num==undefined?0:data.map.num);
				    $("#may_num").html(joinNum>0?joinNum:0);
		    	}else{
		    		 $("#may_num").html(joinNum>0?joinNum:0);
		    	}
		    }
	})

	
	getLuckUser(luckid,option);
  }
}


function changeLuck(){
	cj_ready();
	var option = $("#tagid option:selected").val();
	if(option==0){
		$("#num_input").show();
		$("#num_flag").show();
		$("#endNum").hide();
		$("#tag_flag").hide();
	}else{
	    $("#tag_flag").show();
	    $("#endBtn").hide();
	    $("#num_input").hide();
	    $("#num_flag").hide();
	}
	if(option>-1){
	var luckid = $("#luckid").val();
	
		$.post(LUCKCONTENT,{"luckid":luckid,"luckTag.id":option},function(data){
		    var data = JSON.parse(data);
			var signNum = cj_per.length;
		    var joinNum = signNum;
		   
		    $("#luckname").val(data.map.luck_name);
		    $("#tagNum").val(data.map.tagNum);
			
			
		    if(option==0){
				
			
			   $("#numExclude").val(data.map.tag_exclude);
		    	var numExclude = $("#numExclude").val();
		    	if(numExclude==1){
				    //joinNum = parseInt(signNum)-parseInt(data.map.num==undefined?0:data.map.num);
				    joinNum = parseInt(signNum);
					$("#may_num").html(joinNum>0?joinNum:0);
		    	}else{
		    		 $("#may_num").html(joinNum>0?joinNum:0);
		    	}
		    }
		    if(option>0){
				
			
			    $("#tagExclude").val(data.map.tag_exclude);
		    	var tagExclude = $("#tagExclude").val();
		    	if(tagExclude==1){
				    //joinNum = parseInt(signNum)-parseInt(data.map.num==undefined?0:data.map.num);//同上
				     joinNum = parseInt(signNum);
					$("#may_num").html(joinNum>0?joinNum:0);
		    	}else{
		    		 $("#may_num").html(joinNum>0?joinNum:0);
		    	}
		    }
	})

	
	getLuckUser(luckid,option);
  }
}

function getLuckUser(luckid,option){
    jQuery.ajax({
    	
		url:LUCKUSERLIST,
    	data:{"luckTag.luckid":luckid,"luckTag.id":option},
    	type:"post",
    	async:false,
    	success:function(data){
		    var data = JSON.parse(data);
		    $("#lotteryName").siblings().remove();
		    var length = data.luckMap.luckList.length;
		    if(length>0){
		    $(".lotteryDefault").hide();
            $.each(data.luckMap.luckList,function(i,val){
				
    			$("#lotteryName").after('<li id="'+val.openid+'"><p class="prize">'+val.luckName+'</p><i class="sn">'+parseInt(i+1)+'</i>'+
						'<p class="man"><img src="'+val.imgurl+'" /><div class="luck_username">'+val.name+'<br>'+val.mobile+'</div></p><i class="delLottery"  onclick=confirmLayer("'+val.openid+'",'+val.id+')></i></li>');
				
    			$(".lotteryName li").on({
					mouseenter: function(){
						$(this).addClass("act");
					},
					mouseleave: function(){
						$(this).removeClass("act");
					}
				})
            })
		    }
            $("#lucknum").text(length);
    	}
    });
}

function showLayer(i){
	$("#layer"+i).fadeIn();
	$("body").append("<div class=\"layerBlank\"></div>");
};
function closeLayer(o){
	$(o).parents(".layerStyle").hide();
	$("div").remove(".layerBlank");
};

function confirmLayer(openid,luckid){
	$("#layer2").fadeIn();
	$("body").append("<div class=\"layerBlank\"></div>");
	$("#layer2 :button:eq(0)").off().on("click",function(){
		delLuckUser(openid,luckid);
    })

};
var idx;

function delLuckUser(openid,luckid){
	var option = $("#tagid option:selected").val();
    jQuery.ajax({
    	
		url:REMOVELUCKUSER,
    	data:{"luckUser.openid":openid,"luckUser.id":luckid,"option":option},
    	type:"post",
    	async:false,
    	success:function(data){
    		
    		var alreadyNum = $("#luck_index").children("li").length;
    		$("#lucknum").text(alreadyNum);
    		
    		var tagExclude = $("#tagExclude").val();
    		var numExclude = $("#numExclude").val();

    		var base = $("#may_num").html();
			if(option>0){
				if(tagExclude==1){
			    tagList=tagList.replace(data+",","");
				
				$("#may_num").html(parseInt(base)+1>0?parseInt(base)+1:0);
				}
			}else{
				if(numExclude==1){
				numList=numList.replace(data+",","");
				$("#may_num").html(parseInt(base)+1>0?parseInt(base)+1:0);
				}
			}
   		 $("#luck_img").attr("src",CJIMGURL);
   		 $("#luck_name").empty();
    	}
    });
    var luckid = $("#luckid").val();
    getLuckUser(luckid,option);
}


function reset(){
	
	var option = $("#tagid option:selected").val();
	if(option>-1){
	var alreadyNum = $("#luck_index").children("li").length;
	var tagExclude = $("#tagExclude").val();
	var numExclude = $("#numExclude").val();
	if(alreadyNum>0){
		$("#layer4").fadeIn();
		$("body").append("<div class=\"layerBlank\"></div>");
	    $("#layer4 :button:eq(0)").off().on("click",function(){
			$.post(RESET,{"luckTag.id":option},function(data){
				var data = JSON.parse(data);
				
				$("#lotteryName").siblings().remove();
				$("#lucknum").text(0);
				var base = $("#may_num").html();
				$("#layer4").hide();
				$("div").remove(".layerBlank");
				$.each(data.list,function(i,val){
					if(option>0){
						if($("#tagExclude").val()==1){
					    tagList=tagList.replace(val.openid+",","");
						
					    $("#may_num").html(parseInt(base)+parseInt(data.list.length));
						}
					}else{
						if($("#numExclude").val()==1){
						numList=numList.replace(val.openid+",","");
						$("#may_num").html(parseInt(base)+parseInt(data.list.length));
						}
					}
				})
			
				   		 $("#luck_img").attr("src",CJIMGURL);

				$("#luck_name").empty();
		    })
	    })
   }
 }
}


function endBtn(){
	$("#startBtn").show();
	$("#endBtn").hide();
	var open = false;
	run(open);
}


var ret;
function startBtn(){
	var option = $("#tagid option:selected").val();
	if(option==-1){
		showLayer(1);
		return;
	}
	var base = $("#may_num").html();
	if(parseInt(base)==0){
		showLayer(6);
		return ;
	}

    var alreadyNum = $("#luck_index").children("li").length;
    var tagNum = $("#tagNum").val()==""?0:$("#tagNum").val();

    if(alreadyNum !=0 && alreadyNum==parseInt(tagNum)){
    	showLayer(3);
    	return;
    }
    $("#tagid").attr("disabled","disabled");
	$(".lotteryDefault").hide();
	$("#startBtn").hide();
	$("#endBtn").show();
	
	var open = true;
	run(open);
}

function run(open){
	if(open){
		timer=setInterval(change,50);
	}else{
		change("gain");
		clearInterval(timer);
	}
}

function change(ret){
	var openidList = cj_per;
	var alldata = new Array();
	var newalldata = new Array();
	var nddata =  new Array();
	var option = $("#tagid option:selected").val();
	var tagExclude = $("#tagExclude").val();
	var numExclude = $("#numExclude").val();
	for(var i=0;i<openidList.length;i++){
        alldata[i]= cj_per[i][0];
		
		if(option>0 && tagExclude==1){
			var temp = new Array();
			temp = alldata[i].split("|");
			var index = tagList.indexOf(temp[3]);
			if(index==-1){
				if(temp[4] == undefined || parseInt(temp[4]) == option){
				   newalldata.push(alldata[i]);
				}
			}
		}
	}
	
	if(option>0 && tagExclude==1){
		if(newalldata!=null && newalldata.length>0){
			alldata = null;
			alldata = newalldata;
		}
	}
	var num = alldata.length - 1;
	if(ret=="gain"){
	  
	  for(var i=0;i<alldata.length;i++){
		  
		   
		
			var temp2 = new Array();
			temp2 = alldata[i].split("|");
			var index2 = temp2[4];
			index2 = parseInt(index2);
		   if(index2 == option){

				

                var randomVal = i;
                /*for(var j=0;j<openidList.length;j++){
					 
					    nddata[j]=openidList.eq(j).find("input").val();
						var temp3 = new Array();
						temp3 = nddata[j].split("|");
						
						if(temp3[3]==temp2[3]){
							getSignData().eq(j).find("input").val(temp3[0]+'|'+temp3[1]+'|'+temp3[2]+'|'+temp3[3]);
						}
				}*/
				
				
				break;
			}else{
				
			       var randomVal = Math.round(Math.random() * num);
				
			}
		
	 }
	  
	}else{
	  var randomVal = Math.round(Math.random() * num);
	}
	
	var prizeName = alldata[randomVal];
	var msg = new Array();
	msg = prizeName.split("|");
	$("#luck_img").attr("src",msg[2]);
	$("#luck_name").text(msg[0]);
	if(ret=="gain"){
		$("#tagid").removeAttr("disabled");
	    jQuery.ajax({
			url:SAVELUCKUSER,
	    	data:{"luckUser.openid":msg[3],"luckUser.luckTagId":option},
	    	type:"post",
	    	async:false,
	    	success:function(data){
				data = JSON.parse(data);
	    		if(parseInt(data.id)>0){
				   data.id = parseInt(data.id);
	    		   idx = $("#luck_index li").length;
	    			$("#lotteryName").after('<li id="'+msg[3]+'"><p class="prize">'+$("#luckname").val()+'</p><i class="sn">'+parseInt(idx+1)+'</i>'+
							'<p class="man"><img src="'+msg[2]+'" /><div class="luck_username">'+msg[0]+'<br>'+data.mobile+'</div></p><i class="delLottery"  onclick=confirmLayer("'+msg[3]+'",'+data.id+');></i></li>');
					var lucknum = $("#luck_index").children("li").last().index();
					$("#lucknum").text(lucknum);
					idx++;
					$(".lotteryName li").on({
						mouseenter: function(){
							$(this).addClass("act");
						},
						mouseleave: function(){
							$(this).removeClass("act");
						}
					})
	    		}
	    	}
	    });
		
	    if(option>0){
			if($("#tagExclude").val()==1){
				tagList+=msg[3]+",";
				
				var base = $("#may_num").html();
				$("#may_num").html(parseInt(base-1)>=0?parseInt(base-1):0);
			}
	    }
		
	}
}


function changeClick(){
	$("#startNum").attr('onclick','');  
	$("#startNum").unbind('click');
	$("#startNum").click(function(){  
	   alert("正在进行，不能点击");
	});  
		
	$("#endNum").attr('onclick',''); 
	$("#endNum").unbind('click');
	$("#endNum").click(function(){  
	  alert("正在进行，不能点击");
	});  
	
	$("#newLuckButton").attr('onclick','');    
	$("#newLuckButton").unbind('click');
	$("#newLuckButton").click(function(){  
	  alert("正在进行，不能点击");
	});  
	
}

function recoverClick(){
	$("#startNum").attr('onclick',''); 
	$("#endNum").attr('onclick',''); 
	$("#newLuckButton").attr('onclick','');
	
	$("#startNum").unbind('click');
	$("#endNum").unbind('click');
	$("#newLuckButton").unbind('click');
	
	$("#startNum").attr('onclick','start()');  //此方法如不起作用，可使用“ $(this).unbind('click');”  代替  
	$("#endNum").attr('onclick','stop()');  //此方法如不起作用，可使用“ $(this).unbind('click');”  代替  
	$("#newLuckButton").attr('onclick','javascript:reset();');  //此方法如不起作用，可使用“ $(this).unbind('click');”  代替  
}

var isChange=true;
var num;
var timer;
var numPrizeName;

function start(i){
	$(".lotteryDefault").hide();
	
	if(i!=2){
		
		num=parseInt($("#num option:selected").val());
		var base = $("#may_num").html();
		if(parseInt(base)==0){
			showLayer(6);
			return ;
		}
		$("#tagid").attr("disabled","disabled");
		var numExclude = $("#numExclude").val();
		if(numExclude==1){
			if(num>parseInt(base)){
				num = base;
			}
		}
	}
	timer=setInterval(function(){
		changeNum();
	},50)
	$("#startNum").hide();
	$("#endNum").show();
}


function stop(){
	$("#startNum").show();
	$("#endNum").hide();
	clearInterval(timer);
	var base = $("#may_num").html();
	if(num>0 && base!="0"){
    	checked();
	}else{
		return ;
	}
	num--;
	if(num>0){
    	$("#startNum").val("开始抽奖("+num+")");
	}else{
		$("#tagid").removeAttr("disabled");
		$("#startNum").val("开始抽奖");
	}
	if(num){
		if(isChange){
			changeClick();
			isChange = false;
		}
		
		setTimeout(function(){
			start(2);
		},2000);
		setTimeout(stop,5000);
	}else{
		isChange = true;
		recoverClick();
	}
}


function checked(){
	    var comment = $("#comment").val().trim();
	    if(comment==''){
	    	comment = "参与奖";
	    }
		var msg = new Array();
		msg = numPrizeName.split("|");
	    jQuery.ajax({
	    	url:SAVELUCKUSER,
	    	data:{"luckUser.openid":msg[3],"luckUser.luckTagId":0,"luckUser.perAward":comment},
	    	type:"post",
	    	async:false,
	    	success:function(data){
			data = JSON.parse(data);
	    	if(parseInt(data.id)>0){
				data.id = parseInt(data.id);
	    		idx = $("#luck_index li").length;
				$("#lotteryName").after('<li id="'+msg[3]+'"><p class="prize">'+comment+'</p><i class="sn">'+parseInt(idx+1)+'</i>'+
						'<p class="man"><img src="'+msg[2]+'" /><div class="luck_username">'+msg[0]+'<br>'+data.mobile+'</div></p><i class="delLottery"  onclick=confirmLayer("'+msg[3]+'",'+data.id+');></i></li>');
				var lucknum = $("#luck_index").children("li").last().index();
				$("#lucknum").text(lucknum);
				idx++;
				$(".lotteryName li").on({
					mouseenter: function(){
						$(this).addClass("act");
					},
					mouseleave: function(){
						$(this).removeClass("act");
					}
				})
	    	  }
	    	}
	    });
	    
	    var numExclude = $("#numExclude").val();
	    if(numExclude==1){
			var base = $("#may_num").html();
			$("#may_num").html(parseInt(base-1)>=0?parseInt(base-1):0);
			if($("#numExclude").val()==1){
				numList+=msg[3]+",";
			}
			base = $("#may_num").html();
			if(base==0){

				showLayer(7);
				return ;
			}
	    }
		
}

function changeNum(){
	var openidList = cj_per;
	var alldata = new Array();
	var newalldata = new Array();
	var option = $("#tagid option:selected").val();
	var numExclude = $("#numExclude").val();
	for(var i=0;i<openidList.length;i++){
		alldata[i] = cj_per[i][0];
		if(numExclude==1){
			var temp = new Array();
			temp = alldata[i].split("|");
			var index = numList.indexOf(temp[3]);
			if(index==-1){
				newalldata.push(alldata[i]);
			}
	 }
	}
	
	if(numExclude==1){
		if(newalldata!=null && newalldata.length>0){
			alldata = null;
			alldata = newalldata;
		}
	}
	var num = alldata.length - 1;
	var randomVal = Math.round(Math.random() * num);
    numPrizeName = alldata[randomVal];
	var msg = new Array();
	msg = numPrizeName.split("|");
	$("#luck_img").attr("src",msg[2]);
	$("#luck_name").text(msg[0]);
}