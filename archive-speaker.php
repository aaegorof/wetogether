<?php
$props = array("withDate"=> false, "imgfieldname" => "img-2");

?>

<?php get_header() ;?>

<main>
  <header class="page-header">
      <?php the_archive_title('<h1 class="entry-title">', '</h1>'); ?>
    <div class="text-note header-intro">
        <?php the_archive_description(); ?>
    </div>
  </header>

  <section class="container taxonomy-speaker">
      <?php if (have_posts()) { ?>
          <div class="grid-4">
          <?php while (have_posts()) {
              the_post(); ?>
              <?php get_template_part('template-parts/card', '', $props) ;?>
              <?php wp_reset_postdata() ;?>
          <?php } ?>
          </div>
          <?php the_posts_pagination() ;?>
      <?php }; ?>
  </section>
</main>

<?php get_footer() ;?>
