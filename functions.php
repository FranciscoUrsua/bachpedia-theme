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
        get_template_directory_uri() . '/assets/css/bootstrap.min.css',
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
        get_template_directory_uri() . '/assets/js/custom.js',
        ['bachpedia-bootstrap-js'],
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'bachpedia_enqueue_assets');

// Soporte para características del tema
function bachpedia_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'bachpedia_theme_setup');
