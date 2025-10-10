    </main>

    <!-- Footer Bootstrap 5 con colores personalizados -->
    <footer class="bg-secondary text-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('Todos los derechos reservados.', 'bachpedia'); ?></p>
                    <p class="mb-0 small"><?php printf(__('Tema basado en Bootstrap 5. Licencia: %s', 'bachpedia'), '<a href="https://www.gnu.org/licenses/gpl-3.0.html" target="_blank" rel="noopener">GPLv3</a>'); ?></p>
                </div>
                <div class="col-md-6 text-md-end">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer',
                        'container' => false,
                        'menu_class' => 'list-inline mb-0',
                        'fallback_cb' => false,
                        'depth' => 1,
                    ]);
                    ?>
                    <p class="mb-0 small mt-2"><?php bloginfo('description'); ?></p>
                </div>
            </div>
        </div>
    </footer>

<?php wp_footer(); ?>
</body>
</html>
