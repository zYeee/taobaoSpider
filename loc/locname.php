#!/usr/bin/php
<?php
	require_once("locnamelist.php");
	require_once("/usr/local/app/function.php");
	echo date("Y-m-d H:i:s", time())."\n";
	$locnames=json_decode($locname,true);
	$cats=array("50012027","50012042","50012028","50029451","50027236","50043914","50012047");
	$search_res="http://list.taobao.com/itemlist/.htm?json=on&pSize=96&sort=_oldstart&_input_charset=utf-8";
	foreach($cats as $cat){
		$search_url=$search_res."&cat=$cat";
		echo $cat.":";
		echo "\n";
		foreach($locnames as $province=>$cities){
			echo $province.":";
			$result=0;
			$search_url_p=$search_url."&loc=$province";
			$total=calTotal($search_url_p);
			if($total>=10000){
				foreach ($cities as $city){
					$search_url_c=$search_url."&loc=$city";
					$totalNum=calTotal($search_url_c);
					$totalNum=ceil($totalNum/96);
					if($totalNum>100)
						$totalNum=100;
					for($i=0;$i<$totalNum;$i++){
						$result+=getinfo($search_url_c."&s=".($i*96));
					}
				}
			}
			else{
				$totalNum=ceil($total/96);
				if($totalNum>100)
					$totalNum=100;
				for($i=0;$i<$totalNum;$i++){
					$result+=getinfo($search_url_p."&s=".($i*96));
				}
			}
			echo $result."\n";
		}
	}
	echo date("Y-m-d H:i:s", time())."\n";
?>
