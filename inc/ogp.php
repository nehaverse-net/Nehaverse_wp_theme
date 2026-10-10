<?php
/**
 * Branded OGP share images.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

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
    $version = substr(md5('v2' . $context['title'] . $context['description'] . $context['updated']), 0, 12);
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
    $hash = substr(md5('v2' . $context['title'] . $context['description'] . $context['updated']), 0, 12);
    $file = trailingslashit($directory) . 'card-' . $post_id . '-' . $hash . '.png';

    if (!is_readable($file)) {
        wp_mkdir_p($directory);
        $canvas = new Imagick();
        $canvas->newImage(1200, 630, new ImagickPixel('#ffffff'));
        $canvas->setImageFormat('png');
        $shapes = new ImagickDraw();
        $shapes->setFillColor(new ImagickPixel('#ede7ff'));
        $shapes->ellipse(1050, 90, 250, 210, 0, 360);
        $shapes->setFillColor(new ImagickPixel('#e4dcff'));
        $shapes->ellipse(160, 610, 340, 210, 0, 360);
        $shapes->setFillColor(new ImagickPixel('#f3efff'));
        $shapes->ellipse(1110, 560, 210, 180, 0, 360);
        $canvas->drawImage($shapes);

        $card = new ImagickDraw();
        $card->setFillColor(new ImagickPixel('#ffffff'));
        $card->setStrokeColor(new ImagickPixel('#c4b5fd'));
        $card->setStrokeWidth(2);
        $card->roundRectangle(62, 62, 1138, 568, 0, 0);
        $canvas->drawImage($card);

        $font = get_template_directory() . '/assets/fonts/NotoSansCJK-Regular.ttc';
        $text = new ImagickDraw();
        $text->setFont($font);
        $text->setTextAntialias(true);
        $text->setFillColor(new ImagickPixel('#5b3fc4'));
        $text->setFontSize(24);
        $canvas->annotateImage($text, 125, 155, 0, 'NEHAVERSE  /  SITE PREVIEW');

        $title = new ImagickDraw();
        $title->setFont($font);
        $title->setTextAntialias(true);
        $title->setFillColor(new ImagickPixel('#0b0d14'));
        $title->setFontSize(54);
        $lines = nehaverse_ogp_wrap($canvas, $title, $context['title'], 800, 2);
        foreach ($lines as $index => $line) {
            $canvas->annotateImage($title, 125, 250 + ($index * 78), 0, $line);
        }

        $body = new ImagickDraw();
        $body->setFont($font);
        $body->setFillColor(new ImagickPixel('#4d5569'));
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
