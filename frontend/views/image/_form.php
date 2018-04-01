<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
//use app\assets\ImageAsset;
use  app\models\Image;

//ImageAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Image */
/* @var $form ActiveForm */
?>
<div class="image-_form">

    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']]); ?>


    <div class="row">
        <?= $form->field($model, 'image')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png'],'showUpload' => false,],
        ]);   ?>
    </div>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- image-_form -->
