<?php
$forms_title = get_field('title', 'options');
$forms = get_field('form-wrap', 'options');
$section = get_sub_field('for_section');
?>

<section class="forms-wrap container" id="registrations">
  <h2><?= $section['title'] ? $section['title'] : $forms_title ;?></h2>
  <div class="tab-menu">
    <?php foreach ($forms as $key => $form) :?>
      <a class="item <?= $key === 0 ? 'active' : '' ;?>" data-tab="registr-form-<?= $key ;?>"><?= $form['form-title'] ;?></a>
    <?php endforeach; ;?>
  </div>

    <?php foreach ($forms as $key => $form) :?>
      <div class="tab-item pd-4-v mg-2-b ui tab <?= $key === 0 ? 'active' : '' ;?>" data-tab="registr-form-<?= $key ;?>">
        <?php get_template_part('template-parts/form-content', '', $form) ;?>
    </div>
    <?php endforeach;?>
</section>
