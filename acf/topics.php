<?php
/*
 * @array   $layout      Layout settings (without values)
 * @array   $field       Flexible content field settings
 * @bool    $is_preview  True in Administration
 */
?>

<section class="topics-wrap container">
    <?php $topics = get_sub_field('topics'); ?>
    <?php $section = get_sub_field('for_section'); ?>
  <h2><?php echo $section['title']; ?></h2>
  <div class="row topics">
      <?php foreach ($topics as $topic) : ?>
          <?php
          $name = $topic->name;
          $termId = $topic->term_id;
          $iconId = get_field('icon', $topic);
          $iconUrl = wp_get_attachment_url($iconId);
          $description = $topic->description;
          $notes = $section['notes'];
          ?>
        <div class="topic-item">
            <?php if ($iconUrl): ?>
              <img src="<?= $iconUrl ?>" class="topic-icon"/>
            <?php endif; ?>
          <p class="f-600 topic-title"><?= $name; ?></p>
          <div><?= $description; ?></div>
        </div>
      <?php endforeach; ?>
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
