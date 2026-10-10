<?php
/**
 * Single post / news article.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
while (have_posts()) :
    the_post();
    $label = nehaverse_post_label();
    $is_news = get_post_type() === 'nehaverse_news';
    $permalink = get_permalink();
    $share_text = rawurlencode(get_the_title() . ' | ' . get_bloginfo('name'));
    ?>
    <article <?php post_class('article'); ?>>
        <header class="article-hero">
            <div class="article-hero__inner">
                <nav class="breadcrumb" aria-label="パンくずリスト" data-reveal>
                    <a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a>
                    <span aria-hidden="true">/</span>
                    <a href="<?php echo esc_url($is_news ? (get_post_type_archive_link('nehaverse_news') ?: nehaverse_blog_url()) : nehaverse_blog_url()); ?>"><?php echo $is_news ? 'お知らせ' : 'ニュース'; ?></a>
                    <?php if ($label['url'] && !$is_news) : ?>
                        <span aria-hidden="true">/</span>
                        <a href="<?php echo esc_url($label['url']); ?>"><?php echo esc_html($label['label']); ?></a>
                    <?php endif; ?>
                </nav>
                <p class="article-hero__meta" data-reveal style="--d:1">
                    <span class="post-chip post-chip--<?php echo esc_attr($label['slug']); ?>"><?php echo esc_html($label['label']); ?></span>
                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('Y.m.d')); ?></time>
                    <?php if (get_the_modified_date('Ymd') !== get_the_date('Ymd')) : ?>
                        <span>更新 <time datetime="<?php echo esc_attr(get_the_modified_date('c')); ?>"><?php echo esc_html(get_the_modified_date('Y.m.d')); ?></time></span>
                    <?php endif; ?>
                    <span><?php echo esc_html(sprintf('約%d分で読めます', nehaverse_reading_minutes())); ?></span>
                </p>
                <h1 class="article-hero__title" data-split><?php echo esc_html(get_the_title()); ?></h1>
                <?php if (has_excerpt()) : ?>
                    <p class="article-hero__lead" data-reveal style="--d:3"><?php echo esc_html(wp_strip_all_tags(get_the_excerpt())); ?></p>
                <?php endif; ?>
                <?php if (get_the_author()) : ?>
                    <div class="article-hero__author" data-reveal style="--d:4">
                        <?php echo get_avatar(get_the_author_meta('ID'), 40, '', '', ['class' => 'article-hero__avatar']); ?>
                        <span><?php the_author(); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </header>

        <?php if (has_post_thumbnail()) : ?>
            <figure class="article-cover media hud" data-reveal="wipe">
                <?php the_post_thumbnail('full', ['fetchpriority' => 'high', 'loading' => 'eager']); ?>
            </figure>
            <?php if ($caption = get_the_post_thumbnail_caption()) : ?>
                <p class="media-caption article-cover__caption"><span><?php echo esc_html($caption); ?></span></p>
            <?php endif; ?>
        <?php endif; ?>

        <div class="article-layout">
            <aside class="article-aside">
                <nav class="toc" data-toc hidden aria-labelledby="toc-title">
                    <p class="toc__title" id="toc-title">Contents</p>
                    <ol></ol>
                </nav>
                <div class="share">
                    <p class="share__title">Share</p>
                    <a class="share__btn" href="<?php echo esc_url('https://x.com/intent/post?text=' . $share_text . '&url=' . rawurlencode($permalink)); ?>" target="_blank" rel="noopener noreferrer">X でシェア</a>
                    <button class="share__btn" type="button" data-copy-text="<?php echo esc_attr($permalink); ?>" data-copy-label="リンクをコピーしました">リンクをコピー</button>
                </div>
            </aside>

            <div class="entry-content">
                <?php the_content(); ?>
                <?php wp_link_pages(['before' => '<nav class="page-links">', 'after' => '</nav>']); ?>
            </div>
        </div>

        <footer class="article-footer">
            <?php $tags = get_the_tags(); if ($tags) : ?>
                <ul class="tag-list" aria-label="タグ">
                    <?php foreach ($tags as $tag) : ?>
                        <li><a href="<?php echo esc_url(get_tag_link($tag)); ?>">#<?php echo esc_html($tag->name); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php
            $prev = get_previous_post();
            $next = get_next_post();
            if ($prev || $next) :
                ?>
                <nav class="post-nav" aria-label="前後の記事">
                    <?php if ($prev) : ?>
                        <a class="post-nav__item post-nav__item--prev" href="<?php echo esc_url(get_permalink($prev)); ?>">
                            <span class="post-nav__dir">← Prev</span>
                            <span class="post-nav__title"><?php echo esc_html(get_the_title($prev)); ?></span>
                        </a>
                    <?php else : ?><span></span><?php endif; ?>
                    <?php if ($next) : ?>
                        <a class="post-nav__item post-nav__item--next" href="<?php echo esc_url(get_permalink($next)); ?>">
                            <span class="post-nav__dir">Next →</span>
                            <span class="post-nav__title"><?php echo esc_html(get_the_title($next)); ?></span>
                        </a>
                    <?php endif; ?>
                </nav>
            <?php endif; ?>
        </footer>
    </article>

    <?php
    if (comments_open() || get_comments_number()) {
        comments_template();
    }

    $related_args = [
        'post_type'           => get_post_type(),
        'posts_per_page'      => 3,
        'post__not_in'        => [get_the_ID()],
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
    ];
    $cats = wp_get_post_categories(get_the_ID());
    if ($cats && !$is_news) {
        $related_args['category__in'] = $cats;
    }
    $related = new WP_Query($related_args);
    if ($related->have_posts()) :
        ?>
        <section class="related" aria-labelledby="related-title">
            <div class="section-head section-head--stack" data-reveal>
                <p class="eyebrow">Read next</p>
                <h2 id="related-title">あわせて読みたい</h2>
            </div>
            <div class="post-grid">
                <?php
                $i = 0;
                while ($related->have_posts()) :
                    $related->the_post();
                    get_template_part('template-parts/post-card', null, ['delay' => $i++]);
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </section>
    <?php endif; ?>
    <?php
endwhile;
get_footer();
