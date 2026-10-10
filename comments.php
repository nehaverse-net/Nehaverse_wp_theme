<?php
/**
 * Comments.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

if (post_password_required()) {
    return;
}
?>
<section class="comments" id="comments" aria-labelledby="comments-title">
    <div class="section-head section-head--stack">
        <p class="eyebrow">Comments</p>
        <h2 id="comments-title"><?php echo esc_html(get_comments_number() ? sprintf('コメント（%d）', get_comments_number()) : 'コメント'); ?></h2>
    </div>

    <?php if (have_comments()) : ?>
        <ol class="comment-list">
            <?php wp_list_comments(['style' => 'ol', 'callback' => 'nehaverse_comment', 'avatar_size' => 44]); ?>
        </ol>
        <?php the_comments_pagination(['prev_text' => '←', 'next_text' => '→']); ?>
    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number()) : ?>
        <p class="comments__closed">コメントは受け付けていません。</p>
    <?php endif; ?>

    <?php
    comment_form([
        'class_form'         => 'comment-form',
        'title_reply'        => 'コメントを書く',
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'  => '</h3>',
        'label_submit'       => '送信する',
        'class_submit'       => 'btn btn-primary',
        'submit_button'      => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s <span class="btn__arrow" aria-hidden="true">→</span></button>',
    ]);
    ?>
</section>
