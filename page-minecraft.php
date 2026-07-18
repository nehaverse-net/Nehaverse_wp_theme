<?php
/**
 * Template for the minecraft page.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
nehaverse_page_lead('Minecraft Server', 'neha鯖へようこそ', '自由度の高いワールドで、あなたの物語をつくろう。');
?>
<section class="section reveal-on-scroll">
    <div class="section-heading">
        <h2>neha鯖とは？</h2>
        <p>neha鯖は、自由な建築とサバイバル、そしてコミュニティを大切にするMinecraftサーバーです。初心者からベテランまで楽しめる環境を整えています。</p>
    </div>
    <div class="info-grid">
        <div class="info-card">
            <h3>プレイスタイル</h3>
            <ul>
                <li>サバイバルと建築を両立</li>
                <li>経済システムで取引も可能</li>
                <li>季節イベントも不定期開催</li>
            </ul>
        </div>
        <div class="info-card">
            <h3>対応バージョン</h3>
            <p>Java版の最新推奨バージョン。詳細はDiscord内の案内チャンネルをご確認ください。</p>
        </div>
        <div class="info-card">
            <h3>サーバーの雰囲気</h3>
            <p>アットホームで協力的。建築のスクショ共有や企画持ち込みも大歓迎です。</p>
        </div>
    </div>
</section>

<section class="section reveal-on-scroll">
    <div class="server-callout">
        <div>
            <h3>サーバー接続情報</h3>
            <p>下記アドレスをMinecraftに設定してアクセスしてください。</p>
            <ul>
                <li><span class="label">メインサーバー</span><code>mc.nehaverse.net</code></li>
                <li><span class="label">ダイナマップ</span><a href="https://map.nehaverse.net" target="_blank" rel="noopener noreferrer">map.nehaverse.net</a></li>
            </ul>
        </div>
        <div class="server-callout__cta">
            <p>参加前にDiscordでルールチェックをお願いします。</p>
            <a class="btn btn-primary" href="https://discord.gg/P4edaExrR4" target="_blank" rel="noopener noreferrer">Discordでルールを確認</a>
        </div>
    </div>
</section>
<?php
get_footer();
