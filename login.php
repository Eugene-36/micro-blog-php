<?php 
	require("config.php");
	require("db.php");
	require("functions/all.php");

	if (!empty($_POST)) {
		if (empty($_POST['username'])) 	$errors[] = "Введите имя пользователя";
		

		if (empty($_POST['password']) ) $errors[] = "Введите пароль";
		

		//Поиск пользователя
		if (empty($errors)) {
		 $user =	R::findOne('users', ' username LIKE ? ', [$_POST['username']]);

		 if ($user) {
			// password_verify($_POST['password'], $user['password'])
			 if (password_verify($_POST['password'], $user['password'])) {
				//Пароль совпал с паролем в базе, и с паролем из пост массива
				$_SESSION['username'] = $user['username'];
				$_SESSION['role'] = $user['role'];
				// var_dump($_SESSION);

				 header("Location: " . HOST . "feeds/micro-blog");
				 exit;
			 }else{
				//Пароль не совпал

				$errors[] = "Не верные данные для входа";
			 }
		 }else{
			$errors[] = "Такого пользователя не существует";
		 }
		}
	};

	include(ROOT . "templates/head.tpl");
	include(ROOT . "templates/header.tpl");
?>

	<main class="page-content">
		<div class="container container-narrow">
			<form class="form" method="POST">
				<h2 class="form__title">Вход</h2>

				<?php 
						if(isset($errors) && !empty($errors)){
							foreach($errors as $error){
								echo "<p class='error'>$error</p>";
							};
						};
					?>

				<label class="fieldset">
					<div class="label">Юзернейм</div>
					<input name="username" type="text" id="username" class="input" />
				</label>

				<label class="fieldset">
					<div class="label">Пароль</div>
					<input name="password" type="password" id="password" class="input" />
				</label>
				<button class="button button-lg">Войти</button>
			</form>
		</div>
	</main>
	
	<?php 
	include(ROOT . "templates/footer.tpl");
	?>
