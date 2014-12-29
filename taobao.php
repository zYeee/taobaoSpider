#!/usr/bin/php
<?php
	echo time();
	$ch=curl_init("http://list.taobao.com/itemlist/.htm?json=on&cat=50006843");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
    $output = curl_exec($ch);
    $output=iconv('gbk','utf-8',$output);
    $catagory= json_decode($output,true);

    require_once("conn.php");
    require_once("prop.php");
    $prop="hws.m.taobao.com/cache/wdetail/5.0/?ttid=2013@taobao_h5_1.0.0";
    //$review="http://orate.alicdn.com/detailCommon.htm?";
    //$category=array("50012825"=>"高帮鞋","50012028"=>"靴子","50012047"=>"雨鞋","50012033"=>"拖鞋","50012042"=>"帆布鞋","50012032"=>"凉鞋","50012027"=>"低帮鞋");
    $query1="insert ignore into `50012027` values";
    $query2="insert ignore into `50012028` values";
    $query3="insert ignore into `50012032` values";
    $query4="insert ignore into `50012033` values";
    $query5="insert ignore into `50012042` values";
    $query6="insert ignore into `50012047` values";
    $query7="insert ignore into `50012825` values";
	$query0="insert ignore into score (itemid) values";

    foreach($catagory['cat']['catGroupList'] as $catList){
        foreach($catList['catList'] as $catValue){
            echo $catValue['value'].":";
            for($i=0;$i<100;$i++){
                $search_res="http://list.taobao.com/itemlist/.htm?json=on&pSize=96&sort=biz30day"."&s=".($i*96)."&cat=".$catValue['value'];
                //$search_res="http://list.taobao.com/itemlist/.htm?json=on&pSize=96&sort=biz30day"."&s=".($i*96)."&cat=50012825";
                $ch = curl_init($search_res) ;
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
                curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
                $output = curl_exec($ch) ;
                $output=iconv('gbk','utf-8',$output);
                $output= json_decode($output,true);
                $flag1=$flag2=$flag3=$flag4=$flag5=$flag6=$flag7=false;
                $total=count($output['itemList']);
				$query0="insert ignore into score (itemid) values";
                $query1="insert ignore into `50012027` values";
                $query2="insert ignore into `50012028` values";
                $query3="insert ignore into `50012032` values";
                $query4="insert ignore into `50012033` values";
                $query5="insert ignore into `50012042` values";
                $query6="insert ignore into `50012047` values";
                $query7="insert ignore into `50012825` values";
                foreach ($output['itemList'] as $child){
                    $flag1=$flag2=$flag3=$flag4=$flag5=$flag6=$flag7=false;
                    $title=addslashes(str_replace("‘","'",$child['title']));//标题
                    $price=$child['price'];//原价
                    $currentPrice=$child['currentPrice'];//折扣价
                    $nick=$child['nick'];//旺旺id
                    $sellerid=$child['sellerId'];//sid
                    $loc=$child['loc'];//所在地
                    $itemid=substr($child['href'],35,strlen($child['href'])-35);//itemid
                    $image=$child['image'];//主图
                    //$require_url=$review."auctionNumId=".$itemid."&userNumId=".$sellerid;
                    //$ch = curl_init($require_url) ;//好评率
                    //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ;
                    //curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ;
                    //$res = curl_exec($ch) ;
                    //$code = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );
                    //$res=iconv('gbk','utf-8',$res);
                    //$res=substr($res,5,strlen($res)-6);
                    //$res=json_decode($res,true);
                    //print_r($res);
                    //echo $res['data']['count']['good']." ".$res['data']['count']['total'];
                    //exit();
                    //if($res['data']['count']['total'])
                    //  $review_per=sprintf("%.2f",$res['data']['count']['good']/$res['data']['count']['total']);
                    //else
                    //  $review_per=0;
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
					$data=json_decode($res['data']['apiStack'][0]['value'],true);
					if(!isset($data['data'])){
						continue;
					}
                    $SoldQuantity=$data['data']['itemInfoModel']['totalSoldQuantity']; //销量
					if(!isset($res['data']['itemInfoModel']['categoryId'])){
						continue;
					}
                    //$categoryId=$category[$res['data']['itemInfoModel']['categoryId']];
                    $item_prop=new prop();
                    foreach($res['data']['props'] as $props){
                        $item_prop->get_prop($props);
                    }
					$query_="('$itemid'),";
					$query="('$title',$price,$currentPrice,'$nick','$loc','$itemid','$image',$SoldQuantity,'$review_per',$creditLevel,'$item_prop->p_1','$item_prop->p_2','$item_prop->p_3','$item_prop->p_4','$item_prop->p_5','$item_prop->p_6','$item_prop->p_7','$item_prop->p_8','$item_prop->p_9','$item_prop->p_10','$item_prop->p_11','$item_prop->p_12','$item_prop->p_13','$item_prop->p_14','$item_prop->p_15','$item_prop->p_16','$item_prop->p_17','$item_prop->p_18','$item_prop->p_19','$item_prop->p_20','$item_prop->p_21','$item_prop->p_22','$item_prop->p_23','$item_prop->p_24','$item_prop->p_25','$item_prop->p_26','$item_prop->p_27','$item_prop->p_28','$item_prop->p_29','$item_prop->p_30','$item_prop->p_31','$item_prop->p_32','$item_prop->p_33','$item_prop->p_34',null),";
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
				mysqli_query($conn,substr($query0,0,-1));
                if($flag1) mysqli_query($conn,substr($query1,0,-1));
                if($flag2) mysqli_query($conn,substr($query2,0,-1));
                if($flag3) mysqli_query($conn,substr($query3,0,-1));
                if($flag4) mysqli_query($conn,substr($query4,0,-1));
                if($flag5) mysqli_query($conn,substr($query5,0,-1));
                if($flag6) mysqli_query($conn,substr($query6,0,-1));
                if($flag7) mysqli_query($conn,substr($query7,0,-1));
                echo "(".$i."):".$total." ".mysqli_affected_rows($conn)." ";
                if(mysqli_affected_rows($conn)==-1){
                    if($flag1) echo "一".$query1;
                    if($flag2) echo "二".$query2;
                    if($flag3) echo "三".$query3;
                    if($flag4) echo "四".$query4;
                    if($flag5) echo "五".$query5;
                    if($flag6) echo "六".$query6;
                    if($flag7) echo "七".$query7;
                    exit();
                }
            }
            echo "\n";
        }
    }
	echo time();
?>
