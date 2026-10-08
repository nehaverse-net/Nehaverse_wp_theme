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
$pyramid = $dungeons[0];

get_header();
?>
<section class="nv-cover">
    <img class="nv-cover__image" src="<?php echo nehaverse_world_image('pyramid-exterior'); ?>" alt="砂漠のピラミッド" width="1600" height="841">
    <div class="nv-cover__inner">
        <h1 class="nv-cover__title">ダンジョン</h1>
        <p class="nv-cover__text">資源サーバーにあるダンジョンと、敵の強さのまとめです。</p>
    </div>
</section>

<section class="nv-page">
    <h2 class="nv-page__heading">敵のレベル</h2>
    <p>資源サーバーでは、自然に湧く敵の一部に Lv が付きます。場所によって強さが変わります。</p>

    <div class="nv-xp" role="img" aria-label="普通の場所は Lv1 から 15、砂漠や深い場所は Lv35 から 60">
        <div class="nv-xp__track">
            <span class="nv-xp__band nv-xp__band--low" style="left: 0; width: 23.7%"></span>
            <span class="nv-xp__band nv-xp__band--high" style="left: 57.6%; width: 42.4%"></span>
        </div>
        <div class="nv-xp__labels">
            <span style="left: 0"><span class="nv-nameplate"><b class="nv-nameplate__lv nv-nameplate__lv--low">Lv1–15</b> 普通の場所</span></span>
            <span style="left: 57.6%"><span class="nv-nameplate"><b class="nv-nameplate__lv nv-nameplate__lv--high">Lv35–60</b> 砂漠・深い場所</span></span>
        </div>
    </div>

    <ul class="nv-page__list">
        <li>洞窟では敵が多めに湧きます。</li>
        <li>野生の動物がプレイヤーに体当たりしてきます。</li>
        <li>敵や宝箱から、武器・部品・専用素材が手に入ります。</li>
    </ul>
</section>

<section class="nv-page">
    <h2 class="nv-page__heading"><?php echo esc_html($pyramid['name']); ?></h2>
    <p><?php echo esc_html($pyramid['text']); ?></p>
    <div class="nv-mosaic">
        <?php foreach ($pyramid['images'] as $i => $image) : ?>
            <img src="<?php echo nehaverse_world_image($image, $i > 0); ?>" alt="ピラミッドの<?php echo $i === 0 ? '外観' : '内部'; ?>" loading="lazy">
        <?php endforeach; ?>
    </div>
</section>

<section class="nv-page">
    <h2 class="nv-page__heading">ほかのダンジョン</h2>
    <dl class="nv-rows">
        <?php foreach (array_slice($dungeons, 1) as $dungeon) : ?>
            <div>
                <dt><?php echo esc_html($dungeon['name']); ?></dt>
                <dd><?php echo esc_html($dungeon['text']); ?></dd>
            </div>
        <?php endforeach; ?>
    </dl>
    <p class="nv-page__aside">資源サーバーには、ロビーのゲートから行けます。サーバーの説明は<a href="<?php echo esc_url(home_url('/#server-resource')); ?>">トップページ</a>にあります。</p>
</section>
<?php
get_footer();
