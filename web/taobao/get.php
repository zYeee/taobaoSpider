<?php
	$cid=$_GET['cid'];
	//$ch=curl_init("http://api.taobao.com/apitools/ajax_props.do?act=props&restBool=true&cid=".$cid);
    //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
    //curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
    //$output = curl_exec($ch);
	$path="prop/".$cid;
	echo file_get_contents($path);
?>

