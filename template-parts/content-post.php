<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
global $post;
?>
<?php get_template_part('template-parts/content-nav'); ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

  <div class="row container">
    <div class="col-md-9 pd-md-2-r">
      <div class="post-body bg-white pd-2">
        <div class="row meta-top">
          <div class="text-note">
              <?php the_date('F j Y, g:i'); ?>
          </div>
        </div>
        <h1><?php the_title(); ?></h1>
          <?php the_content(); ?>
      </div>
    </div>
    <aside class="col-md-3 pd-1">
        <?php if (get_post_thumbnail_id()) : ?>
          <img src="<?= get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
        <?php endif; ?>
    </aside>
  </div>



</article><!-- .post -->
