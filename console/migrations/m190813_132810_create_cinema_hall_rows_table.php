<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cinema_hall_rows}}`.
 */
class m190813_132810_create_cinema_hall_rows_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cinema_hall_rows}}', [
            'id' => $this->primaryKey(),
            'number' => $this->integer(),
            'cinema_hall_id' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-cinema_hall_rows-cinema_hall_id',
            '{{%cinema_hall_rows}}',
            'cinema_hall_id',
            '{{%cinema_hall}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-cinema_hall_rows-cinema_hall_id', 'cinema_hall_rows');
        $this->dropTable('{{%cinema_hall_rows}}');
    }
}
