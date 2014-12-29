#!/usr/bin/php
<?php
	require_once("function.php");
	$cat=$argv[1];
	$sort="";
	$loc="";
	if($argc==3){
		$sort=$argv[2];
	}
	if($argc==4){
		$sort=$argv[2];
		$loc=$argv[3];
	}
	$search_res="http://list.taobao.com/itemlist/.htm?json=on&pSize=96&_input_charset=utf-8&cat=".$cat;
	if($sort!="")
		$search_res.="&sort=".$sort;
	if($loc!="")
		$search_res.="&loc=".$loc;

	$total=0;
	echo $cat.":".date("Y-m-d H:i:s", time())." ".$sort.$loc." ".memory_get_usage()."begin\n";
	for($i=0;$i<100;$i++){
		 $total+=getinfo($search_res."&s=".($i*96));
	}
	echo $cat." END ".$total." ".date("Y-m-d H:i:s", time())." ".memory_get_usage()."\n";
?>
