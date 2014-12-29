#!/usr/bin/php
<?php
	require_once("conn.php");
	$query="select * from score where score is null";
	$rows=mysqli_query($conn,$query);
	$uri = "http://112.124.7.124/JZGTitle/MingServlet/titleHome.titleTest";
	$flag=false;
	while(1){
		$no=0;
		$mh=curl_multi_init();
		$chs=array();
		while(1){
			$row=mysqli_fetch_row($rows);
			if($row==null){
				$flag=true;
				break;
			}
			if($no==100)
				break;
			$no++;
			$itemid=$row[0];
			$data = array (
				'_MING_ROOT_' => array(
					'title'=>"http://item.taobao.com/item.htm?id:".$itemid
				),
				'_MING_CLASS_'=>"_MING_CLASS_"
			);
			$data=json_encode($data,true);
			$ch = curl_init ($uri);
			array_push($chs,array('ch'=>$ch,'itemid'=>$itemid));
			curl_setopt ( $ch, CURLOPT_POST, 1 );
			curl_setopt ( $ch, CURLOPT_HEADER, 0 );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
			curl_multi_add_handle($mh,$ch);
		}
		$active=null;
		do{
			curl_multi_exec($mh,$active);
		}while($active);
		foreach($chs as $ch){
			$itemid=$ch['itemid'];
			$return=json_decode(curl_multi_getcontent($ch['ch']),true);
			if(!isset($return['desc'])){
				$query="delete from score where itemid='$itemid'";
				echo "\ndel:$itemid\n";
				mysqli_query($conn,$query);
				continue;
			}
			$evaluation=$return['desc']['desc'];
			$score=$return['desc']['score'];
			$catPrior=$return['desc']['catPrior'];
			$wordNum=$return['desc']['wordNum'];
			$highPVNum=$return['desc']['highPVNum'];
			$highCharNum=$return['desc']['highCharNum'];
			$scoreRate=$return['desc']['scoreRate'];
			$catPriorRate=$return['desc']['catPriorRate'];
			$wordRate=$return['desc']['wordNumRate'];
			$highPVRate=$return['desc']['highPVRate'];
			$highCharRate=$return['desc']['highCharRate'];

			$query="update score set evaluation='$evaluation',score=$score,catPrior=$catPrior,wordNum=$wordNum,highPVNum=$highPVNum,highCharNum=$highCharNum,scoreRate=$scoreRate,catPriorRate=$catPriorRate,wordRate=$wordRate,highPVRate=$highPVRate,highCharRate=$highCharRate where itemid='$itemid'";
			mysqli_query($conn,$query);
			mysqli_query($conn,"COMMIT");
			echo "OK";
		}
		if($flag)
			break;
	}
	mysqli_close($conn);
?>
