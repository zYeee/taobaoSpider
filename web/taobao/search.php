<?php
	session_start();
	if($_SESSION['login']!="OK"){
		header("Location:index.php");
	}
	$rate="";
	$cat="";
	if(isset($_GET['rate'])) $rate=$_GET['rate'];
	if(isset($_GET['cat'])) $cat=$_GET['cat'];
	if(isset($_GET['rate'])&&isset($_GET['cat'])){
		include_once("conn.php");
		$cat="`".$_GET['cat']."`";
		$query="from $cat left join score on $cat.itemid=score.itemid";
		$query.=" where score.score is not null";
		if(isset($_GET['p_1']))
		if($_GET['p_1']!=""){
			$tmp=$_GET['p_1'];
			$query.=" and $cat.p_1 like '%".$tmp."%'";
		}
		if(isset($_GET['p_2']))
		if($_GET['p_2']!=""){
			$tmp=$_GET['p_2'];
			$query.=" and $cat.p_2='$tmp'";
		}
		if(isset($_GET['p_3']))
		if($_GET['p_3']!=""){
			$tmp=$_GET['p_3'];
			$query.=" and $cat.p_3='$tmp'";
		}
		if(isset($_GET['p_4']))
		if($_GET['p_4']!=""){
			$tmp=$_GET['p_4'];
			$query.=" and $cat.p_4='$tmp'";
		}
		if(isset($_GET['p_5']))
		if($_GET['p_5']!=""){
			$tmp=$_GET['p_5'];
			$query.=" and $cat.p_5='$tmp'";
		}
		if(isset($_GET['p_6']))
		if($_GET['p_6']!=""){
			$tmp=$_GET['p_6'];
			$query.=" and $cat.p_6='$tmp'";
		}
		if(isset($_GET['p_7']))
		if($_GET['p_7']!=""){
			$tmp=$_GET['p_7'];
			$query.=" and $cat.p_7='$tmp'";
		}
		if(isset($_GET['p_8']))
		if($_GET['p_8']!=""){
			$tmp=$_GET['p_8'];
			$query.=" and $cat.p_8='$tmp'";
		}
		if(isset($_GET['p_9']))
		if($_GET['p_9']!=""){
			$tmp=$_GET['p_9'];
			$query.=" and $cat.p_9='$tmp'";
		}
		if(isset($_GET['p_10']))
		if($_GET['p_10']!=""){
			$tmp=$_GET['p_10'];
			$query.=" and $cat.p_10='$tmp'";
		}
		if(isset($_GET['p_11']))
		if($_GET['p_11']!=""){
			$tmp=$_GET['p_11'];
			$query.=" and $cat.p_11='$tmp'";
		}
		if(isset($_GET['p_12']))
		if($_GET['p_12']!=""){
			$tmp=$_GET['p_12'];
			$query.=" and $cat.p_12='$tmp'";
		}
		if(isset($_GET['p_13']))
		if($_GET['p_13']!=""){
			$tmp=$_GET['p_13'];
			$query.=" and $cat.p_13='$tmp'";
		}
		if(isset($_GET['p_14']))
		if($_GET['p_14']!=""){
			$tmp=$_GET['p_14'];
			$query.=" and $cat.p_14='$tmp'";
		}
		if(isset($_GET['p_15']))
		if($_GET['p_15']!=""){
			$tmp=$_GET['p_15'];
			$query.=" and $cat.p_15='$tmp'";
		}
		if(isset($_GET['p_16']))
		if($_GET['p_16']!=""){
			$tmp=$_GET['p_16'];
			$query.=" and $cat.p_16='$tmp'";
		}
		if(isset($_GET['p_17']))
		if($_GET['p_17']!=""){
			$tmp=$_GET['p_17'];
			$query.=" and $cat.p_17='$tmp'";
		}
		if(isset($_GET['p_18']))
		if($_GET['p_18']!=""){
			$tmp=$_GET['p_18'];
			$query.=" and $cat.p_18='$tmp'";
		}
		if(isset($_GET['p_19']))
		if($_GET['p_19']!=""){
			$tmp=$_GET['p_19'];
			$query.=" and $cat.p_19='$tmp'";
		}
		if(isset($_GET['p_20']))
		if($_GET['p_20']!=""){
			$tmp=$_GET['p_20'];
			$query.=" and $cat.p_20='$tmp'";
		}
		if(isset($_GET['p_21']))
		if($_GET['p_21']!=""){
			$tmp=$_GET['p_21'];
			$query.=" and $cat.p_21='$tmp'";
		}
		if(isset($_GET['p_22']))
		if($_GET['p_22']!=""){
			$tmp=$_GET['p_22'];
			$query.=" and $cat.p_22='$tmp'";
		}
		if(isset($_GET['p_23']))
		if($_GET['p_23']!=""){
			$tmp=$_GET['p_23'];
			$query.=" and $cat.p_23='$tmp'";
		}
		if(isset($_GET['p_24']))
		if($_GET['p_24']!=""){
			$tmp=$_GET['p_24'];
			$query.=" and $cat.p_24='$tmp'";
		}
		if(isset($_GET['p_25']))
		if($_GET['p_25']!=""){
			$tmp=$_GET['p_25'];
			$query.=" and $cat.p_25='$tmp'";
		}
		if(isset($_GET['p_26']))
		if($_GET['p_26']!=""){
			$tmp=$_GET['p_26'];
			$query.=" and $cat.p_26='$tmp'";
		}
		if(isset($_GET['p_27']))
		if($_GET['p_27']!=""){
			$tmp=$_GET['p_27'];
			$query.=" and $cat.p_27='$tmp'";
		}
		if(isset($_GET['p_28']))
		if($_GET['p_28']!=""){
			$tmp=$_GET['p_28'];
			$query.=" and $cat.p_28='$tmp'";
		}
		if(isset($_GET['p_29']))
		if($_GET['p_29']!=""){
			$tmp=$_GET['p_29'];
			$query.=" and $cat.p_29='$tmp'";
		}
		if(isset($_GET['p_30']))
		if($_GET['p_30']!=""){
			$tmp=$_GET['p_30'];
			$query.=" and $cat.p_30='$tmp'";
		}
		if(isset($_GET['p_31']))
		if($_GET['p_31']!=""){
			$tmp=$_GET['p_31'];
			$query.=" and $cat.p_31='$tmp'";
		}
		if(isset($_GET['p_32']))
		if($_GET['p_32']!=""){
			$tmp=$_GET['p_32'];
			$query.=" and $cat.p_32='$tmp'";
		}
		if(isset($_GET['p_33']))
		if($_GET['p_33']!=""){
			$tmp=$_GET['p_33'];
			$query.=" and $cat.p_33='$tmp'";
		}
		if(isset($_GET['p_34']))
		if($_GET['p_34']!=""){
			$tmp=$_GET['p_34'];
			$query.=" and $cat.p_34='$tmp'";
		}
		if($rate!="不限"){
			$query.=" and score.evaluation='$rate'";
		}
		if(isset($_GET['keyword'])){
			if($_GET['keyword']!=""){
				$tmp=$_GET['keyword'];
				$query.=" and $cat.title like '%".$tmp."%'";
			}
		}
		if(isset($_GET['nick']))
		if($_GET['nick']!=""){
			$tmp=$_GET['nick'];
			$query.=" and $cat.nick='$tmp'";
		}
		if($_GET['isNew']==1){
			$query.=" and $cat.isNew=1";
		}
		if($_GET['price']!=1){
			$tmp=$_GET['price'];
			if($tmp==2)
				$query.=" and $cat.p_0='0-30元'";
			if($tmp==3)
				$query.=" and $cat.p_0='31-100元'";
			if($tmp==4)
				$query.=" and $cat.p_0='101-200元'";
			if($tmp==5)
				$query.=" and $cat.p_0='201-500元'";
			if($tmp==6)
				$query.=" and $cat.p_0='501-1000元'";
			if($tmp==7)
				$query.=" and $cat.p_0='1001-2000元'";
			if($tmp==8)
				$query.=" and $cat.p_0='2000以上'";
		}
		if(isset($_GET['from'])){
			$tmp=$_GET['from'];
			$query.=" and $cat.time_stamp>='$tmp'";
		}
		if(isset($_GET['to'])){
			$tmp=$_GET['to'];
			$tmp=date('Y-m-d',strtotime($tmp)+86400);
			$query.=" and $cat.time_stamp<='$tmp'";
		}
		if(isset($_GET['currentPriceL'])){
			$tmp=$_GET['currentPriceL'];
			$query.=" and $cat.currentPrice>=$tmp";
		}
		if(isset($_GET['currentPriceR'])){
			$tmp=$_GET['currentPriceR'];
			$query.=" and $cat.currentPrice<=$tmp";
		}
		if(isset($_GET['loc'])){
			$tmp=$_GET['loc'];
			$tmp=explode(",",$tmp);
			$locQ="";
			foreach($tmp as $loc){
				if($locQ!="")
				$locQ.="or ";
				$locQ.="$cat.loc like '%$loc%'";
			}
			$locQ =" and (".$locQ.")";
			$query.=$locQ;
		}
		switch ($_GET['sold']){
			case 1:$query.=" and $cat.SoldQuantity>10";break;
			case 2:$query.=" and $cat.SoldQuantity>50";break;
			case 3:$query.=" and $cat.SoldQuantity>100";break;
			case 4:$query.=" and $cat.SoldQuantity>200";break;
			case 5:$query.=" and $cat.SoldQuantity>500";break;
			case 6:$query.=" and $cat.SoldQuantity>1000";break;
			case 7:$query.=" and $cat.SoldQuantity>2000";break;
		}
		switch ($_GET['sort']){
			case 1:$sort="$cat.SoldQuantity";break;
			case 2:$sort="$cat.time_stamp";break;
			case 3:$sort="$cat.SoldQuantity";break;
			case 4:$sort="score.score";break;
			case 5:$sort="score.catPrior";break;
			case 6:$sort="score.wordNum";break;
			case 7:$sort="score.highPVNum";break;
			case 8:$sort="score.highCharNum";break;
		}
		$start=($_GET['page']-1)*100;
		$rs=mysqli_query($conn,"select count(*) ".$query);
		$totalNum=mysqli_fetch_row($rs)[0];
		$res=array("totalNum"=>$totalNum);
		$itemList=array();
		$query="select $cat.image,$cat.title,$cat.price,$cat.currentPrice,$cat.SoldQuantity,$cat.loc,$cat.nick,score.score,score.catPrior,score.wordNum,score.highPVNum,score.highCharNum,score.scoreRate,score.catPriorRate,score.wordRate,score.highPVRate,score.highCharRate,$cat.itemid,$cat.isFlag,$cat.isNew,$cat.time_stamp,$cat.quantity,$cat.endTime ".$query." order by $sort DESC  limit $start,100";
		$rs=mysqli_query($conn,$query);
		while($row=mysqli_fetch_row($rs)){
			array_push($itemList,array("image"=>$row[0],"title"=>$row[1],"price"=>$row[2],"currentPrice"=>$row[3],"soldQuantity"=>$row[4],"loc"=>$row[5],"nick"=>$row[6],"score"=>$row[7],"catPrior"=>$row[8],"wordNum"=>$row[9],"highPVNum"=>$row[10],"highCharNum"=>$row[11],"scoreRate"=>$row[12],"catPriorRate"=>$row[13],"wordRate"=>$row[14],"highPVRate"=>$row[15],"highCharRate"=>$row[16],"itemid"=>$row[17],"isFlag"=>$row[18],"isNew"=>$row[19],"timeStamp"=>date('Y-m-d',strtotime($row[20])),"quantity"=>$row[21],"endTime"=>date('Y-m-d H:i:s',$row[22])));
		} 
		$res['itemList']=$itemList;
		$res=json_encode($res,JSON_UNESCAPED_UNICODE);
		echo "var itemList=".$res;
	}
?>
