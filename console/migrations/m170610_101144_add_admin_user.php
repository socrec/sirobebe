<?php

use yii\db\Migration;

class m170610_101144_add_admin_user extends Migration
{
    public function up()
    {
        $user = new \common\models\User();
        $user->username = 'marina';
        $user->password_hash = Yii::$app->getSecurity()->generatePasswordHash('15182326');
        $user->save();
    }

    public function down()
    {
        echo "m170610_101144_add_admin_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
