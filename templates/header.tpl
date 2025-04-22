		<header class="header">
			<div class="header__row">
				<div class="header__logo">
					<div class="logo">
						<a href="index.php" class="logo__link">MY&#160;BLOG</a>
					</div>
				</div>

				<div class="header__btns">
				<?php if(is_admin()):?>
					<a href="<?=HOST?>feeds/micro-blog/create-post.php" class="button">Добавить пост</a>
					<a href="<?=HOST?>feeds/micro-blog/logout.php" class="button">Выход</a>
					<span><?php echo $_SESSION['username']; ?></span>
				<?php else: ?>
					<a href="<?=HOST?>feeds/micro-blog/login.php" class="button">Вход</a>
					<a href="<?=HOST?>feeds/micro-blog/registration.php" class="button">Регистрация</a>
				<?php endif; ?>

					<?php if(isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark'): ?>
						<a href="<?=HOST?>feeds/micro-blog/index.php?theme=light" class="button toggleDarkMode">☀️</a>

					<?php else: ?>
						<a href="<?=HOST?>feeds/micro-blog/index.php?theme=dark" class="button toggleDarkMode">🌘</a>

					<?php endif; ?>
				</div>

				<div class="header__mobile-nav-btn">
					<button class="mobile-nav-btn">
						<div class="nav-icon"></div>
					</button>
				</div>
			</div>
		</header>

		<div class="mobile-nav">

				<?php if(is_admin()):?>
					<a href="<?=HOST?>feeds/micro-blog/create-post.php" class="button">Добавить пост</a>
					<a href="<?=HOST?>feeds/micro-blog/logout.php" class="button">Выход</a>
				<?php else: ?>
					<a href="<?=HOST?>feeds/micro-blog/login.php" class="button">Вход</a>
				<?php endif; ?>

					<?php if(isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark'): ?>
						<a href="<?=HOST?>feeds/micro-blog/index.php?theme=light" class="button toggleDarkMode">☀️</a>

					<?php else: ?>
						<a href="<?=HOST?>feeds/micro-blog/index.php?theme=dark" class="button toggleDarkMode">🌘</a>

					<?php endif; ?>
		</div>