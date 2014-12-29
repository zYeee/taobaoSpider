<?php
	require_once("function.php");
	function calMin($priceL,$priceR){
		global $search_res;
		$left=$priceL;
	    $right=$priceR;
	    while($left<$right){
	        $mid=($left+$right)>>1;
			//echo "LL:".$priceL."L:".$left."R:".$right."mid:".$mid."\n";
	        $search_url=$search_res."[$priceL,$mid]";
	        $total=calTotal($search_url);
			if($total==3)
				continue;
			echo $left.":".$right.":".$mid.":".$total."\n";
	        if($total>10000){
	            $right=$mid;
	            continue;
	        }
	        else if($total<9000){
	            $left=$mid+1;
	            continue;
	        }
	        break;
	    }
		if($priceL==$mid)
			$mid++;
		echo "                           total:".$total." "."mid:".$mid."\n";
		if($total>100000)
				exit();
	    return $mid;
	}
	$priceL=5;
	$priceR=10000;
	$search_res="http://list.taobao.com/itemlist/.htm?json=on&pSize=96&cat=50012027&_input_charset=utf-8&data-key=filter&module=price&loc=上海&data-value=reserve_price";
	while(1){
		$mid=calMin($priceL,$priceR);
		if(calTotal($mid,$priceR<10000)||$mid==$priceR-1)
			break;
		$priceL=$mid;
	}
?>
