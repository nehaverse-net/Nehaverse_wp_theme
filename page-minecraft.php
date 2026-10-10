<?php
/**
 * Template for the minecraft page (slug: minecraft).
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
    <p class="eyebrow" data-reveal>Minecraft Server</p>
    <h1 id="page-title" class="page-hero__title" data-split>neha鯖へようこそ</h1>
    <p class="page-hero__lead" data-reveal style="--d:3">自由度の高いワールドで、あなたの物語をつくろう。</p>
    <div class="btn-row mc-hero__actions" data-reveal style="--d:4">
      <button class="copy-chip" type="button" data-copy-text="mc.nehaverse.net" aria-label="サーバーアドレス mc.nehaverse.net をコピー"><span class="copy-chip__label">SERVER IP</span><span>mc.nehaverse.net</span><span class="copy-chip__action">COPY</span></button>
      <a class="btn btn-primary" data-magnetic href="<?php echo esc_url(NEHAVERSE_DISCORD_URL); ?>" target="_blank" rel="noopener noreferrer">Discordで参加する <span class="btn__arrow" aria-hidden="true">→</span></a>
    </div>
    <div class="page-hero__meta" data-reveal style="--d:5"><span>Java Edition / Latest</span><span>3 Worlds</span><span>map.nehaverse.net</span></div>
  </div>
  <p class="page-hero__ghost" aria-hidden="true">Minecraft</p>
</section>

<section class="mc-banner" aria-label="neha鯖のポータル広場">
  <figure class="media hud" data-reveal="wipe"><img src="<?php echo nehaverse_asset('images/server-portals.webp'); ?>" alt="neha鯖の各サーバーへつながるポータルが並ぶ広場" width="1920" height="1009" loading="lazy"></figure>
  <p class="media-caption"><span>Hub / Portal Square</span><span>Nehaverse / In-game</span></p>
</section>

<section class="section" aria-labelledby="about-title">
  <div class="section-head" data-reveal>
    <div>
      <p class="eyebrow">About</p>
      <h2 id="about-title">neha鯖とは？</h2>
    </div>
    <p>neha鯖は、自由な建築とサバイバル、そしてコミュニティを大切にするMinecraftサーバーです。初心者からベテランまで楽しめる環境を整えています。</p>
  </div>
  <div class="grid-3">
    <div class="card" data-reveal style="--d:0">
      <span class="card__num">01 / Style</span>
      <h3>プレイスタイル</h3>
      <ul class="list-dash">
        <li>サバイバルと建築を両立</li>
        <li>経済システムで取引も可能</li>
        <li>季節イベントも不定期開催</li>
      </ul>
    </div>
    <div class="card" data-reveal style="--d:1">
      <span class="card__num">02 / Version</span>
      <h3>対応バージョン</h3>
      <p>Java版の最新推奨バージョン。詳細はDiscord内の案内チャンネルをご確認ください。</p>
    </div>
    <div class="card" data-reveal style="--d:2">
      <span class="card__num">03 / Vibe</span>
      <h3>サーバーの雰囲気</h3>
      <p>アットホームで協力的。建築のスクショ共有や企画持ち込みも大歓迎です。</p>
    </div>
  </div>
</section>

<section class="mc-worlds" aria-labelledby="minecraft-worlds-title">
  <div class="mc-worlds__head" data-reveal>
    <p class="eyebrow">Explore the Worlds</p>
    <h2 id="minecraft-worlds-title" class="section-title">3つのサーバーで広がる遊び方</h2>
    <nav class="mc-worlds__nav" aria-label="サーバー紹介">
      <a href="#resource-server"><span>01</span>資源サーバー</a>
      <a href="#survival-server"><span>02</span>サバイバルサーバー</a>
      <a href="#pvp-server"><span>03</span>PvPサーバー</a>
    </nav>
  </div>

  <article class="mc-world" id="resource-server" aria-labelledby="resource-server-title">
    <header class="mc-world__header" data-reveal>
      <span class="mc-world__num" aria-hidden="true">01</span>
      <div>
        <p class="eyebrow">Resource</p>
        <h2 id="resource-server-title">資源サーバー</h2>
        <div class="mc-world__tags" aria-label="遊びの特徴"><span>ダンジョン</span><span>オリジナル武器</span><span>冒険</span></div>
      </div>
    </header>
    <figure class="mc-world__visual">
      <div class="media hud" data-reveal="wipe"><img src="<?php echo nehaverse_asset('images/resource-dungeon.webp'); ?>" alt="強敵が待ち受ける資源サーバーのダンジョン" width="1920" height="1009" loading="lazy"></div>
      <figcaption class="media-caption"><span>01 / Resource</span><span>Nehaverse / In-game</span></figcaption>
    </figure>
    <div class="mc-world__content">
      <p class="mc-world__lead" data-reveal>未知の敵、強力な武器、そして各地に眠るダンジョン。新たな冒険が君を待っている！</p>
      <div class="mc-world__body" data-reveal style="--d:1">
        <p>資源サーバーでは、従来のバニラサーバーとは一味違う、数多くの強敵やオリジナル武器が登場！</p>
        <p>通常のサバイバルよりも攻略難易度は高いものの、その分報酬も豪華！ サバイバルサーバーではクラフトできない、貴重な素材やレアアイテムを手に入れることができるぞ！</p>
        <p>さらに、世界各地には個性豊かなダンジョンが点在しており、既存の装備だけでは太刀打ちできない強敵も待ち受けている。</p>
        <p>ここでしか手に入らない特別な武器を集め、強化しながら、未知のダンジョンを攻略しよう！</p>
      </div>
    </div>
  </article>

  <article class="mc-world" id="survival-server" aria-labelledby="survival-server-title">
    <header class="mc-world__header" data-reveal>
      <span class="mc-world__num" aria-hidden="true">02</span>
      <div>
        <p class="eyebrow">Survival</p>
        <h2 id="survival-server-title">サバイバルサーバー</h2>
        <div class="mc-world__tags" aria-label="遊びの特徴"><span>建築・経済</span><span>nehaca</span><span>釣り・仕事</span></div>
      </div>
    </header>
    <figure class="mc-world__visual">
      <div class="media hud" data-reveal="wipe"><img src="<?php echo nehaverse_asset('images/survival-market.webp'); ?>" alt="サバイバルサーバーの街角と素材の店先" width="1920" height="1009" loading="lazy"></div>
      <figcaption class="media-caption"><span>02 / Survival</span><span>Nehaverse / In-game</span></figcaption>
    </figure>
    <div class="mc-world__content">
      <p class="mc-world__lead" data-reveal>建築、経済、交通、仕事。自分だけの生活をこの世界で始めよう！</p>
      <div class="mc-world__body" data-reveal style="--d:1">
        <p>サバイバルサーバーでは、通常のマインクラフトに加え、さまざまな独自要素を楽しむことができるぞ！</p>
        <p>この世界で豊かな生活を送るには、お金が欠かせない！</p>
        <p>移動手段として列車が運行しており、乗車するには専用の交通カード「nehaca」が必要だ！ カードを使って列車に乗り、広大な世界を旅してみよう！</p>
        <p>さらに、釣りでは見たこともない珍しい魚が釣れたり、自分に合った仕事を選んでお金を稼げるシステムも用意されているぞ！</p>
        <p>稼いだお金を使って便利なアイテムを手に入れたり、さまざまな機能を活用したりすることで、サバイバル生活はもっと快適に！</p>
        <p>働くもよし、冒険するもよし、建築に没頭するもよし。自分だけの自由な暮らしを楽しもう！</p>
      </div>
    </div>
  </article>

  <article class="mc-world" id="pvp-server" aria-labelledby="pvp-server-title">
    <header class="mc-world__header" data-reveal>
      <span class="mc-world__num" aria-hidden="true">03</span>
      <div>
        <p class="eyebrow">PvP</p>
        <h2 id="pvp-server-title">PvPサーバー</h2>
        <div class="mc-world__tags" aria-label="遊びの特徴"><span>Abyss Tide</span><span>最大4人</span><span>ランキング</span></div>
      </div>
    </header>
    <figure class="mc-world__visual">
      <div class="media hud" data-reveal="wipe"><img src="<?php echo nehaverse_asset('images/abyss-enemies.webp'); ?>" alt="Abyss Tideに登場する個性豊かな敵たち" width="1920" height="1009" loading="lazy"></div>
      <figcaption class="media-caption"><span>03 / PvP</span><span>Nehaverse / In-game</span></figcaption>
    </figure>
    <div class="mc-world__content">
      <p class="mc-world__lead" data-reveal>仲間と挑め、限界を超えろ！ 「Abyss Tide（アビスタイド）」で生き残れ！</p>
      <div class="mc-world__body" data-reveal style="--d:1">
        <p>PvPサーバーでは、制限時間内に次々と現れる敵を倒しながら生き残る、バトルコンテンツ「Abyss Tide」に挑戦できるぞ！</p>
        <p>最大4人までチームを組めるため、一人で腕試しをするのも、友達と協力して強敵に立ち向かうのも自由！</p>
        <p>Abyss Tideで獲得したコインや素材は、資源サーバーでの装備強化などにも活用できる！ 戦いを重ねて報酬を集め、さらなる強さを目指そう！</p>
        <p>さらに、プレイ結果はスコアとして記録され、シーズンごとのランキングでほかのプレイヤーと競い合うことができるぞ！</p>
        <p>シーズン上位に入賞したプレイヤーには特別な報酬も用意！</p>
        <p>己の限界に挑戦し、仲間とともにシーズンランキング1位の座をつかみ取れ！</p>
      </div>
    </div>
  </article>
</section>

<section class="section" aria-labelledby="connect-title">
  <div class="connect">
    <div class="connect__info card" data-reveal>
      <p class="eyebrow">Connect</p>
      <h2 id="connect-title">サーバー接続情報</h2>
      <p>下記アドレスをMinecraftに設定してアクセスしてください。</p>
      <dl class="connect__list">
        <div><dt>メインサーバー</dt><dd><button class="copy-chip" type="button" data-copy-text="mc.nehaverse.net" aria-label="サーバーアドレス mc.nehaverse.net をコピー"><span>mc.nehaverse.net</span><span class="copy-chip__action">COPY</span></button></dd></div>
        <div><dt>ダイナマップ</dt><dd><a class="text-link" href="https://map.nehaverse.net" target="_blank" rel="noopener noreferrer">map.nehaverse.net <span class="btn__arrow" aria-hidden="true">↗</span></a></dd></div>
      </dl>
    </div>
    <div class="connect__cta" data-reveal style="--d:1">
      <p class="connect__cta-label">Before you join</p>
      <p class="connect__cta-text">参加前にDiscordでルールチェックをお願いします。</p>
      <a class="btn btn-light" data-magnetic href="<?php echo esc_url(NEHAVERSE_DISCORD_URL); ?>" target="_blank" rel="noopener noreferrer">Discordでルールを確認 <span class="btn__arrow" aria-hidden="true">→</span></a>
    </div>
  </div>
</section>
<?php
get_footer();
