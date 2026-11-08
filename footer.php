<?php
?>
</main>
<footer class="site-footer">
  <div class="footer-inner">
    <p><?php bloginfo('name'); ?> &mdash; <?php echo esc_html(wp_date('Y')); ?></p>
    <?php get_search_form(); ?>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
