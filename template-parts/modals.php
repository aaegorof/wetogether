<?php
$forms = get_field('form-wrap', 'options');
$formMedia = $forms[2];
?>
<section class="modals ui dimmer modals page transition hidden">
  <div class="ui modal" id="registration-mass-media">
    <i class="close icon fa fa-times"></i>
    <div class="header">
        <?= $formMedia['form-title']; ?>
    </div>
    <div class="content">
        <?= $formMedia['text-form']; ?>
    </div>
  </div>

    <div class="ui modal" id="topic-suggest">
        <i class="close icon fa fa-times"></i>
        <div class="header">
           <?php _e('Предложить тему') ;?>
        </div>
        <div class="content">
            <?php echo do_shortcode('[contact-form-7 id="273" title="Предложить тему"]') ;?>
        </div>
    </div>


</section>
