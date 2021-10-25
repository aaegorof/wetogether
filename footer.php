<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */


$has_social_menu = has_nav_menu( 'social' );
?>


<footer id="site-footer" role="contentinfo" class="header-footer-group con">

  <div class="section-inner container">

    <div class="footer-credits">
        <?php if ( $has_social_menu ) { ?>
          <nav aria-label="<?php esc_attr_e( 'Social links', 'twentytwenty' ); ?>" class="footer-social-wrapper">

            <ul class="social-menu footer-social reset-list-style social-icons fill-children-current-color">

                <?php
                wp_nav_menu(
                    array(
                        'theme_location'  => 'social',
                        'container'       => '',
                        'container_class' => '',
                        'items_wrap'      => '%3$s',
                        'menu_id'         => '',
                        'menu_class'      => '',
                        'depth'           => 1,
                        'link_before'     => '<span class="screen-reader-text">',
                        'link_after'      => '</span>',
                        'fallback_cb'     => '',
                    )
                );
                ?>

            </ul><!-- .footer-social -->

          </nav><!-- .footer-social-wrapper -->

        <?php } ?>
    </div><!-- .footer-credits -->

  </div><!-- .section-inner -->

</footer><!-- #site-footer -->
<div class="footer-copyright">
  <div class="container">&copy;
    <?php
    echo date_i18n(
    /* translators: Copyright date format, see https://www.php.net/manual/datetime.format.php */
        _x('Y', 'copyright date format', 'twentytwenty')
    );
    ?>
  <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
  </div>
</div><!-- .footer-copyright -->
<?php wp_footer(); ?>

</body>
</html>
