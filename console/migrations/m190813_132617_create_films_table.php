<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%films}}`.
 */
class m190813_132617_create_films_table extends Migration
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

        $this->createTable('{{%films}}', [
            'id' => $this->primaryKey(),
            'cinema_hall_id' => $this->integer(),
            'title' => $this->string(),
            'image' => $this->string(),
            'price' => $this->float(),
            'start_at' => $this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-films-cinema_hall_id',
            '{{%films}}',
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
        $this->dropForeignKey('fk-films-cinema_hall_id', 'films');
        $this->dropTable('{{%films}}');
    }
}
