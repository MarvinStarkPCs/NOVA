<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLecturasPreguntas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'lectura_id'  => ['type' => 'INT'],
            'pregunta_id' => ['type' => 'INT'],
        ]);
        $this->forge->addKey(['lectura_id', 'pregunta_id'], true);
        $this->forge->addForeignKey('lectura_id', 'lecturas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pregunta_id', 'preguntas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('lecturas_preguntas');
    }

    public function down()
    {
        $this->forge->dropTable('lecturas_preguntas');
    }
}
