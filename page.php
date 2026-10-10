<?php
/**
 * Default page template.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
while (have_posts()) :
    the_post();
    $lead = has_excerpt() ? wp_strip_all_tags(get_the_excerpt()) : '';
    nehaverse_page_hero('Page', get_the_title(), $lead, (string) get_post_field('post_name'));
    ?>
    <div class="article-layout article-layout--page">
        <?php if (has_post_thumbnail()) : ?>
            <figure class="article-cover media hud" data-reveal="wipe"><?php the_post_thumbnail('full'); ?></figure>
        <?php endif; ?>
        <div class="entry-content" data-reveal>
            <?php the_content(); ?>
            <?php wp_link_pages(['before' => '<nav class="page-links">', 'after' => '</nav>']); ?>
        </div>
    </div>
    <?php
    if (comments_open() || get_comments_number()) {
        comments_template();
    }
endwhile;
get_footer();
