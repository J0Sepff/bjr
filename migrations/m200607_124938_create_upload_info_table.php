<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%upload_info}}`.
 */
class m200607_124938_create_upload_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%upload_info}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'ext' => $this->string(),
            'created_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%upload_info}}');
    }
}
