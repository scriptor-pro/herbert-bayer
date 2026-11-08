<?php
get_header();
?>
<section class="notice">
  <h1 class="entry-title"><?php esc_html_e('Page introuvable', 'herbert-bayer'); ?></h1>
  <p><?php esc_html_e('Essayez une recherche ou revenez à l’accueil.', 'herbert-bayer'); ?></p>
  <?php get_search_form(); ?>
</section>
<?php
get_footer();
