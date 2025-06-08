<?php
/**
 * Custom search form template
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="screen-reader-text" for="s"><?php esc_html_e('Pesquisar por:', 'mpa-theme'); ?></label>
    
    <div class="search-input-wrapper">
        <input type="search" 
               id="s"
               class="search-field" 
               placeholder="<?php echo esc_attr_x('Digite sua busca...', 'placeholder', 'mpa-theme'); ?>"
               value="<?php echo get_search_query(); ?>" 
               name="s"
               required>
               
        <button type="submit" class="search-submit" aria-label="<?php esc_attr_e('Buscar', 'mpa-theme'); ?>">
            <i class="fas fa-search"></i>
            <span class="screen-reader-text"><?php esc_html_e('Buscar', 'mpa-theme'); ?></span>
        </button>
    </div>

    <?php
    // If searching in a specific post type
    if (is_post_type_archive('noticias')) :
    ?>
        <input type="hidden" name="post_type" value="noticias">
    <?php endif; ?>
</form>

<style>
.search-form {
    position: relative;
    max-width: 100%;
    margin: 0 auto;
}

.search-input-wrapper {
    display: flex;
    gap: 0.5rem;
}

.search-field {
    flex: 1;
    padding: 0.8rem 1rem;
    font-size: 1rem;
    border: 2px solid #e0e0e0;
    border-radius: 4px;
    background-color: #fff;
    transition: all 0.3s ease;
}

.search-field:focus {
    outline: none;
    border-color: #333;
    box-shadow: 0 0 0 2px rgba(51, 51, 51, 0.1);
}

.search-submit {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.8rem 1.5rem;
    font-size: 1rem;
    color: #fff;
    background-color: #333;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.search-submit:hover {
    background-color: #000;
}

.search-submit i {
    font-size: 1.1rem;
}

/* Responsive styles */
@media (max-width: 576px) {
    .search-input-wrapper {
        flex-direction: column;
    }

    .search-submit {
        width: 100%;
    }
}

/* Accessibility */
.screen-reader-text {
    border: 0;
    clip: rect(1px, 1px, 1px, 1px);
    clip-path: inset(50%);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
    word-wrap: normal !important;
}

.screen-reader-text:focus {
    background-color: #fff;
    clip: auto !important;
    clip-path: none;
    color: #333;
    display: block;
    font-size: 1rem;
    height: auto;
    left: 5px;
    line-height: normal;
    padding: 15px 23px 14px;
    text-decoration: none;
    top: 5px;
    width: auto;
    z-index: 100000;
}
</style>
