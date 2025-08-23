<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jornadas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'     => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'nombre' => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('jornadas');
    }

    public function down()
    {
        $this->forge->dropTable('jornadas');
    }
}
