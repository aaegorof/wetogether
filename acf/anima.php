<?php
/*
 * @array   $layout      Layout settings (without values)
 * @array   $field       Flexible content field settings
 * @bool    $is_preview  True in Administration
 */

$section = get_sub_field('for_section');
$imgLeft = get_sub_field('left-img');
$imgRight = get_sub_field('right-img');
$location = get_sub_field('hero-location');
$date = get_sub_field('hero-date');
?>

<section class="anima" id="hero">
  <svg width="1440" height="315" viewBox="0 0 1440 315" fill="none" xmlns="http://www.w3.org/2000/svg" class="hero-bg">
    <path d="M315 57.001C165 -44.599 -6.5 14.6676 -44.5 57.001L-25 358.501L1821 341.501C1501.5 135.001 1222 85.001 935.5 173.001C649 261.001 502.5 184.001 315 57.001Z" fill="#F6F8FB"/>
  </svg>

    <?php if($imgLeft) :?>
      <img src="<?= $imgLeft ;?>" alt="" class="img-left to-animate">
    <?php endif;?>

  <div class="hero-about">
    <h1 class="to-animate"><?= $section['title'];?></h1>
    <div class="hero-location mg-1-t to-animate"> <i class="fa fa-map-marker-alt"></i> <?= $location ;?></div>
    <div class="hero-date mg-1-t to-animate"><i class="fa fa-calendar-alt"></i> <?= $date ;?></div>
      <?php if ($section['link']): ?>
        <a href="<?= $section['link']['url']; ?>" class="to-animate button primary"><?= $section['link']['title']; ?>
        </a>
    <?php endif;?>
  </div>

    <?php if($imgRight) :?>
    <img src="<?= $imgRight ;?>" alt="" class="img-right to-animate">
  <?php endif;?>
</section>
