<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use johnitvn\ajaxcrud\CrudAsset;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $searchModel \YiiMan\YiiBasics\modules\rbac\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac', 'Permisstions Manager');
$this->params['breadcrumbs'][] = $this->title;
\YiiMan\YiiBasics\widgets\topMenu\TopMenuWidget::addBtb(
    'add',
    Yii::t('rbac', 'ثبت نقش های سیستمی'),
    'success',
    null,
    Yii::$app->Options->BackendUrl.'/rbac/create-permissions/index'
);
?>
<div class="auth-item-index">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-nav-tabs" style="margin-bottom: 20px;padding: 0px">
                        <div class="card-body " style="padding: 0">
                            <h3 class="text-center">جست و جو</h3>
                            <form action="<?= Yii::$app->urlManager->createUrl(['/rbac/permission/index']) ?>"
                                  method="get">
                                <div class="row">
                                    <div class="col-md-12 pull-right">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                $attr = 'name';
                                                ?>
                                                <label for="<?= $attr ?>">بخشی از نام مجوز</label>
                                                <input type="text" name="PermissionSearch[<?= $attr ?>]"
                                                       id="<?= $attr ?>" class="form-control"
                                                       value="<?= !empty($_GET['PermissionSearch'][$attr]) ? $_GET['PermissionSearch'][$attr] : '' ?>"
                                                       title="">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                $attr = 'module';
                                                ?>
                                                <label for="<?= $attr ?>">بخشی از نام ماژول</label>
                                                <input type="text" name="PermissionSearch[<?= $attr ?>]"
                                                       id="<?= $attr ?>" class="form-control"
                                                       value="<?= !empty($_GET['PermissionSearch'][$attr]) ? $_GET['PermissionSearch'][$attr] : '' ?>"
                                                       title="">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success" style="margin-top: 25px;">
                                                    جست و جو
                                                </button>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <?php
            $models = $dataProvider->models;
            $models = \yii\helpers\ArrayHelper::index($models, null, 'module_en');
            foreach ($models as $module_name => $array) {
                /**
                 * @var $model \YiiMan\YiiBasics\modules\rbac\models\Permission
                 */
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row" style="margin-bottom: 20px">
                            <div class="col-md-12">
                                <div class="card card-nav-tabs" style="padding: 0;">
                                    <div class="card-body " style="padding: 0;
margin: auto;">
                                        <h3 class="text-center" style="margin: auto;
padding: 0;"><?= 'مجوز های بخش '.(empty($array[0]->module_fa) ? $array[0]->module_en : $array[0]->module_fa) ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $count = 1;
                        foreach ($array as $key => $model) {
                            if ($count == 1) {
                                echo '<div class="row">';
                            }
                            if ($count != 1 && $count != 4) {
                                $padding = 'padding:2px';
                            } else {
                                if ($count == 1) {
                                    $padding = 'padding-left:2px;padding-top:2px';
                                } else {
                                    $padding = 'padding-right:2px;padding-top:2px';
                                }
                            }
                            ?>
                            <div class="col-md-3" style="margin-bottom: 20px;  <?= $padding ?>">
                                <div class="card card-nav-tabs" style="padding: 2px;min-height: 121px;">
                                    <div class="card-body " style="padding: 1px;">
                                        <p style="font-weight: 900;
text-align: center;line-break: anywhere;">
                                            <?= $out = $model->name ?>
                                        </p>
                                        <p style="text-align: center;
font-size: 10px;
font-weight: 200;top: 56px;position: absolute;">
                                            <?= $model->description ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($count == 4) {
                                $count = 1;
                                echo '</div>';
                            } else {
                                if (empty($array[$key + 1])) {
                                    echo '</div>';
                                }
                                $count++;
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-nav-tabs">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-12 pull-right">
                                    <?php
                                    echo \yii\widgets\LinkPager::widget(
                                        [
                                            'pagination' => $dataProvider->pagination
                                        ]
                                    )
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

