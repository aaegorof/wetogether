<?php
global $post;
$q = get_queried_object();

//query_posts( $query_string .'&cat=-6,-9&order=ASC&posts_per_page=20' );
$props = array("withDate"=> true);
$propssticky = array("withDate"=> true, 'class' => 'double-size sticky');

$stickyids = get_option( 'sticky_posts' );

$args = array(
    'numberposts' => -1,
    'orderby' => 'date',
    'exclude' => $stickyids
);

$stickyargs = array(
//    'post_type' => 'post',
    'numberposts' => 1,
    'orderby' => 'date',
    'include' => $stickyids[0] ? $stickyids : ['1']
);

$stickyposts = get_posts($stickyargs);
$otherposts = get_posts($args);
?>
<?php get_header() ;?>
<main>
  <header class="page-header">
    <h1 class="entry-title"><?php _e('Все новости'); ?></h1>
    <div class="text-note header-intro">
        <?php echo get_the_excerpt($q); ?>
    </div>
  </header>

  <section class="container taxonomy-<?php $q->name ;?>">
      <?php if (have_posts()) { ?>
          <div class="grid-4">
              <?php foreach ($stickyposts as $post):?>
                  <?php setup_postdata($post) ;?>
                  <?php get_template_part('template-parts/card', '', $propssticky) ;?>
                  <?php wp_reset_postdata() ;?>
              <?php endforeach;?>
            <?php foreach ($otherposts as $post):?>
              <?php setup_postdata($post) ;?>
              <?php get_template_part('template-parts/card', '', $props) ;?>
              <?php wp_reset_postdata() ;?>
            <?php endforeach;?>
          </div>
      <?php }; ?>
  </section>
</main>

<?php get_footer() ;?>
