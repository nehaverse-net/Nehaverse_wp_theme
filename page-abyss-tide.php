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

get_header();
?>
<div class="nv-abyss">
    <section class="nv-abyss__hero">
        <div class="nv-abyss__particles" aria-hidden="true"></div>
        <div class="nv-abyss__hero-inner">
            <p class="nv-abyss__kicker animate-fade-up">MINECRAFT // WAVE SURVIVAL</p>
            <h1 class="nv-abyss-logo nv-abyss__title animate-fade-up" style="animation-delay: 0.1s">ABYSS TIDE</h1>
            <p class="nv-abyss__kana animate-fade-up" style="animation-delay: 0.15s">アビスタイド</p>
            <p class="nv-abyss__lead animate-fade-up" style="animation-delay: 0.2s">その波を、越えろ。</p>
            <div class="nv-abyss__pv animate-fade-up" style="animation-delay: 0.3s">
                <?php if ($pv_url !== '' && preg_match('~(?:youtu\.be/|youtube\.com/(?:watch\?v=|embed/))([\w-]{11})~', $pv_url, $match)) : ?>
                    <iframe src="<?php echo esc_url('https://www.youtube-nocookie.com/embed/' . $match[1]); ?>" title="ABYSS TIDE PV" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen loading="lazy"></iframe>
                <?php elseif ($pv_url !== '') : ?>
                    <video src="<?php echo esc_url($pv_url); ?>" poster="<?php echo nehaverse_world_image('abyss-poster'); ?>" controls playsinline preload="none"></video>
                <?php else : ?>
                    <img src="<?php echo nehaverse_world_image('abyss-poster'); ?>" alt="ABYSS TIDE タイトル">
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="nv-abyss__section reveal-on-scroll">
        <div class="nv-abyss__specs">
            <div><strong>4</strong><span>最大人数</span></div>
            <div><strong>3</strong><span>基本ウェーブ</span></div>
            <div><strong>100<small>秒</small></strong><span>1ウェーブ</span></div>
            <div><strong>+α</strong><span>追加ウェーブ</span></div>
        </div>
        <p class="nv-abyss__intro">PvP サーバーで遊べるウェーブ戦闘モードです。仲間と最大4人でチームを組み、押し寄せる敵の波を迎え撃ちます。武器とスキル、アルティメットを組み合わせて、最後まで生き残りましょう。</p>
    </section>

    <section class="nv-abyss__section reveal-on-scroll">
        <header class="nv-abyss__heading">
            <span>HOW TO PLAY</span>
            <h2>ゲームの流れ</h2>
        </header>
        <ol class="nv-abyss__flow">
            <li><span>01</span><strong>ロビーに集合</strong><p>PvP サーバーのロビーで仲間と合流します。</p></li>
            <li><span>02</span><strong>イントロ</strong><p>初めての人にはイントロとチュートリアルがあります。</p></li>
            <li><span>03</span><strong>3つのウェーブ</strong><p>1ウェーブ 100 秒。押し寄せる敵を倒し切ろう。</p></li>
            <li><span>04</span><strong>追加ウェーブ</strong><p>まだ戦える？さらに強い波が待っています。</p></li>
            <li><span>05</span><strong>スコア</strong><p>スコアボードで結果を確認します。</p></li>
        </ol>
    </section>

    <section class="nv-abyss__section reveal-on-scroll">
        <header class="nv-abyss__heading">
            <span>STAGES</span>
            <h2>ステージ</h2>
        </header>
        <ul class="nv-abyss__stages">
            <?php foreach ($stages as $i => $stage) : ?>
                <li><span class="nv-abyss__stage-no"><?php echo esc_html(sprintf('%02d', $i + 1)); ?></span><strong><?php echo esc_html($stage['name']); ?></strong><span class="nv-abyss__stage-en"><?php echo esc_html($stage['en']); ?></span></li>
            <?php endforeach; ?>
        </ul>
    </section>

    <section class="nv-abyss__section reveal-on-scroll">
        <header class="nv-abyss__heading">
            <span>ENEMIES</span>
            <h2>押し寄せる敵たち</h2>
        </header>
        <div class="nv-abyss__enemies">
            <figure class="nv-abyss__shot">
                <img src="<?php echo nehaverse_world_image('abyss-bestiary'); ?>" alt="ABYSS TIDE の敵が並ぶ展示ホール" loading="lazy" width="1600" height="841">
            </figure>
            <div class="nv-abyss__tiers">
                <?php foreach ($tiers as $tier => $names) : ?>
                    <div class="nv-abyss__tier nv-abyss__tier--<?php echo esc_attr(['ノーマル' => 'normal', 'ハード' => 'hard', 'ナイトメア' => 'nightmare'][$tier] ?? 'normal'); ?>">
                        <h3><?php echo esc_html($tier); ?></h3>
                        <ul>
                            <?php foreach ($names as $name) : ?>
                                <li><?php echo esc_html($name); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="nv-abyss__section reveal-on-scroll">
        <div class="nv-abyss__duo">
            <img src="<?php echo nehaverse_world_image('abyss-lobby', true); ?>" alt="ABYSS TIDE のロビー" loading="lazy" width="800" height="420">
            <img src="<?php echo nehaverse_world_image('abyss-hall', true); ?>" alt="ABYSS TIDE のホール" loading="lazy" width="800" height="420">
        </div>
        <div class="nv-abyss__cta">
            <h2>DIVE INTO THE NEXT WAVE</h2>
            <p><code>mc.nehaverse.net</code> に接続して、PvP サーバーへ。</p>
            <a class="btn btn-primary" href="https://discord.gg/P4edaExrR4" target="_blank" rel="noopener noreferrer">Discordで仲間を探す</a>
        </div>
    </section>
</div>
<?php
get_footer();
