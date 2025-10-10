<?php get_header(); ?>

<!-- Hero section para la obra (usa thumbnail si disponible) -->
<?php if (has_post_thumbnail()) : ?>
<div class="hero-image mb-4">
    <?php the_post_thumbnail('full', ['class' => 'img-fluid rounded', 'alt' => get_the_title()]); ?>
</div>
<?php endif; ?>

<div class="container">
    <article id="post-<?php the_ID(); ?>" <?php post_class('mb-5'); ?>>
        <header class="entry-header mb-4">
            <h1 class="entry-title fs-2 fw-bold text-primary"><?php the_title(); ?></h1>
            <?php if (get_the_terms(get_the_ID(), 'bwv')) : ?>
                <div class="entry-bwv badge bg-copper mb-2">BWV: <?php echo get_the_term_list(get_the_ID(), 'bwv', '', ', ', ''); ?></div>
            <?php endif; ?>
            <div class="entry-meta small text-muted">
                <?php
                if (get_post_meta(get_the_ID(), '_bach_fecha', true)) {
                    echo '<span class="me-2">Fecha: ' . esc_html(get_post_meta(get_the_ID(), '_bach_fecha', true)) . '</span>';
                }
                if (get_the_terms(get_the_ID(), 'tipo-obra')) {
                    echo 'Tipo: ' . get_the_term_list(get_the_ID(), 'tipo-obra', '', ', ', '');
                }
                ?>
                <span class="dot-divider">•</span>
                <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
            </div>
        </header>

        <div class="entry-content">
            <?php the_content(); ?>
            <?php
            wp_link_pages([
                'before' => '<div class="page-links">' . esc_html__('Páginas:', 'bachpedia'),
                'after'  => '</div>',
            ]);
            ?>
        </div>

        <footer class="entry-footer mt-4">
            <?php if (get_post_meta(get_the_ID(), '_bach_manuscritos', true)) : ?>
                <div class="manuscritos card bg-light">
                    <div class="card-body">
                        <h5 class="card-title"><?php _e('Manuscritos y Fuentes', 'bachpedia'); ?></h5>
                        <p class="card-text"><?php echo esc_html(get_post_meta(get_the_ID(), '_bach_manuscritos', true)); ?></p>
                    </div>
                </div>
            <?php endif; ?>
            <?php
            the_tags('<div class="tags mt-3"><span>' . esc_html__('Etiquetas:', 'bachpedia') . '</span> ', ' ', '</div>');
            ?>
        </footer>
    </article>

    <!-- Navegación post-prev/next con Bootstrap -->
    <nav class="post-navigation mt-5" aria-label="<?php esc_attr_e('Navegación de entradas', 'bachpedia'); ?>">
        <div class="row">
            <div class="col-md-6"><?php previous_post_link('%link', '<i class="bi bi-arrow-left"></i> %title', true); ?></div>
            <div class="col-md-6 text-md-end"><?php next_post_link('%link', '%title <i class="bi bi-arrow-right"></i>', true); ?></div>
        </div>
    </nav>

    <!-- Sección de Obras Relacionadas (movida al pie, opcional) -->
    <section class="related-works mt-5">
        <h2 class="fw-bold mb-3"><?php _e('Obras Relacionadas', 'bachpedia'); ?></h2>
        <div class="row">
            <?php
            // Query simple para obras relacionadas por tipo (ajusta si usas plugin)
            $related = new WP_Query([
                'post_type' => 'bach_obra',
                'posts_per_page' => 5,
                'post__not_in' => [get_the_ID()],
                'tax_query' => [
                    [
                        'taxonomy' => 'tipo-obra',
                        'field'    => 'term_id',
                        'terms'    => wp_get_post_terms(get_the_ID(), 'tipo-obra', ['fields' => 'ids']),
                    ],
                ],
            ]);
            if ($related->have_posts()) :
                while ($related->have_posts()) : $related->the_post();
                    ?>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card h-100">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                <p class="card-text small"><?php the_excerpt(); ?></p>
                                <span class="badge bg-secondary"><?php echo get_the_terms(get_the_ID(), 'bwv')[0]->name ?? ''; ?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </section>

    <!-- Comentarios si habilitados -->
    <?php if (comments_open() || get_comments_number()) : ?>
        <?php comments_template(); ?>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
