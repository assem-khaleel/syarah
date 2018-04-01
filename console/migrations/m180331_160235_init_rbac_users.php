<?php

use yii\db\Migration;

/**
 * Class m180331_160235_init_rbac_users
 */
class m180331_160235_init_rbac_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180331_160235_init_rbac_users cannot be reverted.\n";

        return false;
    }


   public function up()
    {
        $auth = Yii::$app->authManager;

        // add "uploadImage" permission
        $uploadImage = $auth->createPermission('uploadImage');
        $uploadImage->description = 'Upload image';
        $auth->add($uploadImage);

        // add "validateImage" permission
        $validateImage = $auth->createPermission('validateImage');
        $validateImage->description = 'Validate image';
        $auth->add($validateImage);

        // add "uploader" role and give this role the "uploadImage" permission
        $uploader = $auth->createRole('uploader');
        $auth->add($uploader);
        $auth->addChild($uploader, $uploadImage);

        // add "validator" role and give this role the "validateImage" permission

        $validator = $auth->createRole('validator');
        $auth->add($validator);
        $auth->addChild($validator, $validateImage);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($uploader, 2);
        $auth->assign($validator, 1);
    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
