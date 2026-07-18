<?php
/**
 * Template for the products page.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
nehaverse_page_lead('Products', '個人開発プロダクト', 'Discord BotやMinecraftプラグインでコミュニティ運営をサポート。');
?>
<section class="section reveal-on-scroll">
    <div class="product-card">
        <div class="product-card__header">
            <h2>Voicemanegement（Discord Bot）</h2>
            <span class="product-card__tag">導入累計 10K+</span>
        </div>
        <p>ボイスチャット時間に応じてロールを付与したり、ログを記録したりできる高機能Botです。利用には料金がかかります。</p>
        <div class="product-card__links">
            <a class="btn btn-primary" href="https://discord.com/oauth2/authorize?client_id=1285114704670228513&permissions=8&integration_type=0&scope=bot+applications.commands" target="_blank" rel="noopener noreferrer">招待リンク</a>
            <a class="btn btn-secondary" href="https://note.com/nehatsu/n/n756088f196df" target="_blank" rel="noopener noreferrer">詳細を見る（note）</a>
        </div>
        <div class="command-list">
            <h3>主なコマンド</h3>
            <dl>
                <div><dt>/vclog &lt;チャンネル&gt;</dt><dd>ボイスチャット参加情報を指定チャンネルに記録。管理者権限が必要です。</dd></div>
                <div><dt>/deletevclog</dt><dd>ログ送信設定を削除。管理者権限が必要です。</dd></div>
                <div><dt>/rtwa</dt><dd>累計通話時間をランキング表示。アクティブユーザーを一目で把握できます。</dd></div>
                <div><dt>/add_role &lt;ロール&gt; &lt;時間&gt;</dt><dd>通話時間に応じたロール付与設定を追加、更新します。</dd></div>
                <div><dt>/remove_role &lt;ロール&gt; &lt;時間&gt;</dt><dd>一定時間でロールを外す設定を追加、更新します。</dd></div>
                <div><dt>/sakujyo_add_role &lt;ロール&gt;</dt><dd>指定ロールへの付与設定を削除します。</dd></div>
                <div><dt>/sakujyo_remove_role &lt;ロール&gt;</dt><dd>指定ロールへの剥奪設定を削除します。</dd></div>
                <div><dt>/list_roles</dt><dd>登録されているロール設定を一覧表示します。</dd></div>
                <div><dt>/otoware</dt><dd>音声ファイルを加工して音割れ状態で投稿できます。</dd></div>
                <div><dt>/message</dt><dd>メッセージリンクの装飾設定を切り替えます（初期設定で有効）。</dd></div>
                <div><dt>/sakujyo_setting</dt><dd>通話時間の記録を一括削除します。</dd></div>
                <div><dt>/ignore_channel / unignore_channel</dt><dd>特定ボイスチャンネルの記録除外、再開を設定します。</dd></div>
            </dl>
        </div>
    </div>
</section>

<section class="section reveal-on-scroll">
    <div class="product-card">
        <div class="product-card__header">
            <h2>Minecraft プラグイン</h2>
            <span class="product-card__tag">for Server Operators</span>
        </div>
        <p>GeyserMC / Floodgateの自動更新を行う「geyseruploder」をはじめ、サーバー運営を支えるプラグインを開発しています。</p>
        <ul class="product-links">
            <li><a href="https://github.com/grampr/geyseruploader" target="_blank" rel="noopener noreferrer">geyseruploder（GitHub）</a></li>
            <li><a href="https://github.com/grampr?tab=repositories" target="_blank" rel="noopener noreferrer">その他のプロジェクト</a></li>
        </ul>
        <p class="product-note">お仕事の開発依頼もお気軽にご相談ください。</p>
    </div>
</section>
<?php
get_footer();
