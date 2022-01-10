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
 * @var $model \YiiMan\YiiBasics\modules\ticket\models\Ticket
 */

$n = '\n';
$js = <<<JS
$(function() {
	$('textarea[max-rows]').each(function () {
		var textarea = $(this);

		
		var maxRows = Number(textarea.attr('max-rows'));
		
		$(this).on('input',function(){
		    var lines= $(this).val().split("$n");
		    if (lines.length<maxRows){
		        textarea.attr('rows',lines.length);
		    }
		    
		});
		
		}).trigger('input');
});
$('.file-btn').click(function(e){
    e.preventDefault();
    $('[type="file"]').click();
});

JS;
$this->registerJs($js, $this::POS_END);

?>
<style>
    .box {
        background: #1c1f57;
        border-radius: 5px 5px 0 0;
        padding: 32px;
        color: white;
        float: right;
        width: 100%;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .user-message {
        /* display: block; */
        /* flex-direction: row; */
        /* background: white; */
        max-width: 100%;
        border-radius: 10px;
        float: right;
        margin-top: 20px;
        width: auto;
    }

    .admin-message {
        display: block;
        flex-direction: row;
        max-width: 100%;
        /* background: white; */
        width: auto;
        border-radius: 10px;
        float: left;
        margin-top: 40px;
    }

    .user-message .author {
        /* float: right; */
        display: block;
        width: 50px;
        height: 50px;
        /* margin-left: -11px; */
        position: relative;
        margin-bottom: -32%;
        right: -5px;
    }

    .author img {
        width: 50px;
        height: 50px;
        border-radius: 130px;
        position: relative;
        margin-right: -23px;
        margin-top: -11px;
    }

    .user-message .message {
        margin-right: -20px;
        float: right;
        width: auto;
        background: #ffffff42;
        margin-top: 19px;
        padding: 20px;
        border-radius: 10px;
        max-width: 100%;
        line-height: 2;
        min-width: 230px;
    }

    .name {
        color: aqua;
        margin-bottom: -17px;
        margin-top: 19px;
        text-align: left;
    }

    .admin-message .message {
        background: #32476f;
        border-radius: 10px;
        padding: 21px;
        width: auto;
        margin-right: 48px;
        max-width: 100%;
        line-height: 2;
        min-width: 230px;
    }

    .admin-message .author {
        margin-left: 50px;
        position: relative;
        float: left;
        margin-top: -20px;
        left: -47px;
    }


    .line-break {
        display: block;
        width: 100%;
        float: right;
    }

    .send-box {
        width: 100%;
        background: #111240;
        border-radius: 0 0 5px 5px;
        display: flex;
        flex-wrap: nowrap;
        flex-direction: row-reverse;
        min-height: 70px;
    }

    .textinput {
        text-align: right;
        direction: rtl;
        background: transparent;
        max-height: 230px;
        width: 90%;
        float: left;
    }

    .textinput textarea {
        background: transparent;
        border: none !important;
        color: white;
        padding: 10px;
        overflow-x: hidden;
        overflow-y: auto;
        width: 100%;
        display: block;
        height: 100%;
        outline: none !important;
    }

    .btn-box {
        float: left;
        width: 10%;
    }

    .btn-box .btn.btn-round.btn-info {
        width: 30px !important;
        height: 30px !important;
        padding: 7px;
        margin-right: 10px;
        display: block;
        margin-top: 10px;
        float: right;
    }

    .btn-box button .fa {
        font-size: 13px !important;
        rotate: 28deg;
        padding-top: 0px;
        padding-right: 2px;
        padding-bottom: 2px;
        color: #111240 !important;
    }

    input[type="file"] {
        display: none;
    }

    .file-btn .fa {
        color: #111240 !important;
    }

    .message .datetime {
        color: #00dcff;
        text-align: left;
        margin-top: 14px;
        margin-bottom: -16px;
        font-size: 10px;
    }

    .message .img {
        /* padding: 20px; */
        margin: auto;
        display: block;
        border-radius: 10px;
        height: auto !important;
        max-width: 180px !important;
        /* height: auto; */
    }

    .message a {
        padding: 17px;
        color: white;
    }

    .message p {
        display: block;
        word-wrap: break-word;
        word-break: break-word;
        /* max-width: 60%; */
        line-height: 2.4;
        text-align: justify;
        direction: rtl;
    }
</style>
<div class="message-box">
    <div class="box">
        <?php
        $messages = $model->ticketMessages;
        if (!empty($messages)) {
            $user = null;
            foreach ($messages as $msg) {
                if (!empty($msg->uid)) {
                    if (empty($user)) {
                        $user = $msg->uid0;
                    }
                    ?>
                    <div class="user-message">
                        <div class="author">
                            <img src="<?= $user->getdefaultImageLink('100*100') ?>" alt="<?= $user->fullname ?>">

                        </div>
                        <div class="message">
                            <p>
                                <?= $msg->message ?>
                            </p>
                            <div class="name"><?= $user->fullname ?></div>
                            <div class="datetime"><?= Yii::$app->functions->convert_date($msg->created_at) ?></div>
                        </div>
                    </div>
                    <div class="line-break"></div>
                    <?php
                    if (!empty($msg->file)) {
                        $file = Yii::$app->Options->UploadDir.'/tickets/'.$model->id.'/'.$msg->id.'/'.$msg->file;
                        $ext = pathinfo($file, PATHINFO_EXTENSION);
                        if (!empty($ext)) {
                            switch ($ext) {
                                case 'png':
                                case 'jpeg':
                                case 'jpg':
                                case 'gif':
                                    ?>
                                    <div class="user-message">
                                        <div class="author">
                                            <img src="<?= $user->getdefaultImageLink('100*100') ?>"
                                                 alt="<?= $user->fullname ?>">

                                        </div>
                                        <div class="message">
                                            <a href="<?= Yii::$app->Options->UploadUrl.'/tickets/'.$model->id.'/'.$msg->id.'/'.$msg->file ?>"
                                               target="_blank">
                                                <img class="img"
                                                     src="<?= Yii::$app->Options->UploadUrl.'/tickets/'.$model->id.'/'.$msg->id.'/'.$msg->file ?>"
                                                     alt="">
                                            </a>
                                            <div class="name"><?= $user->fullname ?></div>
                                            <div class="datetime"><?= Yii::$app->functions->convert_date($msg->created_at) ?></div>
                                        </div>
                                    </div>
                                    <div class="line-break"></div>
                                    <?php
                                    break;
                                default:
                                    ?>
                                    <div class="admin-message">
                                        <div class="author">
                                            <img src="<?= $admin->getdefaultImageLink('100*100') ?>"
                                                 alt="<?= $admin->nickName ?>">

                                        </div>
                                        <div class="message">
                                            <a href="<?= Yii::$app->Options->UploadUrl.'/tickets/'.$model->id.'/'.$msg->id.'/'.$msg->file ?>"
                                               target="_blank">
                                                <?= $msg->file ?>
                                            </a>
                                            <div class="name"><?= $admin->nickName ?></div>
                                            <div class="datetime"><?= Yii::$app->functions->convert_date($msg->created_at) ?></div>
                                        </div>
                                    </div>
                                    <div class="line-break"></div>
                                    <?php
                                    break;
                            }
                        }

                    }
                }

                if (!empty($msg->uid_admin)) {
                    $admin = $msg->uid_admin0;
                    ?>

                    <div class="admin-message">
                        <div class="author">
                            <img src="<?= $admin->getdefaultImageLink('100*100') ?>" alt="<?= $admin->nickName ?>">

                        </div>
                        <div class="message">
                            <p>
                                <?= $msg->message ?>
                            </p>
                            <div class="name"><?= $admin->nickName ?></div>
                            <div class="datetime"><?= Yii::$app->functions->convert_date($msg->created_at) ?></div>
                        </div>
                    </div>
                    <div class="line-break"></div>
                    <?php
                    if (!empty($msg->file)) {
                        $file = Yii::$app->Options->UploadDir.'/tickets/'.$model->id.'/'.$msg->id.'/'.$msg->file;
                        $ext = pathinfo($file, PATHINFO_EXTENSION);
                        if (!empty($ext)) {
                            switch ($ext) {
                                case 'png':
                                case 'jpeg':
                                case 'jpg':
                                case 'gif':
                                    ?>
                                    <div class="admin-message">
                                        <div class="author">
                                            <img src="<?= $admin->getdefaultImageLink('100*100') ?>"
                                                 alt="<?= $admin->nickName ?>">

                                        </div>
                                        <div class="message">
                                            <a href="<?= Yii::$app->Options->UploadUrl.'/tickets/'.$model->id.'/'.$msg->id.'/'.$msg->file ?>"
                                               target="_blank">
                                                <img class="img"
                                                     src="<?= Yii::$app->Options->UploadUrl.'/tickets/'.$model->id.'/'.$msg->id.'/'.$msg->file ?>"
                                                     alt="">
                                            </a>
                                            <div class="name"><?= $admin->nickName ?></div>
                                            <div class="datetime"><?= Yii::$app->functions->convert_date($msg->created_at) ?></div>
                                        </div>
                                    </div>
                                    <div class="line-break"></div>
                                    <?php
                                    break;
                                default:
                                    ?>
                                    <div class="admin-message">
                                        <div class="author">
                                            <img src="<?= $admin->getdefaultImageLink('100*100') ?>"
                                                 alt="<?= $admin->nickName ?>">

                                        </div>
                                        <div class="message">
                                            <a href="<?= Yii::$app->Options->UploadUrl.'/tickets/'.$model->id.'/'.$msg->id.'/'.$msg->file ?>"
                                               target="_blank">
                                                <?= $msg->file ?>
                                            </a>
                                            <div class="name"><?= $admin->nickName ?></div>
                                            <div class="datetime"><?= Yii::$app->functions->convert_date($msg->created_at) ?></div>
                                        </div>
                                    </div>
                                    <div class="line-break"></div>
                                    <?php
                                    break;
                            }
                        }

                    }
                }
            }
        }
        ?>


    </div>
    <div class="send-box">
        <div class="textinput">
                                        <textarea rows="1" max-rows="6" name="message" id=""
                                                  placeholder="پاسخ خود را بنویسید"></textarea>
        </div>
        <div class="btn-box">
            <input type="file" name="file">

            <button type="submit"
                    class="btn btn-round btn-info" <?= YiiMan\YiiBasics\widgets\TippyTooltip\TippyWidget::attribute('ارسال پاسخ') ?>>
                <i class="far fa fas fa-location-arrow"></i>
            </button>
            <button type="button"
                    class="btn btn-round btn-info file-btn" <?= YiiMan\YiiBasics\widgets\TippyTooltip\TippyWidget::attribute('الصاق فایل') ?>>
                <i class="fa fa-paperclip"></i>
            </button>
        </div>
    </div>
</div>
