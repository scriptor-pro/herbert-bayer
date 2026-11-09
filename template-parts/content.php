<?php
?>
<article <?php post_class(); ?>>
  <header class="content-header">
    <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>'); ?>
    <div class="entry-meta"><?php herbert_bayer_posted_on(); herbert_bayer_posted_by(); ?></div>
  </header>
  <?php if (has_post_thumbnail()) : ?>
    <figure class="post-thumbnail">
      <?php the_post_thumbnail('medium_large'); ?>
    </figure>
  <?php endif; ?>
  <div class="entry-content">
    <?php the_excerpt(); ?>
  </div>
</article>
