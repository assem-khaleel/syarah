<?php
/* @var $this yii\web\View */
?>


<?php


use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;


$this->title = 'Validate Images';
$this->params['breadcrumbs'][] = $this->title;


echo GridView::widget([
    'dataProvider' => $dataProvider,
    //'pjax'               => true,
    /*'pjaxSettings'       => [
        'options' => [
            'enablePushState' => false,
        ]
    ],*/
    'columns' => [

        ['class' => 'yii\grid\SerialColumn'],
        'image_src_filename',
        'created_by',
        'created_at:date',
        'status',
        [
            'attribute' => 'img',
            'format' => 'html',
            'label' => 'Image',
            'value' => function ($model) {
                return Html::img(Url::base(true) . '/uploads/images/'.$model->image_web_filename,
                    ['width' => '55px','height' => '100px']);
            },
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {approve} {reject}',  // the default buttons + your custom button
            'buttons' => [
                'approve' => function($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, [
                        'title' => Yii::t('yii', 'Approve'),
                    ]);
                },
                'reject' => function($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                        'title' => Yii::t('yii', 'Reject'),
                    ]);
                }
            ]
        ]

        /*'id',
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
        'status' */
    ],
    //'status'

]);

?>
