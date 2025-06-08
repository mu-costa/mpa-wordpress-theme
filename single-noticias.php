<?php get_header(); ?>

<main id="primary" class="site-main single-noticia">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <div class="container">
                    <?php
                    $categories = get_the_terms(get_the_ID(), 'categoria-noticia');
                    if ($categories && !is_wp_error($categories)) :
                    ?>
                        <div class="entry-category">
                            <?php foreach ($categories as $category) : ?>
                                <a href="<?php echo get_term_link($category); ?>"><?php echo esc_html($category->name); ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <h1 class="entry-title"><?php the_title(); ?></h1>

                    <div class="entry-meta">
                        <span class="posted-on">
                            <i class="far fa-calendar-alt"></i>
                            <?php echo get_the_date(); ?>
                        </span>
                        <span class="byline">
                            <i class="far fa-user"></i>
                            <?php
                            printf(
                                esc_html__('Por %s', 'mpa-theme'),
                                '<span class="author vcard"><a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
                            );
                            ?>
                        </span>
                    </div>

                    <div class="social-share-buttons">
                        <span class="share-label"><?php esc_html_e('Compartilhe:', 'mpa-theme'); ?></span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" 
                           class="share-button facebook" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           aria-label="<?php esc_attr_e('Compartilhar no Facebook', 'mpa-theme'); ?>">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                           class="share-button twitter" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           aria-label="<?php esc_attr_e('Compartilhar no Twitter', 'mpa-theme'); ?>">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_the_title() . ' ' . get_the_permalink()); ?>" 
                           class="share-button whatsapp" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           aria-label="<?php esc_attr_e('Compartilhar no WhatsApp', 'mpa-theme'); ?>">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <div class="entry-featured-image">
                    <?php 
                    the_post_thumbnail('full', array(
                        'class' => 'featured-image',
                        'loading' => 'lazy'
                    )); 
                    ?>
                    <?php if (get_post(get_post_thumbnail_id())->post_excerpt) : ?>
                        <div class="featured-image-caption">
                            <?php echo wp_kses_post(get_post(get_post_thumbnail_id())->post_excerpt); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="entry-content">
                <div class="container">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Páginas:', 'mpa-theme'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>
            </div>

            <footer class="entry-footer">
                <div class="container">
                    <?php
                    $tags = get_the_terms(get_the_ID(), 'post_tag');
                    if ($tags && !is_wp_error($tags)) :
                    ?>
                        <div class="entry-tags">
                            <span class="tags-label"><?php esc_html_e('Tags:', 'mpa-theme'); ?></span>
                            <?php foreach ($tags as $tag) : ?>
                                <a href="<?php echo get_term_link($tag); ?>" class="tag-link">
                                    <?php echo esc_html($tag->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </footer>
        </article>

        <!-- Related Posts -->
        <?php
        $related_args = array(
            'post_type' => 'noticias',
            'posts_per_page' => 3,
            'post__not_in' => array(get_the_ID()),
            'orderby' => 'rand',
            'tax_query' => array(
                array(
                    'taxonomy' => 'categoria-noticia',
                    'field' => 'term_id',
                    'terms' => wp_list_pluck($categories, 'term_id'),
                ),
            ),
        );
        $related_query = new WP_Query($related_args);

        if ($related_query->have_posts()) :
        ?>
            <section class="related-posts">
                <div class="container">
                    <h2 class="related-title"><?php esc_html_e('Notícias Relacionadas', 'mpa-theme'); ?></h2>
                    <div class="related-grid">
                        <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                            <article class="related-post">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>" class="related-thumbnail">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                <?php endif; ?>
                                <div class="related-content">
                                    <h3 class="related-post-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="related-meta">
                                        <span class="post-date"><?php echo get_the_date(); ?></span>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>
                </div>
            </section>
            <?php
            wp_reset_postdata();
        endif;
        ?>

        <!-- Post Navigation -->
        <nav class="post-navigation">
            <div class="container">
                <?php
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                ?>
                
                <div class="nav-links">
                    <?php if ($prev_post) : ?>
                        <div class="nav-previous">
                            <a href="<?php echo get_permalink($prev_post); ?>">
                                <span class="nav-subtitle"><?php esc_html_e('Anterior', 'mpa-theme'); ?></span>
                                <span class="nav-title"><?php echo esc_html($prev_post->post_title); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($next_post) : ?>
                        <div class="nav-next">
                            <a href="<?php echo get_permalink($next_post); ?>">
                                <span class="nav-subtitle"><?php esc_html_e('Próximo', 'mpa-theme'); ?></span>
                                <span class="nav-title"><?php echo esc_html($next_post->post_title); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
