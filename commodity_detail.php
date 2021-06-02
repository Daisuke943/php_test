<?php
	// shopping.phpから遷移してきた時の処理
	$id = $_GET["id"];
	
	$sql = "select * from userdata where id=".$id."";
	$db = mysqli_connect("localhost","root","","original_system");
	$result = mysqli_query($db,$sql);
	
	while($data = mysqli_fetch_assoc($result)) {
		$name = $data["name"];
	}
	
	// 詳細を表示する商品を検索
	$commodity_id = $_GET["commodity_id"];
	$sql = "select * from commodity where id=".$commodity_id."";
	
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
					<div><h1>簡易版ECサイト 商品詳細ページ</h1></div>
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
					while($data = mysqli_fetch_assoc($result)){
						echo '<div id="commodity_box" class="text_center box_center2">';
							echo '<image src="'.$data["image_url"].'" id="commodity_image">';
							echo '<h2>'.$data["name"].'</h2>';
							echo '<h3>'.$data["description"].'</h3>';
							echo '<h3>¥'.$data["price"].'</h3>';
							
							echo '<form action="sales.php" method="get" class="text_center">';
								echo '<select name="purchase_number">';
								for ($i=1; $i<=$data["stock"]; $i++){
									$price_total = $i * $data["price"];
									echo '<option value='.$i.'>'.$i.'個   合計'.$price_total.'円</option>';
								}
								echo '</select><br><br>';
								echo '<input type="hidden" name="id" value='.$id.'>';
								echo '<input type="hidden" name="commodity_id" value='.$commodity_id.'>';
								echo '<input type="hidden" name="stock" value='.$data["stock"].'>';
								echo '<input type="submit" value="購入する" class="btn_design2">';
							echo '</form>';
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