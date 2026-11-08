<?php
if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>
<aside class="sidebar" aria-label="<?php esc_attr_e('Barre latérale', 'herbert-bayer'); ?>">
  <?php dynamic_sidebar('sidebar-1'); ?>
</aside>
