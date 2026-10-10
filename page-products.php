<?php
/**
 * Template for the products page (slug: products).
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<section class="page-hero" aria-labelledby="page-title">
  <div class="page-hero__inner">
    <p class="eyebrow" data-reveal>Products</p>
    <h1 id="page-title" class="page-hero__title" data-split>個人開発プロダクト</h1>
    <p class="page-hero__lead" data-reveal style="--d:3">Discord BotやMinecraftプラグインでコミュニティ運営をサポート。</p>
    <div class="page-hero__meta" data-reveal style="--d:4"><span>Discord Bot</span><span>Minecraft Plugin</span><span>github.com/grampr</span></div>
  </div>
  <p class="page-hero__ghost" aria-hidden="true">Products</p>
</section>

<section class="section" aria-label="プロダクト一覧">
  <article class="product" aria-labelledby="voice-title">
    <div class="product__info" data-reveal>
      <p class="eyebrow">01 / Discord Bot</p>
      <h2 id="voice-title">Voicemanegement</h2>
      <span class="tag">導入累計 10K+</span>
      <p>ボイスチャット時間に応じてロールを付与したり、ログを記録したりできる高機能Botです。利用には料金がかかります。</p>
      <div class="btn-row">
        <a class="btn btn-primary" data-magnetic href="https://discord.com/oauth2/authorize?client_id=1285114704670228513&amp;permissions=8&amp;integration_type=0&amp;scope=bot+applications.commands" target="_blank" rel="noopener noreferrer">招待リンク <span class="btn__arrow" aria-hidden="true">→</span></a>
        <a class="btn btn-ghost" href="https://note.com/nehatsu/n/n756088f196df" target="_blank" rel="noopener noreferrer">詳細を見る（note） <span class="btn__arrow" aria-hidden="true">↗</span></a>
      </div>
    </div>
    <div class="terminal" data-reveal style="--d:1">
      <div class="terminal__bar" aria-hidden="true"><i></i><i></i><i></i><span>COMMANDS</span></div>
      <h3 class="visually-hidden">主なコマンド</h3>
      <dl class="command-list">
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
  </article>

  <article class="product" aria-labelledby="plugin-title">
    <div class="product__info" data-reveal>
      <p class="eyebrow">02 / Minecraft Plugin</p>
      <h2 id="plugin-title">Minecraft プラグイン</h2>
      <span class="tag">for Server Operators</span>
      <p>GeyserMC / Floodgateの自動更新を行う「geyseruploder」をはじめ、サーバー運営を支えるプラグインを開発しています。</p>
    </div>
    <div class="link-tiles" data-reveal style="--d:1">
      <a class="link-tile" href="https://github.com/grampr/geyseruploader" target="_blank" rel="noopener noreferrer"><span><small>GITHUB</small>geyseruploder</span><span class="btn__arrow" aria-hidden="true">↗</span></a>
      <a class="link-tile" href="https://github.com/grampr?tab=repositories" target="_blank" rel="noopener noreferrer"><span><small>GITHUB</small>その他のプロジェクト</span><span class="btn__arrow" aria-hidden="true">↗</span></a>
      <a class="link-tile" href="<?php echo esc_url(nehaverse_page_url('contact')); ?>"><span><small>WORK</small>お仕事の開発依頼もお気軽にご相談ください。</span><span class="btn__arrow" aria-hidden="true">→</span></a>
    </div>
  </article>
</section>
<?php
get_footer();
