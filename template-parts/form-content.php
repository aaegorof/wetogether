<?php
$form = $args;
$img = $form['form-img'];

?>
<div class="form-content">
    <div class="row space-between">
        <div class="col-md-5">
            <?= $form['text-form'] ;?>
        </div>
        <?php if($img) :?>
        <div class="col-md-5 pd-md-4-l">
            <img src="<?= $img;?>" alt="<?= $form['form-title'];?>">
        </div>
        <?php endif; ;?>
    </div>
</div>
