<?php
/**
 * Template for the ABYSS TIDE page (slug: abyss-tide).
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

$pv_url = (string) get_theme_mod('nehaverse_abyss_pv_url', '');
$tiers = nehaverse_abyss_enemies();
$stages = nehaverse_abyss_stages();
$tier_class = ['ノーマル' => 'normal', 'ハード' => 'hard', 'ナイトメア' => 'nightmare'];

get_header();
?>
<div class="nv-abyss">
    <section class="nv-abyss__hero">
        <h1 class="nv-abyss-logo nv-abyss__title">ABYSS TIDE</h1>
        <p class="nv-abyss__kana">アビスタイド</p>
        <div class="nv-abyss__pv">
            <?php if ($pv_url !== '' && preg_match('~(?:youtu\.be/|youtube\.com/(?:watch\?v=|embed/))([\w-]{11})~', $pv_url, $match)) : ?>
                <iframe src="<?php echo esc_url('https://www.youtube-nocookie.com/embed/' . $match[1]); ?>" title="ABYSS TIDE PV" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen loading="lazy"></iframe>
            <?php elseif ($pv_url !== '') : ?>
                <video src="<?php echo esc_url($pv_url); ?>" poster="<?php echo nehaverse_world_image('abyss-poster'); ?>" controls playsinline preload="none"></video>
            <?php else : ?>
                <img src="<?php echo nehaverse_world_image('abyss-poster'); ?>" alt="ABYSS TIDE タイトル">
            <?php endif; ?>
        </div>
        <p class="nv-abyss__intro">PvP サーバーで遊べるウェーブ戦です。最大4人でチームを組んで、押し寄せる敵の波を耐えきります。1ウェーブは100秒で、基本は3ウェーブ。耐えきると追加ウェーブがあります。</p>
    </section>

    <section class="nv-abyss__section">
        <h2>遊び方</h2>
        <ol class="nv-abyss__flow">
            <li>PvP サーバーのロビーで仲間と集まる。初めての人にはイントロとチュートリアルがあります。</li>
            <li>3つのウェーブを耐える。1ウェーブ100秒です。</li>
            <li>余裕があれば追加ウェーブへ。</li>
            <li>最後にスコアボードで結果を見る。</li>
        </ol>
    </section>

    <section class="nv-abyss__section">
        <h2>ステージ</h2>
        <p class="nv-abyss__stages">
            <?php foreach ($stages as $stage) : ?>
                <span><?php echo esc_html($stage['name']); ?></span>
            <?php endforeach; ?>
        </p>
    </section>

    <section class="nv-abyss__section nv-abyss__enemies">
        <div>
            <h2>敵</h2>
            <p>強さはノーマル、ハード、ナイトメアの3段階です。</p>
            <div class="nv-abyss__plates">
                <?php foreach ($tiers as $tier => $names) : ?>
                    <?php foreach ($names as $name) : ?>
                        <span class="nv-mob nv-mob--<?php echo esc_attr($tier_class[$tier] ?? 'normal'); ?>">
                            <span class="nv-mob__name"><?php echo esc_html($name); ?></span>
                            <span class="nv-mob__tier"><?php echo esc_html($tier); ?></span>
                        </span>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <img class="nv-abyss__shot" src="<?php echo nehaverse_world_image('abyss-bestiary'); ?>" alt="ABYSS TIDE の敵が並ぶホール" loading="lazy" width="1600" height="841">
    </section>

    <section class="nv-abyss__section nv-abyss__end">
        <p><code>mc.nehaverse.net</code> に入って、ロビーから PvP サーバーへ。仲間は <a href="https://discord.gg/P4edaExrR4" target="_blank" rel="noopener noreferrer">Discord</a> で探せます。</p>
    </section>
</div>
<?php
get_footer();
