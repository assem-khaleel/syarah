<?php
/* @var $this yii\web\View */
?>
<h1>Uploaded images</h1>

<?php


use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\grid\GridView;
use yii\helpers\Url;


$this->title = 'List Images';
$this->params['breadcrumbs'][] = $this->title;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'image_src_filename',
        'created_by',
        'created_at:date',
        [
            'attribute' => 'img',
            'format' => 'html',
            'label' => 'Image',
            'value' => function ($model) {
                return Html::img(Url::base(true) . '/uploads/images/'.$model->image_web_filename,
                    ['width' => '55px','height' => '100px']);
            },
        ],
        'status'
    ],

]);

?>
