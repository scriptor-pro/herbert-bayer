<?php
get_header();
?>
<div class="content-grid">
  <div class="content-area">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', 'page');
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
        endwhile;
    endif;
    ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php
get_footer();
