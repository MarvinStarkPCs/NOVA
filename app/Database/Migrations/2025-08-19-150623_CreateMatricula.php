<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMatricula extends Migration
{
public function up()
{
    $this->forge->addField([
        'id' => [
            'type'           => 'INT',
            'unsigned'       => true,
            'auto_increment' => true,
        ],
        'user_id' => [
            'type'     => 'BIGINT',
            'unsigned' => true,
        ],
        'jornada_id' => [
            'type'     => 'INT',
            'unsigned' => true, // 🔴 esto es fundamental
        ],
         'grupo_id' => [
            'type'     => 'INT',
            'unsigned' => true, // 🔴 esto es fundamental
        ],
          'asignatura_id' => [
            'type'     => 'INT',
            'unsigned' => true, // 🔴 esto es fundamental
        ],
        'fecha_matricula' => [
            'type' => 'DATE',
        ],
        'created_at' => ['type' => 'DATETIME', 'null' => true],
        'updated_at' => ['type' => 'DATETIME', 'null' => true],
    ]);
    $this->forge->addKey('id', true);

    $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    $this->forge->addForeignKey('jornada_id', 'jornadas', 'id', 'CASCADE', 'CASCADE');
    $this->forge->addForeignKey('grupo_id', 'grupos', 'id', 'CASCADE', 'CASCADE');

    $this->forge->createTable('matriculas');
}


    public function down()
    {
        $this->forge->dropTable('matriculas');
    }
}
