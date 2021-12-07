<?php
$tabs = get_sub_field('tab-rows');
$equal = get_sub_field('equal');
$section = get_sub_field('for_section');
$notes = $section['notes'];
?>
<section class="tabs-wrap container">
    <h2><?php echo $section['title']; ?></h2>
    <div class="tab-menu <?= $equal ? 'equal': '' ;?>">
        <?php foreach ($tabs as $key => $tab) :?>
            <a class="item <?= $key === 0 ? 'active' : '' ;?>" data-tab="tab-<?= $key ;?>"><?= $tab['title'] ;?></a>
        <?php endforeach; ;?>
    </div>

    <?php foreach ($tabs as $key => $tab) :?>
        <div class="tab-item pd-4-t ui tab <?= $key === 0 ? 'active' : '' ;?>" data-tab="tab-<?= $key ;?>">
            <?= $tab['content'] ;?>
        </div>
    <?php endforeach;?>

    <?php if ($section['link']): ?>
        <div class="row centered mg-3-t">
            <div class="col-sm-12 text-center">
                <a href="<?= $section['link']['url']; ?>"
                   class="button primary"><?= $section['link']['title']; ?>
                </a>
            </div>
            <?php if ($notes): ?>
                <div class="color-grey text-center font-size-xs footer-notes mg-2-t">
                    <?= $notes; ?>
                </div>
            <?php endif;; ?>
        </div>
    <?php endif; ?>
</section>
