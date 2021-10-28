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
    <button class="button primary add-to-calendar add-event-<?= get_the_ID();?>">Добавить в календарь</button>
    <div class="to-share">
      <button class="button ghost secondary">Поделиться</button>
      <div class="social-dropdown">
        <button class="btn-share social_share fab fa-facebook" data-type="fb"></button>
        <button class="btn-share social_share fab fa-twitter" data-type="twitter"></button>
        <button class="btn-share social_share fab fa-vk" data-type="vk"></button>
        <button class="btn-share social_share fab fa-odnoklassniki" data-type="ok"></button>
        <!--      <button class="btn-share social_share fab" data-type="mailru">Mail.Ru</button>-->
        <!--      <button class="btn-share social_share fab" data-type="gplus">Google+</button>-->
        <!--      <button class="btn-share social_share fab" data-type="googlebookmarks">Google Bookmarks</button>-->
        <!--      <button class="btn-share social_share fab" data-type="livejournal">LiveJournal</button>-->
        <!--      <button class="btn-share social_share fab" data-type="tumblr">Tumblr</button>-->
        <button class="btn-share social_share fab fa-pinterest" data-type="pinterest"></button>
        <button class="btn-share social_share fab fa-linkedin" data-type="linkedin"></button>
        <!--      <button class="btn-share social_share fab" data-type="reddit">Reddit</button>-->
        <!--      <button class="btn-share social_share fab" data-type="weibo">Weibo</button>-->
        <!--      <button class="btn-share social_share fab" data-type="line">Line.me</button>-->
        <!--<button class="btn-share social_share fab" data-type="skype">Skype</button>-->
        <button class="btn-share social_share fab fa-telegram" data-type="telegram"></button>
        <button class="btn-share social_share fab fa-whatsapp" data-type="whatsapp"></button>
        <!--      <button class="btn-share social_share fab" data-type="viber">Viber</button>-->
        <button class="btn-share social_share fab fa-mail-reply" data-type="email"></button>
      </div>
    </div>

  </div>

  <script>
    // http://carlsednaoui.github.io/add-to-calendar-buttons/
    let calendar<?= get_the_ID();?> = createCalendar({
          options: {
            class: 'add-to-calendar-dropdown',
            id: 'add-calendar-<?= get_the_ID();?>'       // You need to pass an ID. If you don't, one will be generated for you.
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
