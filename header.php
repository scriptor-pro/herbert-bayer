<?php
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#content"><?php esc_html_e('Aller au contenu', 'herbert-bayer'); ?></a>
<header class="site-header">
  <?php
  // Le nom du site n'est le titre principal que sur l'accueil.
  $herbert_bayer_title_tag = (is_front_page() && is_home()) ? 'h1' : 'p';
  ?>
  <<?php echo $herbert_bayer_title_tag; ?> class="site-title">
    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
  </<?php echo $herbert_bayer_title_tag; ?>>
  <nav class="site-nav" aria-label="<?php esc_attr_e('Menu principal', 'herbert-bayer'); ?>">
    <?php
    wp_nav_menu([
        'theme_location' => 'primary',
        'container' => false,
        'fallback_cb' => 'herbert_bayer_nav_fallback',
    ]);
    ?>
  </nav>
</header>
<main id="content" class="layout">
