</div><!-- .container -->
</div><!-- .site-content -->

<footer class="site-footer">
    <div class="container">
        <div class="footer-widgets">
            <?php if (is_active_sidebar('footer-1')) : ?>
                <?php dynamic_sidebar('footer-1'); ?>
            <?php endif; ?>
        </div>

        <div class="social-links">
            <a href="https://pt-br.facebook.com/mpacampesinato/" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://www.youtube.com/channel/UCHKRzD41jXK7GnUJ2duQX_Q" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                <i class="fab fa-youtube"></i>
            </a>
            <a href="https://www.instagram.com/mpa.brasil/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://twitter.com/mpa_campesinato" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://soundcloud.com/user-724593544" target="_blank" rel="noopener noreferrer" aria-label="SoundCloud">
                <i class="fab fa-soundcloud"></i>
            </a>
            <a href="https://www.flickr.com/photos/mpabrasil/" target="_blank" rel="noopener noreferrer" aria-label="Flickr">
                <i class="fab fa-flickr"></i>
            </a>
        </div>

        <nav class="footer-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer',
                'menu_class' => 'footer-menu',
                'container' => false,
                'fallback_cb' => false,
                'depth' => 1,
            ));
            ?>
        </nav>

        <div class="site-info">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('Todos os direitos reservados.', 'mpa-theme'); ?></p>
        </div>
    </div>

    <!-- Cookie Consent -->
    <div id="cookie-consent" class="cookie-consent">
        <div class="container">
            <p><?php esc_html_e('Este site usa cookies para melhorar a sua experiência de navegação e ao continuar navegando neste site, você declara estar ciente dessas condições.', 'mpa-theme'); ?></p>
            <button id="accept-cookies" class="button">
                <?php esc_html_e('SALVAR E ACEITAR', 'mpa-theme'); ?>
            </button>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<script>
// Cookie Consent Handler
document.addEventListener('DOMContentLoaded', function() {
    const cookieConsent = document.getElementById('cookie-consent');
    const acceptButton = document.getElementById('accept-cookies');
    
    // Check if user has already accepted cookies
    if (!localStorage.getItem('cookieConsent')) {
        cookieConsent.classList.add('active');
    }
    
    acceptButton.addEventListener('click', function() {
        localStorage.setItem('cookieConsent', 'accepted');
        cookieConsent.classList.remove('active');
    });
});

// Mobile Menu Handler
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const primaryMenu = document.querySelector('.main-navigation .menu');
    
    menuToggle.addEventListener('click', function() {
        primaryMenu.classList.toggle('active');
        menuToggle.setAttribute('aria-expanded', 
            menuToggle.getAttribute('aria-expanded') === 'false' ? 'true' : 'false'
        );
    });
});
</script>

</body>
</html>
