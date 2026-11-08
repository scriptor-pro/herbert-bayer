<?php
get_header();
?>
<header class="content-header">
  <h1 class="entry-title">
    <?php
    printf(
        /* translators: %s: termes recherchés. */
        esc_html__('Résultats de recherche pour : %s', 'herbert-bayer'),
        '<span>' . esc_html(get_search_query()) . '</span>'
    );
    ?>
  </h1>
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
