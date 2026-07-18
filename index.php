<?php
/**
 * Main index template.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<section class="page-lead">
    <div class="page-lead__inner">
        <span class="page-lead__badge animate-fade-up"><?php echo is_post_type_archive('nehaverse_news') ? esc_html('News') : esc_html('Journal'); ?></span>
        <h1 class="page-lead__title animate-fade-up" style="animation-delay: 0.1s">
            <?php echo is_post_type_archive('nehaverse_news') ? esc_html('お知らせ') : esc_html(get_the_archive_title() ?: get_bloginfo('name')); ?>
        </h1>
        <?php if (get_the_archive_description()) : ?>
            <p class="page-lead__subtitle animate-fade-up" style="animation-delay: 0.2s"><?php echo wp_kses_post(get_the_archive_description()); ?></p>
        <?php endif; ?>
    </div>
</section>

<section class="section reveal-on-scroll">
    <div class="news-list">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article class="news-card">
                    <div class="news-card__meta">
                        <time class="news-card__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('Y-m-d')); ?></time>
                    </div>
                    <h2 class="news-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p class="news-card__body"><?php echo esc_html(wp_trim_words(get_the_excerpt() ?: wp_strip_all_tags(get_the_content()), 64)); ?></p>
                </article>
            <?php endwhile; ?>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <p class="news-section__empty">表示できる記事がありません。</p>
        <?php endif; ?>
    </div>
</section>
<?php
get_footer();
