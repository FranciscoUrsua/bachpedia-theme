<?php get_header(); ?>

<div class="container">
    <header class="page-header mb-5">
        <h1 class="page-title fs-1 fw-bold text-primary text-center"><?php
            if (is_home() && !is_front_page()) {
                single_post_title();
            } elseif (is_search()) {
                printf(esc_html__('Resultados de búsqueda para: %s', 'bachpedia'), '<span>' . get_search_query() . '</span>');
            } elseif (is_category() || is_tag()) {
                single_term_title();
            } elseif (is_archive()) {
                post_type_archive_title();
            } else {
                bloginfo('name');
            }
        ?></h1>
        <?php if (is_search()) : ?>
            <p class="text-muted text-center"><?php printf(esc_html__('%d resultados', 'bachpedia'), get_search_query()); ?></p>
        <?php endif; ?>
    </header>

    <div class="row g-4">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="col-md-6 col-lg-4">
                    <article id="post-<?php the_ID(); ?>" <?php post_class('h-100'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                <?php the_post_thumbnail('medium', ['class' => 'card-img-top rounded', 'alt' => get_the_title()]); ?>
                            </a>
                        <?php endif; ?>
                        <div class="card h-100 bg-light">
                            <div class="card-body d-flex flex-column">
                                <?php
                                // Fix: Check para BWV (evita WP_Error si taxonomía no existe)
                                $bwv_terms = get_the_terms(get_the_ID(), 'bwv');
                                if ($bwv_terms && !is_wp_error($bwv_terms)) : ?>
                                    <div class="badge bg-copper mb-2">BWV: <?php echo get_the_term_list(get_the_ID(), 'bwv', '', ', ', ''); ?></div>
                                <?php endif; ?>
                                <h2 class="card-title fs-5 fw-bold mt-auto">
                                    <a href="<?php the_permalink(); ?>" class="text-primary text-decoration-none"><?php the_title(); ?></a>
                                </h2>
                                <p class="card-text flex-grow-1"><?php the_excerpt(); ?></p>
                                <div class="entry-meta small text-muted mt-auto">
                                    <?php
                                    // Fix: Meta fecha (get_post_meta ya es segura, pero check vacío)
                                    $fecha = get_post_meta(get_the_ID(), '_bach_fecha', true);
                                    if (!empty($fecha)) {
                                        echo '<span class="me-2">' . esc_html($fecha) . '</span>';
                                    }
                                    // Fix: Check para tipo-obra (evita WP_Error si taxonomía no existe)
                                    $tipo_terms = get_the_terms(get_the_ID(), 'tipo-obra');
                                    if ($tipo_terms && !is_wp_error($tipo_terms)) {
                                        echo 'Tipo: ' . get_the_term_list(get_the_ID(), 'tipo-obra', '', ', ', '');
                                    }
                                    ?>
                                    <span class="dot-divider">•</span>
                                    <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary mt-2"><?php _e('Leer más', 'bachpedia'); ?></a>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <?php if (is_search()) : ?>
                        <?php _e('No se encontraron resultados. Intenta con otra búsqueda.', 'bachpedia'); ?>
                        <?php get_search_form(); ?>
                    <?php else : ?>
                        <?php _e('No hay entradas disponibles.', 'bachpedia'); ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Paginación con Bootstrap 5 -->
    <?php if (have_posts()) : ?>
        <nav class="pagination-nav mt-5" aria-label="<?php esc_attr_e('Navegación de páginas', 'bachpedia'); ?>">
            <?php
            the_posts_pagination([
                'mid_size' => 2,
                'prev_text' => '<i class="bi bi-chevron-left"></i> ' . esc_html__('Anterior', 'bachpedia'),
                'next_text' => esc_html__('Siguiente', 'bachpedia') . ' <i class="bi bi-chevron-right"></i>',
                'type' => 'list',  // Para ul/li
            ]);
            ?>
        </nav>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
