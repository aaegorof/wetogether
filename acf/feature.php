<?php
/*
 * @array   $layout      Layout settings (without values)
 * @array   $field       Flexible content field settings
 * @bool    $is_preview  True in Administration
 */

$title = $args['title'];
$description = $args['description'];
$image = $args['feature-image'];
$link = $args['link'];
$view = $args['view'];
?>

<div class="feature-item row <?= $view ;?>">
  <div class="row col-md-10">
    <div class="col-md-7 pd-md-2-r">
      <h3><?= $title ?></h3>
      <div class="feature-description"><?= $description ?></div>
      <a href="<?= $link['url']; ?>" class="button primary"><?= $link['title']; ?></a>
    </div>
    <div class="col-md-5 pd-md-2-l">
      <img src="<?= $image ;?>" class="feature-img" alt="" />
    </div>
  </div>
</div>


