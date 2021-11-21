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

function get_meta_values( $key = 'start_date', $type = 'event', $prepare_field = null ) {
    global $wpdb;
    $status = 'publish';
    if( empty( $key ) )
        return;

    $r = $wpdb->get_results( $wpdb->prepare( "
        SELECT p.ID, pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s' 
        AND p.post_status = '%s' 
        AND p.post_type = '%s'
        ORDER BY pm.meta_value ASC
    ", $key, $status, $type ));

    foreach ( $r as $my_r ) {
      $val = $prepare_field ? $prepare_field($my_r->meta_value) : $my_r->meta_value;
      $metas[$my_r->ID] = $val;
    }
    return $metas;
}
//$formatted_date = date_i18n('j F Y с H:i', strtotime($start_date));
$explodeDate = function ($val){
  $onlyDate = explode(' ', $val)[0];
    return date_i18n('j F', strtotime($onlyDate));
};
$values = array_unique(get_meta_values('start_date', 'event', $explodeDate));
?>

<div class="programm-dates row">
    <?php foreach ($values as $k=>$val):?>
      <button class="button"> <?= $val ;?> </button>
    <?php endforeach ;?>
</div>

<?php
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
