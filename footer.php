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
                <?php nehaverse_brand_wordmark(); ?>
                <div>
                    <p class="footer-title">Nehaverse</p>
                    <p class="footer-text">技術で楽しめるコンテンツを、コミュニティとともに。</p>
                </div>
            </div>
            <div class="footer-links">
                <div>
                    <h4>リンク</h4>
                    <ul>
                        <?php foreach (nehaverse_nav_items() as $item) : ?>
                            <li><a href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['label']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <h4>Discord</h4>
                    <ul>
                        <li><a href="https://discord.gg/P4edaExrR4" target="_blank" rel="noopener noreferrer">コミュニティサーバー</a></li>
                        <li><a href="https://discord.gg/guYdDUxaBB" target="_blank" rel="noopener noreferrer">サポートサーバー</a></li>
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
        <p class="site-footer__copy">&copy; <?php echo esc_html(gmdate('Y')); ?> Nehaverse</p>
    </footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
