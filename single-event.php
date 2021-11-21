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

<main id="site-content" class="container type-<?= get_post_type() ;?> mg-4-b" role="main">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post(); ?>

          <div class="row">
            <div class="col-md-9 pd-md-2-r">
              <h1><?php the_title(); ?></h1>
                <?php get_template_part('template-parts/loop-event') ;?>
              <?php if(get_the_content()) :?>
              <div class="card mg-2-t"><?php the_content();?></div>
              <?php endif ;?>
            </div>

            <aside class="col-md-3 pd-1">
              <?php if(get_post_thumbnail_id()) :?>
              <img src="<?= get_the_post_thumbnail_url(); ?>" alt="<?php the_title();?>">
            <?php endif ;?>
            </aside>

          </div>
        <?php }
    }
    ?>
</main><!-- #site-content -->

<?php get_footer(); ?>
