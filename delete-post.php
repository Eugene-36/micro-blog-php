<?php 
	require("config.php");

	require("db.php");
	require("functions/all.php");

	if (!is_admin()) {
		header('Location ' . HOST . 'feeds/micro-blog/index.php');
	};
	

	if (isset($_GET['id']) && is_numeric($_GET['id'])) {
		$deletePost = R::load( 'posts', $_GET['id'] ); 
	}elseif($deletePost['id'] == 0){
		header('location:'. HOST);
		exit;
	}

	if (isset($_POST['delete-post'])) {

		if (is_file(ROOT . 'data/covers/' . $deletePost['cover_name'])) {
			unlink(ROOT . 'data/covers/' . $deletePost['cover_name']);
		}

		R::trash($deletePost);
		header("Location: " . HOST . "feeds/micro-blog");

		exit;
	}
	include(ROOT . "templates/head.tpl");
	include(ROOT . "templates/header.tpl");
?>

		<main class="page-content">
			<div class="container container-narrow">
				<form class="form" method="POST">
					<h2 class="form__title">Удалить пост?</h2>

						<?php
						 
						 include('templates/post-delete-preview.tpl');
						 ?>

					<div class="form__btns--wrapper">
						<button name="delete-post" class="button button-lg">Удалить</button>
						<a href="<?= HOST ?>feeds/micro-blog/index.php" class="button button--secondary button-lg">Отмена</a>
					</div>
				</form>
			</div>
		</main>
		
	<?php 
	include(ROOT . "templates/footer.tpl");
	?>
