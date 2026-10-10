<?php
/**
 * Search form.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}
$field_id = wp_unique_id('search-');
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="visually-hidden" for="<?php echo esc_attr($field_id); ?>">サイト内検索</label>
    <input type="search" id="<?php echo esc_attr($field_id); ?>" class="search-form__input" placeholder="記事を検索" value="<?php echo esc_attr(get_search_query()); ?>" name="s">
    <button type="submit" class="search-form__submit" aria-label="検索"><span aria-hidden="true">→</span></button>
</form>
