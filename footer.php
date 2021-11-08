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
<?php get_template_part('template-parts/modals') ;?>
<footer id="site-footer" role="contentinfo" class="header-footer-group mg-4-t">
  <div class="section-inner container row">
      <?php
      // Site title or logo.
      $logo = get_field('logo-gray', 'option');
      $email_g = get_field('email_general', 'option');
      $email_mass = get_field('email_mass_media', 'option');
      $mail = twentytwenty_get_theme_svg( 'mail', 'social');
//      $mail = twentytwenty_get_theme_svg( 'mail' );
      ?>
    <img src="<?= $logo['url'];?>" alt="" class="logo-gray col-md-1">
    <div class="row col-md-10">
        <?php if ( $has_social_menu ) { ?>
          <nav aria-label="<?php esc_attr_e( 'Social links', 'twentytwenty' ); ?>" class="footer-social-wrapper col-md-3 push-right">
            <p>Мы в социальных сетях</p>
            <ul class="social-menu footer-social reset-list-style social-icons">

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

      <?php if($email_g) :?>
      <div class="col-md-3">
        <p>Общие вопросы</p>
        <a href="mailto:<?= $email_g;?>" class="mail-link"><?= $mail ;?><?= $email_g;?></a>
      </div>
      <?php endif ;?>
        <?php if($email_mass) :?>
          <div>
            <p>Для СМИ</p>
            <a href="mailto:<?= $email_mass;?>" class="mail-link"><?= $mail ;?><?= $email_mass;?></a>
          </div>
        <?php endif ;?>
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
