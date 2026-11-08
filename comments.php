<?php
if (post_password_required()) {
    return;
}
?>
<section class="comments">
  <?php if (have_comments()) : ?>
    <h2 class="comments-title">
      <?php
      printf(
          esc_html(_nx('Un commentaire', '%1$s commentaires', get_comments_number(), 'titre des commentaires', 'herbert-bayer')),
          number_format_i18n(get_comments_number())
      );
      ?>
    </h2>

    <ol class="comment-list">
      <?php
      wp_list_comments([
          'style' => 'ol',
          'short_ping' => true,
          'avatar_size' => 48,
      ]);
      ?>
    </ol>

    <?php the_comments_navigation(); ?>
  <?php endif; ?>

  <?php
  if (!comments_open() && get_comments_number()) :
      ?>
    <p class="comments-closed"><?php esc_html_e('Les commentaires sont fermés.', 'herbert-bayer'); ?></p>
  <?php endif; ?>

  <?php
  comment_form([
      'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
      'title_reply_after' => '</h2>',
  ]);
  ?>
</section>
