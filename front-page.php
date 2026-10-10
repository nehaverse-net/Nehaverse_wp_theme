<?php
/**
 * Front page template.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<section class="hero" data-hero aria-labelledby="home-title">
  <div class="hero__media">
    <img src="<?php echo nehaverse_asset('images/minecraft.webp'); ?>" alt="neha鯖の大きな建築が並ぶ街並み" width="1600" height="841" fetchpriority="high">
  </div>
  <div class="hero__content">
    <div class="hero__inner">
      <p class="eyebrow hero__eyebrow">Nehaverse — Build · Play · Connect</p>
      <h1 id="home-title" class="hero__title" data-split>技術で楽しめる<br>コンテンツを。</h1>
      <p class="hero__lead">自由に遊ぶ、つくる、つながる。<br>MinecraftとDiscordから広がる、自分たちだけの世界。</p>
      <div class="hero__actions btn-row">
        <a class="btn btn-primary" data-magnetic href="<?php echo esc_url(NEHAVERSE_DISCORD_URL); ?>" target="_blank" rel="noopener noreferrer">Discordで参加する <span class="btn__arrow" aria-hidden="true">→</span></a>
        <a class="btn btn-ghost" href="<?php echo esc_url(nehaverse_page_url('minecraft')); ?>">Minecraftサーバーを見る <span class="btn__arrow" aria-hidden="true">→</span></a>
      </div>
      <button class="copy-chip hero__ip" type="button" data-copy-text="mc.nehaverse.net" aria-label="サーバーアドレス mc.nehaverse.net をコピー"><span class="copy-chip__label">SERVER IP</span><span>mc.nehaverse.net</span><span class="copy-chip__action">COPY</span></button>
    </div>
    <div class="hero__bar" aria-hidden="true">
      <span>NEHA SERVER / PLAYER-BUILT WORLD</span>
      <span class="hero__scroll">SCROLL<i></i></span>
    </div>
  </div>
</section>

<div class="marquee" aria-hidden="true">
  <div class="marquee__track">
    <ul class="marquee__list"><li>Build</li><li>Play</li><li>Connect</li><li>neha鯖</li><li>Survival</li><li>Dungeon</li><li>Abyss Tide</li><li>Community</li></ul>
    <ul class="marquee__list"><li>Build</li><li>Play</li><li>Connect</li><li>neha鯖</li><li>Survival</li><li>Dungeon</li><li>Abyss Tide</li><li>Community</li></ul>
  </div>
</div>

<?php nehaverse_render_news_section(); ?>

<section class="stats" aria-label="Nehaverseの数字">
  <dl class="stats__grid">
    <div class="stats__item" data-reveal style="--d:0"><dt>サーバー</dt><dd><span data-count="3">3</span><small>Worlds</small></dd></div>
    <div class="stats__item" data-reveal style="--d:1"><dt>Bot導入累計</dt><dd><span data-count="10" data-suffix="K+">10K+</span><small>Installs</small></dd></div>
    <div class="stats__item" data-reveal style="--d:2"><dt>Abyss Tide 最大チーム</dt><dd><span data-count="4">4</span><small>Players</small></dd></div>
    <div class="stats__item" data-reveal style="--d:3"><dt>対応バージョン</dt><dd><span>Java</span><small>Latest</small></dd></div>
  </dl>
</section>

<section class="worlds" data-hscroll aria-labelledby="worlds-title">
  <div class="worlds__sticky">
    <div class="worlds__head">
      <div data-reveal>
        <p class="eyebrow">Explore the Worlds</p>
        <h2 id="worlds-title" class="section-title">3つのサーバーで<br>広がる遊び方</h2>
      </div>
      <p class="worlds__hint" aria-hidden="true"><span>Scroll</span><i></i></p>
    </div>
    <div class="worlds__viewport">
      <div class="worlds__track" data-hscroll-track>
        <article class="world-panel" data-reveal style="--d:0">
          <figure class="media hud"><img src="<?php echo nehaverse_asset('images/resource-dungeon.webp'); ?>" alt="強敵が待ち受ける資源サーバーのダンジョン" width="1920" height="1009" loading="lazy"></figure>
          <div class="world-panel__body">
            <span class="world-panel__num" aria-hidden="true">01</span>
            <div>
              <p class="world-panel__kicker">Resource</p>
              <h3>資源サーバー</h3>
              <p>未知の敵、強力な武器、そして各地に眠るダンジョン。新たな冒険が君を待っている！</p>
              <a class="text-link" href="<?php echo esc_url(nehaverse_page_url('minecraft') . '#resource-server'); ?>">詳しく見る <span class="btn__arrow" aria-hidden="true">→</span></a>
            </div>
          </div>
        </article>
        <article class="world-panel" data-reveal style="--d:1">
          <figure class="media hud"><img src="<?php echo nehaverse_asset('images/survival-market.webp'); ?>" alt="サバイバルサーバーの街角と素材の店先" width="1920" height="1009" loading="lazy"></figure>
          <div class="world-panel__body">
            <span class="world-panel__num" aria-hidden="true">02</span>
            <div>
              <p class="world-panel__kicker">Survival</p>
              <h3>サバイバルサーバー</h3>
              <p>建築、経済、交通、仕事。自分だけの生活をこの世界で始めよう！</p>
              <a class="text-link" href="<?php echo esc_url(nehaverse_page_url('minecraft') . '#survival-server'); ?>">詳しく見る <span class="btn__arrow" aria-hidden="true">→</span></a>
            </div>
          </div>
        </article>
        <article class="world-panel" data-reveal style="--d:2">
          <figure class="media hud"><img src="<?php echo nehaverse_asset('images/abyss-enemies.webp'); ?>" alt="Abyss Tideに登場する個性豊かな敵たち" width="1920" height="1009" loading="lazy"></figure>
          <div class="world-panel__body">
            <span class="world-panel__num" aria-hidden="true">03</span>
            <div>
              <p class="world-panel__kicker">PvP</p>
              <h3>PvPサーバー</h3>
              <p>仲間と挑め、限界を超えろ！ 「Abyss Tide（アビスタイド）」で生き残れ！</p>
              <a class="text-link" href="<?php echo esc_url(nehaverse_page_url('minecraft') . '#pvp-server'); ?>">詳しく見る <span class="btn__arrow" aria-hidden="true">→</span></a>
            </div>
          </div>
        </article>
        <a class="world-end" href="<?php echo esc_url(nehaverse_page_url('minecraft')); ?>">
          <span class="world-end__label">All Worlds</span>
          <span class="world-end__title">neha鯖の<br>すべてを見る</span>
          <span class="world-end__arrow" aria-hidden="true">→</span>
        </a>
      </div>
    </div>
    <div class="worlds__bar" aria-hidden="true"><span data-hscroll-bar></span></div>
  </div>
</section>

<section class="services" aria-labelledby="overview-title">
  <div class="section-head" data-reveal>
    <div>
      <p class="eyebrow">Overview</p>
      <h2 id="overview-title">ひと目でわかるNehaverse</h2>
    </div>
    <p>Nehaverseが提供する体験を、サービス、コミュニティ、プロダクト、サポートの4つの切り口から紹介します。</p>
  </div>

  <article class="service" id="minecraft">
    <div class="service__media">
      <figure class="media hud" data-reveal="wipe"><img src="<?php echo nehaverse_asset('images/server-portals.webp'); ?>" alt="neha鯖のポータルが並ぶ広場" width="1920" height="1009" loading="lazy"></figure>
      <span class="service__index" data-parallax="0.08" aria-hidden="true">01</span>
    </div>
    <div class="service__body" data-reveal>
      <p class="eyebrow">Minecraft Server</p>
      <h3>neha鯖で広がる<span class="nowrap">サバイバル</span> &amp; <span class="nowrap">建築体験</span></h3>
      <p>自由な建築とサバイバル、経済システムが共存するNehaverseのメインフィールド。仲間とともに理想の街づくりを楽しめます。</p>
      <ul class="list-dash"><li>対応バージョン: Java版 最新推奨</li><li>IP: mc.nehaverse.net</li><li>マップ: map.nehaverse.net</li></ul>
      <a class="text-link" href="<?php echo esc_url(nehaverse_page_url('minecraft')); ?>">Minecraftサーバーの詳細を見る <span class="btn__arrow" aria-hidden="true">→</span></a>
    </div>
  </article>

  <article class="service service--invert" id="community">
    <div class="service__media">
      <figure class="media hud" data-reveal="wipe"><img src="<?php echo nehaverse_asset('images/dis.webp'); ?>" alt="コミュニティで交流するイメージ" width="1600" height="1066" loading="lazy"></figure>
      <span class="service__index" data-parallax="0.08" aria-hidden="true">02</span>
    </div>
    <div class="service__body" data-reveal>
      <p class="eyebrow">Community</p>
      <h3>Discordでつながるコミュニティとサポート</h3>
      <p>イベント告知やアップデート共有、質問対応まですべてDiscordで完結。ルールチャンネルでリアクションするだけで参加準備は完了です。</p>
      <ul class="list-dash"><li>コミュニティ: discord.gg/P4edaExrR4</li><li>サポート: discord.gg/guYdDUxaBB</li><li>ルール確認とリアクションで権限付与</li></ul>
      <a class="text-link" href="<?php echo esc_url(nehaverse_page_url('rules')); ?>">ルールと参加方法を見る <span class="btn__arrow" aria-hidden="true">→</span></a>
    </div>
  </article>

  <article class="service" id="products">
    <div class="service__media">
      <figure class="media hud" data-reveal="wipe"><img src="<?php echo nehaverse_asset('images/cmd.webp'); ?>" alt="技術で支える運営ツールのイメージ" width="1600" height="1065" loading="lazy"></figure>
      <span class="service__index" data-parallax="0.08" aria-hidden="true">03</span>
    </div>
    <div class="service__body" data-reveal>
      <p class="eyebrow">Products</p>
      <h3>技術で支える運営ツール群</h3>
      <p>VoicemanegementをはじめとしたDiscord BotやMinecraftプラグインで、コミュニティ運営をよりスマートに。累計導入 10K+ の実績。</p>
      <ul class="list-dash"><li>ボイスチャットのログとロール連携</li><li>音声加工やメッセージ装飾など豊富な機能</li><li>GitHub: github.com/grampr</li></ul>
      <a class="text-link" href="<?php echo esc_url(nehaverse_page_url('products')); ?>">プロダクト一覧へ <span class="btn__arrow" aria-hidden="true">→</span></a>
    </div>
  </article>

  <article class="service service--invert" id="contact">
    <div class="service__media">
      <figure class="media hud" data-reveal="wipe"><img src="<?php echo nehaverse_asset('images/tool.webp'); ?>" alt="相談や依頼のイメージ" width="1600" height="841" loading="lazy"></figure>
      <span class="service__index" data-parallax="0.08" aria-hidden="true">04</span>
    </div>
    <div class="service__body" data-reveal>
      <p class="eyebrow">Contact</p>
      <h3>相談や依頼もお気軽に</h3>
      <p>Discordサポートサーバーで、開発依頼やコラボのご相談を受け付けています。運営メンバーへの応募フォームもご用意しています。</p>
      <ul class="list-dash"><li>サポートサーバーで質問や不具合報告</li><li>開発依頼・コラボのご相談に対応</li><li>運営メンバーへの応募フォーム</li></ul>
      <a class="text-link" href="<?php echo esc_url(nehaverse_page_url('contact')); ?>">お問い合わせ窓口を見る <span class="btn__arrow" aria-hidden="true">→</span></a>
    </div>
  </article>
</section>

<div class="marquee marquee--dark" aria-hidden="true">
  <div class="marquee__track">
    <ul class="marquee__list"><li>Join the verse</li><li>Nehaverse</li><li>mc.nehaverse.net</li><li>Join the verse</li><li>Nehaverse</li><li>mc.nehaverse.net</li></ul>
    <ul class="marquee__list"><li>Join the verse</li><li>Nehaverse</li><li>mc.nehaverse.net</li><li>Join the verse</li><li>Nehaverse</li><li>mc.nehaverse.net</li></ul>
  </div>
</div>

<?php get_template_part('template-parts/service-status'); ?>

<section class="cta-band" aria-labelledby="cta-title">
  <div class="cta-band__inner">
    <p class="eyebrow">Join Nehaverse</p>
    <h2 id="cta-title" data-split>今すぐ<br>Nehaverseの世界へ</h2>
    <p data-reveal>建築も、サバイバルも、コミュニティ運営も。Nehaverseなら、そのすべてを仲間と一緒に楽しめます。あなたの「やりたい」を教えてください。</p>
    <div class="btn-row" data-reveal style="--d:1">
      <a class="btn btn-primary" data-magnetic href="<?php echo esc_url(NEHAVERSE_DISCORD_URL); ?>" target="_blank" rel="noopener noreferrer">Discordで参加する <span class="btn__arrow" aria-hidden="true">→</span></a>
      <a class="btn btn-ghost" href="<?php echo esc_url(nehaverse_page_url('products')); ?>">ツールをチェック <span class="btn__arrow" aria-hidden="true">→</span></a>
    </div>
  </div>
</section>
<?php
get_footer();
