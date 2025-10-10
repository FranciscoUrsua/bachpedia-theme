<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- Navbar Bootstrap 5 con personalizaciones -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <?php
        if (has_custom_logo()) {
            the_custom_logo();
        } else { ?>
            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                <?php bloginfo('name'); ?>
            </a>
        <?php } ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'navbar-nav ms-auto',
                'fallback_cb' => false,
                'depth' => 2,
                'walker' => new Bootstrap_Walker_Nav_Menu(),  // Opcional: Walker para Bootstrap (ver nota abajo)
            ]);
            ?>
        </div>
    </div>
</nav>

<!-- Contenedor principal con padding para navbar fixed -->
<main class="container-fluid mt-5 pt-4">
