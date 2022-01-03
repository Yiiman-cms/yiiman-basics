<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use yii\db\Schema;
use yii\db\Migration;

class m220103_043640_module_transactions_factor_head extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%module_transactions_factor_head}}',
            [
                'id'               => $this->primaryKey(11),
                'created_at'       => $this->datetime()->notNull()->comment('تاریخ ایجاد'),
                'created_by'       => $this->integer(11)->null()->defaultValue(null)->comment('ایجاد شده توسط'),
                'status'           => $this->tinyInteger(1)->notNull()->comment('وضعیت پرداخت'),
                'uid'              => $this->integer(11)->notNull()->comment('کاربر مربوطه'),
                'payed_at'         => $this->datetime()->null()->defaultValue(null)->comment('زمان پرداخت'),
                'price'            => $this->float(10)->notNull()->comment('مبلغ خالص'),
                'tax_price'        => $this->float(10)->notNull()->comment('مبلغ مالیات'),
                'tax_percent'      => $this->tinyInteger(3)->notNull()->comment('درصد مالیات'),
                'discount_price'   => $this->float(10)->notNull()->comment('مبلغ تخفیف'),
                'discount_percent' => $this->integer(3)->notNull()->comment('درصد تخفیف'),
                'user_credit'      => $this->float(10)->notNull()->comment('اعتبار کاربر'),
                'language'         => $this->integer(11)->null()->defaultValue(null),
                'language_parent'  => $this->integer(11)->null()->defaultValue(null),
                'total_price'      => $this->float(10, 2)->notNull()->comment('مبلغ پرداختی'),
                'extra_data'       => $this->text()->null()->defaultValue(null),
            ], $tableOptions
        );
        $this->createIndex('uid', '{{%module_transactions_factor_head}}', ['uid'], false);
        $this->createIndex('created_by', '{{%module_transactions_factor_head}}', ['created_by'], false);

    }

    public function safeDown()
    {
        $this->dropIndex('uid', '{{%module_transactions_factor_head}}');
        $this->dropIndex('created_by', '{{%module_transactions_factor_head}}');
        $this->dropTable('{{%module_transactions_factor_head}}');
    }
}
