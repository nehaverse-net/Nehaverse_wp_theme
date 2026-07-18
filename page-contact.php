<?php
/**
 * Template for the contact page.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
nehaverse_page_lead('Contact', 'お問い合わせ', 'コラボ、開発依頼、サーバー運営に関するご相談など、お気軽にご連絡ください。');
?>
<section class="section reveal-on-scroll">
    <?php if (isset($_GET['sent']) || isset($_GET['error'])) : ?>
        <div class="alert <?php echo isset($_GET['sent']) ? 'alert--success' : 'alert--error'; ?>">
            <?php echo isset($_GET['sent']) ? esc_html('お問い合わせを受け付けました。Discordで内容を共有しました。') : esc_html('送信に失敗しました。時間をおいて再度お試しください。'); ?>
        </div>
    <?php endif; ?>
    <div class="contact-grid">
        <div class="contact-card">
            <h3>Discordで相談する</h3>
            <p>サポートサーバーでは、質問や不具合報告、依頼のご相談を随時受け付けています。まずはこちらへどうぞ。</p>
            <a class="btn btn-primary" href="https://discord.gg/guYdDUxaBB" target="_blank" rel="noopener noreferrer">サポートサーバーへ</a>
        </div>
        <div class="contact-card">
            <h3>フォームから送信する</h3>
            <p>非公開で相談したい場合はこちらをご利用ください。送信内容はDiscord Webhookに通知されます。</p>
            <form class="contact-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="nehaverse_contact">
                <?php wp_nonce_field('nehaverse_contact', 'nehaverse_contact_nonce'); ?>
                <label>
                    お名前
                    <input type="text" name="name" placeholder="ネハさん" required>
                </label>
                <label>
                    連絡先（Discord IDなど）
                    <input type="text" name="contact" placeholder="neha_example" required>
                </label>
                <label>
                    ご用件
                    <textarea name="message" rows="4" placeholder="ご相談の内容を記入してください" required></textarea>
                </label>
                <button class="btn btn-secondary" type="submit">内容を送信</button>
            </form>
            <p class="contact-note">* 入力内容はDiscord Webhookへ送信されます。記入内容をご確認のうえ送信してください。</p>
        </div>
    </div>
</section>

<section class="section reveal-on-scroll contact-apply">
    <div class="section-heading">
        <h2>運営メンバー募集中</h2>
        <p>Nehaverseの運営に参加したい方はこちらのフォームからご応募ください。技術、デザイン、イベント運営など、得意な分野をぜひ教えてください。</p>
    </div>
    <div class="form-embed">
        <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSefCzGmgRLwEdWKm7ppBs4b7mou7GBXGMeaC_xOYLbd0TCUSw/viewform?embedded=true" width="100%" height="956" frameborder="0" marginheight="0" marginwidth="0">読み込んでいます...</iframe>
    </div>
</section>
<?php
get_footer();
