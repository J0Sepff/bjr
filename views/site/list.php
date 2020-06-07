<?php
use yii\widgets\ActiveForm;
?>

<table style="width:100%">
    <?php
    $query = new \yii\db\Query();
    $query->select(['id', 'name', 'ext', 'created_at'])->from('upload_info');
    $lists = $query->all();

    foreach ($lists as $list) {
        echo '
    <tr>
        <th>'.$list['name'].'</th>
        <th>'.$list['ext'].'</th>
        <th>'.$list['created_at'].'</th>
    </tr>';
    } ?>
</table>