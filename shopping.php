<?php
	// ログイン処理
	if(isset($_POST["login"])){
		
		$email = $_POST["email"];
		$password = $_POST["password"];
		
		$sql = "select * from userdata where email='".$email."' and password='".$password."'";
		
		$db = mysqli_connect("localhost","root","","original_system");
		$result = mysqli_query($db,$sql);
		
		$loginFlag = false;
		$id = null;
		while($data = mysqli_fetch_assoc($result)) {
			$id = $data["id"];
			$name = $data["name"];
			$loginFlag = true;
		}
		
		mysqli_close($db);
	}
	
	// サイト内から遷移してきた時の処理
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		
		$sql = "select * from userdata where id=".$id."";
		$db = mysqli_connect("localhost","root","","original_system");
		$result = mysqli_query($db,$sql);
		
		while($data = mysqli_fetch_assoc($result)) {
			$name = $data["name"];
		}
	}
	
	// 検索処理
	$sql = "select * from commodity";
	if(isset($_GET["name"]) or isset($_GET["price_lower"]) or isset($_GET["price_upper"])){
		$commodity_name = $_GET["name"];
		$price_l = $_GET["price_lower"];
		$price_u = $_GET["price_upper"];
		
		$sql = "select * from commodity where name like '%".$commodity_name."%' and price>=".$price_l." and price<=".$price_u."";
	}
	
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
			<?php
				// ログインページから遷移した時
				if(isset($loginFlag)){
					// ログインに成功した時
					if($loginFlag){
						echo '
							<div id="header">
								<div id="nav">
									<div><h1>簡易版ECサイト 商品一覧ページ</h1></div>
									<div class="box_right text_right"><a href="index.php" class="link_design">ログアウト</a><h3>こんにちは、'.$name.'さん</h3></div>
								</div>
								<image src="./images/header_image.jpg" id="header_image">
								<ul id="nav">
									<li><a href="shopping.php?id='.$id.'">TOP</a></li>
									<li><a href="shopping_history.php?id='.$id.'">購入履歴</a></li>
									<li><a href="member_information.php?id='.$id.'">会員情報</a></li>
								</ul>
							</div>
							<div id="main">
								<div id="search_box">
									<form action="shopping.php" method="get" class="text_center">
										<label for="name">商品名</label>
										<input type="text" name="name">
										<label for ="price">価格</label>
										<select name="price_lower">
						';
						for($i=100; $i<=1000; $i=$i+100){
							echo '<option value='.$i.'>'.$i.'</option>';
						}
						echo '
										</select>円以上
										<select name="price_upper">
						';
						for($i=100; $i<=1000; $i=$i+100){
							if($i==1000){
								echo '<option value='.$i.' selected>'.$i.'</option>';
							}else{
								echo '<option value='.$i.'>'.$i.'</option>';
							}
						}
						echo '
										</select>円以下
										<input type="hidden" name="id" value="'.$id.'">
										<input type="submit" value="検索" class="btn_design2">
									</form>
								</div>
						';
						// 商品の表示
						$count = 0;
						while($data = mysqli_fetch_assoc($result)){
							if($count % 3 == 0 || $count == 0){
								echo '<div id="nav">';
							}
							
							echo '<div id="commodity_box" class="text_center">';
								echo '<image src="'.$data["image_url"].'" id="commodity_image">';
								echo '<h2>'.$data["name"].'</h2>';
								echo '<h3>¥'.$data["price"].'</h3>';
								// 在庫数が0の商品は売り切れと表示する
								if($data["stock"] != 0){
									echo '<h3>残り'.$data["stock"].'個です</h3>';
									echo '<a href="commodity_detail.php?id='.$id.'&commodity_id='.$data["id"].'" class="link_design">詳細</a>';
								}else{
									echo '<h3 style="color:red;">売り切れ</h3>';							
								}
							echo '</div>';
								
							$count++;
							
							if(mysqli_num_rows($result) == $count){
								echo '</div>';
							}else if($count % 3 == 0){
								echo '</div>';
							}
						}
						echo '
							</div>
						';
					// ログインに失敗した時
					} else {
						echo '
							<div id="header">
								<h1>簡易版ECサイト 商品一覧ページ</h1>
								<image src="./images/header_image.jpg" id="header_image">
							</div>
							<div id="main" class="text_center">
								<p>EmailまたはPasswordが正しくありません。</p>
								<form action="index.php" method="post">
									<input type="submit" value="戻る" class="btn_design">
								</from>
							</div>
						';
					}
				// ログインページ以外から遷移した時
				} else {
					// サイト内から遷移してきた時
					if($id != null){
						echo '
							<div id="header">
								<div id="nav">
									<div><h1>簡易版ECサイト 商品一覧ページ</h1></div>
									<div class="box_right text_right"><a href="index.php" class="link_design">ログアウト</a><h3>こんにちは、'.$name.'さん</h3></div>
								</div>
								<image src="./images/header_image.jpg" id="header_image">
								<ul id="nav">
									<li><a href="shopping.php?id='.$id.'">TOP</a></li>
									<li><a href="shopping_history.php?id='.$id.'">購入履歴</a></li>
									<li><a href="member_information.php?id='.$id.'">会員情報</a></li>
								</ul>
							</div>
							<div id="main">
								<div id="search_box">
									<form action="shopping.php" method="get" class="text_center">
										<label for="name">商品名</label>';
										// 商品名の検索内容を保存
										if(isset($commodity_name)){
											echo '<input type="text" name="name" value="'.$commodity_name.'">';
										}else{
											echo '<input type="text" name="name">';
										}
										echo '<label for ="price">価格</label>
										<select name="price_lower">
										';
						for($i=100; $i<=1000; $i=$i+100){
							// 下限価格の検索内容を保存
							if(isset($price_l) and $i==$price_l){
								echo '<option value='.$i.' selected>'.$i.'</option>';
							}else{
								echo '<option value='.$i.'>'.$i.'</option>';
							}
						}
						echo '
										</select>円以上
										<select name="price_upper">
						';
						for($i=1000; $i>=100; $i=$i-100){
							// 上限価格の検索内容を保存
							if(isset($price_u) and $i==$price_u){
								echo '<option value='.$i.' selected>'.$i.'</option>';
							}else{
								echo '<option value='.$i.'>'.$i.'</option>';
							}
						}
						echo '
										</select>円以下
										<input type="hidden" name="id" value="'.$id.'">
										<input type="submit" value="検索" class="btn_design2">
									</form>
								</div>
						';
						
						$count = 0;
						// 商品の表示
						while($data = mysqli_fetch_assoc($result)){
							if($count % 3 == 0 || $count == 0){
								echo '<div id="nav">';
							}
							
							echo '<div id="commodity_box" class="text_center">';
								echo '<image src="'.$data["image_url"].'" id="commodity_image">';
								echo '<h2>'.$data["name"].'</h2>';
								echo '<h3>¥'.$data["price"].'</h3>';
								// 在庫数が0の商品は売り切れと表示する
								if($data["stock"] != 0){
									echo '<h3>残り'.$data["stock"].'個です</h3>';							
									echo '<a href="commodity_detail.php?id='.$id.'&commodity_id='.$data["id"].'" class="link_design">詳細</a>';
								}else{
									echo '<h3 style="color:red;">売り切れ</h3>';								
								}
							echo '</div>';
								
							$count++;
							
							if(mysqli_num_rows($result) == $count){
								echo '</div>';
							}else if($count % 3 == 0){
								echo '</div>';
							}
						}
						echo '
							</div>
						';
						
					// サイト外から遷移してきた時
					}else{
						echo '
							<div id="header">
								<h1>簡易版ECサイト</h1>
								<image src="./images/header_image.jpg" id="header_image">
							</div>
							<div id="main">
								<p>不正アクセスです。</p>
								<form action="index.php" method="post">
									<input type="submit" value="戻る">
								</from>
							</div>
						';
					}
				}
			?>
			<div id="footer" class="box_center">
				<p>Copyright © 2020-2021 EC inc. All Rights Reserved.</p>
			</div>
		</div>
	</body>
</html>