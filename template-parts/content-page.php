<?php
?>
<article <?php post_class(); ?>>
  <header class="content-header">
    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
  </header>
  <?php if (has_post_thumbnail()) : ?>
    <figure class="post-thumbnail">
      <?php the_post_thumbnail('large'); ?>
    </figure>
  <?php endif; ?>
  <div class="entry-content">
    <?php
    the_content();
    wp_link_pages();
    ?>
  </div>
</article>
