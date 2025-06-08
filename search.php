<?php get_header(); ?>

<main id="primary" class="site-main search-results">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">
                <?php
                printf(
                    esc_html__('Resultados da busca por: %s', 'mpa-theme'),
                    '<span class="search-query">' . get_search_query() . '</span>'
                );
                ?>
            </h1>
            
            <div class="search-meta">
                <?php
                global $wp_query;
                printf(
                    esc_html(_n(
                        'Encontrado %s resultado',
                        'Encontrados %s resultados',
                        $wp_query->found_posts,
                        'mpa-theme'
                    )),
                    number_format_i18n($wp_query->found_posts)
                );
                ?>
            </div>

            <!-- Search form at the top of results -->
            <div class="search-form-container">
                <?php get_search_form(); ?>
            </div>
        </header>

        <?php if (have_posts()) : ?>
            <div class="search-filters">
                <div class="filter-options">
                    <span class="filter-label"><?php esc_html_e('Filtrar por:', 'mpa-theme'); ?></span>
                    <div class="post-type-filter">
                        <a href="<?php echo add_query_arg('post_type', 'noticias', get_search_link(get_search_query())); ?>" 
                           class="<?php echo isset($_GET['post_type']) && $_GET['post_type'] === 'noticias' ? 'active' : ''; ?>">
                            <?php esc_html_e('Notícias', 'mpa-theme'); ?>
                        </a>
                        <a href="<?php echo add_query_arg('post_type', 'tv-camponesa', get_search_link(get_search_query())); ?>" 
                           class="<?php echo isset($_GET['post_type']) && $_GET['post_type'] === 'tv-camponesa' ? 'active' : ''; ?>">
                            <?php esc_html_e('TV Camponesa', 'mpa-theme'); ?>
                        </a>
                        <a href="<?php echo add_query_arg('post_type', 'radio-camponesa', get_search_link(get_search_query())); ?>" 
                           class="<?php echo isset($_GET['post_type']) && $_GET['post_type'] === 'radio-camponesa' ? 'active' : ''; ?>">
                            <?php esc_html_e('Rádio Camponesa', 'mpa-theme'); ?>
                        </a>
                    </div>
                </div>
            </div>

            <div class="search-results-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="result-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="result-content">
                            <header class="result-header">
                                <div class="result-meta">
                                    <span class="result-type">
                                        <?php
                                        $post_type = get_post_type();
                                        $post_type_obj = get_post_type_object($post_type);
                                        echo esc_html($post_type_obj->labels->singular_name);
                                        ?>
                                    </span>
                                    <span class="result-date">
                                        <i class="far fa-calendar-alt"></i>
                                        <?php echo get_the_date(); ?>
                                    </span>
                                </div>

                                <h2 class="result-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                            </header>

                            <div class="result-excerpt">
                                <?php
                                // Custom excerpt with highlighted search terms
                                $excerpt = get_the_excerpt();
                                $keys = explode(' ', get_search_query());
                                $excerpt = preg_replace('/(' . implode('|', $keys) . ')/iu', '<mark>$1</mark>', $excerpt);
                                echo wp_kses_post($excerpt);
                                ?>
                            </div>

                            <footer class="result-footer">
                                <a href="<?php the_permalink(); ?>" class="read-more">
                                    <?php esc_html_e('Leia mais', 'mpa-theme'); ?>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </footer>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => '<i class="fas fa-chevron-left"></i> ' . __('Anterior', 'mpa-theme'),
                'next_text' => __('Próximo', 'mpa-theme') . ' <i class="fas fa-chevron-right"></i>',
            ));
            ?>

        <?php else : ?>
            <div class="no-results">
                <h2><?php esc_html_e('Nenhum resultado encontrado', 'mpa-theme'); ?></h2>
                <p><?php esc_html_e('Desculpe, não encontramos nenhum resultado para sua busca. Tente novamente com termos diferentes.', 'mpa-theme'); ?></p>
                
                <div class="suggested-searches">
                    <h3><?php esc_html_e('Sugestões:', 'mpa-theme'); ?></h3>
                    <ul>
                        <li><?php esc_html_e('Verifique se não há erros de digitação', 'mpa-theme'); ?></li>
                        <li><?php esc_html_e('Tente palavras menos específicas', 'mpa-theme'); ?></li>
                        <li><?php esc_html_e('Use termos diferentes com significados similares', 'mpa-theme'); ?></li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<style>
/* Search Results Styles */
.search-results {
    padding: 3rem 0;
}

.page-header {
    text-align: center;
    margin-bottom: 3rem;
}

.page-title {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 1rem;
}

.search-query {
    color: #000;
    font-weight: 700;
}

.search-meta {
    color: #666;
    margin-bottom: 2rem;
}

.search-form-container {
    max-width: 600px;
    margin: 0 auto;
}

.search-filters {
    margin-bottom: 2rem;
    padding: 1rem;
    background-color: #f8f9fa;
    border-radius: 4px;
}

.filter-options {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.filter-label {
    font-weight: 600;
    color: #333;
}

.post-type-filter {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.post-type-filter a {
    padding: 0.5rem 1rem;
    border-radius: 4px;
    text-decoration: none;
    color: #666;
    background-color: #fff;
    border: 1px solid #ddd;
    transition: all 0.3s ease;
}

.post-type-filter a:hover,
.post-type-filter a.active {
    background-color: #333;
    color: #fff;
    border-color: #333;
}

.search-results-grid {
    display: grid;
    gap: 2rem;
}

.search-result-item {
    display: grid;
    grid-template-columns: 200px 1fr;
    gap: 1.5rem;
    padding: 1.5rem;
    background-color: #fff;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.result-thumbnail img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 4px;
}

.result-meta {
    display: flex;
    gap: 1rem;
    margin-bottom: 0.5rem;
}

.result-type {
    background-color: #333;
    color: #fff;
    padding: 0.2rem 0.5rem;
    border-radius: 3px;
    font-size: 0.875rem;
}

.result-date {
    color: #666;
    font-size: 0.875rem;
}

.result-title {
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.result-title a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.result-title a:hover {
    color: #000;
}

.result-excerpt {
    color: #666;
    margin-bottom: 1rem;
}

.result-excerpt mark {
    background-color: #fff3cd;
    padding: 0.1em 0.2em;
}

.read-more {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #333;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.read-more:hover {
    color: #000;
}

.no-results {
    text-align: center;
    padding: 3rem 0;
}

.no-results h2 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 1rem;
}

.suggested-searches {
    margin-top: 2rem;
    text-align: left;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.suggested-searches h3 {
    margin-bottom: 1rem;
    color: #333;
}

.suggested-searches ul {
    list-style: disc;
    padding-left: 1.5rem;
    color: #666;
}

.suggested-searches li {
    margin-bottom: 0.5rem;
}

@media (max-width: 768px) {
    .search-result-item {
        grid-template-columns: 1fr;
    }

    .result-thumbnail img {
        height: 200px;
    }

    .page-title {
        font-size: 2rem;
    }
}
</style>

<?php get_footer(); ?>
