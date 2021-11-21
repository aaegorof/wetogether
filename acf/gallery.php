<?php
/*
 * @array   $layout      Layout settings (without values)
 * @array   $field       Flexible content field settings
 * @bool    $is_preview  True in Administration
 */
?>

<?php $gallery = $args['gallery'] ? $args['gallery'] : get_sub_field('galaereya'); ?>
<?php $section = get_sub_field('for_section'); ?>
<?php $title = $args['title'] ? $args['title'] : $section['title'];?>
<?php $notes = $section['notes']; ?>

<?php if(empty($gallery)){
  return ;
};?>

<section class="gallery-wrap container">
  <?php if($title) :?>
  <h2><?php echo $title;?></h2>
  <?php endif ;?>
  <div class="gallery-list">
      <?php foreach ($gallery as $img) : ?>
          <?php
          $imgUrl = $img['url'];
          $href = $img['alt'];
          ?>
          <?php if ($href): ?>
          <a href="<?= $href; ?>" target="_blank">
          <?php endif; ?>
        <img src="<?= $imgUrl; ?>"/>
          <?php if ($href): ?>
          </a>
          <?php endif; ?>
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
