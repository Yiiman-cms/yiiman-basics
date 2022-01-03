<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use yii\helpers\Url;

$columns =
    [
        [
            'class' => 'kartik\grid\SerialColumn',
            'width' => '30px',
        ],


        'item_name',
        //[
        //    'attribute' => 'user_id',
        //    'value' => function ($model) {
        //        /**
        //         * @var $model \YiiMan\YiiBasics\modules\rbac\models\ModuleRbacAuthAssignment
        //         */
        //        $user = \YiiMan\YiiBasics\modules\useradmin\models\User::findOne($model->user_id);
        //        if (!empty($user)) {
        //            return $user->email;
        //        } else {
        //            return '';
        //        }
        //    }
        //]
    ];


$columns[] =
    [
        'class'         => 'kartik\grid\ActionColumn',
        'template'      => '{update}',
        'header'        => Yii::t('rbac', 'انتساب'),
        'dropdown'      => false,
        'vAlign'        => 'middle',
        'urlCreator'    => function ($action, $model, $key, $index) {
            return Url::to([
                'assignment',
                'id' => $model->item_name
            ]);
        },
        'updateOptions' =>
            [
                'role'        => 'modal-remote',
                'title'       => Yii::t('rbac', 'بروزرسانی'),
                'data-toggle' => 'tooltip'
            ],
    ];

return $columns;


