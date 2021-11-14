<?php
$forms = get_field('form-wrap', 'options');
$formMedia = $forms[2];
?>
<?php get_template_part('template-parts/modal', '', array('header' => $formMedia['form-title'], 'content' => $formMedia['text-form'], 'id' => "registration-mass-media")) ;?>
<?php get_template_part('template-parts/modal', '', array('header' =>  'Предложить тему', 'content' => do_shortcode('[contact-form-7 id="273" title="Предложить тему"]'), 'id' => "topic-suggest")) ;?>
