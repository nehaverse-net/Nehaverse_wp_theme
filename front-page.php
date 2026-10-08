<?php
/**
 * Front page template.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

$servers = nehaverse_servers();

$more = [
    [
        'title' => 'Discord',
        'text'  => '告知、質問、雑談はここで。ルールにリアクションすると参加できます。',
        'link'  => ['url' => home_url('/rules/'), 'label' => 'ルールと参加方法'],
    ],
    [
        'title' => 'プロダクト',
        'text'  => 'Voicemanegement などの Discord Bot と Minecraft プラグインを作っています。',
        'link'  => ['url' => home_url('/products/'), 'label' => 'プロダクト一覧'],
    ],
    [
        'title' => 'お問い合わせ',
        'text'  => '開発の依頼やコラボの相談は、サポートサーバーかフォームからどうぞ。',
        'link'  => ['url' => home_url('/contact/'), 'label' => 'お問い合わせ'],
    ],
];

get_header();
?>
<section class="nv-lobby">
    <img class="nv-lobby__image" src="<?php echo nehaverse_world_image('hub-lobby'); ?>" alt="neha鯖のロビー" width="1600" height="841">
    <div class="nv-lobby__inner">
        <h1 class="nv-lobby__title">neha鯖</h1>
        <p class="nv-lobby__text">Nehaverse の Minecraft Java 版サーバーです。<br>ロビーのゲートから、サバイバル・資源・PvP の3つのサーバーに行けます。</p>

        <div class="nv-serverlist" aria-label="サーバーアドレス">
            <img class="nv-serverlist__icon" src="<?php echo nehaverse_asset('images/logo.png'); ?>" alt="" width="56" height="56">
            <div class="nv-serverlist__body">
                <p class="nv-serverlist__name">neha鯖</p>
                <code class="nv-serverlist__address">mc.nehaverse.net</code>
            </div>
            <button class="nv-serverlist__copy" type="button" data-copy="mc.nehaverse.net">
                <span data-copy-label>コピー</span>
            </button>
        </div>
    </div>
</section>

<section class="nv-gates" aria-label="3つのサーバー">
    <?php foreach ($servers as $server) : ?>
        <a class="nv-gate nv-gate--<?php echo esc_attr($server['id']); ?>" href="#server-<?php echo esc_attr($server['id']); ?>">
            <img src="<?php echo nehaverse_world_image($server['image'], true); ?>" alt="" width="800" height="420">
            <span class="nv-gate__name"><?php echo esc_html($server['name']); ?></span>
            <span class="nv-gate__text"><?php echo esc_html($server['gate']); ?></span>
        </a>
    <?php endforeach; ?>
</section>

<?php nehaverse_render_news_section(); ?>

<?php foreach ($servers as $index => $server) : ?>
    <section class="nv-band nv-band--<?php echo esc_attr($server['id']); ?> <?php echo $index % 2 ? 'nv-band--flip' : ''; ?>" id="server-<?php echo esc_attr($server['id']); ?>">
        <div class="nv-band__media">
            <img class="nv-band__image" src="<?php echo nehaverse_world_image($server['image']); ?>" alt="<?php echo esc_attr($server['name']); ?>サーバーの風景" loading="lazy" width="1600" height="841">
            <div class="nv-band__thumbs">
                <?php foreach ($server['thumbs'] as $thumb) : ?>
                    <img src="<?php echo nehaverse_world_image($thumb, true); ?>" alt="" loading="lazy" width="800" height="420">
                <?php endforeach; ?>
            </div>
        </div>
        <div class="nv-band__body">
            <h2 class="nv-band__name"><?php echo esc_html($server['name']); ?>サーバー</h2>
            <p class="nv-band__summary"><?php echo esc_html($server['summary']); ?></p>

            <?php if ($server['id'] === 'resource') : ?>
                <div class="nv-nameplates">
                    <span class="nv-nameplate"><b class="nv-nameplate__lv nv-nameplate__lv--low">Lv1–15</b> 普通の場所</span>
                    <span class="nv-nameplate"><b class="nv-nameplate__lv nv-nameplate__lv--high">Lv35–60</b> 砂漠・深い場所</span>
                </div>
            <?php endif; ?>

            <div class="nv-tooltip">
                <p class="nv-tooltip__title"><?php echo esc_html($server['name']); ?>サーバー</p>
                <?php if ($server['difficulty'] !== '—') : ?>
                    <p>難易度 <span><?php echo esc_html($server['difficulty']); ?></span></p>
                <?php endif; ?>
                <p>定員 <span><?php echo esc_html($server['capacity']); ?></span></p>
            </div>

            <ul class="nv-band__list">
                <?php foreach ($server['list'] as $item) : ?>
                    <li><?php echo esc_html($item); ?></li>
                <?php endforeach; ?>
            </ul>
            <?php if ($server['note'] !== '') : ?>
                <p class="nv-band__note"><?php echo esc_html($server['note']); ?></p>
            <?php endif; ?>
            <a class="nv-band__link" href="<?php echo esc_url($server['link']['url']); ?>" <?php echo $server['link']['external'] ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html($server['link']['label']); ?> →</a>
        </div>
    </section>
<?php endforeach; ?>

<a class="nv-abyss-strip" href="<?php echo esc_url(home_url('/abyss-tide/')); ?>">
    <img src="<?php echo nehaverse_world_image('abyss-bestiary'); ?>" alt="" loading="lazy" width="1600" height="841">
    <span class="nv-abyss-strip__inner">
        <span class="nv-abyss-logo nv-abyss-strip__title">ABYSS TIDE</span>
        <span class="nv-abyss-strip__text">PvP サーバーのウェーブ戦。最大4人で、100秒ずつ押し寄せる敵を耐えきる。</span>
        <span class="nv-abyss-strip__more">ルールと敵を見る →</span>
    </span>
</a>

<section class="nv-start">
    <div class="nv-start__head">
        <img class="nv-start__mascot" src="<?php echo nehaverse_asset('images/nehal-v3-transparent.svg'); ?>" alt="ネハル" width="96" height="96" loading="lazy">
        <h2>はじめての方へ</h2>
    </div>
    <ol class="nv-start__steps">
        <li><a href="https://discord.gg/P4edaExrR4" target="_blank" rel="noopener noreferrer">Discord</a> に参加して、ルールにリアクションします。</li>
        <li>Minecraft Java 版のマルチプレイに <code>mc.nehaverse.net</code> を追加して入ります。</li>
        <li>サバイバルでチュートリアルを終わらせると、5,000円もらえます。</li>
    </ol>
    <p class="nv-start__help">わからないことは<a href="https://discord.gg/guYdDUxaBB" target="_blank" rel="noopener noreferrer">サポートサーバー</a>で聞いてください。</p>
</section>

<section class="nv-more">
    <?php foreach ($more as $item) : ?>
        <div class="nv-more__item">
            <h3><?php echo esc_html($item['title']); ?></h3>
            <p><?php echo esc_html($item['text']); ?></p>
            <a href="<?php echo esc_url($item['link']['url']); ?>"><?php echo esc_html($item['link']['label']); ?> →</a>
        </div>
    <?php endforeach; ?>
</section>

<?php get_template_part('template-parts/service', 'status'); ?>
<?php
get_footer();
