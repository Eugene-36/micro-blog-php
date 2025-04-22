<?php 
	require("config.php");
	require("db.php");
	require("functions/all.php");

	if (isset($_GET['id']) && is_numeric($_GET['id'])) {
		$fullPost = R::load( 'posts', $_GET['id'] ); 
	}else{
		header('location:'. HOST);
		exit;
	}


	include(ROOT . "templates/head.tpl");
	include(ROOT . "templates/header.tpl");
?>

		<main class="page-content">
			<div class="container container-narrow">
				<div class="posts-wrapper">
					<article class="post">
					<div class="post__date"><?php echo date('d.m.Y', strtotime($fullPost['created_at'])) ?></div>
					<?php if(!empty($fullPost['title'])): ?>
					  <h2 class="post__title"><?= $fullPost['title'] ?></h2>
          <?php endif; ?>

					<?php if(!empty($fullPost['cover_name'])): ?>
						<div class="post__img--wrapper">
							<picture>
								<img src="<?= HOST ?>feeds/micro-blog/data/covers/<?= $fullPost['cover_name'] ?>" alt="" class="post__img" />
							</picture>
						</div>
					<?php endif; ?>

					<?php if(!empty($fullPost['content'])): ?>
						<div class="post__text post__text--full">
							<p>
									<?= $fullPost['content'] ?>
							</p>
						</div>
					<?php endif; ?>

					<div class="post__readmore">
						<a href="<?=HOST?>feeds/micro-blog/index.php" class="link">На&#160;главную</a>
					</div>

					<?php if(is_admin()):?>
						<div class="post__buttons">
							<a href="edit-post.html" class="button button--secondary">Редактировать</a>
							<a href="delete-post.html" class="button button--secondary">Удалить</a>
					</div>
					<?php endif; ?>

					</article>
				</div>
			</div>
		</main>

	<?php 
		include(ROOT . "templates/footer.tpl");
	?>
