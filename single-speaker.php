<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>
<?php get_template_part('template-parts/content-nav') ;?>

<main id="site-content" class="container type-<?= get_post_type() ;?>" role="main">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post(); ?>

            <?php
            $position = get_field('position');
            $email = get_field('email');
            $tel = get_field('telefon');
            ;?>
          <div class="row">
            <aside class="col-md-3 bg-white pd-1">
              <img src="<?= get_the_post_thumbnail_url(); ?>" alt="<?php the_title();?>">
              <div class="pd-1">
                <?php if($position):?>
                  <div class="meta"> <i class="fa fa-briefcase"></i><?= $position ;?></div>
                <?php endif;?>
                  <?php if($email):?>
                    <a class="meta" href="mailto:<?= $email ;?>"> <i class="far fa-envelope"></i><?= $email ;?></a>
                  <?php endif;?>
                  <?php if($tel):?>
                    <a href="tel:<?= $tel ;?>" class="meta"> <i class="fa fa-mobile-alt"></i><?= $tel ;?></a>
                  <?php endif;?>
              </div>
            </aside>

            <div class="col-md-9 pd-md-2-l">
              <h1><?php the_title(); ?></h1>
              <div class="description bg-white pd-2">
                <?php the_content();?>
              </div>
            </div>

          </div>
        <?php }
    }
    ?>
</main><!-- #site-content -->

<?php get_footer(); ?>
