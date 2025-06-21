<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRespuestas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'auto_increment' => true],
            'user_id'          => ['type' => 'BIGINT', 'unsigned' => true],
            'pregunta_id'      => ['type' => 'INT'],
            'opcion_elegida'   => ['type' => 'CHAR', 'constraint' => 1],
            'respuesta_correcta' => ['type' => 'BOOLEAN', 'null' => true],
'fecha_respuesta' => [
    'type'    => 'DATETIME',
    'null'    => false,
],
            
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pregunta_id', 'preguntas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('respuestas');
    }

    public function down()
    {
        $this->forge->dropTable('respuestas');
    }
}
