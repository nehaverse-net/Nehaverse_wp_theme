<?php
/**
 * Plugin Name: Nehaverse Core
 * Description: Theme-independent content types and rewrite rules for Nehaverse.
 * Version: 1.0.0
 * Requires at least: 6.0
 * Requires PHP: 8.0
 * Text Domain: nehaverse-core
 */

if (!defined('ABSPATH')) {
    exit;
}

function nehaverse_core_register_news_type(): void
{
    register_post_type('nehaverse_news', [
        'labels' => [
            'name'          => __('お知らせ', 'nehaverse-core'),
            'singular_name' => __('お知らせ', 'nehaverse-core'),
            'add_new_item'  => __('新しいお知らせを追加', 'nehaverse-core'),
            'edit_item'     => __('お知らせを編集', 'nehaverse-core'),
        ],
        'public'       => true,
        'menu_icon'    => 'dashicons-megaphone',
        'has_archive'  => true,
        'rewrite'      => ['slug' => 'news'],
        'supports'     => ['title', 'editor', 'excerpt', 'thumbnail'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'nehaverse_core_register_news_type');

function nehaverse_core_activate(): void
{
    nehaverse_core_register_news_type();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'nehaverse_core_activate');

function nehaverse_core_deactivate(): void
{
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'nehaverse_core_deactivate');
