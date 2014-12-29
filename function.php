<?php
	require_once("prop.php");
	require_once("conn.php");
	function calTotal($search_res){
        $ch=curl_init($search_res) ;
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true) ;
        curl_setopt($ch,CURLOPT_BINARYTRANSFER,true) ;
        $output=curl_exec($ch) ;
        $output=iconv('GB18030','utf-8',$output);
        $output=json_decode($output,true);
		if($output=="")
			echo "ERROR!!!!!";
        $totalNumber=$output['selectedCondition']['totalNumber'];
        if(strpos($output['selectedCondition']['totalNumber'],"万")){
            $totalNumber*=10000;
        }
        return $totalNumber;
    }
	function getinfo($search_res){
		global $conn;
		$prop="hws.m.taobao.com/cache/wdetail/5.0/?ttid=2013@taobao_h5_1.0.0";
		$ch = curl_init($search_res) ;
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
		$output = curl_exec($ch) ;
		$output=iconv('GB18030','utf-8',$output);
		$output= json_decode($output,true);
		$flag1=$flag2=$flag3=$flag4=$flag5=$flag6=$flag7=false;
		$query0="insert ignore into score (itemid) values";
		$query1="insert ignore into `50012027` values";
		$query2="insert ignore into `50012028` values";
		$query3="insert ignore into `50012032` values";
		$query4="insert ignore into `50012033` values";
		$query5="insert ignore into `50012042` values";
		$query6="insert ignore into `50012047` values";
		$query7="insert ignore into `50012825` values";
		if(!isset($output['itemList'])){
			return 0;
		}
		foreach ($output['itemList'] as $child){
			$title=addslashes(str_replace("‘","'",$child['title']));//标题
			$price=$child['price'];//原价
			$currentPrice=$child['currentPrice'];//折扣价
			$nick=$child['nick'];//旺旺id
			$sellerid=$child['sellerId'];//sid
			$loc=$child['loc'];//所在地
			$itemid=substr($child['href'],35,strlen($child['href'])-35);//itemid
			$image=$child['image'];//主图
			$require_url=$prop."&id=".$itemid;
			$ch = curl_init($require_url) ;//属性
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ;
			curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ;
			$res = curl_exec($ch) ;
			$res= json_decode($res,true);
			if(!isset($res['data']['seller'])){
				continue;
			}
			$review_per=$res['data']['seller']['goodRatePercentage'];
			if(!isset($res['data']['seller']['creditLevel'])){
				continue;
			}
			$creditLevel=$res['data']['seller']['creditLevel'];
			$isNew=0;
			foreach($child['icon']['all'] as $checkNew){
				if($checkNew['id']=='xinpin'){
					$isNew=1;
					break;
				}
			}
			$isFlag=0;
			if($price<=30)
				$priceRange="0-30元";
			else if($price>30&&$price<=100)
				$priceRange="31-100元";
			else if($price>101&&$price<=200)
				$priceRange="101-200元";
			else if($price>201&&$price<=500)
				$priceRange="201-500元";
			else if($price>501&&$price<=1000)
				$priceRange="501-1000元";
			else if($price>1001&&$price<=2000)
				$priceRange="1001-2000元";
			else
				$priceRange="2000元以上";

			$data=json_decode($res['data']['apiStack'][0]['value'],true);
			if(!isset($data['data'])){
				continue;
			}
			$SoldQuantity=$data['data']['itemInfoModel']['totalSoldQuantity']; //销量
			$quantity=$data['data']['itemInfoModel']['quantity']; 
			if(!isset($res['data']['itemInfoModel']['categoryId'])){
				continue;
			}
			$item_prop=new prop();
			foreach($res['data']['props'] as $props){
				$item_prop->get_prop($props);
			}
			$query_="('$itemid'),";
			$query="('$title',$price,$currentPrice,'$nick','$loc','$itemid','$image',$SoldQuantity,'$review_per',$creditLevel,$quantity,null,$isNew,$isFlag,'$priceRange','$item_prop->p_1','$item_prop->p_2','$item_prop->p_3','$item_prop->p_4','$item_prop->p_5','$item_prop->p_6','$item_prop->p_7','$item_prop->p_8','$item_prop->p_9','$item_prop->p_10','$item_prop->p_11','$item_prop->p_12','$item_prop->p_13','$item_prop->p_14','$item_prop->p_15','$item_prop->p_16','$item_prop->p_17','$item_prop->p_18','$item_prop->p_19','$item_prop->p_20','$item_prop->p_21','$item_prop->p_22','$item_prop->p_23','$item_prop->p_24','$item_prop->p_25','$item_prop->p_26','$item_prop->p_27','$item_prop->p_28','$item_prop->p_29','$item_prop->p_30','$item_prop->p_31','$item_prop->p_32','$item_prop->p_33','$item_prop->p_34',null),";
			switch ($res['data']['itemInfoModel']['categoryId']){
				case "50012027":$query1.=$query;$flag1=true;break;
				case "50012028":$query2.=$query;$flag2=true;break;
				case "50012032":$query3.=$query;$flag3=true;break;
				case "50012033":$query4.=$query;$flag4=true;break;
				case "50012042":$query5.=$query;$flag5=true;break;
				case "50012047":$query6.=$query;$flag6=true;break;
				case "50012825":$query7.=$query;$flag7=true;break;
			}
			$query0.=$query_;
		}
		mysqli_query($conn,"BEGIN");
		if(mysqli_query($conn,substr($query0,0,-1))){
			if($flag1)
				if(!mysqli_query($conn,substr($query1,0,-1))){
					mysqli_query($conn,"ROLLBACK");
				}
			if($flag2) 
				if(!mysqli_query($conn,substr($query2,0,-1))){
					mysqli_query($conn,"ROLLBACK");
				}
			if($flag3) 
				if(!mysqli_query($conn,substr($query3,0,-1))){
					mysqli_query($conn,"ROLLBACK");
				}
			if($flag4) 
				if(!mysqli_query($conn,substr($query4,0,-1))){
					mysqli_query($conn,"ROLLBACK");
				}
			if($flag5) 
				if(!mysqli_query($conn,substr($query5,0,-1))){
					mysqli_query($conn,"ROLLBACK");
				}
			if($flag6){
				if(!mysqli_query($conn,substr($query6,0,-1))){
					mysqli_query($conn,"ROLLBACK");
				}
			}
			if($flag7) 
				if(!mysqli_query($conn,substr($query7,0,-1))){
					mysqli_query($conn,"ROLLBACK");
				}
		}
		$res=mysqli_affected_rows($conn);
		mysqli_query($conn,"COMMIT");
		return $res;
	}
?>
