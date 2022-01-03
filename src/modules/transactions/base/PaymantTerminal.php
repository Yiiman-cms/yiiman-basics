<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\transactions\base;


use YiiMan\YiiBasics\modules\transactions\models\Transactions;
use YiiMan\YiiBasics\modules\transactions\models\TransactionsFactor;
use YiiMan\YiiBasics\modules\transactions\models\TransactionsUserCredits;
use YiiMan\YiiBasics\modules\user\models\User;
use yii\web\BadRequestHttpException;

class PaymantTerminal extends \YiiMan\YiiBasics\modules\transactions\base\BaseTerminal
{

    public $token;
    public $sandbox = false;

    public function initTokens()
    {
        $this->token = \Yii::$app->Options->zarinMerchant;
        $this->sandbox = \Yii::$app->Options->isSandbox;
    }


    /**
     * @param  TransactionsFactor  $factor
     * @param  Transactions        $transactions
     * @param  string              $callbackUrl
     * @return mixed|void
     */
    public function start(TransactionsFactor $factor, Transactions $transactions, string $callbackUrl)
    {
        if ($factor->price == 0) {
            return;
        }
        if (\Yii::$app->user->identity->credit >= $factor->price) {
            $transactions->factor0->changeStatus(TransactionsFactor::STATUS_PAYED);
            $transactions->factor0->uid0->chargeUser(-$transactions->factor0->total_price,
                'کسر مبلغ بابت فاکتور شماره '.$transactions->factor);
            return TransactionsUserCredits::addCredit($factor->id, \Yii::$app->user->id, $factor->price,
                $transactions->description);

        }


        $gate = \Yii::$app->Options->paymentGate;
        return (new ('YiiMan\YiiBasics\modules\transactions\Terminals\\'.$gate))->start($factor, $transactions,
            $callbackUrl);
    }

    public function verify(Transactions $transactions)
    {
        $gate = \Yii::$app->Options->paymentGate;
        return (new ('YiiMan\YiiBasics\modules\transactions\Terminals\\'.$gate))->verify($transactions);
    }

    /**
     * @param  float               $price
     * @param  TransactionsFactor  $factor
     * @param  Transactions        $transaction
     * @param  string              $callbackUrl
     * @return mixed
     * @throws BadRequestHttpException
     */
    function get_before_pay_serial(float $price, TransactionsFactor $factor, Transactions $transaction, $callbackUrl)
    {
        $gate = \Yii::$app->Options->paymentGate;
        return (new ('YiiMan\YiiBasics\modules\transactions\Terminals\\'.$gate))->get_before_pay_serial($price, $factor,
            $transaction, $callbackUrl);
    }

    function title()
    {
        return 'زرین پال';
    }


}