<?php
use yii\widgets\DetailView;
use yii\helpers\Url;

?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'created_by',
        'image_web_filename',
        'image_src_filename',
        'created_at',
        'updated_at',
    ],
]) ?>

<?php
if ($model->image_web_filename!='') {
    echo '<br /><p><img width="1000" height="900" src="'.Url::base(true). '/uploads/images/'.$model->image_web_filename.'"></p>';
}
?>