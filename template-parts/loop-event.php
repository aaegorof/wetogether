<?php
$speakers =get_field('event-speakers');
$start_date =get_field('start_date');
$end_date =get_field('end_date');
$location =get_field('location');
$categories = get_the_category()
?>
<div class="event-item">
  <div class="event-title"><?php the_title(); ?></div>
  <div class="excerpt"><?php the_excerpt(); ?></div>

  <ul class="post-categories">
      <?php foreach ($categories as $category): ?>
      <li class="term-name">
        <?= $category->name ;?>
      </li>
    <?php endforeach;?>
  </ul>

  <div class="speaker-list">
    <?php foreach ($speakers as $speaker):?>
    <div class="speaker">
      <img src="<?= get_the_post_thumbnail_url($speaker) ;?>" alt="">
    <?= $speaker->post_title ;?>
    </div>
    <?php endforeach;?>
  </div>
  <div class="location"><?= $location ;?></div>
  <div class="date"><?= $start_date ;?> – <?= $end_date; ?></div>
</div>
