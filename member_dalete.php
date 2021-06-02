<?php
	// 会員情報から遷移してきた時の処理
	$id = $_POST["id"];
	
	$sql = "select * from userdata where id=".$id."";
	$db = mysqli_connect("localhost","root","","original_system");
	$result = mysqli_query($db,$sql);
	
	while($data = mysqli_fetch_assoc($result)) {
		$name = $data["name"];
	}
	
	// 削除処理
	if(isset($_POST["delete"])){
		$sql = "delete from userdata where id=".$id."";
		
		$db = mysqli_connect("localhost","root","","original_system");
		$result = mysqli_query($db,$sql);
		
		mysqli_close($db);
	}
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
					<div><h1>簡易版ECサイト 会員情報削除ページ</h1></div>
					<?php
						if(!isset($_POST["delete"])){
							echo '<div class="box_right text_right"><a href="index.php" class="link_design">ログアウト</a><h3>こんにちは、'.$name.'さん</h3></div>';
						}
					?>
				</div>
				<img src="./images/header_image.jpg" id="header_image">
			</div>
			<div id="main">
				<?php
					if(!isset($_POST["delete"])){
						echo '<ul id="nav">';
							echo '<li><a href="shopping.php?id='.$id.'">TOP</a></li>';
							echo '<li><a href="shopping_history.php?id='.$id.'">購入履歴</a></li>';
							echo '<li><a href="member_information.php?id='.$id.'">会員情報</a></li>';
						echo '</ul>';
						echo '<div class="text_center">';
						echo '<h3>本当に削除しますか？</h3>';
						echo '<form action="member_dalete.php" method="post">';
							echo '<input type="hidden" name="id" value="'.$id.'">';
							echo '<input type="hidden" name="delete" value="true">';
							echo '<input type="submit" value="削除する" class="btn_design">';
						echo '</div>';
					}else{
						echo '<div class="text_center">';
						echo '<h2>削除しました。</h2>';
						echo '<a href="index.php" class="link_design2">ログインページに戻る</a>';
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