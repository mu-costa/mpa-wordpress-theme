<?php get_header(); ?>

<main id="primary" class="site-main error-404">
    <div class="container">
        <section class="error-content">
            <header class="page-header">
                <h1 class="page-title">
                    <?php esc_html_e('404', 'mpa-theme'); ?>
                </h1>
                <div class="error-description">
                    <h2><?php esc_html_e('Página não encontrada', 'mpa-theme'); ?></h2>
                    <p><?php esc_html_e('Desculpe, a página que você está procurando não existe ou foi movida.', 'mpa-theme'); ?></p>
                </div>
            </header>

            <div class="error-actions">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="button home-button">
                    <i class="fas fa-home"></i>
                    <?php esc_html_e('Voltar para a Página Inicial', 'mpa-theme'); ?>
                </a>
                
                <div class="search-form-container">
                    <h3><?php esc_html_e('Ou tente fazer uma busca:', 'mpa-theme'); ?></h3>
                    <?php get_search_form(); ?>
                </div>
            </div>

            <div class="suggested-content">
                <h3><?php esc_html_e('Últimas Notícias', 'mpa-theme'); ?></h3>
                <div class="news-grid">
                    <?php
                    $recent_posts = new WP_Query(array(
                        'post_type' => 'noticias',
                        'posts_per_page' => 3,
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ));

                    if ($recent_posts->have_posts()) :
                        while ($recent_posts->have_posts()) : $recent_posts->the_post();
                    ?>
                        <article class="news-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="news-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="news-content">
                                <h4 class="news-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h4>
                                <div class="news-meta">
                                    <span class="post-date">
                                        <i class="far fa-calendar-alt"></i>
                                        <?php echo get_the_date(); ?>
                                    </span>
                                </div>
                            </div>
                        </article>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </section>
    </div>
</main>

<style>
/* Additional styles specific to 404 page */
.error-404 {
    padding: 4rem 0;
    text-align: center;
    background-color: #f8f9fa;
    min-height: 60vh;
    display: flex;
    align-items: center;
}

.error-content {
    max-width: 800px;
    margin: 0 auto;
}

.page-title {
    font-size: 8rem;
    font-weight: 700;
    color: #333;
    margin: 0;
    line-height: 1;
}

.error-description {
    margin: 2rem 0;
}

.error-description h2 {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 1rem;
}

.error-description p {
    font-size: 1.2rem;
    color: #666;
}

.error-actions {
    margin: 3rem 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2rem;
}

.home-button {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 2rem;
    font-size: 1.1rem;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.home-button:hover {
    background-color: #000;
}

.search-form-container {
    width: 100%;
    max-width: 500px;
}

.search-form-container h3 {
    margin-bottom: 1rem;
    color: #333;
}

.search-form {
    display: flex;
    gap: 0.5rem;
}

.search-form input[type="search"] {
    flex: 1;
    padding: 0.8rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
}

.search-form button {
    padding: 0.8rem 1.5rem;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.search-form button:hover {
    background-color: #000;
}

.suggested-content {
    margin-top: 4rem;
}

.suggested-content h3 {
    margin-bottom: 2rem;
    color: #333;
}

.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

@media (max-width: 768px) {
    .page-title {
        font-size: 6rem;
    }

    .error-description h2 {
        font-size: 2rem;
    }

    .news-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>
