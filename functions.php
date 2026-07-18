<?php
/**
 * Nehaverse theme functions.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

function nehaverse_setup(): void
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('custom-logo', [
        'height'      => 72,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

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

function nehaverse_assets(): void
{
    wp_enqueue_style(
        'nehaverse-fonts',
        'https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500&family=Zen+Kaku+Gothic+New:wght@400;500;700&family=Poppins:wght@500;600&display=swap',
        [],
        null
    );
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        [],
        '6.5.1'
    );
    wp_enqueue_style('nehaverse-style', get_stylesheet_uri(), ['nehaverse-fonts', 'font-awesome'], '1.0.2');
    wp_enqueue_script('nehaverse-main', get_template_directory_uri() . '/assets/js/main.js', [], '1.0.2', true);
}
add_action('wp_enqueue_scripts', 'nehaverse_assets');

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
        'supports'     => ['title', 'editor', 'excerpt', 'thumbnail'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'nehaverse_register_news_type');

function nehaverse_asset(string $path): string
{
    return esc_url(get_template_directory_uri() . '/assets/' . ltrim($path, '/'));
}

function nehaverse_nav_items(): array
{
    return [
        'home' => ['label' => 'ホーム', 'url' => home_url('/')],
    ];
}

function nehaverse_render_fallback_nav(string $current): void
{
    ?>
    <ul>
        <?php foreach (nehaverse_nav_items() as $key => $item) : ?>
            <li>
                <a class="nav-link <?php echo $current === $key ? 'is-active' : ''; ?>" href="<?php echo esc_url($item['url']); ?>">
                    <?php echo esc_html($item['label']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php
}

function nehaverse_header_menu_locations(): array
{
    return [
        'primary',
        'header_dropdown_1',
        'header_dropdown_2',
        'header_dropdown_3',
        'header_dropdown_4',
        'header_dropdown_5',
    ];
}

function nehaverse_render_header_menu_group(string $location): void
{
    $locations = get_nav_menu_locations();
    $menu = isset($locations[$location]) ? wp_get_nav_menu_object($locations[$location]) : null;

    if (!$menu instanceof WP_Term) {
        return;
    }

    $menu_name = $menu instanceof WP_Term ? $menu->name : __('Menu', 'nehaverse');

    ?>
    <li class="menu-item menu-item-has-children nehaverse-menu-group">
        <a class="nav-link" href="#" aria-haspopup="true" aria-expanded="false">
            <?php echo esc_html($menu_name); ?>
        </a>
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
    if (!in_array($args->theme_location ?? '', nehaverse_header_menu_locations(), true)) {
        return $atts;
    }

    $classes = ['nav-link'];
    $item_classes = is_array($item->classes ?? null) ? $item->classes : [];

    if (array_intersect($item_classes, ['current-menu-item', 'current-menu-parent', 'current-menu-ancestor'])) {
        $classes[] = 'is-active';
    }

    $atts['class'] = trim(($atts['class'] ?? '') . ' ' . implode(' ', $classes));

    if (in_array('menu-item-has-children', $item_classes, true)) {
        $atts['aria-haspopup'] = 'true';
        $atts['aria-expanded'] = 'false';
    }

    return $atts;
}
add_filter('nav_menu_link_attributes', 'nehaverse_nav_link_attributes', 10, 3);

function nehaverse_customize_register(WP_Customize_Manager $wp_customize): void
{
    $wp_customize->add_section('nehaverse_header', [
        'title'       => __('Nehaverse Header', 'nehaverse'),
        'description' => __('Header navigation button settings.', 'nehaverse'),
        'priority'    => 80,
    ]);

    $wp_customize->add_setting('nehaverse_nav_cta_label', [
        'default'           => 'コミュニティ参加',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('nehaverse_nav_cta_label', [
        'label'   => __('Header button label', 'nehaverse'),
        'section' => 'nehaverse_header',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('nehaverse_nav_cta_url', [
        'default'           => 'https://discord.gg/P4edaExrR4',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('nehaverse_nav_cta_url', [
        'label'   => __('Header button URL', 'nehaverse'),
        'section' => 'nehaverse_header',
        'type'    => 'url',
    ]);

    $wp_customize->add_setting('nehaverse_nav_cta_new_tab', [
        'default'           => true,
        'sanitize_callback' => static fn($value): bool => (bool) $value,
    ]);
    $wp_customize->add_control('nehaverse_nav_cta_new_tab', [
        'label'   => __('Open header button in a new tab', 'nehaverse'),
        'section' => 'nehaverse_header',
        'type'    => 'checkbox',
    ]);
}
add_action('customize_register', 'nehaverse_customize_register');

function nehaverse_header_cta(): array
{
    return [
        'label'   => get_theme_mod('nehaverse_nav_cta_label', 'コミュニティ参加'),
        'url'     => get_theme_mod('nehaverse_nav_cta_url', 'https://discord.gg/P4edaExrR4'),
        'new_tab' => (bool) get_theme_mod('nehaverse_nav_cta_new_tab', true),
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

    return 'not-found';
}

function nehaverse_brand_wordmark(): void
{
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo_url = $custom_logo_id ? wp_get_attachment_image_url($custom_logo_id, 'full') : nehaverse_asset('images/logo.png');
    ?>
    <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name') ?: 'Nehaverse'); ?>" class="brand-logo">
    <span class="brand-name"><?php echo esc_html(get_bloginfo('name') ?: 'Nehaverse'); ?></span>
    <?php
}

function nehaverse_page_lead(string $badge, string $title, string $subtitle): void
{
    ?>
    <section class="page-lead">
        <div class="page-lead__inner">
            <span class="page-lead__badge animate-fade-up"><?php echo esc_html($badge); ?></span>
            <h1 class="page-lead__title animate-fade-up" style="animation-delay: 0.1s"><?php echo esc_html($title); ?></h1>
            <p class="page-lead__subtitle animate-fade-up" style="animation-delay: 0.2s"><?php echo esc_html($subtitle); ?></p>
        </div>
    </section>
    <?php
}

function nehaverse_news_badge(string $type): array
{
    $badges = [
        'maintenance' => ['label' => 'メンテナンス', 'color' => '#e74c3c'],
        'event'       => ['label' => 'イベント', 'color' => '#9b59b6'],
        'update'      => ['label' => 'アップデート', 'color' => '#3498db'],
        'other'       => ['label' => 'その他', 'color' => '#95a5a6'],
    ];

    return $badges[$type] ?? $badges['other'];
}

function nehaverse_render_news_section(): void
{
    $news_query = new WP_Query([
        'post_type'           => 'nehaverse_news',
        'posts_per_page'      => 5,
        'ignore_sticky_posts' => true,
    ]);
    ?>
    <section class="news-section reveal-on-scroll">
        <div class="news-section__inner">
            <div class="news-section__header">
                <span class="news-section__badge">News</span>
                <h2>お知らせ</h2>
            </div>
            <?php if (!$news_query->have_posts()) : ?>
                <p class="news-section__empty">現在お知らせはありません。</p>
            <?php else : ?>
                <div class="news-list">
                    <?php
                    while ($news_query->have_posts()) :
                        $news_query->the_post();
                        $type = get_post_meta(get_the_ID(), 'news_type', true) ?: 'other';
                        $badge = nehaverse_news_badge((string) $type);
                        ?>
                        <article class="news-card">
                            <div class="news-card__meta">
                                <time class="news-card__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('Y-m-d')); ?></time>
                                <span class="news-card__category" style="background-color: <?php echo esc_attr($badge['color']); ?>"><?php echo esc_html($badge['label']); ?></span>
                            </div>
                            <h3 class="news-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p class="news-card__body"><?php echo esc_html(wp_trim_words(get_the_excerpt() ?: wp_strip_all_tags(get_the_content()), 48)); ?></p>
                        </article>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php
    wp_reset_postdata();
}

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
                'color'     => 0x6f7edc,
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

/**
 * Branded OGP cards. Every page receives a share image carrying its title.
 */
function nehaverse_ogp_query_vars(array $vars): array
{
    $vars[] = 'nehaverse_ogp';
    return $vars;
}
add_filter('query_vars', 'nehaverse_ogp_query_vars');

function nehaverse_ogp_rewrite_rules(): void
{
    add_rewrite_rule('^ogp/([0-9]+)/?$', 'index.php?nehaverse_ogp=$matches[1]', 'top');
    add_rewrite_rule('^ogp/?$', 'index.php?nehaverse_ogp=0', 'top');
}
add_action('init', 'nehaverse_ogp_rewrite_rules');

function nehaverse_ogp_flush_rules(): void
{
    nehaverse_ogp_rewrite_rules();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'nehaverse_ogp_flush_rules');

function nehaverse_ogp_context(int $post_id): array
{
    if ($post_id > 0 && get_post_status($post_id)) {
        $post = get_post($post_id);
        return [
            'title'       => wp_strip_all_tags(get_the_title($post_id)),
            'description' => wp_trim_words(wp_strip_all_tags($post?->post_excerpt ?: $post?->post_content ?: ''), 28, '…'),
            'url'         => get_permalink($post_id),
            'updated'     => (string) get_post_modified_time('U', true, $post_id),
        ];
    }

    return [
        'title'       => get_bloginfo('name') . ' | ' . get_bloginfo('description'),
        'description' => '技術で楽しめるコンテンツを、コミュニティとともに。',
        'url'         => home_url('/'),
        'updated'     => '1',
    ];
}

function nehaverse_ogp_url(?int $post_id = null): string
{
    $post_id = $post_id ?? (is_singular() ? (int) get_queried_object_id() : 0);
    $context = nehaverse_ogp_context($post_id);
    $version = substr(md5($context['title'] . $context['description'] . $context['updated']), 0, 12);
    return add_query_arg('v', $version, home_url('/ogp/' . $post_id . '/'));
}

function nehaverse_ogp_meta(): void
{
    if (is_admin() || is_feed() || defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION')) {
        return;
    }

    $post_id = is_singular() ? (int) get_queried_object_id() : 0;
    $context = nehaverse_ogp_context($post_id);
    ?>
    <meta property="og:locale" content="ja_JP">
    <meta property="og:type" content="<?php echo is_singular('post') ? 'article' : 'website'; ?>">
    <meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')); ?>">
    <meta property="og:title" content="<?php echo esc_attr($context['title']); ?>">
    <meta property="og:description" content="<?php echo esc_attr($context['description']); ?>">
    <meta property="og:url" content="<?php echo esc_url($context['url']); ?>">
    <meta property="og:image" content="<?php echo esc_url(nehaverse_ogp_url($post_id)); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta name="twitter:card" content="summary_large_image">
    <?php
}
add_action('wp_head', 'nehaverse_ogp_meta', 5);

function nehaverse_ogp_wrap(Imagick $canvas, ImagickDraw $draw, string $text, int $width, int $max_lines): array
{
    $lines = [];
    $line = '';
    $characters = preg_split('//u', trim($text), -1, PREG_SPLIT_NO_EMPTY) ?: [];
    foreach ($characters as $character) {
        $candidate = $line . $character;
        $metrics = $canvas->queryFontMetrics($draw, $candidate);
        if ($line !== '' && $metrics['textWidth'] > $width) {
            $lines[] = $line;
            $line = $character;
            if (count($lines) === $max_lines) {
                break;
            }
        } else {
            $line = $candidate;
        }
    }
    if ($line !== '' && count($lines) < $max_lines) {
        $lines[] = $line;
    }
    if (count($lines) === $max_lines && count($characters) > mb_strlen(implode('', $lines))) {
        $lines[$max_lines - 1] = rtrim($lines[$max_lines - 1]) . '…';
    }
    return $lines;
}

function nehaverse_ogp_output(): void
{
    $value = get_query_var('nehaverse_ogp', null);
    if ($value === null || $value === '') {
        return;
    }
    if (!class_exists('Imagick')) {
        status_header(503);
        exit;
    }

    $post_id = max(0, absint($value));
    $context = nehaverse_ogp_context($post_id);
    $uploads = wp_get_upload_dir();
    $directory = trailingslashit($uploads['basedir']) . 'nehaverse-ogp';
    $hash = substr(md5($context['title'] . $context['description'] . $context['updated']), 0, 12);
    $file = trailingslashit($directory) . 'card-' . $post_id . '-' . $hash . '.png';

    if (!is_readable($file)) {
        wp_mkdir_p($directory);
        $canvas = new Imagick();
        $canvas->newImage(1200, 630, new ImagickPixel('#f6f8fb'));
        $canvas->setImageFormat('png');
        $shapes = new ImagickDraw();
        $shapes->setFillColor(new ImagickPixel('#d9f4ff'));
        $shapes->ellipse(1050, 90, 250, 210, 0, 360);
        $shapes->setFillColor(new ImagickPixel('#e6e5ff'));
        $shapes->ellipse(160, 610, 340, 210, 0, 360);
        $shapes->setFillColor(new ImagickPixel('#ffe4f3'));
        $shapes->ellipse(1110, 560, 210, 180, 0, 360);
        $canvas->drawImage($shapes);

        $card = new ImagickDraw();
        $card->setFillColor(new ImagickPixel('#ffffff'));
        $card->setStrokeColor(new ImagickPixel('#e1e4ff'));
        $card->setStrokeWidth(2);
        $card->roundRectangle(62, 62, 1138, 568, 34, 34);
        $canvas->drawImage($card);

        $font = get_template_directory() . '/assets/fonts/NotoSansCJK-Regular.ttc';
        $text = new ImagickDraw();
        $text->setFont($font);
        $text->setTextAntialias(true);
        $text->setFillColor(new ImagickPixel('#7f84ff'));
        $text->setFontSize(24);
        $canvas->annotateImage($text, 125, 155, 0, 'NEHAVERSE  /  SITE PREVIEW');

        $title = new ImagickDraw();
        $title->setFont($font);
        $title->setTextAntialias(true);
        $title->setFillColor(new ImagickPixel('#1e1f31'));
        $title->setFontSize(54);
        $lines = nehaverse_ogp_wrap($canvas, $title, $context['title'], 800, 2);
        foreach ($lines as $index => $line) {
            $canvas->annotateImage($title, 125, 250 + ($index * 78), 0, $line);
        }

        $body = new ImagickDraw();
        $body->setFont($font);
        $body->setFillColor(new ImagickPixel('#5c5f7a'));
        $body->setFontSize(25);
        $description = $context['description'] !== '' ? $context['description'] : '技術で楽しめるコンテンツを、コミュニティとともに。';
        foreach (nehaverse_ogp_wrap($canvas, $body, $description, 760, 2) as $index => $line) {
            $canvas->annotateImage($body, 125, 450 + ($index * 38), 0, $line);
        }

        $logo_file = get_template_directory() . '/assets/images/logo.png';
        if (is_readable($logo_file)) {
            $logo = new Imagick($logo_file);
            $logo->setImageBackgroundColor(new ImagickPixel('transparent'));
            $logo->thumbnailImage(155, 155, true, true);
            $canvas->compositeImage($logo, Imagick::COMPOSITE_OVER, 910, 328);
            $logo->clear();
        }
        $canvas->setImageCompressionQuality(90);
        $canvas->writeImage($file);
        $canvas->clear();
    }

    if (!is_readable($file)) {
        status_header(500);
        exit;
    }
    status_header(200);
    header('Content-Type: image/png');
    header('Content-Length: ' . filesize($file));
    header('Cache-Control: public, max-age=31536000, immutable');
    header('X-Robots-Tag: noindex, nofollow');
    readfile($file);
    exit;
}
add_action('template_redirect', 'nehaverse_ogp_output');
