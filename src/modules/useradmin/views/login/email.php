<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \YiiMan\YiiBasics\modules\login\models\LoginForm */

use YiiMan\YiiBasics\modules\user\models\User;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('useradmin', 'login page title');
$this->params['breadcrumbs'][] = $this->title;
$keyboardError = Yii::t('useradmin', 'your keyboard language must be latin');
$js = <<<JS

	$('input').keyup(function(e) {
     if (e.key.charCodeAt(0) > 160){
         $(this).val('');
	      swal('$keyboardError',
                        {
                            timer: 3000,
                            buttons: false,
                            icon: 'warning'
                        }
                    );
     }
	});
JS;
$this->registerJs($js, $this::POS_END);
?>

<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
<div class="card-header card-header-primary text-center">
    <h4 class="card-title"><?= Yii::t('useradmin', 'login to admin account') ?></h4>

</div>
<p class="description text-center"><?= Yii::t('useradmin', 'please enter your account details') ?></p>
<div class="card-body">
    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'rememberMe')->checkbox() ?>
    <hr>
    <div class="form-group">
        <?= Html::submitButton(
            Yii::t('useradmin', 'Login'),
            [
                'class' => 'btn btn-primary',
                'name'  => 'login-button'
            ]
        ) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
