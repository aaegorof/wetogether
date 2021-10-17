<?php
/*
 * @array   $layout      Layout settings (without values)
 * @array   $field       Flexible content field settings
 * @bool    $is_preview  True in Administration
 */
?>

<h2><?php the_sub_field('title'); ?></h2>
<a href="<?= get_sub_field('link')['url']; ?>"><?= get_sub_field('link')['title']; ?></a>
