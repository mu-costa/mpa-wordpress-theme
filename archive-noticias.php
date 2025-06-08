<?php get_header(); ?>

<main id="primary" class="site-main archive-noticias">
    <div class="archive-header">
        <h1 class="archive-title">
            <?php
            if (is_tax('categoria-noticia')) {
                single_term_title('Categoria: ');
            } else {
                esc_html_e('Notícias', 'mpa-theme');
            }
            ?>
        </h1>

        <?php if (is_tax('categoria-noticia') && term_description()) : ?>
            <div class="archive-description">
                <?php echo term_description(); ?>
            </div>
        <?php endif; ?>

        <!-- Categories Filter -->
        <div class="categories-filter">
            <?php
            $categories = get_terms(array(
                'taxonomy' => 'categoria-noticia',
                'hide_empty' => true,
            ));

            if (!empty($categories) && !is_wp_error($categories)) :
            ?>
                <ul class="category-list">
                    <li>
                        <a href="<?php echo get_post_type_archive_link('noticias'); ?>" 
                           class="<?php echo !is_tax('categoria-noticia') ? 'active' : ''; ?>">
                            <?php esc_html_e('Todas', 'mpa-theme'); ?>
                        </a>
                    </li>
                    <?php foreach ($categories as $category) : ?>
                        <li>
                            <a href="<?php echo get_term_link($category); ?>" 
                               class="<?php echo is_tax('categoria-noticia', $category->term_id) ? 'active' : ''; ?>">
                                <?php echo esc_html($category->name); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <?php if (have_posts()) : ?>
        <div class="news-grid">
            <?php while (have_posts()) : the_post(); ?>
                <article class="news-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="news-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium_large'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="news-content">
                        <?php
                        $categories = get_the_terms(get_the_ID(), 'categoria-noticia');
                        if ($categories && !is_wp_error($categories)) :
                        ?>
                            <div class="news-category">
                                <?php echo esc_html($categories[0]->name); ?>
                            </div>
                        <?php endif; ?>

                        <h2 class="news-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>

                        <div class="news-meta">
                            <span class="post-date">
                                <i class="far fa-calendar-alt"></i>
                                <?php echo get_the_date(); ?>
                            </span>
                        </div>

                        <div class="news-excerpt">
                            <?php the_excerpt(); ?>
                        </div>

                        <div class="news-footer">
                            <a href="<?php the_permalink(); ?>" class="read-more">
                                <?php esc_html_e('Leia mais', 'mpa-theme'); ?>
                                <i class="fas fa-arrow-right"></i>
                            </a>

                            <div class="social-share">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" 
                                   target="_blank" rel="noopener noreferrer" 
                                   aria-label="<?php esc_attr_e('Compartilhar no Facebook', 'mpa-theme'); ?>">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                                   target="_blank" rel="noopener noreferrer"
                                   aria-label="<?php esc_attr_e('Compartilhar no Twitter', 'mpa-theme'); ?>">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_the_title() . ' ' . get_the_permalink()); ?>" 
                                   target="_blank" rel="noopener noreferrer"
                                   aria-label="<?php esc_attr_e('Compartilhar no WhatsApp', 'mpa-theme'); ?>">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
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
            <h2><?php esc_html_e('Nenhuma notícia encontrada', 'mpa-theme'); ?></h2>
            <p><?php esc_html_e('Desculpe, não encontramos nenhuma notícia nesta categoria.', 'mpa-theme'); ?></p>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
