<?php
	require_once("conn.php");
	$query="select * from statistics";
	$rs=mysqli_query($conn,$query);
?>
<html>
	<head>
		<title>采集统计</title>
	</head>
	<body>
		<table>
			<tr>	
				<th>日期</th>
				<th>低帮鞋</th>
				<th>靴子</th>
				<th>凉鞋</th>
				<th>拖鞋</th>
				<th>帆布鞋</th>
				<th>雨鞋</th>
				<th>高帮鞋</th>
			</tr>
			<?php
				while ($row=mysqli_fetch_row($rs)){?>
					<tr>
						<?php foreach ($row as $items){?>
							<td><?php echo $items; ?></td>
						<?php } ?>
					</tr>
			<?php
				}
			?>
		</table>
	</body>
</html>
