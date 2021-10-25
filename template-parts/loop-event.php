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
  <div class="buttons-row">
    <button class="add-event-<?= get_the_ID();?>">Добавить в календарь</button>
  </div>

  <script>
    let calendar<?= get_the_ID();?> = createCalendar({
          options: {
            class: 'my-class',
            id: 'my-id'                               // You need to pass an ID. If you don't, one will be generated for you.
          },
          data: {
            title: "<?php the_title(); ?>",     // Event title
            start: new Date("<?= $start_date;?>"),   // Event start date
            // duration: 120,                            // Event duration (IN MINUTES)
            end: new Date("<?= $end_date;?>"),     // You can also choose to set an end time.
                                                      // If an end time is set, this will take precedence over duration
            address: "<?= $location;?>",
            description: 'Get on the front page of HN, then prepare for world domination.'
          }
        })
    document.querySelector('.add-event-<?= get_the_ID();?>').appendChild(calendar<?= get_the_ID();?>);
  </script>
</div>
