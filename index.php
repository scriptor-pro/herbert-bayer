<?php
get_header();

// Page des articles distincte de l'accueil : son titre devient le h1.
if (is_home() && !is_front_page()) :
    ?>
  <header class="content-header">
    <h1 class="entry-title"><?php single_post_title(); ?></h1>
  </header>
    <?php
endif;
?>
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
