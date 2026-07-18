<?php
/**
 * 404 template.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<section class="not-found">
    <h1>ページが見つかりませんでした</h1>
    <p>URLが間違っているか、ページが移動した可能性があります。</p>
    <a class="btn btn-primary" href="<?php echo esc_url(home_url('/')); ?>">ホームへ戻る</a>
</section>
<?php
get_footer();
