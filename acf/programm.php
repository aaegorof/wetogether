<?php
$defaultArgs = array(
    'post_type' => 'event',
    'posts_per_page' => 4,
    'meta_key' => 'start_date',
    'orderby' => 'meta_value',
    'order' => 'ASC'
);
?>

<?php
$query = get_sub_field('event-list') ? get_sub_field('event-list') : get_posts($defaultArgs);
$section = get_sub_field('for_section');
$notes = $section['notes'];
global $post;
?>

<section class="container" id="programm">
  <h2><?php echo $section['title']; ?></h2>
  <div class="programm-results">
      <?php
      foreach ($query as $post) {
          setup_postdata($post);
          get_template_part('template-parts/loop-event');
      }
      wp_reset_postdata();
      ?>
  </div>

    <?php if ($section['link']): ?>
      <div class="row centered mg-3-t">
        <div class="col-sm-12 text-center">
          <a href="<?= $section['link']['url']; ?>"
             class="button primary"><?= $section['link']['title']; ?>
          </a>
        </div>
          <?php if ($notes): ?>
            <div class="color-grey text-center font-size-xs footer-notes mg-2-t">
                <?= $notes; ?>
            </div>
          <?php endif;; ?>
      </div>
    <?php endif; ?>
</section>
