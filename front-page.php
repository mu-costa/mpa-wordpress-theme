<?php get_header(); ?>

<main id="primary" class="site-main">
    <!-- Featured Slider Section -->
    <section class="featured-slider">
        <div class="slider-container">
            <?php
            $featured_query = new WP_Query(array(
                'post_type' => 'noticias',
                'posts_per_page' => 5,
                'meta_query' => array(
                    array(
                        'key' => '_thumbnail_id',
                        'compare' => 'EXISTS'
                    ),
                )
            ));

            if ($featured_query->have_posts()) :
                while ($featured_query->have_posts()) : $featured_query->the_post();
            ?>
                <div class="slide">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="slide-image">
                            <?php the_post_thumbnail('full'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="slide-content">
                        <h2 class="slide-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div class="slide-meta">
                            <span class="post-date"><?php echo get_the_date(); ?></span>
                        </div>
                        <div class="slide-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="social-share">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" rel="noopener noreferrer">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text=<?php the_title(); ?> <?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
            <button class="slider-nav prev" aria-label="Previous slide">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="slider-nav next" aria-label="Next slide">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </section>

    <!-- Latest News Section -->
    <section class="latest-news">
        <h2 class="section-title"><?php esc_html_e('Últimas Notícias', 'mpa-theme'); ?></h2>
        <div class="news-grid">
            <?php
            $news_query = new WP_Query(array(
                'post_type' => 'noticias',
                'posts_per_page' => 6,
                'offset' => 5
            ));

            if ($news_query->have_posts()) :
                while ($news_query->have_posts()) : $news_query->the_post();
            ?>
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
                        <h3 class="news-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <div class="news-meta">
                            <span class="post-date"><?php echo get_the_date(); ?></span>
                        </div>
                        <div class="news-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="read-more">
                            <?php esc_html_e('Leia mais', 'mpa-theme'); ?>
                        </a>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
        <div class="view-all">
            <a href="<?php echo get_post_type_archive_link('noticias'); ?>" class="button">
                <?php esc_html_e('Ver todas as notícias', 'mpa-theme'); ?>
            </a>
        </div>
    </section>

    <!-- TV Camponesa Section -->
    <section class="tv-camponesa">
        <h2 class="section-title"><?php esc_html_e('TV Camponesa', 'mpa-theme'); ?></h2>
        <div class="video-grid">
            <?php
            $tv_query = new WP_Query(array(
                'post_type' => 'tv-camponesa',
                'posts_per_page' => 3
            ));

            if ($tv_query->have_posts()) :
                while ($tv_query->have_posts()) : $tv_query->the_post();
            ?>
                <article class="video-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="video-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium_large'); ?>
                                <span class="play-icon">
                                    <i class="fas fa-play"></i>
                                </span>
                            </a>
                        </div>
                    <?php endif; ?>
                    <h3 class="video-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
        <div class="view-all">
            <a href="<?php echo get_post_type_archive_link('tv-camponesa'); ?>" class="button">
                <?php esc_html_e('Ver todos os vídeos', 'mpa-theme'); ?>
            </a>
        </div>
    </section>

    <!-- Radio Camponesa Section -->
    <section class="radio-camponesa">
        <h2 class="section-title"><?php esc_html_e('Rádio Camponesa', 'mpa-theme'); ?></h2>
        <div class="audio-grid">
            <?php
            $radio_query = new WP_Query(array(
                'post_type' => 'radio-camponesa',
                'posts_per_page' => 3
            ));

            if ($radio_query->have_posts()) :
                while ($radio_query->have_posts()) : $radio_query->the_post();
            ?>
                <article class="audio-card">
                    <div class="audio-content">
                        <h3 class="audio-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <div class="audio-meta">
                            <span class="post-date"><?php echo get_the_date(); ?></span>
                        </div>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
        <div class="view-all">
            <a href="<?php echo get_post_type_archive_link('radio-camponesa'); ?>" class="button">
                <?php esc_html_e('Ver todos os áudios', 'mpa-theme'); ?>
            </a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
