<?php
/**
 * Template for the contact page (slug: contact).
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
    <p class="eyebrow" data-reveal>Contact</p>
    <h1 id="page-title" class="page-hero__title" data-split>お問い合わせ</h1>
    <p class="page-hero__lead" data-reveal style="--d:3">コラボ、開発依頼、サーバー運営に関するご相談など、お気軽にご連絡ください。</p>
  </div>
  <p class="page-hero__ghost" aria-hidden="true">Contact</p>
</section>

<section class="section" aria-label="相談窓口">
  <div class="contact-grid">
    <div class="card" data-reveal style="--d:0">
      <span class="card__num">01 / Support</span>
      <h3>Discordで相談する</h3>
      <p>サポートサーバーでは、質問や不具合報告、依頼のご相談を随時受け付けています。まずはこちらへどうぞ。</p>
      <a class="btn btn-primary" data-magnetic href="<?php echo esc_url(NEHAVERSE_SUPPORT_URL); ?>" target="_blank" rel="noopener noreferrer">サポートサーバーへ <span class="btn__arrow" aria-hidden="true">→</span></a>
    </div>
    <div class="card" data-reveal style="--d:1">
      <span class="card__num">02 / Work &amp; Collab</span>
      <h3>開発依頼・コラボのご相談</h3>
      <p>ご相談の内容と連絡先をご用意のうえ、Discordサポートサーバーでスタッフへお問い合わせください。</p>
      <a class="btn btn-ghost" href="<?php echo esc_url(NEHAVERSE_SUPPORT_URL); ?>" target="_blank" rel="noopener noreferrer">相談窓口を開く <span class="btn__arrow" aria-hidden="true">→</span></a>
    </div>
  </div>
</section>

<section class="section contact-apply" aria-labelledby="apply-title">
  <div class="section-head" data-reveal>
    <div>
      <p class="eyebrow">Join the team</p>
      <h2 id="apply-title">運営メンバー募集中</h2>
    </div>
    <p>Nehaverseの運営に参加したい方はこちらのフォームからご応募ください。技術、デザイン、イベント運営など、得意な分野をぜひ教えてください。</p>
  </div>
  <div class="form-embed" data-reveal>
    <iframe title="Nehaverse運営メンバー応募フォーム" loading="lazy" src="https://docs.google.com/forms/d/e/1FAIpQLSefCzGmgRLwEdWKm7ppBs4b7mou7GBXGMeaC_xOYLbd0TCUSw/viewform?embedded=true">読み込んでいます...</iframe>
  </div>
</section>
<?php
get_footer();
