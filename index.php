<?php 
	require("config.php");
	require("db.php");
	require("functions/all.php");

	if (isset($_GET['theme'])) {
		if ($_GET['theme'] == 'light') {
			setcookie('theme', "light",time() + 60 * 60 * 24 * 30);
			header("Location: " . HOST . "feeds/micro-blog/" . basename(__FILE__));
		}

		if ($_GET['theme'] == 'dark') {
			setcookie('theme', "dark",time() + 60 * 60 * 24 * 30);
			header("Location: " . HOST . "feeds/micro-blog/" . basename(__FILE__));
		}
	}

$posts =	R::findAll('posts', ' ORDER BY id Desc ');
	include(ROOT . "templates/head.tpl");
	include(ROOT . "templates/header.tpl");

	
?>

	<main class="page-content">
		<div class="container container-narrow">
			<div class="posts-wrapper">
			<?php
					
					foreach($posts as $post){
						include(ROOT . 'templates/post-short.tpl');
					};

			?>
			</div>
		</div>
	</main>

	<?php 
		include(ROOT . "templates/footer.tpl");
	?>
