<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

$this->title = Yii::t('backend', 'Create Role');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('backend', 'Menu - Users Role'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="role-create">

    <div class="col-lg-12">

        <?=
        $this->render('_form', [
            'model' => $model,
            'pages' => $pages,
            'access' => $access,
            'type' => 'create',
        ])
        ?>

    </div>

    <div class="clearfix"></div>

</div>
