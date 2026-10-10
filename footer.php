<?php
/**
 * Footer template.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
    </main>
    <footer class="site-footer">
        <div class="site-footer__inner">
            <div class="footer-brand">
                <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr((get_bloginfo('name') ?: 'Nehaverse') . ' ホーム'); ?>"><?php nehaverse_brand_wordmark(); ?></a>
                <p class="footer-text">技術で楽しめるコンテンツを、コミュニティとともに。</p>
            </div>
            <div class="footer-links">
                <div>
                    <h4>Site</h4>
                    <?php if (has_nav_menu('footer')) : ?>
                        <?php wp_nav_menu(['theme_location' => 'footer', 'container' => false, 'depth' => 1, 'fallback_cb' => false]); ?>
                    <?php else : ?>
                        <ul>
                            <?php foreach (nehaverse_nav_items() as $item) : ?>
                                <li><a href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['label']); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div>
                    <h4>Discord</h4>
                    <ul>
                        <li><a href="<?php echo esc_url(NEHAVERSE_DISCORD_URL); ?>" target="_blank" rel="noopener noreferrer">コミュニティサーバー</a></li>
                        <li><a href="<?php echo esc_url(NEHAVERSE_SUPPORT_URL); ?>" target="_blank" rel="noopener noreferrer">サポートサーバー</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Minecraft</h4>
                    <ul>
                        <li><span>mc.nehaverse.net</span></li>
                        <li><a href="https://map.nehaverse.net" target="_blank" rel="noopener noreferrer">map.nehaverse.net</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <p class="footer-wordmark" aria-hidden="true">Nehaverse</p>
        <p class="site-footer__copy"><span>&copy; <?php echo esc_html(wp_date('Y')); ?> NEHAVERSE</span><span>BUILD · PLAY · CONNECT</span></p>
    </footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
