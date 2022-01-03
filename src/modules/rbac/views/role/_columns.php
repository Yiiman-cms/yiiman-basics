<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'attribute' => 'name',
        'label'     => $searchModel->attributeLabels()['name'],
        'width'     => '140px',
    ],
    [
        'attribute' => 'description',
        'label'     => $searchModel->attributeLabels()['description'],
    ],
    [
        'label' => $searchModel->attributeLabels()['ruleName'],
        'width' => '140px',
        'value' => function ($model) {
            return $model->ruleName == null ? Yii::t('rbac', '(not use)') : $model->ruleName;
        }
    ],
    [
        'class'         => 'kartik\grid\ActionColumn',
        'dropdown'      => false,
        'template'      => '{update} {delete}',
        'vAlign'        => 'middle',
        'urlCreator'    => function ($action, $model, $key, $index) {
            return Url::to([
                $action,
                'name' => $key
            ]);
        },
        //'viewOptions' => ['role' => 'modal-remote', 'title' => Yii::t('rbac', 'View'), 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role'        => 'modal-remote',
                            'title'       => Yii::t('rbac', 'Update'),
                            'data-toggle' => 'tooltip'
        ],
        'deleteOptions' => [
            'role'                 => 'modal-remote',
            'title'                => Yii::t('rbac', 'Delete'),
            'data-confirm'         => false,
            'data-method'          => false,
            // for overide yii data api
            'data-request-method'  => 'post',
            'data-toggle'          => 'tooltip',
            'data-comfirm-ok'      => Yii::t('rbac', 'حذف'),
            'data-comfirm-cancel'  => Yii::t('rbac', 'لغو'),
            'data-confirm-title'   => Yii::t('rbac', 'آیا اطمینان دارید؟'),
            'data-confirm-message' => Yii::t('rbac', 'آیا برای حذف این آیتم اطمینان کافی دارید؟')
        ],
    ],
];
        