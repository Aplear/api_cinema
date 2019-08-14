<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cinema_hall_seats}}`.
 */
class m190813_132820_create_cinema_hall_seats_table extends Migration
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

        $this->createTable('{{%cinema_hall_seats}}', [
            'id' => $this->primaryKey(),
            'number' => $this->integer(),
            'cinema_hall_id' => $this->integer(),
            'cinema_hall_row_id' => $this->integer()
        ], $tableOptions);

        $this->addForeignKey(
            'fk-cinema_hall_seats-cinema_hall_id',
            '{{%cinema_hall_seats}}',
            'cinema_hall_id',
            '{{%cinema_hall}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-cinema_hall_seats-cinema_hall_row_id',
            '{{%cinema_hall_seats}}',
            'cinema_hall_row_id',
            '{{%cinema_hall_rows}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->insert('cinema_hall', [
            'title' => 'Большой зал 1',
        ]);


        for ($i=1; $i<11; ++$i) {
            $this->insert('cinema_hall_rows', [
                'number' => $i,
                'cinema_hall_id' => 1
            ]);

            for ($j=1; $j<13; ++$j) {
                $this->insert('cinema_hall_seats', [
                    'number' => $j,
                    'cinema_hall_id' => 1,
                    'cinema_hall_row_id' => $i
                ]);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-cinema_hall_seats-cinema_hall_row_id', 'cinema_hall_seats');
        $this->dropForeignKey('fk-cinema_hall_seats-cinema_hall_id', 'cinema_hall_seats');
        $this->dropTable('{{%cinema_hall_seats}}');
    }
}
