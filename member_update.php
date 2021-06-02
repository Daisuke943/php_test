<?php
	// 会員情報から遷移してきた時の処理
	$id = $_POST["id"];
	
	$sql = "select * from userdata where id=".$id."";
	$db = mysqli_connect("localhost","root","","original_system");
	$result = mysqli_query($db,$sql);
	
	while($data = mysqli_fetch_assoc($result)) {
		$name = $data["name"];
	}

	// 更新処理
	$name = $_POST["name"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$gender = $_POST["gender"];
	$old = $_POST["old"];
	
	$sql = "update userdata set name='".$name."',email='".$email."',password='".$password."',gender='".$gender."',old=".$old." where id=".$id."";
	
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
					<div><h1>簡易版ECサイト 会員情報更新ページ</h1></div>
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
					<h2>更新しました。</h2>
					<?php
						echo '<a href="shopping.php?id='.$id.'" class="link_design2">TOPへ戻る</a>';
					?>
				</div>
			</div>
			<div id="footer" class="box_center">
				<p>Copyright © 2020-2021 EC inc. All Rights Reserved.</p>
			</div>
		</div>
	</body>
</html>