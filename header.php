<?php
/**
 * Header template.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

$current = nehaverse_current_nav_key();
$header_cta = nehaverse_header_cta();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="app-shell">
    <header class="site-header">
        <div class="site-header__inner">
            <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr((get_bloginfo('name') ?: 'Nehaverse') . ' ホーム'); ?>">
                <?php nehaverse_brand_wordmark(); ?>
            </a>
            <button class="nav-toggle" aria-expanded="false" aria-controls="site-nav" aria-label="メニューを開く">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav class="site-nav" id="site-nav" aria-label="<?php esc_attr_e('Primary navigation', 'nehaverse'); ?>">
                <?php nehaverse_render_primary_nav($current); ?>
                <?php if ($header_cta['label'] !== '' && $header_cta['url'] !== '') : ?>
                    <div class="nav-cta">
                        <a
                            class="btn btn-primary"
                            href="<?php echo esc_url($header_cta['url']); ?>"
                            <?php echo $header_cta['new_tab'] ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
                        >
                            <?php echo esc_html($header_cta['label']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main>
