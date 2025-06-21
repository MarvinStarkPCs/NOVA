<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLecturas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'auto_increment' => true],
            'titulo'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'contenido'     => ['type' => 'TEXT'],
            'asignatura_id' => ['type' => 'INT'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('asignatura_id', 'asignaturas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('lecturas');
    }

    public function down()
    {
        $this->forge->dropTable('lecturas');
    }
}
