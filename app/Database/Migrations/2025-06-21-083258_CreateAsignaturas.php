<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAsignaturas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'     => ['type' => 'INT', 'auto_increment' => true],
            'nombre' => ['type' => 'VARCHAR', 'constraint' => 100],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('asignaturas');
    }

    public function down()
    {
        $this->forge->dropTable('asignaturas');
    }
}
