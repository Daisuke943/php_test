<?php
	// サイト内から遷移してきた時の処理
	$id = $_GET["id"];
	
	$sql = "select * from userdata where id=".$id."";
	$db = mysqli_connect("localhost","root","","original_system");
	$result = mysqli_query($db,$sql);
	
	while($data = mysqli_fetch_assoc($result)) {
		$name = $data["name"];
	}
	
	// 購入履歴を検索する
	$sql = "select * from commodity where purchaser_id=".$id." order by purchase_date asc";
	
	$db = mysqli_connect("localhost","root","","original_system");
	$result = mysqli_query($db,$sql);
	
	mysqli_close($db);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link href="./css/style.css" rel="stylesheet" type="text/css">
		<title>簡易版ECサイト</title>
	</head>
	<body>
		<div id="wrapper">	
			<div id="header">
				<div id="nav">
					<div><h1>簡易版ECサイト 購入履歴ページ</h1></div>
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
				<?php
					// 商品の表示
					$total_price = 0;
					while($data = mysqli_fetch_assoc($result)){
						// 合計金額を計算する
						$total_price = $data["price"] * $data["purchase_number"];
						
						echo '<div id="commodity_box2">';
							echo '<div>';
								echo '<image src="'.$data["image_url"].'" id="commodity_image">';
							echo '</div>';
							echo '<div class="margin_left">';
							echo '<h2>'.$data["name"].'</h2>';
								// echo '<h3>'.$data["description"].'</h2>';						
								echo '<h3 class="margin_top">購入日時　'.$data["purchase_date"].'</h3>';
								echo '<h3>商品単価　¥'.$data["price"].'</h3>';
								echo '<h3>購入数　'.$data["purchase_number"].'個</h3>';
								echo '<h3>合計金額　'.$total_price.'円</h3>';
							echo '</div>';
						echo '</div>';
						
					}
				?>
			</div>
			<div id="footer" class="box_center">
				<p>Copyright © 2020-2021 EC inc. All Rights Reserved.</p>
			</div>
		</div>
	</body>
</html>