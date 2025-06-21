<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePreguntas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'auto_increment' => true],
            'enunciado'       => ['type' => 'TEXT'],
            'opcion_a'        => ['type' => 'TEXT'],
            'opcion_b'        => ['type' => 'TEXT'],
            'opcion_c'        => ['type' => 'TEXT'],
            'opcion_d'        => ['type' => 'TEXT'],
            'opcion_correcta' => ['type' => 'CHAR', 'constraint' => 1],
            'justificacion'   => ['type' => 'TEXT'],
            'tipo'            => ['type' => 'VARCHAR', 'constraint' => 50],
            'asignatura_id'   => ['type' => 'INT'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('asignatura_id', 'asignaturas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('preguntas');
    }

    public function down()
    {
        $this->forge->dropTable('preguntas');
    }
}
