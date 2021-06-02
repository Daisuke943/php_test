<?php
	// サイト内から遷移してきた時の処理
	$id = $_GET["id"];
	
	$sql = "select * from userdata where id=".$id."";
	$db = mysqli_connect("localhost","root","","original_system");
	$result = mysqli_query($db,$sql);
	
	while($data = mysqli_fetch_assoc($result)) {
		$name = $data["name"];
	}
	
	// 会員情報を検索する
	$sql = "select * from userdata where id=".$id."";
	
	$db = mysqli_connect("localhost","root","","original_system");
	$result = mysqli_query($db,$sql);
	
	while($data = mysqli_fetch_assoc($result)){
		$name = $data["name"];
		$email = $data["email"];
		$password = $data["password"];
		$gender = $data["gender"];
		$old = $data["old"];
	}	
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
					<div><h1>簡易版ECサイト 会員情報ページ</h1></div>
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
				<div id="member_box" class="text_center box_center2">
					<h3>会員情報</h3><br>
					<?php
						echo '<form action="member_dalete.php" method="post">';
							echo '<label for="name">名前</label><br>';
							echo '<input type="text" size="25" id="name" name="name" value="'.$name.'"><br><br>';
							echo '<label for="email">Email</label><br>';
							echo '<input type="text" size="25" id="email" name="email" value="'.$email.'"><br><br>';
							echo '<label for="password">Password</label><br>';
							echo '<input type="text" size="25" id="password" name="password" value="'.$password.'"><br><br>';
							echo '<label for="gender">性別</label><br>';
							
							if($gender == 0){
								echo '<input type="radio" name="gender" value="0" checked=checked>男';
								echo '<input type="radio" name="gender" value="1">女<br><br>';
							}else{
								echo '<input type="radio" name="gender" value="0">男';
								echo '<input type="radio" name="gender" value="1" checked=checked>女<br><br>';
							}
							
							echo '<label for="old">年齢</label><br>';
							
							echo '<select name="old">';
							for($i=1; $i<=100; $i++){
								if($i == $old){
									echo '<option value='.$i.' selected>'.$i.'</option>';
								}else{
									echo '<option value='.$i.'>'.$i.'</option>';
								}
							}
							echo '</select><br><br>';
							echo '<input type="hidden" name="id" value="'.$id.'">';
							echo '<button type="submit" formaction="member_update.php" class="btn_design2">更新</button>';
							echo '<input type="submit" value="削除" class="btn_design2">';
						echo '</form>';
					?>
				</div>
			</div>
			<div id="footer" class="box_center">
				<p>Copyright © 2020-2021 EC inc. All Rights Reserved.</p>
			</div>
		</div>
	</body>
</html>