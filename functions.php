<?php

if (!defined('HERBERT_BAYER_VERSION')) {
    define('HERBERT_BAYER_VERSION', '0.3.3');
}

// Une seule URL pour les deux familles, sinon Bunny Fonts ignore la seconde.
define('HERBERT_BAYER_FONTS_URL', 'https://fonts.bunny.net/css?family=work-sans:400,600,700|source-serif-4:400,600&display=swap');

if (!isset($content_width)) {
    $content_width = 720;
}

function herbert_bayer_setup(): void
{
    load_theme_textdomain('herbert-bayer', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_editor_style([HERBERT_BAYER_FONTS_URL, 'style.css']);
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    register_nav_menus([
        'primary' => __('Menu principal', 'herbert-bayer'),
    ]);
}
add_action('after_setup_theme', 'herbert_bayer_setup');

function herbert_bayer_enqueue_assets(): void
{
    wp_enqueue_style('herbert-bayer-fonts', HERBERT_BAYER_FONTS_URL, [], null);

    wp_enqueue_style(
        'herbert-bayer-style',
        get_stylesheet_uri(),
        ['herbert-bayer-fonts'],
        HERBERT_BAYER_VERSION
    );
}
add_action('wp_enqueue_scripts', 'herbert_bayer_enqueue_assets');

function herbert_bayer_resource_hints(array $urls, string $relation_type): array
{
    if ('preconnect' === $relation_type) {
        $urls[] = [
            'href' => 'https://fonts.bunny.net',
            'crossorigin',
        ];
    }

    return $urls;
}
add_filter('wp_resource_hints', 'herbert_bayer_resource_hints', 10, 2);

function herbert_bayer_nav_fallback(): void
{
    echo '<ul class="menu">';
    wp_list_pages([
        'title_li' => '',
    ]);
    echo '</ul>';
}

function herbert_bayer_widgets_init(): void
{
    register_sidebar([
        'name' => __('Barre latérale', 'herbert-bayer'),
        'id' => 'sidebar-1',
        'description' => __('Widgets de la barre latérale.', 'herbert-bayer'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ]);
}
add_action('widgets_init', 'herbert_bayer_widgets_init');

// Permet au CSS de passer en une colonne quand la barre latérale est vide.
function herbert_bayer_body_classes(array $classes): array
{
    if (is_active_sidebar('sidebar-1') && !is_404()) {
        $classes[] = 'has-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'herbert_bayer_body_classes');

function herbert_bayer_posted_on(): void
{
    printf(
        '<time datetime="%1$s">%2$s</time>',
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date())
    );
}

// Signature des articles : « · par Auteur », avec lien vers la page de l'auteur.
// Le point médian est décoratif : masqué aux lecteurs d'écran.
function herbert_bayer_posted_by(): void
{
    if (get_post_type() !== 'post') {
        return;
    }

    printf(
        '<span class="byline"><span aria-hidden="true"> · </span>%1$s <a href="%2$s" rel="author">%3$s</a></span>',
        esc_html__('par', 'herbert-bayer'),
        esc_url(get_author_posts_url((int) get_the_author_meta('ID'))),
        esc_html(get_the_author())
    );
}

/**
 * Titre de remplacement pour les articles sans titre : « Billet du 11 septembre 2009 ».
 * Sert de titre principal (h1) et de lien dans les listes. Seulement sur le site
 * public : ni dans l'administration, ni dans l'API REST, ni dans les flux.
 * Le titre enregistré dans la base n'est pas modifié.
 * On teste le titre enregistré (et non $title) : pour les liens précédent/suivant,
 * WordPress remplace déjà un titre vide par « Article précédent » avant ce filtre.
 */
function herbert_bayer_untitled_post_title(string $title, $post_id = 0): string
{
    if (
        !$post_id
        || trim((string) get_post_field('post_title', $post_id)) !== ''
        || is_admin()
        || is_feed()
        || wp_is_serving_rest_request()
        || get_post_type($post_id) !== 'post'
    ) {
        return $title;
    }

    return sprintf(
        /* translators: %s: date de publication de l'article. */
        __('Billet du %s', 'herbert-bayer'),
        get_the_date('', $post_id)
    );
}
add_filter('the_title', 'herbert_bayer_untitled_post_title', 10, 2);

function herbert_bayer_entry_footer(): void
{
    $categories = get_the_category_list(', ');
    $tags = get_the_tag_list('', ', ');

    if (!$categories && !$tags) {
        return;
    }

    echo '<footer class="entry-footer">';
    if ($categories) {
        printf(
            '<p class="cat-links"><span class="entry-footer-label">%1$s</span> %2$s</p>',
            esc_html__('Catégories :', 'herbert-bayer'),
            $categories // Déjà échappé par WordPress.
        );
    }
    if ($tags) {
        printf(
            '<p class="tags-links"><span class="entry-footer-label">%1$s</span> %2$s</p>',
            esc_html__('Étiquettes :', 'herbert-bayer'),
            $tags // Déjà échappé par WordPress.
        );
    }
    echo '</footer>';
}

function herbert_bayer_post_navigation(): void
{
    the_post_navigation([
        'prev_text' => '<span class="nav-subtitle">' . esc_html__('Article précédent', 'herbert-bayer') . '</span> <span class="nav-title">%title</span>',
        'next_text' => '<span class="nav-subtitle">' . esc_html__('Article suivant', 'herbert-bayer') . '</span> <span class="nav-title">%title</span>',
        'aria_label' => __('Articles voisins', 'herbert-bayer'),
        'screen_reader_text' => __('Navigation entre les articles', 'herbert-bayer'),
    ]);
}
