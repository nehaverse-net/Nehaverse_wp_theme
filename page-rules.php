<?php
/**
 * Template for the rules page (slug: rules).
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
    <p class="eyebrow" data-reveal>Guidelines</p>
    <h1 id="page-title" class="page-hero__title" data-split>コミュニティルール</h1>
    <p class="page-hero__lead" data-reveal style="--d:3">みんなが安心して楽しめるよう、以下のルールへのご協力をお願いします。</p>
  </div>
  <p class="page-hero__ghost" aria-hidden="true">Rules</p>
</section>

<section class="section" aria-labelledby="policy-title">
  <div class="section-head section-head--stack" data-reveal>
    <p class="eyebrow">Policy</p>
    <h2 id="policy-title">基本方針</h2>
  </div>
  <div class="rules-grid">
    <div class="card" data-reveal style="--d:0">
      <span class="card__num">01 / Respect</span>
      <h3>尊重と礼儀</h3>
      <p>サーバー全体で礼儀正しく振る舞い、他のメンバーを尊重しましょう。</p>
    </div>
    <div class="card" data-reveal style="--d:1">
      <span class="card__num">02 / Prohibited</span>
      <h3>禁止事項</h3>
      <ul class="list-dash">
        <li>不適切な画像の投稿、発言、スパム</li>
        <li>差別、ハラスメント、迷惑行為</li>
        <li>デマ、詐欺、ウイルスサイトへの誘導</li>
        <li>個人情報の漏洩、なりすまし（架空キャラは除く）</li>
        <li>その他、法律やDiscord規約に抵触する行為</li>
      </ul>
    </div>
    <div class="card" data-reveal style="--d:2">
      <span class="card__num">03 / Reference</span>
      <h3>参考リンク</h3>
      <ul class="list-dash">
        <li><a href="https://discord.com/terms" target="_blank" rel="noopener noreferrer">Discord サービス利用規約</a></li>
        <li><a href="https://discord.com/guidelines" target="_blank" rel="noopener noreferrer">Discord コミュニティガイドライン</a></li>
      </ul>
    </div>
  </div>
</section>

<div class="marquee marquee--dark" aria-hidden="true">
  <div class="marquee__track">
    <ul class="marquee__list"><li>Respect</li><li>Be kind</li><li>Play fair</li><li>Respect</li><li>Be kind</li><li>Play fair</li></ul>
    <ul class="marquee__list"><li>Respect</li><li>Be kind</li><li>Play fair</li><li>Respect</li><li>Be kind</li><li>Play fair</li></ul>
  </div>
</div>

<section class="section" aria-labelledby="join-title">
  <div class="section-head" data-reveal>
    <div>
      <p class="eyebrow">How to join</p>
      <h2 id="join-title">参加方法</h2>
    </div>
    <p>ルールを読まれた方はDiscordルールチャンネルでリアクションを押してください。アクセス権限が付与されます。</p>
  </div>
  <ol class="steps">
    <li class="card" data-reveal style="--d:0"><span class="card__num">Step</span><h3>Discordに参加</h3><p>コミュニティサーバーに参加します。</p></li>
    <li class="card" data-reveal style="--d:1"><span class="card__num">Step</span><h3>ルールを確認</h3><p>このページとDiscordのルールチャンネルを読みます。</p></li>
    <li class="card" data-reveal style="--d:2"><span class="card__num">Step</span><h3>リアクションで参加完了</h3><p>ルールチャンネルでリアクションを押すと、アクセス権限が付与されます。</p></li>
  </ol>
</section>

<section class="section section--tight" aria-labelledby="notice-title">
  <div class="section-head section-head--stack" data-reveal>
    <p class="eyebrow">Notice</p>
    <h2 id="notice-title">注意事項</h2>
  </div>
  <p class="note" data-reveal>参加者が写っている写真などの扱いは、ご自身の責任でお願いします。万が一の際、運営では責任を負いかねます。</p>
  <div class="notice-box" data-reveal>
    <p>neha鯖へようこそ！<br>ルールを読まれた方はDiscordルールチャンネルでリアクションを押してください。アクセス権限が付与されます。</p>
    <a class="btn btn-primary" data-magnetic href="<?php echo esc_url(NEHAVERSE_DISCORD_URL); ?>" target="_blank" rel="noopener noreferrer">Discordルールチャンネルへ <span class="btn__arrow" aria-hidden="true">→</span></a>
  </div>
</section>
<?php
get_footer();
