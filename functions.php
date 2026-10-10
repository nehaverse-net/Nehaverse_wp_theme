<?php
/**
 * Nehaverse theme functions.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

const NEHAVERSE_VERSION = '2.0.0';
const NEHAVERSE_DISCORD_URL = 'https://discord.gg/P4edaExrR4';
const NEHAVERSE_SUPPORT_URL = 'https://discord.gg/guYdDUxaBB';

/* ---------------------------------------------------------------------------
 * Setup
 * ------------------------------------------------------------------------- */

function nehaverse_setup(): void
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets']);
    add_theme_support('custom-logo', [
        'height'      => 72,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
    add_theme_support('editor-styles');
    add_editor_style(['https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@500;600;700&family=Zen+Kaku+Gothic+New:wght@400;500;700;900&display=swap', 'assets/css/editor.css']);
    add_theme_support('editor-color-palette', [
        ['name' => __('インク', 'nehaverse'), 'slug' => 'ink', 'color' => '#0b0d14'],
        ['name' => __('ラベンダー', 'nehaverse'), 'slug' => 'lavender', 'color' => '#c4b5fd'],
        ['name' => __('パープル', 'nehaverse'), 'slug' => 'purple', 'color' => '#8b6ff0'],
        ['name' => __('ディープパープル', 'nehaverse'), 'slug' => 'deep-purple', 'color' => '#5b3fc4'],
        ['name' => __('グレー', 'nehaverse'), 'slug' => 'gray', 'color' => '#4d5569'],
        ['name' => __('パネル', 'nehaverse'), 'slug' => 'panel', 'color' => '#f6f7fa'],
        ['name' => __('ホワイト', 'nehaverse'), 'slug' => 'white', 'color' => '#ffffff'],
    ]);
    set_post_thumbnail_size(1600, 0, false);
    add_image_size('nehaverse-card', 960, 540, true);

    register_nav_menus([
        'primary'           => __('ヘッダー項目 1', 'nehaverse'),
        'header_dropdown_1' => __('ヘッダー項目 2', 'nehaverse'),
        'header_dropdown_2' => __('ヘッダー項目 3', 'nehaverse'),
        'header_dropdown_3' => __('ヘッダー項目 4', 'nehaverse'),
        'header_dropdown_4' => __('ヘッダー項目 5', 'nehaverse'),
        'header_dropdown_5' => __('ヘッダー項目 6', 'nehaverse'),
        'footer'            => __('フッターメニュー', 'nehaverse'),
    ]);
}
add_action('after_setup_theme', 'nehaverse_setup');

function nehaverse_content_width(): void
{
    $GLOBALS['content_width'] = 760;
}
add_action('after_setup_theme', 'nehaverse_content_width', 0);

/* ---------------------------------------------------------------------------
 * Assets
 * ------------------------------------------------------------------------- */

function nehaverse_asset(string $path): string
{
    return esc_url(get_template_directory_uri() . '/assets/' . ltrim($path, '/'));
}

function nehaverse_assets(): void
{
    $uri = get_template_directory_uri();

    wp_enqueue_style(
        'nehaverse-fonts',
        'https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@500;600;700&family=Zen+Kaku+Gothic+New:wght@400;500;700;900&display=swap',
        [],
        null
    );
    // Kept so that icons already used in posts keep working.
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', [], '6.5.1');
    wp_enqueue_style('nehaverse-style', get_stylesheet_uri(), ['nehaverse-fonts'], NEHAVERSE_VERSION);
    wp_enqueue_style('nehaverse-content', $uri . '/assets/css/content.css', ['nehaverse-style'], NEHAVERSE_VERSION);
    wp_enqueue_script('nehaverse-main', $uri . '/assets/js/main.js', [], NEHAVERSE_VERSION, ['strategy' => 'defer', 'in_footer' => false]);

    if (is_front_page()) {
        wp_enqueue_style('nehaverse-home', $uri . '/assets/css/home.css', ['nehaverse-style'], NEHAVERSE_VERSION);
        wp_enqueue_style('nehaverse-status', $uri . '/assets/css/status.css', ['nehaverse-style'], NEHAVERSE_VERSION);
        wp_enqueue_script('nehaverse-status', $uri . '/assets/js/status.js', [], NEHAVERSE_VERSION, ['strategy' => 'defer', 'in_footer' => true]);
        wp_localize_script('nehaverse-status', 'NehaverseStatusConfig', [
            'apiUrl'          => esc_url_raw(get_theme_mod('nehaverse_status_api_url', '')),
            'refreshInterval' => 60000,
        ]);
    }

    if (is_page('minecraft')) {
        wp_enqueue_style('nehaverse-minecraft', $uri . '/assets/css/minecraft.css', ['nehaverse-style'], NEHAVERSE_VERSION);
    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'nehaverse_assets');

/**
 * Motion flags are set before first paint so content never flashes.
 * Without JavaScript, or with reduced motion, everything is shown statically.
 */
function nehaverse_motion_flags(): void
{
    $loader = is_front_page()
        ? "if(!sessionStorage.getItem('nhv-intro')){d.classList.add('has-loader');sessionStorage.setItem('nhv-intro','1');}"
        : '';
    echo "<script>(function(d){d.classList.add('js');try{if(!window.matchMedia('(prefers-reduced-motion: reduce)').matches){d.classList.add('motion');{$loader}}}catch(e){}})(document.documentElement);</script>\n";
    echo '<meta name="theme-color" content="#ffffff">' . "\n";
}
add_action('wp_head', 'nehaverse_motion_flags', 0);

function nehaverse_resource_hints(array $urls, string $relation): array
{
    if ($relation === 'preconnect') {
        $urls[] = 'https://fonts.googleapis.com';
        $urls[] = ['href' => 'https://fonts.gstatic.com', 'crossorigin'];
    }
    return $urls;
}
add_filter('wp_resource_hints', 'nehaverse_resource_hints', 10, 2);

function nehaverse_body_classes(array $classes): array
{
    if (is_front_page()) {
        $classes[] = 'home-page';
    }
    if (is_page('minecraft')) {
        $classes[] = 'minecraft-page';
    }
    if (is_singular('post') || is_singular('nehaverse_news')) {
        $classes[] = 'article-page';
    }
    return $classes;
}
add_filter('body_class', 'nehaverse_body_classes');

/* ---------------------------------------------------------------------------
 * News post type (kept from v1)
 * ------------------------------------------------------------------------- */

function nehaverse_register_news_type(): void
{
    register_post_type('nehaverse_news', [
        'labels' => [
            'name'          => __('お知らせ', 'nehaverse'),
            'singular_name' => __('お知らせ', 'nehaverse'),
            'add_new_item'  => __('新しいお知らせを追加', 'nehaverse'),
            'edit_item'     => __('お知らせを編集', 'nehaverse'),
        ],
        'public'       => true,
        'menu_icon'    => 'dashicons-megaphone',
        'has_archive'  => true,
        'rewrite'      => ['slug' => 'news'],
        'supports'     => ['title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'nehaverse_register_news_type');

function nehaverse_news_badge(string $type): array
{
    $badges = [
        'maintenance' => ['label' => 'メンテナンス', 'slug' => 'maintenance'],
        'event'       => ['label' => 'イベント', 'slug' => 'event'],
        'update'      => ['label' => 'アップデート', 'slug' => 'update'],
        'other'       => ['label' => 'お知らせ', 'slug' => 'other'],
    ];

    return $badges[$type] ?? $badges['other'];
}

/**
 * Label shown on cards and article headers: category for posts, news type for news.
 */
function nehaverse_post_label(?int $post_id = null): array
{
    $post_id = $post_id ?: get_the_ID();
    if (get_post_type($post_id) === 'nehaverse_news') {
        $badge = nehaverse_news_badge((string) (get_post_meta($post_id, 'news_type', true) ?: 'other'));
        return ['label' => $badge['label'], 'url' => get_post_type_archive_link('nehaverse_news') ?: '', 'slug' => $badge['slug']];
    }

    $categories = get_the_category($post_id);
    if ($categories) {
        return ['label' => $categories[0]->name, 'url' => get_category_link($categories[0]), 'slug' => 'category'];
    }

    return ['label' => 'Article', 'url' => '', 'slug' => 'other'];
}

function nehaverse_reading_minutes(?int $post_id = null): int
{
    $text = wp_strip_all_tags((string) get_post_field('post_content', $post_id ?: get_the_ID()));
    $length = mb_strlen(preg_replace('/\s+/u', '', $text));
    return max(1, (int) ceil($length / 500));
}

/* ---------------------------------------------------------------------------
 * Navigation
 * ------------------------------------------------------------------------- */

function nehaverse_page_url(string $slug): string
{
    $page = get_page_by_path($slug);
    return $page ? (string) get_permalink($page) : home_url('/' . $slug . '/');
}

function nehaverse_blog_url(): string
{
    $posts_page = (int) get_option('page_for_posts');
    if ($posts_page) {
        return (string) get_permalink($posts_page);
    }
    return (string) (get_post_type_archive_link('nehaverse_news') ?: home_url('/news/'));
}

function nehaverse_nav_items(): array
{
    return [
        'home'      => ['label' => 'ホーム', 'url' => home_url('/')],
        'minecraft' => ['label' => 'Minecraft', 'url' => nehaverse_page_url('minecraft')],
        'rules'     => ['label' => 'ルール・参加方法', 'url' => nehaverse_page_url('rules')],
        'products'  => ['label' => 'プロダクト', 'url' => nehaverse_page_url('products')],
        'news'      => ['label' => 'ニュース', 'url' => nehaverse_blog_url()],
        'contact'   => ['label' => 'お問い合わせ', 'url' => nehaverse_page_url('contact')],
    ];
}

function nehaverse_current_nav_key(): string
{
    if (is_front_page()) {
        return 'home';
    }
    foreach (['minecraft', 'rules', 'products', 'contact'] as $slug) {
        if (is_page($slug)) {
            return $slug;
        }
    }
    if (is_home() || is_archive() || is_singular('post') || is_singular('nehaverse_news') || is_search()) {
        return 'news';
    }
    return '';
}

function nehaverse_render_fallback_nav(string $current): void
{
    ?>
    <ul>
        <?php $index = 0; foreach (nehaverse_nav_items() as $key => $item) : $index++; ?>
            <li>
                <a class="nav-link<?php echo $current === $key ? ' is-active' : ''; ?>" href="<?php echo esc_url($item['url']); ?>"<?php echo $current === $key ? ' aria-current="page"' : ''; ?>>
                    <span class="nav-link__num"><?php echo esc_html(sprintf('%02d', $index)); ?></span><?php echo esc_html($item['label']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php
}

function nehaverse_header_menu_locations(): array
{
    return ['primary', 'header_dropdown_1', 'header_dropdown_2', 'header_dropdown_3', 'header_dropdown_4', 'header_dropdown_5'];
}

function nehaverse_render_header_menu_group(string $location): void
{
    $locations = get_nav_menu_locations();
    $menu = isset($locations[$location]) ? wp_get_nav_menu_object($locations[$location]) : null;

    if (!$menu instanceof WP_Term) {
        return;
    }

    $items = wp_get_nav_menu_items($menu->term_id) ?: [];
    $top_level = array_values(array_filter($items, static fn($item) => (int) $item->menu_item_parent === 0));

    // A menu with one item becomes a plain link; larger menus become a dropdown named after the menu.
    if (count($top_level) === 1) {
        $item = $top_level[0];
        $active = in_array('current-menu-item', (array) $item->classes, true) || (int) $item->object_id === get_queried_object_id();
        ?>
        <li class="menu-item">
            <a class="nav-link<?php echo $active ? ' is-active' : ''; ?>" href="<?php echo esc_url($item->url); ?>"<?php echo $item->target ? ' target="' . esc_attr($item->target) . '" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html($item->title); ?></a>
        </li>
        <?php
        return;
    }
    ?>
    <li class="menu-item menu-item-has-children nehaverse-menu-group">
        <button class="nav-link nav-link--group" type="button" aria-expanded="false">
            <?php echo esc_html($menu->name); ?><span class="nav-link__caret" aria-hidden="true"></span>
        </button>
        <?php
        wp_nav_menu([
            'theme_location' => $location,
            'container'      => false,
            'menu_class'     => 'sub-menu',
            'fallback_cb'    => false,
            'depth'          => 1,
        ]);
        ?>
    </li>
    <?php
}

function nehaverse_render_primary_nav(string $current): void
{
    $has_header_menu = false;
    foreach (nehaverse_header_menu_locations() as $location) {
        if (has_nav_menu($location)) {
            $has_header_menu = true;
            break;
        }
    }

    if (!$has_header_menu) {
        nehaverse_render_fallback_nav($current);
        return;
    }
    ?>
    <ul>
        <?php foreach (nehaverse_header_menu_locations() as $location) : ?>
            <?php nehaverse_render_header_menu_group($location); ?>
        <?php endforeach; ?>
    </ul>
    <?php
}

function nehaverse_nav_link_attributes(array $atts, WP_Post $item, stdClass $args): array
{
    $location = $args->theme_location ?? '';
    if (!in_array($location, nehaverse_header_menu_locations(), true) && $location !== 'footer') {
        return $atts;
    }

    $classes = $location === 'footer' ? [] : ['sub-menu__link'];
    $item_classes = is_array($item->classes ?? null) ? $item->classes : [];
    if (array_intersect($item_classes, ['current-menu-item', 'current-menu-parent', 'current-menu-ancestor'])) {
        $classes[] = 'is-active';
    }
    if ($classes) {
        $atts['class'] = trim(($atts['class'] ?? '') . ' ' . implode(' ', $classes));
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'nehaverse_nav_link_attributes', 10, 3);

/* ---------------------------------------------------------------------------
 * Customizer (kept from v1)
 * ------------------------------------------------------------------------- */

function nehaverse_customize_register(WP_Customize_Manager $wp_customize): void
{
    $wp_customize->add_section('nehaverse_header', [
        'title'       => __('Nehaverse Header', 'nehaverse'),
        'description' => __('Header navigation button settings.', 'nehaverse'),
        'priority'    => 80,
    ]);

    $wp_customize->add_setting('nehaverse_nav_cta_label', ['default' => 'Discordに参加', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('nehaverse_nav_cta_label', ['label' => __('Header button label', 'nehaverse'), 'section' => 'nehaverse_header', 'type' => 'text']);

    $wp_customize->add_setting('nehaverse_nav_cta_url', ['default' => NEHAVERSE_DISCORD_URL, 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('nehaverse_nav_cta_url', ['label' => __('Header button URL', 'nehaverse'), 'section' => 'nehaverse_header', 'type' => 'url']);

    $wp_customize->add_setting('nehaverse_nav_cta_new_tab', ['default' => true, 'sanitize_callback' => static fn($value): bool => (bool) $value]);
    $wp_customize->add_control('nehaverse_nav_cta_new_tab', ['label' => __('Open header button in a new tab', 'nehaverse'), 'section' => 'nehaverse_header', 'type' => 'checkbox']);

    $wp_customize->add_section('nehaverse_status', [
        'title'       => __('Service Status', 'nehaverse'),
        'description' => __('Cloudflare WorkerのステータスAPIを設定します。', 'nehaverse'),
        'priority'    => 85,
    ]);
    $wp_customize->add_setting('nehaverse_status_api_url', ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('nehaverse_status_api_url', [
        'label'       => __('Status API URL', 'nehaverse'),
        'description' => __('例: https://status.example.workers.dev/api/status', 'nehaverse'),
        'section'     => 'nehaverse_status',
        'type'        => 'url',
    ]);
}
add_action('customize_register', 'nehaverse_customize_register');

function nehaverse_header_cta(): array
{
    return [
        'label'   => get_theme_mod('nehaverse_nav_cta_label', 'Discordに参加'),
        'url'     => get_theme_mod('nehaverse_nav_cta_url', NEHAVERSE_DISCORD_URL),
        'new_tab' => (bool) get_theme_mod('nehaverse_nav_cta_new_tab', true),
    ];
}

/* ---------------------------------------------------------------------------
 * Template helpers
 * ------------------------------------------------------------------------- */

function nehaverse_brand_wordmark(): void
{
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo_url = $custom_logo_id ? wp_get_attachment_image_url($custom_logo_id, 'full') : nehaverse_asset('images/logo-dark.png');
    ?>
    <img src="<?php echo esc_url($logo_url); ?>" alt="" class="brand-logo" width="174" height="192">
    <span class="brand-name"><?php echo esc_html(get_bloginfo('name') ?: 'Nehaverse'); ?></span>
    <?php
}

/**
 * Sub-page hero: eyebrow, kinetic title, lead, outlined background word.
 */
function nehaverse_page_hero(string $eyebrow, string $title, string $lead = '', string $ghost = '', string $extra = ''): void
{
    ?>
    <section class="page-hero" aria-labelledby="page-title">
        <div class="page-hero__inner">
            <p class="eyebrow" data-reveal><?php echo esc_html($eyebrow); ?></p>
            <h1 id="page-title" class="page-hero__title" data-split><?php echo esc_html($title); ?></h1>
            <?php if ($lead !== '') : ?>
                <p class="page-hero__lead" data-reveal style="--d:3"><?php echo esc_html($lead); ?></p>
            <?php endif; ?>
            <?php echo $extra; // phpcs:ignore WordPress.Security.EscapeOutput -- built from escaped template markup. ?>
        </div>
        <?php if ($ghost !== '') : ?>
            <p class="page-hero__ghost" aria-hidden="true"><?php echo esc_html($ghost); ?></p>
        <?php endif; ?>
    </section>
    <?php
}

/** Backwards-compatible alias for child themes or snippets that used v1. */
function nehaverse_page_lead(string $badge, string $title, string $subtitle): void
{
    nehaverse_page_hero($badge, $title, $subtitle);
}

function nehaverse_arrow(string $glyph = '→'): string
{
    return '<span class="btn__arrow" aria-hidden="true">' . esc_html($glyph) . '</span>';
}

function nehaverse_copy_chip(string $address = 'mc.nehaverse.net', bool $label = true): void
{
    ?>
    <button class="copy-chip" type="button" data-copy-text="<?php echo esc_attr($address); ?>" aria-label="<?php echo esc_attr('サーバーアドレス ' . $address . ' をコピー'); ?>">
        <?php if ($label) : ?><span class="copy-chip__label">SERVER IP</span><?php endif; ?>
        <span><?php echo esc_html($address); ?></span><span class="copy-chip__action">COPY</span>
    </button>
    <?php
}

/**
 * Latest posts and news, shown on the front page.
 */
function nehaverse_render_news_section(): void
{
    $query = new WP_Query([
        'post_type'           => ['post', 'nehaverse_news'],
        'posts_per_page'      => 3,
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
    ]);
    ?>
    <section class="news" aria-labelledby="news-title">
        <div class="news__head" data-reveal>
            <div class="news__label"><span class="eyebrow">News</span><h2 id="news-title">お知らせ・記事</h2></div>
            <a class="text-link" href="<?php echo esc_url(nehaverse_blog_url()); ?>">すべて見る <?php echo nehaverse_arrow(); ?></a>
        </div>
        <?php if (!$query->have_posts()) : ?>
            <p class="news-section__empty" data-reveal>現在お知らせはありません。</p>
        <?php else : ?>
            <div class="post-grid">
                <?php
                $i = 0;
                while ($query->have_posts()) :
                    $query->the_post();
                    get_template_part('template-parts/post-card', null, ['delay' => $i++]);
                endwhile;
                ?>
            </div>
        <?php endif; ?>
    </section>
    <?php
    wp_reset_postdata();
}

function nehaverse_pagination(): void
{
    the_posts_pagination([
        'mid_size'           => 1,
        'prev_text'          => '<span aria-hidden="true">←</span><span class="visually-hidden">前のページ</span>',
        'next_text'          => '<span aria-hidden="true">→</span><span class="visually-hidden">次のページ</span>',
        'screen_reader_text' => 'ページ送り',
    ]);
}

function nehaverse_excerpt_more(): string
{
    return '…';
}
add_filter('excerpt_more', 'nehaverse_excerpt_more');

function nehaverse_excerpt_length(): int
{
    return 60;
}
add_filter('excerpt_length', 'nehaverse_excerpt_length');

/** Wrap the archive title prefix ("カテゴリー:") so it can be styled as an eyebrow instead. */
function nehaverse_archive_title(string $title): string
{
    if (is_category() || is_tag() || is_tax()) {
        return single_term_title('', false);
    }
    if (is_post_type_archive()) {
        return post_type_archive_title('', false);
    }
    if (is_author()) {
        return get_the_author();
    }
    return $title;
}
add_filter('get_the_archive_title', 'nehaverse_archive_title');

function nehaverse_comment(WP_Comment $comment, array $args, int $depth): void
{
    $tag = ($args['style'] ?? 'ol') === 'div' ? 'div' : 'li';
    ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class('comment-item'); ?>>
        <article class="comment-body">
            <header class="comment-meta">
                <?php echo get_avatar($comment, 44, '', '', ['class' => 'comment-avatar']); ?>
                <div>
                    <b class="comment-author"><?php comment_author(); ?></b>
                    <time datetime="<?php comment_time('c'); ?>"><?php comment_date('Y.m.d'); ?> <?php comment_time('H:i'); ?></time>
                </div>
            </header>
            <?php if ($comment->comment_approved === '0') : ?>
                <p class="comment-awaiting">コメントは承認待ちです。</p>
            <?php endif; ?>
            <div class="comment-content"><?php comment_text(); ?></div>
            <div class="comment-reply">
                <?php comment_reply_link(array_merge($args, ['depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '返信する'])); ?>
            </div>
        </article>
    <?php
}

/* ---------------------------------------------------------------------------
 * Contact form handler (kept from v1; requires NEHAVERSE_DISCORD_WEBHOOK_URL)
 * ------------------------------------------------------------------------- */

function nehaverse_handle_contact(): void
{
    if (!isset($_POST['nehaverse_contact_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nehaverse_contact_nonce'])), 'nehaverse_contact')) {
        wp_safe_redirect(add_query_arg('error', '1', wp_get_referer() ?: home_url('/contact/')));
        exit;
    }

    $name = sanitize_text_field(wp_unslash($_POST['name'] ?? ''));
    $contact = sanitize_text_field(wp_unslash($_POST['contact'] ?? ''));
    $message = sanitize_textarea_field(wp_unslash($_POST['message'] ?? ''));

    if ($name === '' || $contact === '' || $message === '') {
        wp_safe_redirect(add_query_arg('error', '1', wp_get_referer() ?: home_url('/contact/')));
        exit;
    }

    $webhook = defined('NEHAVERSE_DISCORD_WEBHOOK_URL') ? NEHAVERSE_DISCORD_WEBHOOK_URL : '';
    if ($webhook === '') {
        wp_safe_redirect(add_query_arg('error', '1', wp_get_referer() ?: home_url('/contact/')));
        exit;
    }

    $response = wp_remote_post($webhook, [
        'headers' => ['Content-Type' => 'application/json'],
        'timeout' => 10,
        'body'    => wp_json_encode([
            'embeds' => [[
                'title'     => 'Nehaverse Web から新しいお問い合わせ',
                'color'     => 0x8b6ff0,
                'fields'    => [
                    ['name' => 'お名前', 'value' => $name, 'inline' => false],
                    ['name' => '連絡先', 'value' => $contact, 'inline' => false],
                    ['name' => 'メッセージ', 'value' => mb_substr($message, 0, 1000), 'inline' => false],
                ],
                'footer'    => ['text' => 'Nehaverse Contact Form'],
                'timestamp' => gmdate('c'),
            ]],
        ]),
    ]);

    $ok = !is_wp_error($response) && (int) wp_remote_retrieve_response_code($response) < 300;
    wp_safe_redirect(add_query_arg($ok ? 'sent' : 'error', '1', home_url('/contact/')));
    exit;
}
add_action('admin_post_nehaverse_contact', 'nehaverse_handle_contact');
add_action('admin_post_nopriv_nehaverse_contact', 'nehaverse_handle_contact');

/* ---------------------------------------------------------------------------
 * Branded OGP cards (kept from v1, recoloured)
 * ------------------------------------------------------------------------- */

require_once get_template_directory() . '/inc/ogp.php';
