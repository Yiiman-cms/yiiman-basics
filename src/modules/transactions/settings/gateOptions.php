<?php
/**
 * Copyright (c) 2022-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Created by YiiMan TM.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 * Date: 03/25/2020
 * Time: 01:04 AM
 */

/**
 * @var $this \YiiMan\YiiBasics\lib\View
 * @var $model
 */
$url = Yii::$app->urlManager->createUrl(['/transactions/default/loadform']);
$urlJs = Yii::$app->urlManager->createUrl(['/transactions/default/load-js']);
$js = <<<JS
    $('#dynamicmodel-paymentgate').change(function (){
        loadPaymentForm($('#dynamicmodel-paymentgate').val());
    });
    function loadPaymentForm(id){
        var data={id:id};
                $.ajax
                    (
                        {
                          url: "$url",
                          method:'post',
                          data:data
                        }
                    )
                  .done(function( response ) {
                      $('.payment-form').html(response);
                      
                      
                      
                     // <load form JS>
                     
                         $.ajax
                            (
                                {
                                  url: "$urlJs",
                                  method:'post',
                                  data:data
                                }
                            )
                          .done(function( jsResponse ) {
                              $('.payment-form').append(jsResponse);
                          })
                          .fail(function(e) {
                            
                          });
                     
                     // </load form js>
                      
                      
                      
                      
                  })
                  .fail(function(e) {
                    
                  });
    } 
    
    loadPaymentForm($('#dynamicmodel-paymentgate').val());
JS;
Yii::$app->view->registerJs($js, Yii::$app->view::POS_END);

?>
<div style="margin: -10px -12.5px -10px -10px;padding: 10px;">
    <div class="card" style="margin-top: 20px">
        <h3><?= Yii::t('transactions', 'تنظیمات پرداخت') ?></h3>
        <div class="row">
            <div class="col-md-6">
                <?php
                $gates = [];
                $gatesFiles = getFileList(__DIR__.'/../Terminals');
                foreach ($gatesFiles as $gate) {

                    if ($gate['type'] == 'text/x-php') {
                        $className = str_replace('.php', '', $gate['name']);
                        $code = '$gates[$className] = (new YiiMan\YiiBasics\modules\transactions\Terminals\\'.$className.')->title();';

                        eval($code);

                    }
                }

                $attr = 'paymentGate';
                $model->addRule([$attr], 'required');
                $model->addRule([$attr], 'trim');
                $model->addRule([$attr], 'string', ['max' => 50]);
                echo $form->field($model, $attr)->widget(\kartik\select2\Select2::className(),
                    [
                        'data' => $gates
                    ]
                )->hint(
                    Yii::t('settings', 'درگاه پرداخت خود را انتخاب کنید')
                )->label('درگاه پرداخت');
                ?>
            </div>
            <div class="col-md-6">
                <?php

                $attr = 'PaymentDebug';
                $model->addRule([$attr], 'required');
                $model->addRule([$attr], 'trim');
                $model->addRule([$attr], 'string', ['max' => 50]);
                echo $form->field($model, $attr)->dropDownList(
                    [
                        0 => 'غیر فعال',
                        1 => 'فعال'
                    ]
                )->hint(
                    Yii::t('settings', 'در صورت فعال بودن حالت برنامه نویسی, هیچ پرداختی به صورت واقعی ارسال نمیشود.')
                )->label('حالت برنامه نویسی');
                ?>
            </div>
        </div>
        <div class="payment-form">

        </div>

    </div>
</div>
