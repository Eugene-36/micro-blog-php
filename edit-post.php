<?php 
	require("config.php");


	require("db.php");
	require("functions/all.php");

if (!is_admin()){
	header('Location: ' . HOST . 'feeds/micro-blog');
	exit;
}
	if (isset($_GET['id']) && is_numeric($_GET['id'])) {
		$updatePost = R::load( 'posts', $_GET['id'] ); 
	}elseif($updatePost['id'] == 0){
		header('location:'. HOST);
		exit;
	}

	if (isset($_POST['update-post'])) {
		R::trash($updatePost);
		// header("Location: " . HOST . "feeds/micro-blog");

		exit;
	}

	if (!empty($_POST)) {
		if (empty($_POST['content']) && empty($_FILES['cover']['name'])) {
			$errors[] = "Пост обязательно должен содержать текст или обложку";
		}

		if (empty($errors)) {
		//Работа с обложкой
			$cover_name = $updatePost['cover_name'];
			if (isset($_POST['deleteCover']) && $_POST['deleteCover'] == 'on') {
				$cover_name = null;
			}
	
		if (!empty($_FILES['cover']['tmp_name'])) {

			// Проверка загруженной фотографии, на ошибки, размер, тип файла
			$checkResult = 	checkPhotoBeforeUpload();
			if (is_array($checkResult)) {
				$errors[] = $checkResult;
			}elseif($checkResult === true){
				//Откуда временное размещение
				$sours_path = $_FILES['cover']['tmp_name'];

				//Куда путь на сайте
				$extension =	pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
				if ($extension === 'jpeg') $extension = 'jpg';
				
				$file_name = uniqid() . '.' . $extension;
				$result_path = ROOT . "data/covers/" . $file_name;

				//Ресайз и сохранение обложки на сайт
				if (resizeImageByWidth($sours_path, $result_path, 600)) {
					if (is_file(ROOT . 'data/covers/' . $cover_name)) {
						unlink(ROOT . 'data/covers/' . $cover_name);
					}
					$cover_name = $file_name;
				}
			}

			}



			//Создание поста
			$updatePost->title = trim($_POST['title']);
			$updatePost->content = trim($_POST['content']);
			$updatePost->cover_name = $cover_name;
			$id = R::store($updatePost);
		};


	};

	include(ROOT . "templates/head.tpl");
	include(ROOT . "templates/header.tpl");
?>

	<main class="page-content">
			<div class="container container-narrow">
				<form class="form" enctype="multipart/form-data" method="POST">
					<h2 class="form__title">Редактировать</h2>

					<?php 
						if(isset($errors) && !empty($errors)){
							foreach($errors as $error){
								echo "<p class='error'>$error</p>";
							};
						};
					?>
					<label class="fieldset">
						<div class="label">Название</div>
						<input name="title" type="text" id="text" class="input" value="<?= $updatePost['title'] ?>" />
					</label>

					<label class="fieldset">
						<div class="label">Содержание</div>
						<textarea name="content" id="content" class="textarea">
							<?= $updatePost['content'] ?>
            </textarea
						>
					</label>

					<fieldset>
						<div class="label">Обложка</div>
						<?php if(!empty($updatePost['cover_name'])): ?>
							<div class="fieldset__cover--wrapper">
								<picture>
									<!-- <source srcset="./img/post/cover-edit.webp 1x, ./img/post/cover-edit@2x.webp 2x" type="image/webp" /> -->
									<!-- <source srcset="./img/post/cover-edit.jpg 1x, ./img/post/cover-edit@2x.jpg 2x" type="image/jpeg" /> -->
									<img src="<?= HOST ?>feeds/micro-blog/data/covers/<?= $updatePost['cover_name'] ?>" class="fieldset__cover" alt="" />
								</picture>
							</div>
							<label class="fieldset fieldset--checkbox">
								<input name="deleteCover" type="checkbox" />
								Удалить обложку
							</label>
						<?php endif; ?>

						<input name="cover" type="file" class="file" />
					</fieldset>

					<div class="form__btns--wrapper">
						<button class="button button-lg">Обновить</button>
						<a href="<?= HOST ?>feeds/micro-blog/index.php" class="button button--secondary button-lg">Отмена</a>
					</div>
				</form>
			</div>
		</main>
	<?php 
	include(ROOT . "templates/footer.tpl");
	?>
