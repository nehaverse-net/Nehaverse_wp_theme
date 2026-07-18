<?php
/**
 * Front-page service status section.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<section class="nhv-status reveal-on-scroll" data-nehaverse-status aria-labelledby="nhv-status-title">
    <div class="nhv-status__shell">
        <header class="nhv-status__header">
            <span class="nhv-status__badge">Service Status</span>
            <h2 id="nhv-status-title">サービス稼働状況</h2>
            <p>WebサイトとMinecraftサーバーの現在の状態を確認できます。</p>
        </header>

        <div class="nhv-status__summary" data-summary aria-live="polite">
            <span class="nhv-status__summary-dot is-checking" data-summary-dot></span>
            <div>
                <span class="nhv-status__summary-label">CURRENT STATUS</span>
                <strong data-summary-title>ステータスを確認中</strong>
                <p data-summary-copy>各サービスに接続しています…</p>
            </div>
            <div class="nhv-status__summary-time">
                <span>最終確認</span>
                <time data-last-checked>--:--:--</time>
            </div>
        </div>

        <div class="nhv-status__grid">
            <article class="nhv-status__card" data-service="website" aria-busy="true">
                <div class="nhv-status__card-top">
                    <span class="nhv-status__type"><i class="fa-solid fa-globe" aria-hidden="true"></i> WEB SERVICE</span>
                    <span class="nhv-status__pill is-checking"><i></i><b>確認中</b></span>
                </div>
                <h3>Nehaverse Web</h3>
                <a href="https://wp.nehaverse.net/" target="_blank" rel="noopener noreferrer">wp.nehaverse.net <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
                <dl>
                    <div><dt>応答時間</dt><dd data-metric="latency">—</dd></div>
                    <div><dt>HTTP</dt><dd data-metric="detail">—</dd></div>
                </dl>
            </article>

            <article class="nhv-status__card" data-service="minecraft" aria-busy="true">
                <div class="nhv-status__card-top">
                    <span class="nhv-status__type"><i class="fa-solid fa-cube" aria-hidden="true"></i> GAME SERVER</span>
                    <span class="nhv-status__pill is-checking"><i></i><b>確認中</b></span>
                </div>
                <h3>Minecraft Server</h3>
                <button type="button" data-copy="mc.nehaverse.net">mc.nehaverse.net <i class="fa-regular fa-copy" aria-hidden="true"></i></button>
                <dl>
                    <div><dt>オンライン</dt><dd data-metric="players">—</dd></div>
                    <div><dt>応答時間</dt><dd data-metric="latency">—</dd></div>
                </dl>
                <p class="nhv-status__version" data-metric="version">サーバー情報を取得中</p>
            </article>
        </div>

        <div class="nhv-status__footer">
            <p>表示は60秒ごとに自動更新されます。</p>
            <button type="button" data-status-refresh>今すぐ更新 <span>→</span></button>
        </div>
    </div>
    <div class="nhv-status__toast" data-status-toast role="status">アドレスをコピーしました</div>
</section>
