<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @var $model       \YiiMan\YiiBasics\modules\systemlog\models\Systemlog
 * @var $searchModel YiiMan\YiiBasics\modules\systemlog\models\SearchSystemlog
 */

$message = str_replace(
    [
        '= [',
        '\"',

        '\\\\'
    ],
    [
        '= <br> [',
        '"',

        '\\'
    ]
    , $model->message);
?>
<div class="row">
    <div class="col-md-12">

        <div class="card card-nav-tabs">
            <div class="card-body ">
                <h3 class="text-center">متن خطا</h3>
                <div class="row">
                    <div class="log-message pull-right">
                        <?= nl2br($message) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin-top:20px">
    <div class="col-md-12">

        <div class="card card-nav-tabs">
            <div class="card-body ">
                <h3 class="text-center">پیشوند ها</h3>

                <div class="row">
                    <div class="col-md-12 pull-right">
                        <div class="prefix card">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>IP</th>
                                    <th>App</th>
                                    <th>User</th>
                                    <th>Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?= $model->ip ?></td>
                                    <td><?= \YiiMan\YiiBasics\lib\Core::getAppsList()[$model->app_name] ?></td>
                                    <td><?php
                                        if ($searchModel->app_name == 'app-backend') {
                                            $user = \YiiMan\YiiBasics\modules\useradmin\models\User::findOne($model->uid);
                                            if (!empty($user)) {
                                                echo $user->email;
                                            } else {
                                                echo 'حذف شده';
                                            }
                                        } else {
                                            $user = \YiiMan\YiiBasics\modules\user\models\User::findOne($model->uid);
                                            if (!empty($user)) {
                                                echo $user->username;
                                            } else {
                                                echo '؟';
                                            }
                                        }
                                        ?></td>
                                    <td>
                                        <?php

                                        $time = Yii::$app->functions->convert_date($model->log_time);
                                        $time .= '<br>';
                                        $time .= Yii::$app->functions->timeLeft($model->log_time);
                                        echo $time;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>شناسه سشن</th>
                                    <td><?= $model->session_id ?></td>
                                    <th>اطلاعات سشن در زمان رخداد</th>
                                    <td><?= $model->session_details ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

