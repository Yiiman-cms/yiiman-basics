<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @var $this  \YiiMan\YiiBasics\lib\View
 * @var $model Menu
 */

$this->registerJs(file_get_contents(__DIR__.'/../../assets/form.js'), $this::POS_END);
$this->registerJs(
    file_get_contents(__DIR__.'/../../assets/contentType.js'),
    $this::POS_END
);

use YiiMan\YiiBasics\modules\menumodern\models\Menu;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use YiiMan\YiiBasics\modules\blog\models\BlogCategory;
use kartik\select2\Select2;

?>
<script>
    var url = backend + '<?php
        if (Yii::$app->controller->action->id == 'create') {
            echo 'menumodern/default/create';
        } else {
            echo 'menumodern/default/update?id='.$model->id;
        }
        ?>';
</script>
<!--<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/XigeTime/FontAwesome-Selector/cdn/vUNSTABLE/faSelectorStyle.min">-->
<!--<script src="https://cdn.jsdelivr.net/gh/XigeTime/FontAwesome-Selector/cdn/vUNSTABLE/faSelectorWidget-vUNSTABLE.min"></script>-->
<div class="menu-form">
    <div class="row">
        <div class="col-md-6">
            <?php $form = ActiveForm::begin(['id' => 'updateForm']); ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <div style="color: hsla(0, 0%, 0%, 0.54)">
                <p>چنانچه قصد دارید منوی شما در بالای سایت نمایش داده شود، منوی اصلی را انتخاب نمایید.</p>
                <p>چنانچه قصد دارید منوی شما در مگامنو در سمت راست(به عنوان تب) قرار گیرد، تب منو را انتخاب نمایید </p>
                <p>چنانچه قصد دارید منوی شما به عنوان یک زیر منو در سمت چپ مگامنو قرارگیرد، منوی داخلی تب منو(سطح 1) را
                    انتخاب
                    نمایید</p>
                <p>چنانچه قصد دارید منوی شما به عنوان یک زیر منو در سمت چپ مگامنو و ذیل یکی از منوهای سطح 1 قرارگیرد،
                    منوی
                    داخلی تب منو(سطح 2) را انتخاب
                    نمایید</p>
            </div>
            <?= $form->field($model, 'menuType', ['options' => ['onChange' => 'menuType();']])->dropDownList(
                [
                    'parent' => 'منوی سطح 1',
                    'right'  => 'تب منو',
                    'child'  => 'منوی داخلی تب منو(سطح 1)',
                    'child2' => 'منوی داخلی تب منو(سطح 2)',
                ]
            ) ?>
            <hr>
            <?= \YiiMan\YiiBasics\modules\slug\widgets\SlugField::run($form, $model) ?>
            <?= $form->field($model, 'menuContentType',
                ['options' => ['onChange' => 'menuContentType();']])->dropDownList(
                [
                    'data' =>
                        ArrayHelper::merge(
                            [
                                0     => \Yii::t('menu', 'یکی را انتخاب کنید'),
                                'url' => \Yii::t('menu', 'لینک'),
                            ],
                            ArrayHelper::map(Menu::getTypes(), 'name', 'label'))
                ]
            ) ?>
            <hr>


            <?php
            /* < Parents > */
            {
                echo $form->field(
                    $model,
                    'parent',
                    [
                        'options' => [
                            'hidden' => 'hidden',
                            'id'     => 'parent'
                        ]
                    ]
                )
                    ->dropDownList(
                        [
                            '0' => Yii::t('menumoern', 'select'),
                            ' ' => ArrayHelper::map(
                                $model::find()
                                    ->where(['menuType' => 'parent'])
                                    ->all(),
                                'id',
                                'name'
                            )
                        ]
                    );

                echo $form->field(
                    $model,
                    'right',
                    [
                        'options' => [
                            'hidden' => 'hidden',
                            'id'     => 'right'
                        ]
                    ]
                )
                    ->dropDownList(
                        ArrayHelper::map(
                            Menu::find()->where(['parent_id' => $model->parent])->all(),
                            'id',
                            'name'
                        )
                    );

                echo $form->field(
                    $model,
                    'child',
                    [
                        'options' => [
                            'hidden' => 'hidden',
                            'id'     => 'child'
                        ]
                    ]
                )
                    ->dropDownList(
                        $model->menuType == 'child2' ?
                            ArrayHelper::map(
                                Menu::find()->where(['parent_id' => $model->right])->all(),
                                'id',
                                'name'
                            ) : []
                    );

            }
            /* </ Parents > */
            ?>

            <?= $form->field($model, 'url', ['options' => ['id' => 'address']])->widget(
                Select2::classname(),
                [
                    'data'    => ['' => ''] + ArrayHelper::map(BlogCategory::find()->all(), 'id', 'title'),
                    'options' => [
                        'dir' => 'rtl'
                    ],
                ]
            ) ?>

            <?= $form->field($model, 'hyper_url', ['options' => ['id' => 'hyperl']])->textInput(
                ['maxlength' => true]
            ) ?>

        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'column', ['options' => ['id' => 'columnL']])->textInput(
                ['maxlength' => true]
            ) ?>

            <?= $form->field($model, 'img', ['options' => ['id' => 'imgL']])->textInput(
                ['maxlength' => true]
            ) ?>

            <?= $form->field($model, 'pos', ['options' => ['id' => 'positions']])->dropDownList(Menu::getLocations()) ?>
            <div id="iconPack">
                <p>برای تب منوها(تب های سمت راست در مگامنو) می توانید آیکون متناسب در نظر بگیرید.</p>
                <p>"برای انتخاب آیکون مورد نظر به سایت <a
                            href="https://fontawesome.com/v5.2.0/icons?d=gallery&m=free"
                            target="_blank">fontawesome.com</a>
                    مراجعه نمایید و آیکون مورد نظر خود را انتخاب نمایید. سپس نام کلاس آیکون که برای مثال fa-home می باشد
                    را
                    در اینجا وارد کنید.</p>
                <?= $form->field($model,
                    'icon')->widget(\YiiMan\YiiBasics\widgets\fontAwesomePicker\FontAwesomeFontPickerWidget::className(),
                    [
                        'pluginOptions' =>
                            [
                                'placement' => 'right'
                            ]
                    ]
                ); ?>
            </div>


            <?= $form->field($model, 'enable', ['options' => ['id' => 'enable']])->dropDownList(
                [
                    '1' => Yii::t('menumodern', 'قابل نمایش برای عموم'),
                    '0' => Yii::t('menumodern', 'غیر قابل نمایش برای عموم')
                ]
            ) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('menumodern', 'ایجاد') : Yii::t('menumodern', 'بروزرسانی').' '.$model->name,
            [
                'class' => $model->isNewRecord ? 'btn btn-success floatBtn' : 'btn btn-success floatBtn',
                'id'    => 'submitBtn'
            ]
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


