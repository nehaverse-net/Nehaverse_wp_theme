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
        'badge' => 'Community',
        'title' => 'Discordでつながる',
        'text'  => 'イベント告知やアップデート、質問対応はDiscordで。ルールにリアクションすれば参加準備は完了です。',
        'image' => nehaverse_asset('images/dis.webp'),
        'link'  => ['url' => home_url('/rules/'), 'label' => 'ルールと参加方法'],
    ],
    [
        'badge' => 'Products',
        'title' => '運営を支えるツール',
        'text'  => 'Voicemanegement をはじめとした Discord Bot や Minecraft プラグイン。累計導入 10K+。',
        'image' => nehaverse_asset('images/cmd.webp'),
        'link'  => ['url' => home_url('/products/'), 'label' => 'プロダクト一覧'],
    ],
    [
        'badge' => 'Contact',
        'title' => '相談や依頼も',
        'text'  => 'サポートサーバーと問い合わせフォームの二本立て。開発依頼やコラボ相談もどうぞ。',
        'image' => nehaverse_asset('images/tool.webp'),
        'link'  => ['url' => home_url('/contact/'), 'label' => 'お問い合わせ'],
    ],
];

get_header();
?>
<section class="nv-hero">
    <div class="nv-hero__inner">
        <div class="nv-hero__content">
            <span class="nv-eyebrow animate-fade-up">neha鯖 / Minecraft Network</span>
            <h1 class="nv-hero__title animate-fade-up" style="animation-delay: 0.1s">3つのワールドで、<br>遊び方を選ぼう。</h1>
            <p class="nv-hero__text animate-fade-up" style="animation-delay: 0.2s">
                暮らして建てるサバイバル、ダンジョンと強敵が待つ資源ワールド、仲間と波に挑む PvP。
                Nehaverse の Minecraft サーバー「neha鯖」は、気分に合わせて行き先を選べます。
            </p>
            <div class="nv-address animate-fade-up" style="animation-delay: 0.3s">
                <span class="nv-address__label">サーバーアドレス</span>
                <code class="nv-address__value">mc.nehaverse.net</code>
                <button class="nv-address__copy" type="button" data-copy="mc.nehaverse.net" aria-label="アドレスをコピー">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i><span data-copy-label>コピー</span>
                </button>
            </div>
            <div class="nv-hero__actions animate-fade-up" style="animation-delay: 0.4s">
                <a class="btn btn-primary" href="https://discord.gg/P4edaExrR4" target="_blank" rel="noopener noreferrer">Discordに参加</a>
                <a class="btn btn-secondary" href="#servers">サーバーを見る</a>
            </div>
        </div>
        <div class="nv-hero__visual animate-fade-up" style="animation-delay: 0.2s">
            <figure class="nv-hero__main">
                <img src="<?php echo nehaverse_world_image('hub-lobby'); ?>" alt="neha鯖のロビー。各サーバーへのゲートが並ぶ" width="1600" height="841">
            </figure>
            <div class="nv-hero__chips" aria-hidden="true">
                <?php foreach ($servers as $server) : ?>
                    <a class="nv-chip nv-chip--<?php echo esc_attr($server['id']); ?>" href="#server-<?php echo esc_attr($server['id']); ?>" tabindex="-1">
                        <span class="nv-chip__dot"></span><?php echo esc_html($server['name']); ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php nehaverse_nehal_says('どのワールドに行く？', 'nv-nehal--hero'); ?>
        </div>
    </div>
</section>

<?php nehaverse_render_news_section(); ?>

<section class="nv-section" id="servers">
    <header class="nv-heading reveal-on-scroll">
        <span class="nv-eyebrow">Servers</span>
        <h2>3つのサーバー</h2>
        <p>サバイバルが暮らしと経済、資源が採集と高難度の探索、PvP が対戦と専用ゲーム。役割の違う3つのワールドを行き来できます。</p>
    </header>

    <nav class="nv-switch reveal-on-scroll" aria-label="サーバーへ移動">
        <?php foreach ($servers as $index => $server) : ?>
            <a class="nv-switch__item nv-switch__item--<?php echo esc_attr($server['id']); ?>" href="#server-<?php echo esc_attr($server['id']); ?>">
                <span class="nv-switch__num">0<?php echo esc_html((string) ($index + 1)); ?></span>
                <span class="nv-switch__name"><?php echo esc_html($server['name']); ?></span>
                <span class="nv-switch__tag"><?php echo esc_html($server['tagline']); ?></span>
            </a>
        <?php endforeach; ?>
    </nav>

    <?php foreach ($servers as $index => $server) : ?>
        <article class="nv-world nv-world--<?php echo esc_attr($server['id']); ?> <?php echo $index % 2 ? 'nv-world--flip' : ''; ?> reveal-on-scroll" id="server-<?php echo esc_attr($server['id']); ?>">
            <div class="nv-world__media">
                <img class="nv-world__image" src="<?php echo nehaverse_world_image($server['image']); ?>" alt="<?php echo esc_attr($server['name']); ?>の風景" loading="lazy" width="1600" height="841">
                <div class="nv-world__thumbs">
                    <?php foreach ($server['thumbs'] as $thumb) : ?>
                        <img src="<?php echo nehaverse_world_image($thumb, true); ?>" alt="" loading="lazy" width="800" height="420">
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="nv-world__body">
                <p class="nv-world__label"><span class="nv-world__dot"></span><?php echo esc_html($server['label']); ?></p>
                <h3 class="nv-world__name"><?php echo esc_html($server['name']); ?></h3>
                <p class="nv-world__tagline"><?php echo esc_html($server['tagline']); ?></p>
                <p class="nv-world__summary"><?php echo esc_html($server['summary']); ?></p>
                <dl class="nv-stats">
                    <?php foreach ($server['stats'] as $stat) : ?>
                        <div>
                            <dt><?php echo esc_html($stat['label']); ?></dt>
                            <dd><?php echo esc_html($stat['value']); ?></dd>
                        </div>
                    <?php endforeach; ?>
                </dl>
                <ul class="nv-features">
                    <?php foreach ($server['features'] as $feature) : ?>
                        <li>
                            <i class="fa-solid <?php echo esc_attr($feature['icon']); ?>" aria-hidden="true"></i>
                            <div>
                                <strong><?php echo esc_html($feature['title']); ?></strong>
                                <span><?php echo esc_html($feature['text']); ?></span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php if ($server['note'] !== '') : ?>
                    <p class="nv-world__note"><i class="fa-solid fa-circle-info" aria-hidden="true"></i><?php echo esc_html($server['note']); ?></p>
                <?php endif; ?>
                <a class="nv-world__link" href="<?php echo esc_url($server['link']['url']); ?>" <?php echo $server['link']['external'] ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                    <?php echo esc_html($server['link']['label']); ?> <span aria-hidden="true">→</span>
                </a>
            </div>
        </article>
    <?php endforeach; ?>
</section>

<section class="nv-section nv-section--tight reveal-on-scroll">
    <div class="nv-compare">
        <table>
            <caption>ひと目で比べる</caption>
            <thead>
                <tr>
                    <th scope="col">サーバー</th>
                    <th scope="col">主な遊び方</th>
                    <th scope="col">難易度</th>
                    <th scope="col">定員</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($servers as $server) : ?>
                    <tr class="nv-compare__row--<?php echo esc_attr($server['id']); ?>">
                        <th scope="row"><span class="nv-world__dot"></span><?php echo esc_html($server['name']); ?></th>
                        <td><?php echo esc_html($server['play']); ?></td>
                        <td><?php echo esc_html($server['difficulty']); ?></td>
                        <td><?php echo esc_html($server['capacity']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<section class="nv-section">
    <div class="nv-spotlights">
        <a class="nv-spotlight nv-spotlight--dungeon reveal-on-scroll" href="<?php echo esc_url(home_url('/dungeons/')); ?>">
            <img src="<?php echo nehaverse_world_image('pyramid-hall'); ?>" alt="" loading="lazy" width="1600" height="841">
            <div class="nv-spotlight__body">
                <span class="nv-eyebrow">Resource Server</span>
                <h3>ダンジョンに挑む</h3>
                <p>ピラミッドや地下都市に眠る宝と、Lv60 に達する強敵たち。</p>
                <span class="nv-spotlight__more">ダンジョンガイドへ →</span>
            </div>
        </a>
        <a class="nv-spotlight nv-spotlight--abyss reveal-on-scroll" href="<?php echo esc_url(home_url('/abyss-tide/')); ?>">
            <img src="<?php echo nehaverse_world_image('abyss-bestiary'); ?>" alt="" loading="lazy" width="1600" height="841">
            <div class="nv-spotlight__body">
                <span class="nv-eyebrow">PvP Server / Wave Survival</span>
                <h3 class="nv-abyss-logo">ABYSS TIDE</h3>
                <p>その波を、越えろ。最大4人で押し寄せる敵を迎え撃つ。</p>
                <span class="nv-spotlight__more">ゲームを見る →</span>
            </div>
        </a>
    </div>
</section>

<section class="nv-section nv-section--tight reveal-on-scroll">
    <header class="nv-heading nv-heading--row">
        <div>
            <span class="nv-eyebrow">Gallery</span>
            <h2>neha鯖の風景</h2>
        </div>
        <?php nehaverse_nehal_says('雨の日の街もきれいだよ。'); ?>
    </header>
    <div class="nv-gallery" tabindex="0" aria-label="スクリーンショット">
        <?php foreach (['survival-street', 'world-hall', 'survival-market', 'world-rail', 'pyramid-corridor', 'abyss-hall'] as $shot) : ?>
            <img src="<?php echo nehaverse_world_image($shot, true); ?>" alt="" loading="lazy" width="800" height="420">
        <?php endforeach; ?>
    </div>
</section>

<section class="nv-section reveal-on-scroll">
    <div class="nv-start">
        <div class="nv-start__intro">
            <span class="nv-eyebrow">Getting Started</span>
            <h2>はじめての方へ</h2>
            <p>4ステップで参加できます。迷ったらサポートサーバーで気軽に聞いてください。</p>
            <img class="nv-start__mascot" src="<?php echo nehaverse_asset('images/nehal-v3-transparent.svg'); ?>" alt="Nehaverse のマスコット、ネハル" width="160" height="160" loading="lazy">
        </div>
        <ol class="nv-steps">
            <li><strong>Discord に参加</strong><span>コミュニティサーバーで告知や質問ができます。</span></li>
            <li><strong>ルールを確認</strong><span>ルールチャンネルでリアクションすると権限が付きます。</span></li>
            <li><strong>サーバーに接続</strong><span>Java 版のマルチプレイに <code>mc.nehaverse.net</code> を追加します。</span></li>
            <li><strong>チュートリアル</strong><span>サバイバルで採掘と土地申請を練習。完了すると 5,000円 もらえます。</span></li>
        </ol>
    </div>
</section>

<section class="nv-section nv-section--more">
    <header class="nv-heading reveal-on-scroll">
        <span class="nv-eyebrow">Nehaverse</span>
        <h2>サーバーのほかにも</h2>
    </header>
    <div class="nv-more">
        <?php foreach ($more as $item) : ?>
            <a class="nv-more__card reveal-on-scroll" href="<?php echo esc_url($item['link']['url']); ?>">
                <img src="<?php echo esc_url($item['image']); ?>" alt="" loading="lazy">
                <span class="nv-eyebrow"><?php echo esc_html($item['badge']); ?></span>
                <h3><?php echo esc_html($item['title']); ?></h3>
                <p><?php echo esc_html($item['text']); ?></p>
                <span class="nv-more__link"><?php echo esc_html($item['link']['label']); ?> →</span>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<section class="highlight reveal-on-scroll">
    <div class="highlight__content">
        <h2>今すぐ neha鯖 の世界へ</h2>
        <p>建築も、探索も、対戦も。Nehaverse なら、そのすべてを仲間と一緒に楽しめます。</p>
        <div class="highlight__actions">
            <a class="btn btn-light" href="https://discord.gg/P4edaExrR4" target="_blank" rel="noopener noreferrer">Discordで参加する</a>
            <a class="btn btn-outline" href="https://map.nehaverse.net" target="_blank" rel="noopener noreferrer">Webマップを見る</a>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/service', 'status'); ?>
<?php
get_footer();
