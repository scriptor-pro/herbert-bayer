<?php
?>
<article <?php post_class(); ?>>
  <header class="content-header">
    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    <div class="entry-meta"><?php herbert_bayer_posted_on(); ?></div>
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
  <?php herbert_bayer_entry_footer(); ?>
</article>
