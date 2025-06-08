<?php get_header(); ?>

<main id="primary" class="site-main">
    <div class="container">
        <?php if (is_home() && !is_front_page()) : ?>
            <header class="page-header">
                <h1 class="page-title">
                    <?php single_post_title(); ?>
                </h1>
            </header>
        <?php endif; ?>

        <?php if (have_posts()) : ?>
            <div class="posts-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php 
                                    the_post_thumbnail('medium_large', array(
                                        'class' => 'post-thumbnail-img',
                                        'loading' => 'lazy'
                                    )); 
                                    ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="post-content">
                            <header class="post-header">
                                <?php
                                $categories = get_the_category();
                                if ($categories) :
                                ?>
                                    <div class="post-categories">
                                        <?php
                                        foreach ($categories as $category) {
                                            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="category-link">' 
                                                . esc_html($category->name) . '</a>';
                                        }
                                        ?>
                                    </div>
                                <?php endif; ?>

                                <h2 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>

                                <div class="post-meta">
                                    <span class="post-date">
                                        <i class="far fa-calendar-alt"></i>
                                        <?php echo get_the_date(); ?>
                                    </span>
                                    <span class="post-author">
                                        <i class="far fa-user"></i>
                                        <?php the_author_posts_link(); ?>
                                    </span>
                                </div>
                            </header>

                            <div class="post-excerpt">
                                <?php the_excerpt(); ?>
                            </div>

                            <footer class="post-footer">
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
                <h2><?php esc_html_e('Nenhum conteúdo encontrado', 'mpa-theme'); ?></h2>
                <p><?php esc_html_e('Desculpe, não encontramos nenhum conteúdo nesta página.', 'mpa-theme'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</main>

<style>
/* Index/Blog Listing Styles */
.site-main {
    padding: 3rem 0;
}

.page-header {
    text-align: center;
    margin-bottom: 3rem;
}

.page-title {
    font-size: 2.5rem;
    color: #333;
}

.posts-grid {
    display: grid;
    gap: 2rem;
    margin-bottom: 3rem;
}

.post-card {
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.post-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.post-thumbnail {
    position: relative;
    padding-top: 56.25%; /* 16:9 aspect ratio */
    overflow: hidden;
}

.post-thumbnail-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.post-card:hover .post-thumbnail-img {
    transform: scale(1.05);
}

.post-content {
    padding: 1.5rem;
}

.post-categories {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1rem;
    flex-wrap: wrap;
}

.category-link {
    display: inline-block;
    padding: 0.2rem 0.8rem;
    background-color: #333;
    color: #fff;
    text-decoration: none;
    border-radius: 3px;
    font-size: 0.875rem;
    transition: background-color 0.3s ease;
}

.category-link:hover {
    background-color: #000;
}

.post-title {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    line-height: 1.3;
}

.post-title a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.post-title a:hover {
    color: #000;
}

.post-meta {
    display: flex;
    gap: 1rem;
    color: #666;
    font-size: 0.875rem;
    margin-bottom: 1rem;
}

.post-meta i {
    margin-right: 0.3rem;
}

.post-excerpt {
    color: #666;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.post-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    border-top: 1px solid #eee;
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

.social-share {
    display: flex;
    gap: 1rem;
}

.social-share a {
    color: #666;
    transition: color 0.3s ease;
}

.social-share a:hover {
    color: #333;
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

.no-results p {
    color: #666;
}

/* Pagination */
.navigation.pagination {
    margin-top: 3rem;
    text-align: center;
}

.nav-links {
    display: inline-flex;
    gap: 0.5rem;
}

.page-numbers {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    color: #333;
    text-decoration: none;
    transition: all 0.3s ease;
}

.page-numbers.current {
    background-color: #333;
    color: #fff;
    border-color: #333;
}

.page-numbers:hover:not(.current) {
    background-color: #f8f9fa;
    border-color: #333;
}

@media (min-width: 768px) {
    .posts-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .posts-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 767px) {
    .page-title {
        font-size: 2rem;
    }

    .post-title {
        font-size: 1.25rem;
    }

    .post-meta {
        flex-direction: column;
        gap: 0.5rem;
    }

    .post-footer {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
}
</style>

<?php get_footer(); ?>
