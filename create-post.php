<?php 

	require("config.php");
	require("db.php");
	require("functions/all.php");

	if (!is_admin()) {
		header('Location ' . HOST . 'feeds/micro-blog/index.php');
	};
	

	include(ROOT . "templates/head.tpl");
	include(ROOT . "templates/header.tpl");

	if (!empty($_POST)) {
		if (empty($_POST['content']) && empty($_FILES['cover']['name'])) {
			$errors[] = "Пост обязательно должен содержать текст или обложку";
		}

		if (empty($errors)) {

			//Работа с обложкой
			$cover_name = null;
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
					$cover_name = $file_name;
				}
			}

			}



			//Создание поста
			$post =	R::dispense('posts');
			$post->title = trim($_POST['title']);
			$post->content = trim($_POST['content']);
			$post->created_at = date('Y-m-d H:i:s');
			$post->cover_name = $cover_name;
			$id = R::store($post);
		};
	}
?>

		<main class="page-content">
			<div class="container container-narrow">
				<form class="form" method="POST" enctype="multipart/form-data">
					<h2 class="form__title">Добавить запись</h2>
					
					<?php 
						if(isset($errors) && !empty($errors)){
							foreach($errors as $error){
								echo "<p class='error'>$error</p>";
							};
						};
						if (isset($id)) {
							echo "<div class='success'>Пост с $id создан. </div>";
						}
					?>
					
					<label class="fieldset">
						<div class="label">Название</div>
						<input type="text" id="text" class="input" name="title"/>
					</label>

					<label class="fieldset">
						<div class="label">Содержание</div>
						<textarea name="content" id="content" class="textarea"></textarea>
					</label>

					<fieldset>
						<div class="label">Обложка</div>
						<div class="fieldset__cover--wrapper">
							<picture>
								<source srcset="./img/post/cover-edit.webp 1x, ./img/post/cover-edit@2x.webp 2x" type="image/webp" />
								<source srcset="./img/post/cover-edit.jpg 1x, ./img/post/cover-edit@2x.jpg 2x" type="image/jpeg" />
								<img src="./img/post/cover-edit.jpg" class="fieldset__cover" alt="" />
							</picture>
						</div>
						<input type="file" class="file" name="cover" id="coverInput" />
						<div class="cover-preview-wrapper">
							<img src="" alt="" id="coverPreview">
						</div>
					</fieldset>
					<button class="button button-lg">Опубликовать</button>
				</form>
			</div>
		</main>
		
		<script>
		const previewUploadPostCover = () => {
		document.querySelector('#coverInput').addEventListener('change', function() {
			const file = this.files[0];
      
			if (file && file.type.startsWith('image/')) {
				const reader = new FileReader();

				reader.onload = ({
					target
				}) => {
					document.querySelector('#coverPreview').src = target.result;
					document.querySelector('.cover-preview-wrapper').style.display = 'block';
				};

				reader.readAsDataURL(file);
			}
			});
		}
		previewUploadPostCover();
		</script>
	<?php 
	include(ROOT . "templates/footer.tpl");
	?>
