<?php
/**
 * Template for the rules page.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
nehaverse_page_lead('Guidelines', 'コミュニティルール', 'みんなが安心して楽しめるよう、以下のルールへのご協力をお願いします。');
?>
<section class="section reveal-on-scroll">
    <div class="section-heading">
        <h2>基本方針</h2>
    </div>
    <div class="rules-grid">
        <div class="rule-card">
            <h3>尊重と礼儀</h3>
            <p>サーバー全体で礼儀正しく振る舞い、他のメンバーを尊重しましょう。</p>
        </div>
        <div class="rule-card">
            <h3>禁止事項</h3>
            <ul>
                <li>不適切な画像の投稿、発言、スパム</li>
                <li>差別、ハラスメント、迷惑行為</li>
                <li>デマ、詐欺、ウイルスサイトへの誘導</li>
                <li>個人情報の漏洩、なりすまし（架空キャラは除く）</li>
                <li>その他、法律やDiscord規約に抵触する行為</li>
            </ul>
        </div>
        <div class="rule-card">
            <h3>参考リンク</h3>
            <ul>
                <li><a href="https://discord.com/terms" target="_blank" rel="noopener noreferrer">Discord サービス利用規約</a></li>
                <li><a href="https://discord.com/guidelines" target="_blank" rel="noopener noreferrer">Discord コミュニティガイドライン</a></li>
            </ul>
        </div>
    </div>
</section>

<section class="section reveal-on-scroll">
    <div class="section-heading">
        <h2>注意事項</h2>
        <p>参加者が写っている写真などの扱いは、ご自身の責任でお願いします。万が一の際、運営では責任を負いかねます。</p>
    </div>
    <div class="notice-box">
        <p>neha鯖へようこそ！<br>ルールを読まれた方はDiscordルールチャンネルでリアクションを押してください。アクセス権限が付与されます。</p>
        <a class="btn btn-primary" href="https://discord.gg/P4edaExrR4" target="_blank" rel="noopener noreferrer">Discordルールチャンネルへ</a>
    </div>
</section>
<?php
get_footer();
