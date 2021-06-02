<?php
	// commodity_detail.phpから遷移してきた時の処理
	$id = $_GET["id"];
	$commodity_id = $_GET["commodity_id"];
	
	$sql = "select * from userdata where id=".$id."";
	$db = mysqli_connect("localhost","root","","original_system");
	$result = mysqli_query($db,$sql);
	
	while($data = mysqli_fetch_assoc($result)) {
	$name = $data["name"];
	}
	
	// 商品購入処理
	$stock = $_GET["stock"];
	$purchase_number = $_GET["purchase_number"];
	
	// 在庫を減らす
	$stock = $stock - $purchase_number;
	
	// 購入日時を記録する
	date_default_timezone_set('Asia/Tokyo');
	$date = date("Y/m/d H:i:s");
	
	$sql = "update commodity set purchaser_id=".$id.",stock=".$stock.",purchase_number=".$purchase_number.",purchase_date='".$date."' where id=".$commodity_id."";
	$db = mysqli_connect("localhost","root","","original_system");
	$result = mysqli_query($db,$sql);
	
	mysqli_close($db);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link href="./css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div id="wrapper">	
			<div id="header">
				<div id="nav">
					<div><h1>簡易版ECサイト 商品購入ページ</h1></div>
					<?php
					echo '<div class="box_right text_right"><a href="index.php" class="link_design">ログアウト</a><h3>こんにちは、'.$name.'さん</h3></div>';
					?>
				</div>
				<img src="./images/header_image.jpg" id="header_image">
				<ul id="nav">
				<?php
				echo '<li><a href="shopping.php?id='.$id.'">TOP</a></li>';
				echo '<li><a href="shopping_history.php?id='.$id.'">購入履歴</a></li>';
				echo '<li><a href="member_information.php?id='.$id.'">会員情報</a></li>';
				?>
				</ul>
			</div>
			<div id="main">
				<div class="text_center">
					<h2>購入しました。</h2>
					<?php
					echo '<a href="shopping.php?id='.$id.'" class="link_design">TOPへ戻る</a>';
					?>
				</div>
			</div>
			<div id="footer" class="box_center">
				<p>Copyright © 2020-2021 EC inc. All Rights Reserved.</p>
			</div>
		</div>
	</body>
</html>