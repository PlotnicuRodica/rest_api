<?php

namespace frontend\controllers;

use common\models\Poetry;
use common\models\PoetryCategory;
use yii\db\Exception;
use yii\web\Controller;
use Yii;
use yii\web\HttpException;

/**
 * Poetry controller for Api
 */
class PoetryController extends Controller
{

    /*
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'list'  => ['GET'],
                    'one'   => ['GET'],
                    'create' => ['GET', 'POST'],
                    'update' => ['GET', 'PUT', 'POST'],
                    'delete' => ['POST', 'DELETE'],
                ],
            ],
        ];
    }
    */

    public function beforeAction($action)
    {
        Yii::$app->response->format = 'json';
        Yii::$app->controller->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionList()
    {
        if(Yii::$app->request->isGet) {
            $models = Poetry::find()->all();
            foreach ($models as $model) $model->category_id = PoetryCategory::findOne(['id' => $model->category_id]);
            return $models;
        } else throw new HttpException(400);
    }

    public function actionFilter($id){
        if(Yii::$app->request->isGet) {
            $models = Poetry::find()->where(['category_id' => $id])->all();
            foreach ($models as $model) $model->category_id = PoetryCategory::findOne(['id' => $model->category_id]);
            return $models;
        } else throw new HttpException(400);
    }

    public function actionPagination($id)
    {
        if(Yii::$app->request->isGet){
            $limit = 10;
            $offset = ($id * 10)-10;
            $models = Poetry::find()->offset($offset)->limit($limit)->all();
            foreach ($models as $model) $model->category_id = PoetryCategory::findOne(['id' => $model->category_id]);
            return $models;
        }
        else throw new HttpException(400);
    }

    public function actionOne($id)
    {
        if(Yii::$app->request->isGet) {
            $poetry = Poetry::findOne(['id' => $id]);
            $poetry->category_id = PoetryCategory::findOne(['id' => $poetry->category_id]);
            if ($poetry) return $poetry;
            throw new HttpException(404,'There is no poetry with this ID');
        } else throw new HttpException(400);
    }

    public function actionCreate()
    {
        if(Yii::$app->request->isPost) {
            try {
                $data = json_decode(file_get_contents("php://input"), true);
                $poetry = new Poetry();
                $poetry->setAttributes($data);
                if ($poetry->save()) {
                    return $poetry->getAttribute('id');
                }
                $errors_s = '';
                foreach ($poetry->errors as $error) {
                    if (is_array($error)) {
                        foreach ($error as $err) {
                            $errors_s .= $err.'; ';
                        }
                    }
                }
                throw new HttpException(400, $errors_s);
            } catch (Exception $err) {
                throw new HttpException(400);
            }
        } else throw new HttpException(400);
    }

    public function actionUpdate($id)
    {
        if(Yii::$app->request->isPut) {
            try {
                $poetry = Poetry::findOne(['id' => $id]);
                if ($poetry) {
                    $data = json_decode(file_get_contents("php://input"), true);
                    $poetry->setAttributes($data);
                    if ($poetry->save()) {
                        return $poetry;
                    }
                    $errors_s = '';
                    foreach ($poetry->errors as $error) {
                        if (is_array($error)) {
                            foreach ($error as $err) {
                                $errors_s .= $err.'; ';
                            }
                        }
                    }
                    throw new HttpException(400, $errors_s);
                }
                throw new HttpException(404, 'There is no poetry with this ID');
            } catch (Exception $err) {
                throw new HttpException(400);
            }
        } else throw new HttpException(400);
    }

    public function actionDelete($id){
        if(Yii::$app->request->isDelete) {
            $poetry = Poetry::findOne(['id' => $id]);
            if ($poetry) {
                return $poetry->delete();
            } else throw new HttpException(404, 'There is no poetry with this ID');
        } else throw new HttpException(400);
    }
}