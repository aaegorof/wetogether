<?php
/**
 * Search & Filter Pro
 *
 * Sample Results Template
 *
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      https://searchandfilter.com
 * @copyright 2018 Search & Filter
 *
 * Note: these templates are not full page templates, rather
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think
 * of it as a template part
 *
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs
 * and using template tags -
 *
 * http://codex.wordpress.org/Template_Tags
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( $query->have_posts() )
{
    ?>
<section class="container programm-results search-filter-results-list">

    <?php
    while ($query->have_posts())
    {
        $query->the_post();

        get_template_part('template-parts/loop-event');
    }
    ?>
</section>
  Стр <?php echo $query->query['paged']; ?> of <?php echo $query->max_num_pages; ?><br />

  <div class="pagination">

    <div class="nav-previous"><?php next_posts_link( 'След', $query->max_num_pages ); ?></div>
    <div class="nav-next"><?php previous_posts_link( 'Пред' ); ?></div>
      <?php
      /* example code for using the wp_pagenavi plugin */
      if (function_exists('wp_pagenavi'))
      {
          echo "<br />";
          wp_pagenavi( array( 'query' => $query ) );
      }
      ?>
  </div>
    <?php
}
else
{?>
  <div class='search-filter-results-list' data-search-filter-action='infinite-scroll-end'>
    <span>End of Results</span>
  </div>
<?php } ?>
