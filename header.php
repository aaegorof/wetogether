<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
wp_body_open();
?>

<div class="bg-gradient"></div>
<header id="site-header" class="main-header" role="banner">
  <div class="container row space-between align-center">
    <?php
    // Site title or logo.
    the_custom_logo();
    ?>

    <div class="header-navigation-wrapper">
        <?php
        if (has_nav_menu('primary') || !has_nav_menu('expanded')) {
            ?>

          <nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x('Horizontal', 'menu', 'twentytwenty'); ?>"
               role="navigation">

            <ul class="primary-menu reset-list-style">

                <?php
                if (has_nav_menu('primary')) {
                    wp_nav_menu(
                        array(
                            'container' => '',
                            'items_wrap' => '%3$s',
                            'theme_location' => 'primary',
                        )
                    );

                } elseif (!has_nav_menu('expanded')) {

                    wp_list_pages(
                        array(
                            'match_menu_classes' => true,
                            'show_sub_menu_icons' => true,
                            'title_li' => false,
                            'walker' => new TwentyTwenty_Walker_Page(),
                        )
                    );

                }
                ?>

            </ul>

          </nav><!-- .primary-menu-wrapper -->

            <?php
        }
        ?>

    </div><!-- .header-navigation-wrapper -->

    <?php dynamic_sidebar('Шапка 0'); ?>

    <select name="" id="">
      <option value="ru"></option>
      <option value="en"></option>
    </select>
  </div>
</header><!-- #site-header -->

<?php
// Output the menu modal.
get_template_part('template-parts/modal-menu');
