
				<article class="post">
					<div class="post__date">
						<?php echo date('d.m.Y', strtotime($post['created_at'])) ?>
						<div class="post-view">
							<?php 
									echo	viewers_count();
								?>
								<svg fill="#000000" height="25px" width="25px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 57.945 57.945" xml:space="preserve">
									<g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M57.655,27.873c-7.613-7.674-17.758-11.9-28.568-11.9c-0.026,0-0.051,0.002-0.077,0.002c-0.013,0-0.025-0.002-0.037-0.002 c-0.036,0-0.071,0.005-0.106,0.005C18.14,16.035,8.08,20.251,0.52,27.873l-0.23,0.232c-0.389,0.392-0.386,1.025,0.006,1.414 c0.195,0.193,0.45,0.29,0.704,0.29c0.257,0,0.515-0.099,0.71-0.296l0.23-0.232c5.245-5.287,11.758-8.841,18.856-10.402 c-2.939,2.385-4.823,6.022-4.823,10.094c0,7.168,5.832,13,13,13s13-5.832,13-13c0-4.116-1.928-7.784-4.922-10.167 c7.226,1.522,13.858,5.107,19.184,10.476c0.389,0.393,1.023,0.395,1.414,0.006C58.041,28.898,58.044,28.265,57.655,27.873z M39.973,28.972c0,6.065-4.935,11-11,11s-11-4.935-11-11c0-6.029,4.878-10.937,10.893-10.995c0.048,0,0.096-0.003,0.144-0.003 C35.058,17.995,39.973,22.92,39.973,28.972z">
									</path> 
									<path d="M36,27.972c-0.552,0-1,0.448-1,1c0,3.309-2.691,6-6,6s-6-2.691-6-6s2.691-6,6-6c0.552,0,1-0.448,1-1s-0.448-1-1-1 c-4.411,0-8,3.589-8,8s3.589,8,8,8s8-3.589,8-8C37,28.42,36.552,27.972,36,27.972z"></path> </g> </g>
								</svg>
						</div>
					</div>
          <?php if(!empty($post['title'])): ?>
					  <h2 class="post__title"><?= $post['title'] ?></h2>
          <?php endif; ?>

				<?php if(!empty($post['cover_name'])): ?>
					<div class="post__img--wrapper">
						<picture>
							<img src="<?= HOST ?>feeds/micro-blog/data/covers/<?= $post['cover_name'] ?>" alt="" class="post__img" />
						</picture>
					</div>
					<?php endif; ?>

				<?php if(!empty($post['content'])): ?>

					<div class="post__text">
						<div class="post__views">
								<p>
									<?php 
										echo	getExcerpt($post['content'],400 ,340);
									?>
								</p>
						</div>
					</div>
					<?php endif; ?>

					<?php if(mb_strlen($post['content'], 'UTF-8') > 400): ?>
						<div class="post__readmore">
							<a href="post.php?id=<?= $post['id'] ?>" class="link">Читать далее</a>
						</div>
					<?php endif; ?>

					<?php if(is_admin()):?>
						<div class="post__buttons">
							<a href="edit-post.php?id=<?= $post['id'] ?>" class="button button--secondary">Редактировать</a>
							<a href="delete-post.php?id=<?= $post['id'] ?>" class="button button--secondary">Удалить</a>
						</div>
					<?php endif; ?>

				</article>