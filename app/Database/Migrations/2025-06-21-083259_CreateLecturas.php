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
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('lecturas');
    }

    public function down()
    {
        $this->forge->dropTable('lecturas');
    }
}
