<?php

use \YiiMan\YiiBasics\modules\posttypes\models\Posttypes;
\system\widgets\fontAwesomePicker\assets\FontAwesomeFontPickerAssets::register($this);
/**
 * @var $posttype string
 */
if (Yii::$app->controller->action->id == 'index') {

    $columns[] = ['class' => 'yii\grid\SerialColumn'];
    if (\YiiMan\YiiBasics\lib\Core::$enabledLanguage) {
        $columns[] = ['class' => '\YiiMan\YiiBasics\lib\i18n\LanguageColumn'];
    }
}
$columns[] = 'title';
if (empty($searchModel)) {
    $searchModel = $model;
}

?>
<style>
    .fas{
        text-align: center;
        display: block;
        color: #1a534b;
        font-size: 32px;
    }
</style>
<?php
foreach ($searchModel::getConfigs()['items'][$posttype]['indexAttributes'] as $name => $column) {
    switch ($searchModel::getConfigs(true)[$posttype][$column]['type']) {
        case Posttypes::INPUT_CHECKBOX:
        case Posttypes::INPUT_MULTI_SELECT:
            $columns[] =
                [
                    'attribute' => 'fields[' . $column . ']',
                    'value' => function ($model) use ($column, $searchModel) {
                        $relation = \YiiMan\YiiBasics\modules\posttypes\models\PosttypesFields::find()->select(['content'])->where(['posttype' => $model->id, 'fieldName' => $column])->all();

                        if (!empty($relation)) {
                            $array = [];
                            foreach ($relation as $r) {
                                $array[] = $r->content;
                            }
                            return $array;
                        }
                    },
                    'label' => $searchModel::getConfigs(true)[$posttype][$column]['label']
                ];
            break;
        case Posttypes::INPUT_MULTIPLE:
            $columns[] =
                [
                    'attribute' => 'fields[' . $column . ']',
                    'value' => function ($model) use ($column, $searchModel) {
                        return '';
                    },
                    'label' => $searchModel::getConfigs(true)[$posttype][$column]['label']
                ];
            break;
        case Posttypes::INPUT_NUMBER:
        case Posttypes::INPUT_TEXT:
        case Posttypes::INPUT_TEXTAREA:
            $columns[] =
                [
                    'attribute' => 'fields[' . $column . ']',
                    'value' => function ($model) use ($column, $searchModel) {
                        $relation = \YiiMan\YiiBasics\modules\posttypes\models\PosttypesFields::findOne(['posttype' => $model->id, 'fieldName' => $column]);
                        if (!empty($relation)) {
                            return '<i class="fa ' . $relation->content . '"></i>';
                        }
                    },
                    'label' => $searchModel::getConfigs(true)[$posttype][$column]['label']
                ];
            break;
        case Posttypes::INPUT_FONTAWESOME_ICON:
            $columns[] =
                [
                    'attribute' => 'fields[' . $column . ']',
                    'value' => function ($model) use ($column, $searchModel) {
                        $relation = \YiiMan\YiiBasics\modules\posttypes\models\PosttypesFields::findOne(['posttype' => $model->id, 'fieldName' => $column]);
                        if (!empty($relation)) {
                            return '<i class="' . $relation->content . '"></i>';
                        }
                    },
                    'format' => 'raw',
                    'label' => $searchModel::getConfigs(true)[$posttype][$column]['label']
                ];
            break;

        case Posttypes::INPUT_RADIO:
        case Posttypes::INPUT_SELECT:
            $columns[] =
                [
                    'attribute' => 'fields[' . $column . ']',
                    'value' => function ($model) use ($column, $searchModel) {
                        $relation = \YiiMan\YiiBasics\modules\posttypes\models\PosttypesFields::findOne(['posttype' => $model->id, 'fieldName' => $column]);
                        if (!empty($relation)) {
                            return $searchModel::getConfigs(true)[$model->posttype][$column]['data'][$relation->content];
                        }
                    },
                    'label' => $searchModel::getConfigs(true)[$posttype][$column]['label']
                ];
            break;

    }
}

$columns[] =
    [
        'attribute' => 'status',
        'value' => function ($model) {
            /**
             * @var $model Posttypes
             */
            switch ($model->status) {
                case 1:
                    return 'انتشار یافته';
                    break;
                case 0:
                    return 'بازبینی';
                    break;
            }
        },
    ];
if (Yii::$app->controller->action->id == 'index') {
    $columns[] =
        [
            'class' => 'YiiMan\YiiBasics\lib\ActionColumn',
            'urlCreator' => function ($action, $model, $key, $index, $_this) {
                if ($action == 'index') {
                    return Yii::$app->urlManager->createUrl(['/pt/' . $_GET['posttype']]);
                } else {
                    return Yii::$app->urlManager->createUrl(['/pt/' . $action . '/' . $_GET['posttype'] . '/' . $model->id]);
                }
            }
        ];
}
return $columns;
?>
