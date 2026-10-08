<?php
/**
 * Template for the dungeons page (slug: dungeons).
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

$dungeons = nehaverse_dungeons();

get_header();
?>
<section class="nv-cover">
    <img class="nv-cover__image" src="<?php echo nehaverse_world_image('pyramid-exterior'); ?>" alt="砂漠にそびえるピラミッド" width="1600" height="841">
    <div class="nv-cover__inner">
        <span class="nv-eyebrow animate-fade-up">Resource Server / Dungeons</span>
        <h1 class="nv-cover__title animate-fade-up" style="animation-delay: 0.1s">ダンジョンガイド</h1>
        <p class="nv-cover__text animate-fade-up" style="animation-delay: 0.2s">資源サーバーには、独自の地形の中にダンジョンが眠っています。レベル付きの敵を倒し、宝箱から武器や素材を集めましょう。</p>
    </div>
</section>

<section class="nv-section nv-section--tight reveal-on-scroll">
    <div class="nv-levels">
        <div class="nv-levels__head">
            <span class="nv-eyebrow">Enemy Level</span>
            <h2>敵の強さは場所で変わる</h2>
            <p>自然に湧く敵の一部が、レベル付きの強化された敵に置き換わります。</p>
        </div>
        <div class="nv-levels__meter" role="img" aria-label="通常の地域は Lv1 から 15、砂漠や深い地域は Lv35 から 60">
            <div class="nv-levels__track">
                <span class="nv-levels__band nv-levels__band--low" style="left: 0; width: 23.7%"></span>
                <span class="nv-levels__band nv-levels__band--high" style="left: 57.6%; width: 42.4%"></span>
            </div>
            <div class="nv-levels__labels">
                <div style="left: 0"><strong>Lv1–15</strong><span>通常の地域</span></div>
                <div style="left: 57.6%"><strong>Lv35–60</strong><span>砂漠・深い地域</span></div>
            </div>
            <div class="nv-levels__scale" aria-hidden="true"><span style="left: 0">1</span><span style="left: 23.7%">15</span><span style="left: 57.6%">35</span><span style="left: 100%">60</span></div>
        </div>
        <ul class="nv-hazards">
            <li><i class="fa-solid fa-dungeon" aria-hidden="true"></i><strong>洞窟は危険地帯</strong><span>洞窟では追加の敵が湧きます。</span></li>
            <li><i class="fa-solid fa-cow" aria-hidden="true"></i><strong>野生動物にも注意</strong><span>動物がプレイヤーに体当たりしてきます。</span></li>
            <li><i class="fa-solid fa-gem" aria-hidden="true"></i><strong>報酬</strong><span>敵や宝箱から武器、部品、専用素材が手に入ります。</span></li>
        </ul>
    </div>
</section>

<section class="nv-section">
    <header class="nv-heading reveal-on-scroll">
        <span class="nv-eyebrow">Dungeons</span>
        <h2>ダンジョン一覧</h2>
    </header>

    <?php $feature = $dungeons[0]; ?>
    <article class="nv-dungeon-feature reveal-on-scroll">
        <div class="nv-dungeon-feature__gallery">
            <?php foreach ($feature['images'] as $i => $image) : ?>
                <img src="<?php echo nehaverse_world_image($image, $i > 0); ?>" alt="<?php echo esc_attr($feature['name']); ?>の様子" loading="lazy">
            <?php endforeach; ?>
        </div>
        <div class="nv-dungeon-feature__body">
            <p class="nv-tag"><i class="fa-solid <?php echo esc_attr($feature['icon']); ?>" aria-hidden="true"></i><?php echo esc_html($feature['area']); ?></p>
            <h3><?php echo esc_html($feature['name']); ?></h3>
            <p><?php echo esc_html($feature['text']); ?></p>
            <?php nehaverse_nehal_says('砂漠の敵は Lv35 から。準備してから入ろうね。'); ?>
        </div>
    </article>

    <div class="nv-dungeons">
        <?php foreach (array_slice($dungeons, 1) as $dungeon) : ?>
            <article class="nv-dungeon reveal-on-scroll">
                <span class="nv-dungeon__icon"><i class="fa-solid <?php echo esc_attr($dungeon['icon']); ?>" aria-hidden="true"></i></span>
                <?php if ($dungeon['area'] !== '') : ?>
                    <p class="nv-tag"><?php echo esc_html($dungeon['area']); ?></p>
                <?php endif; ?>
                <h3><?php echo esc_html($dungeon['name']); ?></h3>
                <p><?php echo esc_html($dungeon['text']); ?></p>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="nv-section nv-section--tight reveal-on-scroll">
    <div class="nv-banner">
        <div>
            <h2>資源サーバーへ行くには</h2>
            <p><code>mc.nehaverse.net</code> に接続したら、ロビーのゲートから資源サーバーへ移動できます。</p>
        </div>
        <a class="btn btn-primary" href="<?php echo esc_url(home_url('/#server-resource')); ?>">資源サーバーの説明へ</a>
    </div>
</section>
<?php
get_footer();
