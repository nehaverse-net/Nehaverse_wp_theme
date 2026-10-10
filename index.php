<?php
/**
 * Blog index, archives and search results.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

if (is_search()) {
    $eyebrow = 'Search';
    $title = sprintf('「%s」の検索結果', get_search_query());
    $lead = sprintf('%d件の記事が見つかりました。', (int) $GLOBALS['wp_query']->found_posts);
} elseif (is_post_type_archive('nehaverse_news')) {
    $eyebrow = 'News';
    $title = 'お知らせ';
    $lead = 'メンテナンス、イベント、アップデートの最新情報。';
} elseif (is_category()) {
    $eyebrow = 'Category';
    $title = single_cat_title('', false);
    $lead = wp_strip_all_tags(category_description());
} elseif (is_tag()) {
    $eyebrow = 'Tag';
    $title = '#' . single_tag_title('', false);
    $lead = wp_strip_all_tags(tag_description());
} elseif (is_archive()) {
    $eyebrow = 'Archive';
    $title = wp_strip_all_tags(get_the_archive_title());
    $lead = wp_strip_all_tags(get_the_archive_description());
} else {
    $posts_page = (int) get_option('page_for_posts');
    $eyebrow = 'News & Journal';
    $title = $posts_page ? get_the_title($posts_page) : 'ニュース';
    $lead = 'Nehaverseの最新情報、開発記録、イベントレポート。';
}

nehaverse_page_hero($eyebrow, $title, $lead, 'Journal');

$categories = get_categories(['hide_empty' => true, 'number' => 12]);
?>
<section class="section archive-list" aria-label="記事一覧">
    <div class="archive-list__tools" data-reveal>
        <?php if ($categories && !is_post_type_archive('nehaverse_news')) : ?>
            <nav class="filter" aria-label="カテゴリー">
                <a class="filter__item<?php echo (is_home() && !is_category()) ? ' is-active' : ''; ?>" href="<?php echo esc_url(nehaverse_blog_url()); ?>">すべて</a>
                <?php foreach ($categories as $category) : ?>
                    <a class="filter__item<?php echo is_category($category->term_id) ? ' is-active' : ''; ?>" href="<?php echo esc_url(get_category_link($category)); ?>"><?php echo esc_html($category->name); ?></a>
                <?php endforeach; ?>
            </nav>
        <?php endif; ?>
        <?php get_search_form(); ?>
    </div>

    <?php if (have_posts()) : ?>
        <div class="post-grid">
            <?php
            $i = 0;
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/post-card', null, ['delay' => $i++]);
            endwhile;
            ?>
        </div>
        <?php nehaverse_pagination(); ?>
    <?php else : ?>
        <div class="empty-state" data-reveal>
            <p class="empty-state__title">記事が見つかりませんでした</p>
            <p>キーワードを変えて検索するか、ホームから最新情報をご覧ください。</p>
            <a class="btn btn-primary" href="<?php echo esc_url(home_url('/')); ?>">ホームへ戻る <?php echo nehaverse_arrow(); ?></a>
        </div>
    <?php endif; ?>
</section>
<?php
get_footer();
