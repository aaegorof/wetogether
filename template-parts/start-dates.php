<?php

function get_meta_values($key = 'start_date', $type = 'event', $prepare_field = null)
{
    global $wpdb;
    $status = 'publish';
    if (empty($key))
        return;

    $r = $wpdb->get_results($wpdb->prepare("
SELECT p.ID, pm.meta_value FROM {$wpdb->postmeta} pm
LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
WHERE pm.meta_key = '%s'
AND p.post_status = '%s'
AND p.post_type = '%s'
ORDER BY pm.meta_value ASC
", $key, $status, $type));

    foreach ($r as $my_r) {
        $val = $prepare_field ? $prepare_field($my_r->meta_value) : $my_r->meta_value;
        $metas[$my_r->ID] = $val;
    }
    return $metas;
}

//$formatted_date = date_i18n('j F Y с H:i', strtotime($start_date));
$explodeDate = function ($val) {
    $onlyDate = explode(' ', $val)[0];
    if (strtotime($val) >= strtotime(date('Ymd H:i'))) {
        return date_i18n('j F', strtotime($onlyDate));
    }
};
$values = array_filter(array_unique(get_meta_values('start_date', 'event')), function ($value) {
    return !is_null($value) && $value !== '';
});
?>

<?php $uniqDates = []; ?>
<div class="programm-dates ui top secondary menu">
    <a class="item set-start-date"
       data-startDate="all">Все</a>
    <?php foreach ($values as $k => $val): ?>
        <?php if (strtotime($val) >= strtotime(date('Ymd H:i'))) : ?>
            <?php
            $onlyDate = explode(' ', $val)[0];
            if (!in_array($onlyDate, $uniqDates)):?>
                <?php array_push($uniqDates, $onlyDate);; ?>
              <a class="item set-start-date"
                      data-startDate="<?= $onlyDate; ?>"> <?= date_i18n('j F', strtotime($onlyDate)); ?> </a>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

