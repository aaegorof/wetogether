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
$samePosts = get_posts(array(
    'posts_per_page' => 3,
    'post_type' => 'post',
    'meta_key' => '',
    'orderby' => 'meta_value',
    'order'  => 'ASC',
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'terms' => get_categories(),
        )
    )
));
?>
<?php get_template_part('template-parts/content-nav') ;?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

  <div class="row container">
    <div class="col-md-9 pd-md-2-r">
      <div class="post-body bg-white pd-2">
        <div class="row meta-top">
          <div class="text-note">
            <?php the_date('F j Y, g:i') ;?>
          </div>
        </div>
        <h1><?php the_title(); ?></h1>
        <?php the_content();?>
      </div>
    </div>
    <aside class="col-md-3 pd-1">

    </aside>
  </div>

	<div class="container">
		<?php
		  edit_post_link();
		  if(!empty($samePosts)): ?>
    <h2><?php _e('Смотрите также', 'twentytwenty') ;?></h2>
    <div class="grid-4 mg-2-t mg-4-b">
    <?php foreach ($samePosts as $post) {
      setup_postdata($post);
        get_template_part('template-parts/card', '', array('withDate' => true));
      }
    wp_reset_postdata();?>
      <?php endif;?>
    </div>
	</div><!-- .section-inner -->

</article><!-- .post -->
