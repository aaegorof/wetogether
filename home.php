<?php $q = get_queried_object();

$props = array("withDate"=> $q->name !== 'speaker');
?>

<?php get_header() ;?>
<main>
  <header class="page-header">
    <h1 class="entry-title"><?php _e('Все новости'); ?></h1>
    <div class="text-note header-intro">
        <?php the_content(); ?>
    </div>
  </header>

  <section class="container taxonomy-<?php $q->name ;?>">
      <?php if (have_posts()) { ?>
          <div class="grid-4">
          <?php while (have_posts()) {
              the_post(); ?>
              <?php get_template_part('template-parts/card', '', $props) ;?>
          <?php } ?>
          </div>
      <?php }; ?>
  </section>
</main>

<?php get_footer() ;?>
