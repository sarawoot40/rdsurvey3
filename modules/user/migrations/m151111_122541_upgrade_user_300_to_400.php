<?php

use yii\db\Migration;
use yii\db\Schema;

class m151111_122541_upgrade_user_300_to_400 extends Migration
{
    public function safeUp()
    {
        $this->dropColumn("{{%user}}", "new_email");

        $this->renameTable("{{%user_key}}", "{{%user_token}}");
        $this->renameColumn("{{%user_token}}", "key_value", "token"); // may be "key" if <3.0.0
        $this->renameColumn("{{%user_token}}", "create_time", "created_at");
        $this->renameColumn("{{%user_token}}", "expire_time", "expired_at");
        $this->dropColumn("{{%user_token}}", "consume_time");
        $this->addColumn("{{%user_token}}", "data", Schema::TYPE_STRING . " null after token");
        $this->alterColumn("{{%user_token}}", "user_id", Schema::TYPE_INTEGER . " null");
    }

    public function safeDown()
    {
        // delete null values in user_token.user_id and then make column not null
        // note that the foreign key name is user_key, NOT user_token
        $this->execute("delete from {{%user_token}} where user_id is null");
        $this->dropForeignKey("{{%user_key_user_id}}", "{{%user_token}}");
        $this->alterColumn("{{%user_token}}", "user_id", Schema::TYPE_INTEGER . " not null");
        $this->addForeignKey("{{%user_key_user_id}}", "{{%user_token}}", "user_id", "{{%user}}", "id");

        $this->renameColumn("{{%user_token}}", "token", "key_value"); // may be "key" if <3.0.0
        $this->renameColumn("{{%user_token}}", "created_at", "create_time");
        $this->renameColumn("{{%user_token}}", "expired_at", "expire_time");
        $this->addColumn("{{%user_token}}", "consume_time", Schema::TYPE_STRING . " null");
        $this->dropColumn("{{%user_token}}", "data");
        $this->renameTable("{{%user_token}}", "{{%user_key}}");

        $this->renameColumn("{{%role}}", "created_at", "create_time");
        $this->renameColumn("{{%role}}", "updated_at", "update_time");
        $this->renameColumn("{{%profile}}", "created_at", "create_time");
        $this->renameColumn("{{%profile}}", "updated_at", "update_time");
        $this->renameColumn("{{%user_auth}}", "created_at", "create_time");
        $this->renameColumn("{{%user_auth}}", "updated_at", "update_time");

        $this->renameColumn("{{%user}}", "created_at", "create_time");
        $this->renameColumn("{{%user}}", "updated_at", "update_time");
        $this->renameColumn("{{%user}}", "access_token", "api_key");
        $this->renameColumn("{{%user}}", "logged_in_ip", "login_ip");
        $this->renameColumn("{{%user}}", "logged_in_at", "login_time");
        $this->renameColumn("{{%user}}", "created_ip", "create_ip");
        $this->renameColumn("{{%user}}", "banned_at", "ban_time");
        $this->renameColumn("{{%user}}", "banned_reason", "ban_reason");
        $this->addColumn("{{%user}}", "new_email", Schema::TYPE_STRING . " null after email");
    }
}