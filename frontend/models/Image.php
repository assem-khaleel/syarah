<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Image".
 *
 * @property int $id
 * @property string $image_src_filename
 * @property string $image_web_filename
 * @property string $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 */
class Image extends \yii\db\ActiveRecord
{
    public $image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        /*return [
            [['image_src_filename', 'image_web_filename'], 'required'],
            [['created_at', 'updated_at', 'created_by'], 'integer'],
            [['image_src_filename', 'image_web_filename'], 'string', 'max' => 255],
        ]; */

        return [
            [['created_at', 'updated_at','created_by'], 'integer'],
            [['image'], 'safe'],
            //[['image'], 'file', 'types'=>'jpg,gif,png,JPG,JPEG'],
            [['image'], 'file', 'extensions' => 'jpg,GIF,gif,png,JPG,JPEG'],
            [['image'], 'file', 'maxSize'=>'15000000'],
            [['image_src_filename', 'image_web_filename'], 'string', 'max' => 255],
            [['status', 'image_web_filename'], 'string'],
            ];


    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_src_filename' => 'Image Src Filename',
            'image_web_filename' => 'Image Web Filename',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'status' => 'Status',
        ];
    }
}
