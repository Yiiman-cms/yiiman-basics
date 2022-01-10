<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\slug\controllers;

use YiiMan\YiiBasics\modules\menu\models\Menu;
use Yii;
use YiiMan\YiiBasics\modules\slug\models\Slug;
use YiiMan\YiiBasics\modules\slug\models\SearchSlug;
use yii\db\ActiveRecord;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * DefaultController implements the CRUD actions for Slug model.
 */
class DefaultController extends \YiiMan\YiiBasics\lib\Controller
{
    public $enableCsrfValidation = false;
    public $skipPermittions=['check'=>true];
    /**
     * @var $model SearchSlug
     */
    public $model;

    public static function update(ActiveRecord $relatedModel)
    {
        $post = Yii::$app->request->post();
        if (!empty($post['Slug']['slug'])) {
            $query = <<<SQL
select * from module_slug where slug='{$post['Slug']['slug']}'
SQL;

            $model = Yii::$app->db->createCommand($query)->queryAll();
            if (empty($model)) {
                if ($relatedModel->isNewRecord) {
                    $model = new Slug();
                    $model->slug = $post['Slug']['slug'];
                    $model->table_id = $relatedModel->id;
                    $model->table_name = $relatedModel::tableName();
                    $model->save();
                } else {
                    $model = Slug::findOne(['table_id'   => $relatedModel->id,
                                            'table_name' => $relatedModel::tableName()
                    ]);
                    if (!empty($model)) {
                        $model->slug = $post['Slug']['slug'];
                        $model->save();
                    } else {
                        $model = new Slug();
                        $model->slug = $post['Slug']['slug'];
                        $model->table_id = $relatedModel->id;
                        $model->table_name = $relatedModel::tableName();
                        $model->save();
                    }
                }
            }
        } else {
            if (empty($post['slug'])) {
                $slugModel = Slug::findOne(['table_id'   => $relatedModel->id,
                                            'table_name' => $relatedModel::tableName()
                ]);
                if (!empty($slugModel)) {
                    $slugModel->delete();
                }
            }
        }
    }

    public function actionCheck()
    {
        $post = Yii::$app->request->post();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (!empty($post['slug'])) {

            if (!Slug::checkSlug($post['slug'])) {
                return [
                    'status'  => 'error',
                    'message' => '<span style="color: red">نمیتوانید از این کاراکتر ها در نامک استفاده کنید:    -   .   /   \   &   $   %   ^   !   #   ~   `   (   )   =   +   *   @   ; , " \' <> _  | [] {} ? : </span>'
                ];
            }
            $slug = Slug::generateSlug($post['slug']);
            $query = <<<SQL
select * from module_slug where slug="{$slug}"
SQL;
            $model = Yii::$app->db->createCommand($query)->queryAll();


            if (!empty($model)) {
                $error = true;
                foreach ($model as $m) {
                    if ($m['slug'] == $post['slug'] && $m['table_id'] == $post['id']) {
                        $error = false;
                    }
                }

                if ($error) {
                    return ['status'  => 'error',
                            'message' => '<span style="color: red">این نامک قبلا رزرو شده است</span>'
                    ];
                } else {
                    return ['status'  => 'success',
                            'message' => '<span style="color: green">این نامک مورد تایید است</span>'
                    ];
                }
            } else {
                return ['status'  => 'success',
                        'message' => '<span style="color: green">این نامک مورد تایید است</span>'
                ];
            }
        }
    }
}
