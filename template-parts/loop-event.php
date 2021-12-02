<?php
$speakers = get_field('event-speakers');
$moderators = get_field('moderator');
$start_date = get_field('start_date');
$end_date = get_field('end_date');
$start_date_D = get_field('start_date') ? new DateTime($start_date) : null;
$end_date_D = get_field('end_date') ? new DateTime($end_date) : null;

$formatted_date = date_i18n('j F Y с H:i', strtotime($start_date));

$location = get_field('location');
$categories = get_the_category();
$types = get_the_terms($post->ID, 'event_type');
?>

<div class="event-item">
    <?php if (!is_single()) : ?>
  <div class="event-title">
    <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
    </a>
  </div>
    <?php endif; ?>
    <?php if (!is_single()) : ?>
      <div class="excerpt"><?php the_excerpt(); ?></div>
    <?php endif; ?>
  <ul class="post-categories">
      <?php foreach ((array)$categories as $category): ?>
        <li class="term-name">
            <?= $category->name; ?>
        </li>
      <?php endforeach; ?>
      <?php foreach ((array)$types as $type): ?>
        <li class="term-name">
            <?= $type->name; ?>
        </li>
      <?php endforeach; ?>
  </ul>

    <?php if (isset($speakers[0])): ?>
      <div class="speaker-list">
          <?php foreach ($speakers as $speaker): ?>
            <a class="speaker" href="<?= get_post_permalink($speaker->ID); ?>">
              <img src="<?= get_the_post_thumbnail_url($speaker); ?>" alt="">
                <?= $speaker->post_title; ?>
            </a>
          <?php endforeach; ?>
      </div>
    <?php endif; ?>

  <div class="meta location mg-2-t"><i class="fa fa-map-marker-alt"></i> <?= $location; ?></div>
  <div class="meta">
    <i class="fa fa-calendar-alt"></i>
      <?= $formatted_date; ?>
      <?= $end_date ? ' – ' . date_format($end_date_D, 'H:i') : ''; ?>
  </div>

    <?php if (isset($moderators[0])): ?>
      <div class="speaker-list">
        <div style="align-self: center;">Модераторы: </div>
          <?php foreach ($moderators as $moderator): ?>
            <a class="speaker" href="<?= get_post_permalink($moderator->ID); ?>">
              <img src="<?= get_the_post_thumbnail_url($moderator); ?>" alt="">
                <?= $moderator->post_title; ?>
            </a>
          <?php endforeach; ?>
      </div>
    <?php endif; ?>

  <div class="buttons-row">
    <div class="ui dropdown add-event-<?= get_the_ID(); ?>">
      <button class="button primary calendar-button" style="width: 100%;">Добавить в календарь</button>
      <div class="menu"></div>
    </div>
    <div class="ui dropdown">
      <button class="button ghost secondary" style="width: 100%;">Поделиться</button>
      <div class="menu" style="min-width: 100%;">
        <div class="social-dropdown">
          <button class="item btn-share social_share fab fa-facebook" data-type="fb"></button>
          <button class="item btn-share social_share fab fa-twitter" data-type="twitter"></button>
          <button class="item btn-share social_share fab fa-vk" data-type="vk"></button>
          <button class="item btn-share social_share fab fa-odnoklassniki" data-type="ok"></button>
          <button class="item btn-share social_share fab fa-pinterest" data-type="pinterest"></button>
          <button class="item btn-share social_share fab fa-linkedin" data-type="linkedin"></button>
          <button class="item btn-share social_share fab fa-telegram" data-type="telegram"></button>
          <button class="item btn-share social_share fab fa-whatsapp" data-type="whatsapp"></button>
          <button class="item btn-share social_share fab fa-mail-reply" data-type="email"></button>
        </div>
      </div>
    </div>

  </div>

  <script>
    addCalendar();
    (function ($) {
      $('.ui.dropdown').dropdown('refresh');
    })(jQuery);

    // http://carlsednaoui.github.io/add-to-calendar-buttons/
    function addCalendar() {
      let calendar<?= get_the_ID();?>;
      if (!calendar<?= get_the_ID();?>) {
        calendar<?= get_the_ID();?> = createCalendar({
          options: {
            class: 'add-to-calendar-dropdown',
            id: 'add-calendar-<?= get_the_ID();?>'       // You need to pass an ID. If you don't, one will be generated for you.
          },
          data: {
            title: "<?php the_title(); ?>",     // Event title
            start: new Date("<?= date_format($start_date_D, 'm/d/Y H:i');?>"),   // Event start date
            // duration: 120,                            // Event duration (IN MINUTES)
            end: new Date("<?= date_format($end_date_D, 'm/d/Y H:i');?>"),     // You can also choose to set an end time.
            // If an end time is set, this will take precedence over duration
            address: "<?= $location;?>",
            description: "<?= get_the_excerpt();?>"
          }
        })
        document.querySelector('.add-event-<?= get_the_ID();?> .menu').appendChild(calendar<?= get_the_ID();?>);
      }
    }
  </script>
</div>
