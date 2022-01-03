<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\transactions\Terminals;

use YiiMan\YiiBasics\modules\transactions\base\BaseTerminal;
use YiiMan\YiiBasics\modules\transactions\models\Transactions;
use YiiMan\YiiBasics\modules\transactions\models\TransactionsFactor;

/**
 * کلاس ترمینال پرداخت از کیف پول
 * Class CreditTerminal
 * @package YiiMan\YiiBasics\modules\transactions\Terminals
 */
class CreditTerminal extends BaseTerminal
{

    function initTokens()
    {
        // TODO: Implement initTokens() method.
    }

    public function get_before_pay_serial(
        float $price,
        TransactionsFactor $factor,
        Transactions $transaction,
        $callbackUrl
    ) {
        return 0;
    }

    function start
    (
        TransactionsFactor $factorModel,
        Transactions $transactionModel,
        string $callbackUrl
    ) {
        $transactionModel->factor0->changeStatus(TransactionsFactor::STATUS_PAYED);
        $transactionModel->factor0->uid0->chargeUser(-$transactionModel->factor0->total_price,
            'کسر مبلغ بابت فاکتور شماره '.$transactionModel->factor);
        return true;
    }

    function verify(Transactions $transactionModel)
    {
        // TODO: Implement verify() method.
    }

    function title()
    {
        return 'پرداخت از کیف پول';
    }
}
