<?php
/*
 * @array   $layout      Layout settings (without values)
 * @array   $field       Flexible content field settings
 * @bool    $is_preview  True in Administration
 */

$features = get_sub_field('feature-list');
?>

<section class="features-wrap container">
    <?php foreach ($features as $feature) : ?>
        <?php get_template_part('acf/feature', '', $feature); ?>
    <?php endforeach; ?>
</section>
