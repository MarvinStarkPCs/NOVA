<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGruposTable extends Migration
{
    public function up()
    {
         $this->forge->addField([
            'id'     => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'nombre' => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('grupos');
    }

    public function down()
    {
        $this->forge->dropTable('grupos');
    }
}
