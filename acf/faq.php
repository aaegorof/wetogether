<?php
/*
 * @array   $layout      Layout settings (without values)
 * @array   $field       Flexible content field settings
 * @bool    $is_preview  True in Administration
 */
?>

<section class="faq-wrap container row" id="faq">
  <div class="col-md-8">
    <?php $faq_list = get_sub_field('faq'); ?>
    <?php $section = get_sub_field('for_section'); ?>
    <?php $notes = $section['notes'] ;?>
    <?php $arrow = twentytwenty_get_theme_svg('chevron-down') ;?>
  <h2><?php echo $section['title']; ?></h2>
  <div class="faq-list">
      <?php foreach ($faq_list as $faq) : ?>
          <?php
          $question = $faq['faq-title'];
          $answer = $faq['faq-answer'];
          ?>
        <div class="faq-item">
          <div class="f-600 faq-title"><?= $question; ?> <?= $arrow;?></div>
          <div class="faq-answer"><?= $answer; ?></div>
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
  </div>
</section>
