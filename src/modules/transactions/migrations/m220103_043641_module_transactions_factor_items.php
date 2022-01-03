<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_043641_module_transactions_factor_items extends Migration
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
            '{{%module_transactions_factor_items}}',
            [
                'id'=> $this->primaryKey(11),
                'title'=> $this->string(255)->notNull()->comment('نام محصول'),
                'price'=> $this->float(10)->notNull()->comment('مبلغ هر عدد(خالص)'),
                'count'=> $this->integer(11)->notNull()->comment('تعداد'),
                'tax_price'=> $this->float(10)->notNull()->comment('مبلغ مالیات'),
                'tax_percent'=> $this->tinyInteger(3)->notNull()->comment('درصد مالیت'),
                'discount_price'=> $this->float(10)->notNull()->comment('مبلغ تخفیف'),
                'discount_percent'=> $this->tinyInteger(3)->notNull()->comment('درصد تخفیف'),
                'factor'=> $this->integer(11)->notNull()->comment('فاکتور'),
                'total_price'=> $this->float(10)->notNull()->comment('مبلغ قابل پرداخت'),
                'module_class'=> $this->string(255)->notNull()->comment('کلاس مدل محصول'),
                'module_id'=> $this->integer(11)->notNull()->comment('آی دی مدل محصول'),
                'module_after_pay_function'=> $this->string(255)->notNull()->comment('تابعی که پس از پرداخت فراخوانی میشود'),
                'language'=> $this->integer(11)->null()->defaultValue(null),
                'language_parent'=> $this->integer(11)->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('factor','{{%module_transactions_factor_items}}',['factor'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('factor', '{{%module_transactions_factor_items}}');
        $this->dropTable('{{%module_transactions_factor_items}}');
    }
}
