<!DOCTYPE html>
<?php
	session_start();
	if($_SESSION['login']!="OK"){
		header("Location:index.php");
	}
	$rate="";
	$cat="";
	if(isset($_GET['rate'])) $rate=$_GET['rate'];
	if(isset($_GET['cat'])) $cat=$_GET['cat'];
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>taobao</title>
		<link href="jquery-ui.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="style.css" />
	</head>
	<div style="float:left;">
		<select class="rate" id="rate" name="rate">
			<option <?php if($rate=="不限")echo 'selected = "selected"';?>>不限</option>
			<option <?php if($rate=="优秀")echo 'selected = "selected"';?>>优秀</option>
			<option <?php if($rate=="良好")echo 'selected = "selected"';?>>良好</option>
			<option <?php if($rate=="一般")echo 'selected = "selected"';?>>一般</option>
			<option <?php if($rate=="较差")echo 'selected = "selected"';?>>较差</option>
			<option <?php if($rate=="很差")echo 'selected = "selected"';?>>很差</option>
		</select>
		<select class="rate2" id="cat" name="cat">
			<option <?php if($cat=="50012825")echo 'selected = "selected"';?> value="50012825">高帮鞋</option>
			<option <?php if($cat=="50012028")echo 'selected = "selected"';?> value="50012028">靴子</option>
			<option <?php if($cat=="50012047")echo 'selected = "selected"';?> value="50012047">雨鞋</option>
			<option <?php if($cat=="50012033")echo 'selected = "selected"';?> value="50012033">拖鞋</option>
			<option <?php if($cat=="50012042")echo 'selected = "selected"';?> value="50012042">帆布鞋</option>
			<option <?php if($cat=="50012032")echo 'selected = "selected"';?> value="50012032">凉鞋</option>
			<option <?php if($cat=="50012027")echo 'selected = "selected"';?> value="50012027">低帮鞋</option>
		</select>
		<select class="rate2" id="sold" name="sold">
			<option value="0">销量不限</option>
			<option value="1">10以上</option>
			<option value="2">50以上</option>
			<option value="3">100以上</option>
			<option value="4">200以上</option>
			<option value="5">500以上</option>
			<option value="6">1000以上</option>
			<option value="7">2000以上</option>
		</select>
	</div>
	<div align="left" id="submit" style="float:right;">
		<button id="submit">提交查询</button>
	</div>		
	<div style="float:right;">
		<button id="screenmenu">排序方式</button>
		<button id="propmenu">属性选择</button>
	</div>
	<div id="menu" style="float:right;margin-top:3px;" >
		<input id="keyWord" type="text" placeholder="标题关键字" style="height:30px;width:150px;">
		<input type="text" placeholder="品牌关键字" class="enum-input" id="p_1">
		<input type="text" placeholder="货号" class="enum-input" id="p_2">
		<input type="text" placeholder="旺旺ID" class="enum-input" id="nick">
		<input type="text" placeholder="地区，多地区以英文逗号隔开" class="enum-input" style="width:170px;" id="loc">
	</div>
	<div id="screen" class="clear" style="float:left;display:none;">
		<div id="radioset" style="float:left;margin-top:3px;">
			<input type="radio" id="radio1" name="radio" checked="checked" value="1"><label for="radio1">销量</label>
			<input type="radio" id="radio2" name="radio" value="2"><label for="radio2">采集时间</label>
			<input type="radio" id="radio3" name="radio" value="3"><label for="radio3">创建时间</label>
			<input type="radio" id="radio4" name="radio" value="4"><label for="radio4">标题得分</label>
			<input type="radio" id="radio5" name="radio" value="5"><label for="radio5">类目关联关键词数</label>
			<input type="radio" id="radio6" name="radio" value="6"><label for="radio6">标题关键词数量</label>
			<input type="radio" id="radio7" name="radio" value="7"><label for="radio7">核心关键词数量</label>
			<input type="radio" id="radio8" name="radio" value="8"><label for="radio8">高质量关键词数量</label>
		</div>
	</div>
	<div class="clear" id="multi-props">
		<div style="float:right;margin:3px 0px 0px 10px;">
			from<input type="text" placeholder="YY-MM-DD" class="enum-input" id="datepicker_from">
			to<input type="text" placeholder="YY-MM-DD" class="enum-input" id="datepicker_to">
			<input type="checkbox" id="checkbox1" value="1"> 新品
		</div>
		<div style="float:right;margin:3px 0px 0px 10px;">
			现价<input type="text" class="enum-input" id="currentPriceL">－
			<input type="text" class="enum-input" id="currentPriceR">
		</div>
		<div style="float:right;margin:3px 0px 0px 10px;">	
			<select style="width:150px;"id="price">
				<option selected="selected" value="1">价格不限</option>
				<option value="2">0-30元</option>
				<option value="3">31-100元</option>
				<option value="4">101-200元</option>
				<option value="5">201-500元</option>
				<option value="6">501-1000元</option>
				<option value="7">1001-2000元</option>
				<option value="8">2000以上</option>
			</select>
		</div>
		<div id="enum-multi-props" class="clear"></div>
	</div>
	<div id="result">
		<div class="clear" id="item-list" style="margin-left:30px;"></div>
		<div class="clear" id="pager">
			<button style="font-size:62.5%;" id="goto_pre">上一页</button>
			<button style="font-size:62.5%;" id="goto_next">下一页</button>
			<span>共</span><span id="total"></span><span>页</span><span> 当前第</span><input type="text" id="page" style="width:30px;"><span>页</span>
			<button style="font-size:62.5%;" id="goto">GO</button>
		</div>
	</div>
	<div style="position:absolute;top:40%; left:45%;z-index:1;display:none;"id="msg"><span>正在加载，请稍候</span></div>
	<div style="display:none;"><span style="display:block;width:48px;height:48px;"><a href="javascript:scroll(0,0) ">返回顶部</a><span></div>
</html>
				
<script src="external/jquery/jquery.js"></script>
<script src="jquery-ui.js"></script>
<script>	
	$("#datepicker_from").datepicker({dateFormat:"yy-mm-dd"});
	$("#datepicker_to").datepicker({dateFormat:"yy-mm-dd"});
	$("#radioset").buttonset();
	$("select").selectmenu();
	$("#cat").selectmenu({width:"115px"});
	$("#sold").selectmenu({width:"135px"});
	$("button").button();
	$(document).ready(function(){
		getProp();
	});
	$("#propmenu").click(function(){
		$("#multi-props").slideToggle();
	})
	$("#screenmenu").click(function(){
		$("#screen").slideToggle();
	})
	$("#submit").click(function(){
		$('#item-list').empty();
		$("#page").val('1');
		var url=getUrl();		
		$.ajax({
			url:"search.php",
			type:'get',
			data:url,
			beforeSend:function(){
			},
			success:function(data){
				eval(data);
				getList(itemList);
			}
		});
	});
	$("#goto_pre").click(function(){
		$('#item-list').empty();
		if($("#page").val()>'1')
			$("#page").val(parseInt($("#page").val())-1);
		var url=getUrl();
		$.get('search.php',url,
			function(data){
				eval(data);
				getList(itemList);
			})
	});
	$("#goto_next").click(function(){
		$('#item-list').empty();
		$("#page").val(parseInt($("#page").val())+1);
		var url=getUrl();
		$.get('search.php',url,
			function(data){
				eval(data);
				getList(itemList);
			})
	});
	$("#goto").click(function(){
		$('#item-list').empty();
		var url=getUrl();
		$.get('search.php',url,
			function(data){
				eval(data);
				getList(itemList);
			})
	});

	$("#cat").selectmenu({
		change: 
			function(){
				$('#item-list').empty();
				getProp();
				$("#pager").hide()
			}
	});
	function getList(itemList){
		$("#msg").hide();
		$('#item-list').empty();
		if(itemList['totalNum']==0){
			alert("该条件下没有结果！");
			return;
		}
		document.getElementById('total').innerHTML=Math.ceil(itemList['totalNum']/100);
		var i;
		for(i in itemList['itemList']){
			var pic=document.createElement('div');
			pic.id="pic";
			pic.innerHTML="<a href='http://item.taobao.com/item.htm?id="+itemList['itemList'][i]['itemid']+"' target='_blank'><img src='"+itemList['itemList'][i]['image']+"_220x220.jpg'></a>";
			
			var price=document.createElement('div');
			var spPrice=document.createElement('span');
			spPrice.style.cssText = "display:block;float:left;";
			spPrice.innerHTML="原价"+itemList['itemList'][i]['price'];
			price.appendChild(spPrice);
			var spCurrentPrice=document.createElement('span');
			spCurrentPrice.style.cssText = "padding-left:10px;display:block;color:red;float:left;";
			spCurrentPrice.innerHTML="现价"+itemList['itemList'][i]['currentPrice'];
			price.appendChild(spCurrentPrice);
			var spSoldQuantity=document.createElement('span');
			spSoldQuantity.style.cssText = "display:block;float:right";
			spSoldQuantity.innerHTML="销量"+itemList['itemList'][i]['soldQuantity'];
			price.appendChild(spSoldQuantity);
			
			var title=document.createElement('div');
			if(itemList['itemList'][i]['isFlag']==1)
				title.style.cssText="margin-top:25px;color:red;";
			else
				title.style.cssText="margin-top:25px;";
			title.setAttribute('class', 'clear');
			var spTitle=document.createElement('span');
			spTitle.style.cssText="font-size:13px;";
			spTitle.innerHTML=itemList['itemList'][i]['title'];
			title.appendChild(spTitle);
			
			var buttons=document.createElement('div');
			var timeStamp=document.createElement('span');
			timeStamp.innerHTML="采集时间:"+itemList['itemList'][i]['timeStamp'];
			timeStamp.style.cssText="float:left;font-size:13px;margin-top:3px;";
			buttons.appendChild(timeStamp);
			var isNew=document.createElement('div');
			isNew.innerHTML="<img src='images/isNew.jpg'>";
			isNew.style.cssText="float:left;margin:3px 0 0 8px;";
			if(itemList['itemList'][i]['isNew']==0){
				isNew.style.cssText+="display:none;";
			}
			buttons.appendChild(isNew);
			var setFlag=document.createElement('button');
			setFlag.innerHTML="标记";
			setFlag.setAttribute('id', 'setFlag');
			setFlag.setAttribute('onclick', 'setFlag('+itemList['itemList'][i]['itemid']+')');
			setFlag.style.cssText = "float:right;";
			buttons.appendChild(setFlag);
			
			var quantity=document.createElement('div');
			quantity.setAttribute('class', 'clear');
			var spQuantity=document.createElement('span');
			if(itemList['itemList'][i]['quantity']!=null){
				spQuantity.innerHTML="库存:"+itemList['itemList'][i]['quantity'];
				spQuantity.setAttribute('id', 'spanFontL');
				quantity.appendChild(spQuantity);
			}
			var spEndTime=document.createElement('span');
			if(itemList['itemList'][i]['endTime']!='1970-01-01 08:00:00'){
				spEndTime.innerHTML="下架时间:"+itemList['itemList'][i]['endTime'];
				spEndTime.setAttribute('id', 'spanFontR');
				quantity.appendChild(spEndTime);
			}
			
			var locNick=document.createElement('div');
			locNick.setAttribute('class', 'clear');
			var spLoc=document.createElement('span');
			spLoc.setAttribute('id', 'spanFontL');
			spLoc.innerHTML=itemList['itemList'][i]['loc'];
			locNick.appendChild(spLoc);
			var spNick=document.createElement('span');
			spNick.setAttribute('id', 'spanFontR');
			spNick.innerHTML="旺旺："+itemList['itemList'][i]['nick'];
			locNick.appendChild(spNick);
			
			var score=document.createElement('div');
			score.style.cssText="margin-top:20px";
			score.setAttribute('class', 'clear');
			var spScore=document.createElement('span');
			spScore.setAttribute('id', 'spanFontL');
			spScore.innerHTML="标题得分："+itemList['itemList'][i]['score'];
			score.appendChild(spScore);
			var spScoreRate=document.createElement('span');
			spScoreRate.setAttribute('id', 'spanFontR');
			spScoreRate.innerHTML=itemList['itemList'][i]['scoreRate'];
			score.appendChild(spScoreRate);
			
			var catPrior=document.createElement('div');
			catPrior.style.cssText="margin-top:20px";
			catPrior.setAttribute('class', 'clear');
			var spCatPrior=document.createElement('span');
			spCatPrior.setAttribute('id', 'spanFontL');
			spCatPrior.innerHTML="类目关联关键词数："+itemList['itemList'][i]['catPrior'];
			catPrior.appendChild(spCatPrior);
			var spCatPriorRate=document.createElement('span');
			spCatPriorRate.setAttribute('id', 'spanFontR');
			spCatPriorRate.innerHTML=itemList['itemList'][i]['catPriorRate'];
			catPrior.appendChild(spCatPriorRate);
			
			var wordNum=document.createElement('div');
			wordNum.style.cssText="margin-top:20px";
			wordNum.setAttribute('class', 'clear');
			var spWordNum=document.createElement('span');
			spWordNum.style.cssText="color:red";
			spWordNum.setAttribute('id', 'spanFontL');
			spWordNum.innerHTML="标题关键词数量："+itemList['itemList'][i]['wordNum'];
			wordNum.appendChild(spWordNum);
			var spWordRate=document.createElement('span');
			spWordRate.style.cssText="color:red";
			spWordRate.setAttribute('id', 'spanFontR');
			spWordRate.innerHTML=itemList['itemList'][i]['wordNum'];
			wordNum.appendChild(spWordRate);
			
			var highPVNum=document.createElement('div');
			highPVNum.style.cssText="margin-top:20px";
			highPVNum.setAttribute('class', 'clear');
			var spHighPVNum=document.createElement('span');
			spHighPVNum.setAttribute('id', 'spanFontL');
			spHighPVNum.innerHTML="核心关键词数量："+itemList['itemList'][i]['highPVNum'];
			highPVNum.appendChild(spHighPVNum);
			var spHighPVRate=document.createElement('span');
			spHighPVRate.setAttribute('id', 'spanFontR');
			spHighPVRate.innerHTML=itemList['itemList'][i]['highPVRate'];
			highPVNum.appendChild(spHighPVRate);
			
			var highCharNum=document.createElement('div');
			highCharNum.style.cssText="margin-top:20px";
			highCharNum.setAttribute('class', 'clear');
			var spHighCharNum=document.createElement('span');
			spHighCharNum.setAttribute('id', 'spanFontL');
			spHighCharNum.innerHTML="高质量关键词数量："+itemList['itemList'][i]['highCharNum'];
			highCharNum.appendChild(spHighCharNum);
			var spHighCharRate=document.createElement('span');
			spHighCharRate.setAttribute('id', 'spanFontR');
			spHighCharRate.innerHTML=itemList['itemList'][i]['highCharRate'];
			highCharNum.appendChild(spHighCharRate);
			
			
			var item = document.createElement('div');
			item.id="items";
			item.appendChild(pic);
			item.appendChild(price);
			item.appendChild(title);
			item.appendChild(buttons);
			item.appendChild(quantity);
			item.appendChild(locNick);
			item.appendChild(score);
			item.appendChild(catPrior);
			item.appendChild(wordNum);
			item.appendChild(highPVNum);
			item.appendChild(highCharNum);
			document.getElementById('item-list').appendChild(item);
		}
		$("#pager").show();
	}
	function getProp(){
		$('#enum-multi-props').empty();
		$('#items').empty();
		$.get("get.php",{ cid:$("#cat").val() },
		function(data){
			eval(data);
			var i;
			for(i in props){
				var sel = document.createElement('SELECT');
				sel.setAttribute('name', props[i]['pid']);
				sel.setAttribute('id', props[i]['pid']);
				var op = document.createElement('OPTION');
				op.setAttribute('value', '');
				op.innerHTML = '--请选择--';
				sel.appendChild(op);
				var j;
				for(j in props[i]['pvalue']){
					op = document.createElement('OPTION');
					op.setAttribute('value', props[i]['pvalue'][j]);
					op.innerHTML = props[i]['pvalue'][j];
					sel.appendChild(op);
				}
				var propDiv = document.createElement('div');
				propDiv.innerHTML = "<div style='float:left;text-align:left;padding-top:5px;margin-left:10px;'>" + props[i]['pname']+"</div>";
				propDiv.id = "pid_"+props[i]['pid'];
				propDiv.style.cssText = "width:260px;padding:5px 0px;float:left";
				
				var propvaluesDiv = document.createElement('div');
				propvaluesDiv.style.cssText = "float:left;";
				propvaluesDiv.appendChild(sel);
				var propSpan = document.createElement('div');
				propSpan.id = 'pid_' + props[i]['pid'] + '_span';
				propSpan.style.cssText = "padding:2px 0px;line-height:0px";
				propvaluesDiv.appendChild(propSpan);
				propDiv.appendChild(propvaluesDiv);
				document.getElementById('enum-multi-props').appendChild(propDiv);
			}
		});
	}
	function getUrl(){
		$("#msg").show();
		$("#pager").hide();
		url="rate="+$("#rate").val();
		url+="&cat="+$("#cat").val();
		if($("#p_3").val()!=undefined&&$("#p_3").val()!="")
			url+="&p_3="+$("#p_3").val();
		if($("#p_4").val()!=undefined&&$("#p_4").val()!="")
			url+="&p_4="+$("#p_4").val();
		if($("#p_5").val()!=undefined&&$("#p_5").val()!="")
			url+="&p_5="+$("#p_5").val();
		if($("#p_6").val()!=undefined&&$("#p_6").val()!="")
			url+="&p_6="+$("#p_6").val();
		if($("#p_7").val()!=undefined&&$("#p_7").val()!="")
			url+="&p_7="+$("#p_7").val();
		if($("#p_8").val()!=undefined&&$("#p_8").val()!="")
			url+="&p_8="+$("#p_8").val();
		if($("#p_9").val()!=undefined&&$("#p_9").val()!="")
			url+="&p_9="+$("#p_9").val();
		if($("#p_10").val()!=undefined&&$("#p_10").val()!="")
			url+="&p_10="+$("#p_10").val();
		if($("#p_11").val()!=undefined&&$("#p_11").val()!="")
			url+="&p_11="+$("#p_11").val();
		if($("#p_12").val()!=undefined&&$("#p_12").val()!="")
			url+="&p_12="+$("#p_12").val();
		if($("#p_13").val()!=undefined&&$("#p_13").val()!="")
			url+="&p_13="+$("#p_13").val();
		if($("#p_14").val()!=undefined&&$("#p_14").val()!="")
			url+="&p_14="+$("#p_14").val();
		if($("#p_15").val()!=undefined&&$("#p_15").val()!="")
			url+="&p_15="+$("#p_15").val();
		if($("#p_16").val()!=undefined&&$("#p_16").val()!="")
			url+="&p_16="+$("#p_16").val();
		if($("#p_17").val()!=undefined&&$("#p_17").val()!="")
			url+="&p_17="+$("#p_17").val();
		if($("#p_18").val()!=undefined&&$("#p_18").val()!="")
			url+="&p_18="+$("#p_18").val();
		if($("#p_19").val()!=undefined&&$("#p_19").val()!="")
			url+="&p_19="+$("#p_19").val();
		if($("#p_20").val()!=undefined&&$("#p_20").val()!="")
			url+="&p_20="+$("#p_20").val();
		if($("#p_21").val()!=undefined&&$("#p_21").val()!="")
			url+="&p_21="+$("#p_21").val();
		if($("#p_22").val()!=undefined&&$("#p_22").val()!="")
			url+="&p_22="+$("#p_22").val();
		if($("#p_23").val()!=undefined&&$("#p_23").val()!="")
			url+="&p_23="+$("#p_23").val();
		if($("#p_24").val()!=undefined&&$("#p_24").val()!="")
			url+="&p_24="+$("#p_24").val();
		if($("#p_25").val()!=undefined&&$("#p_25").val()!="")
			url+="&p_25="+$("#p_25").val();
		if($("#p_26").val()!=undefined&&$("#p_26").val()!="")
			url+="&p_26="+$("#p_26").val();
		if($("#p_27").val()!=undefined&&$("#p_27").val()!="")
			url+="&p_27="+$("#p_27").val();
		if($("#p_28").val()!=undefined&&$("#p_28").val()!="")
			url+="&p_28="+$("#p_28").val();
		if($("#p_29").val()!=undefined&&$("#p_29").val()!="")
			url+="&p_29="+$("#p_29").val();
		if($("#p_30").val()!=undefined&&$("#p_30").val()!="")
			url+="&p_30="+$("#p_30").val();
		if($("#p_31").val()!=undefined&&$("#p_31").val()!="")
			url+="&p_31="+$("#p_31").val();
		if($("#p_32").val()!=undefined&&$("#p_32").val()!="")
			url+="&p_32="+$("#p_32").val();
		if($("#p_33").val()!=undefined&&$("#p_33").val()!="")
			url+="&p_33="+$("#p_33").val();
		if($("#p_34").val()!=undefined&&$("#p_34").val()!="")
			url+="&p_34="+$("#p_34").val();
		if($("#keyWord").val()!="")
			url+="&keyword="+$("#keyWord").val();
		if($("#p_1").val()!="")
			url+="&p_1="+$("#p_1").val();
		if($("#p_2").val()!="")
			url+="&p_2="+$("#p_2").val();
		if($("#nick").val()!="")
			url+="&nick="+$("#nick").val();
		if($("#checkbox1").prop("checked")==true)
			url+="&isNew="+"1";
		else
			url+="&isNew="+"0";
		if($('#currentPriceL').val()!="")
			url+="&currentPriceL="+$('#currentPriceL').val();
		if($('#currentPriceR').val()!="")
			url+="&currentPriceR="+$('#currentPriceR').val();

		if($('#datepicker_from').val()!="")
			url+="&from="+$('#datepicker_from').val();
		if($('#datepicker_to').val()!="")
			url+="&to="+$('#datepicker_to').val();
		if($('#loc').val()!=""){
			url+="&loc="+$('#loc').val();
		}
		url+="&sold="+$("#sold").val();
		url+="&price="+$("#price").val();
		url+="&page="+$("#page").val();
		url+="&sort="+$('input:radio:checked').val();
		return url;
	}
	function setFlag(itemid){
		var cat=$("#cat").val();
		$.get('setFlag.php',{cat:cat,itemid:itemid},
			function(data,status){
				if(status=='success')
					alert("标记成功！");
			})
	}
</script>
<div style="display:none">
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1253065503'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s19.cnzz.com/stat.php%3Fid%3D1253065503' type='text/javascript'%3E%3C/script%3E"));</script></div>
