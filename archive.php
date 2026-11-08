<?php
// Couvre aussi les catégories, étiquettes, auteurs et dates.
get_header();
?>
<header class="content-header">
  <h1 class="entry-title"><?php the_archive_title(); ?></h1>
  <?php the_archive_description('<div class="entry-meta">', '</div>'); ?>
</header>
<div class="content-grid">
  <div class="content-area">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content');
        endwhile;
        the_posts_navigation();
    else :
        get_template_part('template-parts/content', 'none');
    endif;
    ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php
get_footer();
