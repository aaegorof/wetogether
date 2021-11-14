<?php
$speakers = get_sub_field('speakers');
$section = get_sub_field('for_section');
$notes = $section['notes'];
?>

<section class="speakers-wrap container sticky-container" id="speakers">
  <h2><?php echo $section['title']; ?></h2>
  <div class="speakers-list">
    <?php foreach ($speakers as $speaker) : ?>
    <?php

        $id =  $speaker->ID;
        $name = $speaker->post_title;
        $image = get_the_post_thumbnail_url($id);
        $position = get_field('position', $speaker->ID);
    ?>
    <a href="<?= get_permalink($speaker->ID) ;?>" class="speaker-card">
      <img src="<?= $image;?>" alt="<?= $name;?>">
      <div class="pd-1-h">
        <div class="speaker-name"><?= $name ;?></div>
        <?php if($position): ?>
        <div class="meta speaker-description">
          <i class="fa fa-briefcase" style="color: #000;"></i>
          <?= $position; ?>
        </div>
        <?php endif;?>
      </div>
    </a>

  <?php endforeach;?>
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
