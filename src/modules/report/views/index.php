<?php
/**
 * @var $this \yii\web\View
 * @var $dataProvider
 * @var $searchModel
 * @var $viewname string
 * @var $view \YiiMan\YiiBasics\modules\report\controllers\BaseReportController
 */
$this->title = $view->reportTitle();
$columns = [];
$columns[] = ['class' => 'yii\grid\SerialColumn'];
$columns = array_merge_recursive(
    $columns,
    $view->columns(),

);
$columns[] =
    [
        'class' => 'YiiMan\YiiBasics\lib\ActionColumn',
        'template' => $view->IndexButtons()
    ];
?>
<style>
    .box {
        display: block;
        float: right;
        width: 100%;
        height: auto;
        margin-top: 20px;
        border-radius: 5px;
        border: dashed 1px #a0aad0;
        padding: 10px;
        margin-bottom: 20px;
    }
    .box > h5 {
        background: #212121 !important;
        border-radius: 3px;
        color: white;
        padding: 2px 6px;
        margin-top: -25px;
        box-shadow: 0 4px 20px 0 rgba(0,0,0,.14),0 7px 12px -5px rgba(33,33,33,.46);
    }
    form > p {
        font-weight: 800;
        padding-right: 7px;
        border-right: 8px solid #212121;
        height: auto;
        display: block;
        float: right;
        border-radius: 5px;
        margin-right: 17px;
    }
    .keys {
        display: block;
        width: 100%;
        float: right;
        border-radius: 5px;
        border: dashed 1px #c0cec4;
        padding: 0px;
        margin: 15px 0;
    }
</style>
<div class="store-index">
    <div class="card card-nav-tabs">
        <div class="card-body ">
            <h3 class="text-center"><?= \yii\helpers\Html::encode($this->title) ?></h3>
            <div class="row">
                <div class="col-md-12 pull-right">
                    <?php \yii\widgets\Pjax::begin(); ?>
                    <?php
                    if (realpath(Yii::getAlias('@system') . '/reports/views/' . $viewname . '/_search.php')) {

                        $form = \yii\bootstrap\ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'get',
                            'options' => [
                                'data-pjax' => 1
                            ],
                        ]);

                        echo $this->render('@system/reports/views/' . $viewname . '/_search.php', ['model' => $searchModel, 'form' => $form]);;
                        ?>
                            <div class="keys">
                                <div class="col-md-12" style="margin-top:20px">
                                    <div class="form-group ">
                                        <?= \yii\helpers\Html::submitButton(Yii::t('user', 'جست و جو'), ['class' => 'btn btn-primary']) ?>
                                        <?= \yii\helpers\Html::resetButton(Yii::t('user', 'بازنشانی'), ['class' => 'btn btn-default']) ?>
                                    </div>
                                </div>
                            </div>


                        <?php
                        \yii\bootstrap\ActiveForm::end();
                    }
                    ?>
                    <div class="col-md-12">
                        <?=
                        \kartik\grid\GridView::widget(
                            [
                                'dataProvider' => $dataProvider,
//                                'filterModel' => $searchModel,
                                'columns' => $columns,
                            ]
                        );
                        \yii\widgets\Pjax::end();
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>