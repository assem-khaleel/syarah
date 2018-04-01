<?php

namespace frontend\controllers;



use Yii;
use app\models\Image;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\db\Exception;





class ImageController extends \yii\web\Controller
{
    public $model;

    public function rules()
    {
        return array(
            array('image', 'file', 'mimeTypes'=>'image/gif, image/jpeg, image/png , image/jpg'),
        );
    }

    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['Uploader'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['Validator'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['Validator'],
                    ],

                ],
            ],
        ];
    }*/

    public function actionIndex()
    {
        $assigments = Yii::$app->authManager->getAssignments(Yii::$app->user->getId());
        if(isset($assigments['Uploader'])){

            $dataProvider = new ActiveDataProvider([
                'query' => Image::find()->where(['created_by'=>Yii::$app->user->getId()]),
                'pagination' => [
                    'pageSize' => 8,
                ],
            ]);

            return $this->render('index', ['model' => $this->model,'dataProvider' => $dataProvider]);
        }
        else{
            throw new \yii\base\Exception('Hello , You are not authorized for this action');
        }

    }

    public function actionCreate()
    {
        $assigments = Yii::$app->authManager->getAssignments(Yii::$app->user->getId());
        if(isset($assigments['Uploader'])){
            $model = new Image();

            if ($model->load(Yii::$app->request->post())) {
                $image = UploadedFile::getInstance($model, 'image');
                if (!is_null($image)) {
                    $model->image_src_filename = $image->name;
                    $ext = explode(".", $image->name);
                    $ext = end($ext);

                    $model->image_web_filename = Yii::$app->security->generateRandomString() . ".{$ext}";
                    Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/images/';
                    $path = Yii::$app->params['uploadPath'] . $model->image_web_filename;

                    $model->created_at = time();
                    $model->updated_at = time();
                    $model->created_by = Yii::$app->user->getId();


                    $image->saveAs($path);
                }
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    var_dump($model->getErrors());
                    die();
                }
            }
            return $this->render('create', [
                'model' => $model,
            ]);

        }
        else{
            throw new \yii\base\Exception('Hello , You are not authorized for this action');
        }

    }

    public function actionView($id)
    {
        $model = Image::findOne($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionValidate()
    {
        $assigments = Yii::$app->authManager->getAssignments(Yii::$app->user->getId());
        if(isset($assigments['Validator'])){
            $dataProvider = new ActiveDataProvider([
                'query' => Image::find(),
                'pagination' => [
                    'pageSize' => 8,
                ],
            ]);

            return $this->render('validate', ['model' => $this->model,'dataProvider' => $dataProvider]);
        }
        else{
            throw new \yii\base\Exception('Hello , You are not authorized for this action');
        }


    }

    public function actionApprove($id)
    {
        $assigments = Yii::$app->authManager->getAssignments(Yii::$app->user->getId());
        if(isset($assigments['Validator'])){
            $model = Image::findOne($id);
            $model->status = 'approved';

            if($model->save()){
                Yii::$app->session->setFlash('success', "Image Approved");
                return $this->redirect(['image/validate']);
            }
            else{
                throw new Exception("Error saving UserProfile model : " . var_export($model->getErrors(), true));
            }
        }
        else{
            throw new \yii\base\Exception('Hello , You are not authorized for this action');
        }

    }

    public function actionReject($id)
    {
        $assigments = Yii::$app->authManager->getAssignments(Yii::$app->user->getId());
        if(isset($assigments['Validator'])){
            $model = Image::findOne($id);
            $model->status = 'rejected';

            if($model->save()){
                Yii::$app->session->setFlash('error', "Image rejected");
                return $this->redirect(['image/validate']);
            }
            else{
                throw new Exception("Error saving UserProfile model : " . var_export($model->getErrors(), true));
            }
        }
        else{
            throw new \yii\base\Exception('Hello , You are not authorized for this action');
        }

    }


}