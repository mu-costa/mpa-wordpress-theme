<?php get_header(); ?>

<main id="primary" class="site-main">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
                <header class="page-header">
                    <h1 class="page-title">
                        <?php the_title(); ?>
                    </h1>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="featured-image">
                        <?php 
                        the_post_thumbnail('full', array(
                            'class' => 'page-featured-image',
                            'loading' => 'lazy'
                        )); 
                        ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Páginas:', 'mpa-theme'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <?php if (get_edit_post_link()) : ?>
                    <footer class="entry-footer">
                        <?php
                        edit_post_link(
                            sprintf(
                                /* translators: %s: Name of current post */
                                esc_html__('Editar %s', 'mpa-theme'),
                                the_title('<span class="screen-reader-text">"', '"</span>', false)
                            ),
                            '<span class="edit-link">',
                            '</span>'
                        );
                        ?>
                    </footer>
                <?php endif; ?>
            </article>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>

        <?php endwhile; ?>
    </div>
</main>

<style>
/* Page Template Styles */
.page-content {
    max-width: 800px;
    margin: 0 auto;
    padding: 3rem 0;
}

.page-header {
    text-align: center;
    margin-bottom: 2rem;
}

.page-title {
    font-size: 2.5rem;
    color: #333;
    margin: 0;
    line-height: 1.2;
}

.featured-image {
    margin-bottom: 2rem;
    border-radius: 8px;
    overflow: hidden;
}

.page-featured-image {
    width: 100%;
    height: auto;
    display: block;
}

.entry-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #444;
}

.entry-content p {
    margin-bottom: 1.5rem;
}

.entry-content h2,
.entry-content h3,
.entry-content h4 {
    color: #333;
    margin: 2rem 0 1rem;
}

.entry-content ul,
.entry-content ol {
    margin-bottom: 1.5rem;
    padding-left: 1.5rem;
}

.entry-content li {
    margin-bottom: 0.5rem;
}

.entry-content img {
    max-width: 100%;
    height: auto;
    border-radius: 4px;
    margin: 1.5rem 0;
}

.entry-content a {
    color: #333;
    text-decoration: underline;
    transition: color 0.3s ease;
}

.entry-content a:hover {
    color: #000;
}

.entry-content blockquote {
    margin: 2rem 0;
    padding: 1rem 2rem;
    border-left: 4px solid #333;
    background-color: #f8f9fa;
    font-style: italic;
}

.entry-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 1.5rem 0;
}

.entry-content th,
.entry-content td {
    padding: 0.75rem;
    border: 1px solid #ddd;
    text-align: left;
}

.entry-content th {
    background-color: #f8f9fa;
    font-weight: 600;
}

.page-links {
    margin: 2rem 0;
    padding-top: 1rem;
    border-top: 1px solid #eee;
}

.entry-footer {
    margin-top: 3rem;
    padding-top: 1rem;
    border-top: 1px solid #eee;
    font-size: 0.9rem;
    color: #666;
}

.edit-link a {
    color: #666;
    text-decoration: none;
    transition: color 0.3s ease;
}

.edit-link a:hover {
    color: #333;
}

/* Comments Area */
.comments-area {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid #eee;
}

.comments-title {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 2rem;
}

.comment-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.comment {
    margin-bottom: 2rem;
}

.comment-body {
    padding: 1rem;
    background-color: #f8f9fa;
    border-radius: 4px;
}

.comment-meta {
    margin-bottom: 1rem;
}

.comment-author {
    font-weight: 600;
}

.comment-metadata {
    font-size: 0.875rem;
    color: #666;
}

.comment-content {
    margin-bottom: 1rem;
}

.reply {
    font-size: 0.875rem;
}

.comment-respond {
    margin-top: 2rem;
}

.comment-form {
    display: grid;
    gap: 1rem;
}

.comment-form label {
    display: block;
    margin-bottom: 0.5rem;
    color: #333;
}

.comment-form input[type="text"],
.comment-form input[type="email"],
.comment-form input[type="url"],
.comment-form textarea {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.comment-form input[type="submit"] {
    background-color: #333;
    color: #fff;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.comment-form input[type="submit"]:hover {
    background-color: #000;
}

@media (max-width: 768px) {
    .page-content {
        padding: 2rem 0;
    }

    .page-title {
        font-size: 2rem;
    }

    .entry-content {
        font-size: 1rem;
    }
}
</style>

<?php get_footer(); ?>
