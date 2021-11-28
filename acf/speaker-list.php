<?php
$speakers = get_sub_field('speakers');
$section = get_sub_field('for_section');
$notes = $section['notes'];
$type = 'withanimation';
?>

<section class="speakers-wrap container" id="speakers">
  <h2><?php echo $section['title']; ?></h2>

  <?php if($type === 'withanimation'):?>
    <div class="dobroSlider__container">
      <div class="dobroSlider">
    <?php foreach ($speakers as $speaker) : ?>
    <?php

    $id =  $speaker->ID;
    $name = $speaker->post_title;
    $imageUrl = get_field('alternative-img', $id);
    $animSvgGallery = get_field('anim-img', $id);
    ?>
      <?php  if($imageUrl):?>
        <a href="<?= get_permalink($id) ;?>" class="dobroSlider__item">
          <?php foreach ((array)$animSvgGallery as $svgUrl) :?>
              <img class="crazy-bg" src="<?= $svgUrl;?>">
          <?php endforeach;?>
          <div class="dobroSlider__item-content">
            <div class="photo">
              <img src="<?= $imageUrl;?>" alt="<?= $name ;?>">
            </div>
            <div class="name"><?= $name ;?></div>
          </div>
        </a>
        <?php endif ;?>
      <?php endforeach;?>

      </div>
    </div>
  <?php else:?>

  <div class="speakers-list">
    <?php foreach ((array)$speakers as $speaker) : ?>
    <?php

        $id =  $speaker->ID;
        $name = $speaker->post_title;
        $image = get_the_post_thumbnail_url($id);
        $position = get_field('position', $speaker->ID);
    ?>
    <a href="<?= get_permalink($id) ;?>" class="speaker-card">
      <img src="<?= $image;?>" alt="<?= $name;?>">
      <div class="pd-1-h">
        <div class="speaker-name"><?= $name ;?></div>
      </div>
    </a>

  <?php endforeach;?>
  </div>

  <?php endif ;?>

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
