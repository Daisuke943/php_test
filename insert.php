<?php
	$input_check = true;
	if (isset($_POST["insert"])){
		$name = $_POST["name"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$gender = $_POST["gender"];
		$old = $_POST["old"];
		
		// 入力チェック
		if($name =="" or $email=="" or $password==""){
			$_POST["insert"] = null;
			$input_check = false;
		}else{
			// 会員登録処理
			$sql = "insert into userdata (name,email,password,gender,old) value 
			('".$name."','".$email."','".$password."','".$gender."',".$old.")";
		
			$db = mysqli_connect("localhost","root","","original_system");
			$result = mysqli_query($db,$sql);
			
			mysqli_close($db);
		}
	}
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
				<h1>簡易版ECサイト 会員登録ページ</h1>
				<image src="./images/header_image.jpg" id="header_image">
			</div>
			<div id="main">
			<?php
				if (!isset($_POST["insert"])){
					echo '<div id="member_box" class="text_center box_center2">
						<h3>会員登録</h3><br>';
					echo '<form action="insert.php" method="post">';
						if(!$input_check){
							echo '<p style="color:red;" class="margin_0">名前、Email、Passwordのいずれかが入力されていません。</p>';
						}
						echo '<label for="name">名前(必須)</label><br>';
						echo '<input type="text" id="name" name="name" value=""><br><br>';
						echo '<label for="email">Email(必須)</label><br>';
						echo '<input type="text" id="email" name="email" value=""><br><br>';
						echo '<label for="password">Password(必須)</label><br>';
						echo '<input type="text" id="password" name="password" value=""><br><br>';
						echo '<label for="gender">性別</label><br>';
						echo '<input type="radio" name="gender" value="0" checked=checked>男';
						echo '<input type="radio" name="gender" value="1">女<br><br>';
						echo '<label for="old">年齢 </label>';
						
						echo '<select name="old">';
						for($i=1; $i<=100; $i++){
							echo '<option value='.$i.'>'.$i.'</option>';
						}
						echo '</select><br><br>';
						
						echo '<input type="hidden" name="insert" value="true">';
						echo '<button type="submit" formaction="index.php" class="btn_design2">戻る</button>';
						echo '<input type="submit" value="登録" class="btn_design2">';
					echo '</form>';
					echo '</div>';
				} else {
					echo '
					<div class="text_center">
						<p>登録が完了しました</p>
						<a href="index.php" class="link_design2">ログインページへ</a>
					</div>';
				}
			?>
			</div>
			<div id="footer" class="box_center">
				<p>Copyright © 2020-2021 EC inc. All Rights Reserved.</p>
			</div>
		</div>
	</body>
</html>