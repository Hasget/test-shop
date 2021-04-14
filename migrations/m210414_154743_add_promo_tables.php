<?php

use yii\db\Migration;

/**
 * Class m210414_154743_add_promo_tables
 */
class m210414_154743_add_promo_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%promo_codes}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'label' => $this->string(50)->notNull()->unique(),
            'type' => 'ENUM("percent", "money")',
            'discount' => $this->float()->notNull()
        ], $tableOptions);

        $this->createTable('{{%promo_links}}', [
            'id' => $this->primaryKey(),
            'promo_id' => $this->integer(),
            'product_id' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('promo_id_idx', 'promo_links', 'promo_id');
        $this->createIndex('product_id_idx', 'promo_links', 'product_id');

        $this->addForeignKey('promo_id_fk', 'promo_links', 'promo_id', 'promo_codes', 'id', 'CASCADE');
        $this->addForeignKey('product_id_fk', 'promo_links', 'product_id', 'products', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('promo_id_fk', 'promo_links');
        $this->dropForeignKey('product_id_fk', 'promo_links');
        $this->dropIndex('promo_id_idx', 'promo_links');
        $this->dropIndex('product_id_idx', 'promo_links');
        $this->dropTable('promo_links');
        $this->dropTable('promo_codes');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210414_154743_add_promo_tables cannot be reverted.\n";

        return false;
    }
    */
}
