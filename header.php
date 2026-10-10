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
<?php if (is_front_page()) : ?>
<div class="loader" aria-hidden="true"><div class="loader__inner"><img class="loader__logo" src="<?php echo nehaverse_asset('images/logo-dark.png'); ?>" alt="" width="174" height="192"><span class="loader__name">NEHAVERSE</span><span class="loader__bar"><span></span></span></div></div>
<?php endif; ?>
<a class="skip-link" href="#main-content">本文へスキップ</a>
<div class="scroll-progress" aria-hidden="true"></div>
<div class="app-shell">
    <header class="site-header">
        <div class="site-header__inner">
            <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr((get_bloginfo('name') ?: 'Nehaverse') . ' ホーム'); ?>">
                <?php nehaverse_brand_wordmark(); ?>
            </a>
            <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav" aria-label="メニューを開く"><span></span><span></span><span></span></button>
            <nav class="site-nav" id="site-nav" aria-label="メインナビゲーション">
                <?php nehaverse_render_primary_nav($current); ?>
            </nav>
            <?php if ($header_cta['label'] !== '' && $header_cta['url'] !== '') : ?>
                <a class="btn btn-primary header-cta" href="<?php echo esc_url($header_cta['url']); ?>"<?php echo $header_cta['new_tab'] ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
                    <?php echo esc_html($header_cta['label']); ?> <?php echo nehaverse_arrow(); ?>
                </a>
            <?php endif; ?>
        </div>
    </header>
    <main id="main-content" tabindex="-1">
