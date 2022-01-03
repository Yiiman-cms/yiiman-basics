<?php
/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Created by YiiMan TM.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 *
 * Site:https://yiiman.ir
 * Date: 03/25/2020
 * Time: 01:04 AM
 */
/**
 * @var $this \YiiMan\YiiBasics\lib\View
 */
$url = Yii::$app->urlManager->createUrl(['/sms/default/loadform']);
$js = <<<JS
    $('#dynamicmodel-smsgate').change(function (){
        loadSmsForm($('#dynamicmodel-smsgate').val());
    });
    function loadSmsForm(id){
        var data={id:id};
                $.ajax
                    (
                        {
                          url: "$url",
                          // beforeSend: function( xhr ) {
                          //   xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
                          // },
                          method:'post',
                          data:data
                        }
                    )
                  .done(function( data ) {
                      $('.sms-form').html(data);
                  })
                  .fail(function(e) {
                    
                  });
    } 
    
    loadSmsForm($('#dynamicmodel-smsgate').val());
    
    $('#send-test-pattern-sms').click((e)=>{
        $('.response-row').css('display','block');
        
        console.log($('#send-test-pattern-sms').attr('href'));
        
        e.preventDefault();
            var data={};
                $.ajax
                    (
                        {
                          url: $('#send-test-pattern-sms').attr('href'),
                          method:'post',
                          data:data
                        }
                    )
                  .done(function( data ) {
                      $('#smsErrors').html(data.error);
                      $('#smsResponse').html(data.response);
                      $('#smsParams').html(data.params);
                  })
                  .fail(function(e) {
                    
                  });
            
    })
JS;
Yii::$app->view->registerJs($js, Yii::$app->view::POS_END);
?>
<style>
    code {
        background: black;
        width: 100%;
        display: block;
        min-height: 200px;
        padding: 10px;
        color: white;
        direction: ltr;
        text-align: left;
        overflow-y: auto;
        max-height: 200px;
    }
    .response-row h4{
        text-align: center;
    }
    .response-row{
        display: none;
    }
</style>

<div style="margin: -10px -12.5px -10px -10px;padding: 10px;">
    <div class="card" style="margin-top: 20px">
        <h3><?= Yii::t('sms', 'تنظیمات پیامک') ?></h3>
        <div class="row">
            <div class="col-md-6">
                <?php
                $gates = [];
                $gatesFiles = getFileList(__DIR__ . '/../gates');
                foreach ($gatesFiles as $gate) {
                    if ($gate['type'] == 'text/x-php') {
                        $className = str_replace('.php', '', $gate['name']);
                        $gates[$className] = ('YiiMan\YiiBasics\modules\sms\gates\\' . $className)::title();
                    }
                }

                $attr = 'SmsGate';
                $model->addRule([$attr], 'required');
                $model->addRule([$attr], 'trim');
                $model->addRule([$attr], 'string', ['max' => 50]);
                echo $form->field($model, $attr)->widget(\kartik\select2\Select2::className(),
                    [
                        'data' => $gates
                    ]
                )->hint(
                    Yii::t('settings', 'درگاه پیامک خود را انتخاب کنید')
                )->label('درگاه پیامک');
                ?>
            </div>
            <div class="col-md-6">
                <?php

                $attr = 'SMSDebug';
                $model->addRule([$attr], 'required');
                $model->addRule([$attr], 'trim');
                $model->addRule([$attr], 'string', ['max' => 50]);
                echo $form->field($model, $attr)->dropDownList(
                    [
                        0 => 'غیر فعال',
                        1 => 'فعال'
                    ]
                )->hint(
                    Yii::t('settings', 'در صورت فعال بودن حالت برنامه نویسی, هیچ پیامکی به صورت واقعی ارسال نمیشود.')
                )->label('حالت برنامه نویسی');
                ?>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php
                if (empty(Yii::$app->Options->MaxVerifySms)){
                    Yii::$app->Options->MaxVerifySms=3;
                }
                $attr = 'MaxVerifySms';
                $model->addRule([$attr], 'trim');
                $model->addRule([$attr], 'string', ['max' => 2]);

                echo $form->field($model, $attr)->input('number')->hint(
                    Yii::t('sms', 'مشخص کنید حداکثر چند بار پیامک تغییر رمز در یک روز برای کاربر ارسال شود')
                )->label('حداکثر تعداد ارسال کد اعتبارسنجی');
                ?>

            </div>
        </div>
        <div class="sms-form">

        </div>

        <hr>
        <div class="row response-row">
            <div class="col-md-4">
                <h4>پارامتر های ارسالی</h4>
                <code id="smsParams">

                </code>
            </div>
            <div class="col-md-4">
                <h4>پاسخ دریافتی از پنل پیامک</h4>
                <code id="smsResponse">

                </code>
            </div>
            <div class="col-md-4">
                <h4>خطاهای پیش آمده(ارسالی از سرور پنل پیامک)</h4>
                <code id="smsErrors">

                </code>
            </div>
        </div>

        <a href="<?= Yii::$app->urlManager->createUrl(['/sms/default/sendtest']) ?>" class="btn btn-success">ارسال پیامک
            تست</a>
        <btn href="<?= Yii::$app->urlManager->createUrl(['/sms/default/sendtestpatten']) ?>" class="btn btn-success" id="send-test-pattern-sms">ارسال پیامک
            تست مبتنی بر الگو</btn>


    </div>
</div>

