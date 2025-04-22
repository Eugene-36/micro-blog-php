<?php 
	require("config.php");
	require("db.php");
	require("functions/all.php");

	if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] === 'POST') {
		if (empty($_POST['username'])) 	$errors[] = "Введите имя пользователя";
		if (empty($_POST['password']) ) $errors[] = "Введите пароль";
		if (empty($_POST['age']) ) $errors[] = "Введите возраст";
		if (empty($_POST['content']) ) $errors[] = "Введите контент";
		
		//Поиск пользователя
		if (empty($errors)) {
      $name = $_POST['username'] ?? '';
      $password = $_POST['password'] ?? '';
      $age = $_POST['age'] ?? '';
      $content = $_POST['content'] ?? '';
  
      // Create a new bean
      $user = R::dispense('users');
      $user->username = $name;
      $user->password = password_hash($password, PASSWORD_DEFAULT);
      $user->age = $age;
      $user->content = $content;
  
      // Store it in the database
      R::store($user);
      header("Location: " . HOST . "feeds/micro-blog");
      echo "User saved successfully!";


      // ==========================
		//  $user =	R::findOne('users', ' username LIKE ? ', [$_POST['username']]);

		//  if ($user) {
		// 	 if ($user['password'] == $_POST['password']) {
		// 		//Пароль совпал с паролем в базе, и с паролем из пост массива
		// 		$_SESSION['username'] = $user['username'];
		// 		$_SESSION['role'] = $user['role'];
		// 		 header("Location: " . HOST . "feeds/micro-blog");
		// 		 exit;
		// 	 }else{
		// 		//Пароль не совпал

		// 		$errors[] = "Не верные данные для входа";
		// 	 }
		//  }else{
		// 	$errors[] = "Такого пользователя не существует";
		//  }
		}
	};

	include(ROOT . "templates/head.tpl");
	include(ROOT . "templates/header.tpl");
?>

	<main class="page-content">
		<div class="container container-narrow">
			<form class="form" method="POST">
				<h2 class="form__title">Регистрация</h2>

				<?php 
						if(isset($errors) && !empty($errors)){
							foreach($errors as $error){
								echo "<p class='error'>$error</p>";
							};
						};
					?>

				<label class="fieldset">
					<div class="label">Введите ваше имя</div>
					<input name="username" type="text" id="username" class="input" />
				</label>

				<label class="fieldset">
					<div class="label">Введите возраст</div>
					<input name="age" type="number" id="age" class="input" />
				</label>

				<label class="fieldset">
					<div class="label">Введите пароль</div>
					<input name="password" type="password" id="password" class="input" />
				</label>

          <label class="fieldset">
            <div class="label">Введите тему и заголовок вашего блога</div>
            <textarea name="content" id="content" class="textarea"></textarea>
          </label>
				<button class="button button-lg">Войти</button>
			</form>
		</div>
	</main>
	
	<?php 
	include(ROOT . "templates/footer.tpl");
	?>
