<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateConfigurationTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_config' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'config_key' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
                'unique'     => true,
            ],
            'config_value' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_config', true); // Clave primaria
        $this->forge->createTable('configuration');
    }

    public function down()
    {
        $this->forge->dropTable('configuration');
    }
}
