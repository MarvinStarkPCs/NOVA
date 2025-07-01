<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'login'             => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'name'              => ['type' => 'VARCHAR', 'constraint' => 255],
            'last_name'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'email'             => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'email_verified_at' => ['type' => 'DATETIME', 'null' => true],
            'password'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'remember_token'    => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'created_at'        => ['type' => 'DATETIME', 'null' => true],
            'updated_at'        => ['type' => 'DATETIME', 'null' => true],
            'role_id'           => ['type' => 'INT'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
