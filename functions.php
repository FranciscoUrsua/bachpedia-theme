<?php
/**
 * Bachpedia Theme Functions
 *
 * @package Bachpedia
 * @author Tu Nombre
 * @license GPL-3.0
 * @link https://www.gnu.org/licenses/gpl-3.0.html
 */

function bachpedia_enqueue_assets() {
    // Encolar CSS de Bootstrap
    wp_enqueue_style(
        'bachpedia-bootstrap',
        get_template_directory_uri() . '/assets/css/bootstrap-bachpedia.min.css',
        [],
        '5.3.3'
    );

    // Encolar CSS personalizado del tema
    wp_enqueue_style(
        'bachpedia-style',
        get_stylesheet_uri(),
        ['bachpedia-bootstrap'],
        '1.0.0'
    );

    // Encolar JS de Bootstrap (incluye Popper.js)
    wp_enqueue_script(
        'bachpedia-bootstrap-js',
        get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js',
        [],
        '5.3.3',
        true
    );

    // Encolar JS personalizado
    wp_enqueue_script(
        'bachpedia-custom-js',
        get_template_directory_uri(),
        ['bachpedia-bootstrap-js'],
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'bachpedia_enqueue_assets');

// Añade favicon en head
function bachpedia_add_favicon() {
    echo '<link rel="icon" type="image/png" sizes="32x32" href="' . esc_url(get_template_directory_uri() . '/assets/img/bachpedia-icon.png') . '">';
    echo '<link rel="icon" type="image/png" sizes="16x16" href="' . esc_url(get_template_directory_uri() . '/assets/img/bachpedia-icon.png') . '">';
    // Opcional: Apple touch icon para iOS
    echo '<link rel="apple-touch-icon" sizes="180x180" href="' . esc_url(get_template_directory_uri() . '/assets/img/bachpedia-icon.png') . '">';
}
add_action('wp_head', 'bachpedia_add_favicon');


// Soporte para características del tema
function bachpedia_theme_setup() {
    load_theme_textdomain('bachpedia', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    add_theme_support('automatic-feed-links');


    register_nav_menus([
        'primary' => __('Primary Menu', 'bachpedia'),
        'footer' => __('Footer Menu', 'bachpedia'),
    ]);

}
add_action('after_setup_theme', 'bachpedia_theme_setup');

// Walker para menús Bootstrap 5
class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {
    /**
     * Inicia el elemento li.
     */
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // Añade clases Bootstrap: dropdown para parents
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'dropdown';
            $args->link_before = '<span class="nav-link dropdown-toggle" href="' . esc_url($item->url) . '" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . $args->link_before;
            $args->link_after = '</span>' . $args->link_after;
        } else {
            $classes[] = 'nav-item';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_url($item->url) . '"' : '';

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * Inicia el submenú ul.
     */
    public function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    /**
     * Termina el submenú ul.
     */
    public function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
}
