<?php
["content" => $content, 'header' => $header, 'id' => $id] = $args;
;?>

<div class="ui modal" id="<?= $id ;?>">
    <i class="close icon fa fa-times"></i>
    <?php if($header): ?>
    <div class="header">
        <?= $header; ?>
    </div>
    <?php endif;?>
    <div class="content">
        <?= $content; ?>
    </div>
</div>
