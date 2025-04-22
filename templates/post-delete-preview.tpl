    <article class="post post--preview">
      <div class="post__date"><?php echo date('d.m.Y', strtotime($deletePost['created_at'])) ?></div>
      <?php if(!empty($deletePost['title'])): ?>
        <h2 class="post__title"><?= $deletePost['title'] ?></h2>
      <?php endif; ?>
      <?php if(!empty($deletePost['cover_name'])): ?>
        <div class="post__img--wrapper">
          <picture>
            <img src="<?= HOST ?>feeds/micro-blog/data/covers/<?= $deletePost['cover_name'] ?>" alt="" class="post__img" />
          </picture>
        </div>
      <?php endif; ?>

    <?php if(!empty($deletePost['content'])): ?>
        <div class="post__text">
          <p>
              <?= $deletePost['content'] ?>
          </p>
        </div>
      <?php endif; ?>

        <?php if(mb_strlen($post['content'], 'UTF-8') > 400): ?>
              <div class="post__readmore">
                <a href="post.php?id=<?= $post['id'] ?>" class="link">Читать далее</a>
              </div>
        <?php endif; ?>
    </article>