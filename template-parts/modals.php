<?php
$forms = get_field('form-wrap', 'options');
?>
<?php get_template_part('template-parts/modal', '', array('header' => 'Регистрация СМИ', 'content' => do_shortcode('[contact-form-7 id="193" title="Регистрация СМИ"]'), 'id' => "registration-mass-media")) ;?>
<?php get_template_part('template-parts/modal', '', array('header' =>  'Предложить тему', 'content' => do_shortcode('[contact-form-7 id="273" title="Предложить тему"]'), 'id' => "topic-suggest")) ;?>
