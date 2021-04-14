<?php

use yii\db\Migration;

class m210414_110603_add_products_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(200)->notNull(),
            'slug' => $this->string(220)->unique(),
            'price' => $this->decimal(10, 2),
            'currency' => 'ENUM("rub", "usd", "euro")',
            'status' => 'ENUM("draft", "active") DEFAULT "draft"',
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('products');
    }
}
