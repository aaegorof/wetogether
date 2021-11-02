<?php
$withDate = $args['withDate'];
?>
<a href="<?= get_permalink() ;?>" class="card-item">
    <img src="<?= get_the_post_thumbnail_url();?>" alt="<?php the_title();?>">
    <div class="pd-1 metas">
        <?php if($withDate):?>
            <div class="date text-note"><?= twentytwenty_get_theme_svg('calendar', 'ui'); ?><?=  get_the_date();?></div>
        <?php endif;?>
        <div class="name"><?php the_title() ;?></div>
        <div class="description">
            <?php if($withDate){
              the_excerpt();
            } else {
                the_field('position');
            }?>
        </div>
    </div>
</a>
