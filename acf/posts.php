<?php
/*
 * @array   $layout      Layout settings (without values)
 * @array   $field       Flexible content field settings
 * @bool    $is_preview  True in Administration
 */
?>

<section class="posts-wrap container">
    <?php global $post; ?>
    <?php $type = get_sub_field('post-types'); ?>
    <?php $view = get_sub_field('posts_view'); ?>
    <?php $section = get_sub_field('for_section'); ?>
    <?php $notes = $section['notes']; ?>
    <?php $postNumber = ($view === 'metro') ? 4 : 3; ?>
    <?php $posts = get_posts(array(
        'numberposts' => $postNumber,
        'orderby' => 'date',
        'post_type' => $type
    ));
    ?>
  <h2><?php echo $section['title']; ?></h2>
  <div class="post-list <?= $view; ?>">
      <?php foreach ($posts as $key => $post) :
          setup_postdata($post); ?>
          <?php
          $iframe = get_field('video');
          // используем preg_match чтобы найти iframe src
          preg_match('/src="(.+?)"/', $iframe, $matches);
          $src = $matches[1];


          // добавим дополнительные параметры к src
          $params = array(
              'controls' => 0,
              'hd' => 1,
              'autohide' => 1,
              'modestbranding' => 1,
              'showinfo' => 0
          );

          $new_src = add_query_arg($params, $src);

          $iframe = str_replace($src, $new_src, $iframe);


          // добавим дополнительные параметры к html iframe
          $attributes = 'frameborder="0"';

          $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
          $imgUrl = get_the_post_thumbnail_url($post);
          ?>
          <?php if ($key == 2 && $view === 'metro') {
          echo '<div class="post-tail">';
      } ?>
<!--          --><?php //if ($iframe) {
//          get_template_part('template-parts/modal', '', array('content' => $iframe, 'id' => "video-" . $post->ID));
//      }; ?>
        <a href="<?php the_permalink(); ?>" class="post-item">
            <?php if ($iframe) {
              echo $iframe;
            } else {?>
              <img src="<?= $imgUrl ?>" class="post-img"/>
            <?php } ?>

            <?php if ($key !== 0 || $view === 'columns'): ?>
          <div class="pd-1 <?= $key; ?>">
              <?php endif; ?>

              <?php if (get_the_date() && $view === 'metro') : ?>
                <div class="date">
                    <?= twentytwenty_get_theme_svg('calendar', 'ui'); ?><?php the_date(); ?>
                </div>
              <?php endif; ?>

            <div class="f-600 post-title"><?php the_title(); ?></div>

              <?php if ($key !== 0 || $view === 'columns'): ?>
          </div>
        <?php endif;
        ?>
        </a>
          <?php if ($key == 3 && $view === 'metro') {
          echo '</div>';
      } ?>
      <?php endforeach;
      wp_reset_postdata();
      ?>

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
