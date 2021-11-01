<?php
$forms_title = get_field('title', 'options');
$forms = get_field('form-wrap', 'options');
?>

<section class="forms-wrap container">
    <?php foreach ($forms as $form) :?>
    <div class="form pd-2 mg-2-b">
        <div class="h2"><?= $form['form-title'] ;?></div>
        <div class="form-content">
            <?= $form['text-form'] ;?>
        </div>
    </div>
    <?php endforeach;?>
</section>
