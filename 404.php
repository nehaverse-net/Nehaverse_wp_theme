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
<section class="not-found" aria-labelledby="page-title">
  <p class="not-found__code" aria-hidden="true">404</p>
  <h1 id="page-title">ページが見つかりませんでした</h1>
  <p>URLが間違っているか、ページが移動した可能性があります。</p>
  <a class="btn btn-primary" data-magnetic href="<?php echo esc_url(home_url('/')); ?>">ホームへ戻る <span class="btn__arrow" aria-hidden="true">→</span></a>
</section>
<?php
get_footer();
