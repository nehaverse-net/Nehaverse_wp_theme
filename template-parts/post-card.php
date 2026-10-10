<?php
/**
 * Post card used on the front page, archives and related posts.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

$delay = (int) ($args['delay'] ?? 0);
$label = nehaverse_post_label();
?>
<article <?php post_class('post-card'); ?> data-reveal style="--d:<?php echo esc_attr((string) ($delay % 6)); ?>">
    <a class="post-card__link" href="<?php the_permalink(); ?>">
        <div class="post-card__media">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('nehaverse-card', ['loading' => 'lazy', 'alt' => '']); ?>
            <?php else : ?>
                <span class="post-card__placeholder" aria-hidden="true"><img src="<?php echo nehaverse_asset('images/logo-dark.png'); ?>" alt="" width="174" height="192"></span>
            <?php endif; ?>
        </div>
        <div class="post-card__body">
            <p class="post-card__meta">
                <span class="post-chip post-chip--<?php echo esc_attr($label['slug']); ?>"><?php echo esc_html($label['label']); ?></span>
                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('Y.m.d')); ?></time>
            </p>
            <h3 class="post-card__title"><?php the_title(); ?></h3>
            <p class="post-card__excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 48, '…')); ?></p>
            <span class="post-card__more">続きを読む <?php echo nehaverse_arrow(); ?></span>
        </div>
    </a>
</article>
