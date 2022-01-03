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

class m220103_043644_Relations extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_module_transactions_coupons_uid_limit',
            '{{%module_transactions_coupons}}', 'uid_limit',
            '{{%module_user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_transactions_coupons_created_by',
            '{{%module_transactions_coupons}}', 'created_by',
            '{{%module_user_admin}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_transactions_uid',
            '{{%module_transactions}}', 'uid',
            '{{%module_user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_transactions_factor',
            '{{%module_transactions}}', 'factor',
            '{{%module_transactions_factor_head}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_transactions_factor_head_uid',
            '{{%module_transactions_factor_head}}', 'uid',
            '{{%module_user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_transactions_factor_head_created_by',
            '{{%module_transactions_factor_head}}', 'created_by',
            '{{%module_user_admin}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_transactions_factor_items_factor',
            '{{%module_transactions_factor_items}}', 'factor',
            '{{%module_transactions_factor_head}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_transactions_user_credits_factor',
            '{{%module_transactions_user_credits}}', 'factor',
            '{{%module_transactions_factor_head}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_transactions_user_credits_uid',
            '{{%module_transactions_user_credits}}', 'uid',
            '{{%module_user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_transactions_user_credits_created_by',
            '{{%module_transactions_user_credits}}', 'created_by',
            '{{%module_user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_transactions_user_credits_created_by',
            '{{%module_transactions_user_credits}}', 'created_by',
            '{{%module_user_admin}}', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_module_transactions_coupons_uid_limit', '{{%module_transactions_coupons}}');
        $this->dropForeignKey('fk_module_transactions_coupons_created_by', '{{%module_transactions_coupons}}');
        $this->dropForeignKey('fk_module_transactions_uid', '{{%module_transactions}}');
        $this->dropForeignKey('fk_module_transactions_factor', '{{%module_transactions}}');
        $this->dropForeignKey('fk_module_transactions_factor_head_uid', '{{%module_transactions_factor_head}}');
        $this->dropForeignKey('fk_module_transactions_factor_head_created_by', '{{%module_transactions_factor_head}}');
        $this->dropForeignKey('fk_module_transactions_factor_items_factor', '{{%module_transactions_factor_items}}');
        $this->dropForeignKey('fk_module_transactions_user_credits_factor', '{{%module_transactions_user_credits}}');
        $this->dropForeignKey('fk_module_transactions_user_credits_uid', '{{%module_transactions_user_credits}}');
        $this->dropForeignKey('fk_module_transactions_user_credits_created_by',
            '{{%module_transactions_user_credits}}');
        $this->dropForeignKey('fk_module_transactions_user_credits_created_by',
            '{{%module_transactions_user_credits}}');
    }
}
