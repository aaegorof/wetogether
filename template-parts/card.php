<?php
['withDate' => $withDate, 'class' =>$class, 'withExcerpt' => $withExcerpt, 'imgfieldname' => $imgfieldname ] = $args;

$imgUrl = get_field($imgfieldname) ? get_field($imgfieldname)  : get_the_post_thumbnail_url();
?>
<a href="<?= get_permalink() ;?>" class="card-item <?= $class;?>">
  <?php if($imgUrl):?>
    <img src="<?= $imgUrl;?>" alt="<?php the_title();?>">
  <?php endif ;?>
    <div class="pd-1 metas">
        <?php if($withDate):?>
            <div class="date text-note"><?= twentytwenty_get_theme_svg('calendar', 'ui'); ?><?=  get_the_date();?></div>
        <?php endif;?>
        <div class="name"><?php the_title() ;?></div>
        <div class="description">
            <?php if($withExcerpt){
              echo get_the_excerpt();
            } else {
                the_field('position');
            }?>
        </div>
    </div>
</a>
<?php wp_reset_postdata() ;?>
