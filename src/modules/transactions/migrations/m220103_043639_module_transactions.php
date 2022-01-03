<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_043639_module_transactions extends Migration
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
            '{{%module_transactions}}',
            [
                'id'=> $this->primaryKey(11),
                'uid'=> $this->integer(11)->notNull()->comment('کاربری که پرداخت برای وی ایجاد شده است'),
                'terminal'=> $this->string(255)->notNull()->comment('درگاه پرداخت'),
                'description'=> $this->string(1000)->notNull()->comment('توضیحات و هیستوری'),
                'created_at'=> $this->datetime()->notNull()->comment('تاریخ ایجاد'),
                'payed_at'=> $this->datetime()->null()->defaultValue(null)->comment('تاریخ پرداخت'),
                'status'=> $this->tinyInteger(1)->notNull()->comment('وضعیت پرداخت'),
                'terminal_pre_pay_serial'=> $this->string(255)->null()->defaultValue(null)->comment('شماره تراکنش پیش از پرداخت'),
                'terminal_after_pay_serial'=> $this->string(255)->null()->defaultValue(null)->comment('شماره تراکنش پس از پرداخت'),
                'terminal_final_transaction_serial'=> $this->string(255)->null()->defaultValue(null)->comment('شماره تراکنش نهایی'),
                'created_user_mode'=> $this->tinyInteger(1)->notNull()->comment('نوع کاربری که این تراکنش را ایجاد کرده است(ادمین یا کاربر عادی)'),
                'created_from_uid'=> $this->integer(255)->null()->defaultValue(null)->comment('در صورتی که مد کاربر عادی باشد، از جدول کاربران عادی و در صورتی که از کاربران ادمین باشد، شناسه ی کابر ادمین را بازگردانی میکند'),
                'price'=> $this->float(10)->notNull()->comment('مبلغ'),
                'factor'=> $this->integer(11)->notNull()->comment('فاکتور'),
                'language'=> $this->integer(11)->null()->defaultValue(null),
                'language_parent'=> $this->integer(11)->null()->defaultValue(null),
                'hash'=> $this->string(255)->notNull(),
            ],$tableOptions
        );
        $this->createIndex('module_transactions_ibfk_1','{{%module_transactions}}',['uid'],false);
        $this->createIndex('factor','{{%module_transactions}}',['factor'],false);
        $this->createIndex('created_from_uid','{{%module_transactions}}',['created_from_uid'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('module_transactions_ibfk_1', '{{%module_transactions}}');
        $this->dropIndex('factor', '{{%module_transactions}}');
        $this->dropIndex('created_from_uid', '{{%module_transactions}}');
        $this->dropTable('{{%module_transactions}}');
    }
}
