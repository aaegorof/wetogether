
<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>
<section class="main">
  <?php if(has_flexible('content-row')):
      the_flexible('content-row');
  endif; ?>
    <?php the_content(); ?>
</section>

<?php
$start_date = wp_date('Ymd\THis');
$end_date = wp_date('Ymd\THis');
?>
<form method="post" action="?ics=true">

  <input type="hidden" name="start_date" value="<?php echo $start_date; ?>">

  <input type="hidden" name="end_date" value="<?php echo $end_date; ?>">

  <input type="hidden" name="location" value="event_location">

  <input type="hidden" name="summary" value="<?php the_title(); ?>">

  <input type="submit" value="Add to Calendar">
</form>

<?php get_footer(); ?>
