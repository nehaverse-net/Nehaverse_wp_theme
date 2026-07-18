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
    nehaverse_page_lead('Page', get_the_title(), wp_strip_all_tags(get_the_excerpt()));
    ?>
    <section class="section reveal-on-scroll">
        <article class="wp-content">
            <?php the_content(); ?>
        </article>
    </section>
<?php
endwhile;
get_footer();
