<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%booking}}`.
 */
class m190813_132940_create_booking_table extends Migration
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

        $this->createTable('{{%booking}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'film_id' => $this->integer(),
            'cinema_hall_id' => $this->integer(),
            'cinema_hall_row_id' => $this->integer(),
            'cinema_hall_seat_id' => $this->integer(),
            'price' => $this->float(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-booking-user_id',
            '{{%booking}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-booking-cinema_hall_id',
            '{{%booking}}',
            'cinema_hall_id',
            '{{%cinema_hall}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-booking-cinema_hall_row_id',
            '{{%booking}}',
            'cinema_hall_row_id',
            '{{%cinema_hall_rows}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-booking-cinema_hall_seat_id',
            '{{%booking}}',
            'cinema_hall_seat_id',
            '{{%cinema_hall_seats}}',
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
        $this->dropForeignKey('fk-booking-cinema_hall_seat_id', 'booking');
        $this->dropForeignKey('fk-booking-cinema_hall_row_id', 'booking');
        $this->dropForeignKey('fk-booking-cinema_hall_id', 'booking');
        $this->dropForeignKey('fk-booking-user_id', 'booking');
        $this->dropTable('{{%booking}}');
    }
}
