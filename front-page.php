<?php
/**
 * Front page template.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

$features = [
    [
        'id'          => 'minecraft',
        'badge'       => 'Minecraft Server',
        'title'       => 'neha鯖で広がるサバイバル & 建築体験',
        'description' => '自由な建築とサバイバル、経済システムが共存するNehaverseのメインフィールド。仲間とともに理想の街づくりを楽しめます。',
        'points'      => ['対応バージョン: Java版 最新推奨', 'IP: mc.nehaverse.net', 'マップ: map.nehaverse.net'],
        'link'        => ['url' => home_url('/minecraft/'), 'label' => 'Minecraftサーバーの詳細を見る'],
        'image'       => ['src' => nehaverse_asset('images/minecraft.webp'), 'alt' => 'Minecraftを楽しむイメージ'],
    ],
    [
        'id'          => 'community',
        'badge'       => 'Community',
        'title'       => 'Discordでつながるコミュニティとサポート',
        'description' => 'イベント告知やアップデート共有、質問対応まですべてDiscordで完結。ルールチャンネルでリアクションするだけで参加準備は完了です。',
        'points'      => ['コミュニティ: discord.gg/P4edaExrR4', 'サポート: discord.gg/guYdDUxaBB', 'ルール確認とリアクションで権限付与'],
        'link'        => ['url' => home_url('/rules/'), 'label' => 'ルールと参加方法を見る'],
        'image'       => ['src' => nehaverse_asset('images/dis.webp'), 'alt' => 'コミュニティで交流するイメージ'],
        'invert'      => true,
    ],
    [
        'id'          => 'products',
        'badge'       => 'Products',
        'title'       => '技術で支える運営ツール群',
        'description' => 'VoicemanegementをはじめとしたDiscord BotやMinecraftプラグインで、コミュニティ運営をよりスマートに。累計導入 10K+ の実績。',
        'points'      => ['ボイスチャットのログとロール連携', '音声加工やメッセージ装飾など豊富な機能', 'GitHub: github.com/grampr'],
        'link'        => ['url' => home_url('/products/'), 'label' => 'プロダクト一覧へ'],
        'image'       => ['src' => nehaverse_asset('images/cmd.webp'), 'alt' => '技術で支える運営ツールのイメージ'],
    ],
    [
        'id'          => 'contact',
        'badge'       => 'Contact',
        'title'       => '相談や依頼もお気軽に',
        'description' => 'Discordサポートサーバーと問い合わせフォームの二本立て。開発依頼やコラボ相談も24時間いつでも送信できます。',
        'points'      => ['サポートサーバー: 常時スタッフが対応', 'フォームでの個別相談に対応', 'メール通知も順次開設予定'],
        'link'        => ['url' => home_url('/contact/'), 'label' => 'お問い合わせ窓口を見る'],
        'image'       => ['src' => nehaverse_asset('images/tool.webp'), 'alt' => '相談や依頼のイメージ'],
        'invert'      => true,
    ],
];

get_header();
?>
<section class="hero">
    <div class="hero__overlay"></div>
    <div class="hero__inner">
        <div class="hero__content">
            <span class="hero__badge animate-fade-up">Our Mission</span>
            <h1 class="hero__title animate-fade-up" style="animation-delay: 0.1s">技術で楽しめるコンテンツを。</h1>
            <p class="hero__text animate-fade-up" style="animation-delay: 0.2s">
                Nehaverseは、Minecraftサーバー「neha鯖」とDiscord向けユーティリティを通じて、技術で楽しめる体験をつくり、
                コミュニティの楽しさを広げるプロジェクトです。自由に遊ぶ、学ぶ、つながる。そんな時間をともに育てていきます。
            </p>
            <div class="hero__actions animate-fade-up" style="animation-delay: 0.3s">
                <a class="btn btn-primary" href="https://discord.gg/P4edaExrR4" target="_blank" rel="noopener noreferrer">コミュニティサーバーに参加</a>
                <a class="btn btn-secondary" href="<?php echo esc_url(home_url('/minecraft/')); ?>">Minecraftサーバーを見る</a>
            </div>
            <div class="hero__links animate-fade-up" style="animation-delay: 0.4s">
                <a href="https://discord.gg/guYdDUxaBB" target="_blank" rel="noopener noreferrer">サポートサーバー →</a>
                <a href="https://map.nehaverse.net" target="_blank" rel="noopener noreferrer">サーバーマップ →</a>
            </div>
        </div>
        <div class="hero__visual animate-fade-up" style="animation-delay: 0.3s">
            <div class="hero__visual-card">
                <p class="hero__visual-title">nehaverse.net</p>
                <p class="hero__visual-desc">自由な建築とサバイバルが共存するneha鯖では、イベントや経済システムも随時アップデート。</p>
                <div class="hero__visual-tags">
                    <span>#Minecraft</span>
                    <span>#Discord</span>
                    <span>#Community</span>
                </div>
            </div>
        </div>
    </div>
</section>

<?php nehaverse_render_news_section(); ?>

<section class="section-intro reveal-on-scroll">
    <span class="section-intro__badge">Overview</span>
    <h2>ひと目でわかるNehaverse</h2>
    <p>Nehaverseが提供する体験を、サービス、コミュニティ、プロダクト、サポートの4つの切り口から紹介します。</p>
</section>

<?php foreach ($features as $feature) : ?>
    <section class="feature-section <?php echo !empty($feature['invert']) ? 'feature-section--invert' : ''; ?> reveal-on-scroll">
        <div class="feature-section__inner">
            <div class="feature-section__content">
                <span class="feature-section__badge"><?php echo esc_html($feature['badge']); ?></span>
                <h3><?php echo esc_html($feature['title']); ?></h3>
                <p><?php echo esc_html($feature['description']); ?></p>
                <ul>
                    <?php foreach ($feature['points'] as $point) : ?>
                        <li><?php echo esc_html($point); ?></li>
                    <?php endforeach; ?>
                </ul>
                <a class="feature-section__link" href="<?php echo esc_url($feature['link']['url']); ?>"><?php echo esc_html($feature['link']['label']); ?> →</a>
            </div>
            <div class="feature-section__visual">
                <div class="feature-section__image-frame">
                    <img src="<?php echo esc_url($feature['image']['src']); ?>" alt="<?php echo esc_attr($feature['image']['alt']); ?>">
                </div>
            </div>
        </div>
    </section>
<?php endforeach; ?>

<section class="highlight reveal-on-scroll">
    <div class="highlight__content">
        <h2>今すぐNehaverseの世界へ</h2>
        <p>建築も、サバイバルも、コミュニティ運営も。Nehaverseなら、そのすべてを仲間と一緒に楽しめます。あなたの「やりたい」を教えてください。</p>
        <div class="highlight__actions">
            <a class="btn btn-light" href="https://discord.gg/P4edaExrR4" target="_blank" rel="noopener noreferrer">Discordで参加する</a>
            <a class="btn btn-outline" href="<?php echo esc_url(home_url('/products/')); ?>">ツールをチェック</a>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/service', 'status'); ?>
<?php
get_footer();
