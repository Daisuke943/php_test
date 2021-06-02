<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link href="./css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<h1>簡易版ECサイト ログインページ</h1>
				<image src="./images/header_image.jpg" id="header_image">
			</div>
			<div id="main" style="height:700px">
				<div id="login_box" class="text_center">
					<form action="shopping.php" method="post">
						<label for="email">Email</label>
						<input type="text" id="email" name="email">
						<label for="password">Password</label>
						<input type="password" id="password" name="password">
						<input type="hidden" name="login" value="true">
						<input type="submit" value="ログイン" class="btn_design">
					</form>
					<div id="link_insert"><a href="insert.php" class="link_design2">会員登録はコチラ</a></div>
				</div>
			</div>
			<div id="footer" class="box_center">
				<p>Copyright © 2020-2021 EC inc. All Rights Reserved.</p>
			</div>
		</div>
	</body>
</html>