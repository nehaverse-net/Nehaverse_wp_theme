<?php
/**
 * Single post template.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
while (have_posts()) :
    the_post();
    nehaverse_page_lead(get_post_type() === 'nehaverse_news' ? 'News' : 'Article', get_the_title(), get_the_date('Y-m-d'));
    ?>
    <section class="section reveal-on-scroll">
        <article class="wp-content">
            <?php if (has_post_thumbnail()) : ?>
                <div class="feature-section__image-frame single-featured-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>
            <?php the_content(); ?>
        </article>
    </section>
<?php
endwhile;
get_footer();
