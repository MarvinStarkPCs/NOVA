<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGrupoIdToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'grupo_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
                'after'    => 'role_id',
            ],'grado_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
                'after'    => 'grupo_id',
            ],
        ]);

        $this->db->query('ALTER TABLE users ADD CONSTRAINT fk_users_grupo_id FOREIGN KEY (grupo_id) REFERENCES grupos(id) ON DELETE SET NULL');
        $this->db->query('ALTER TABLE users ADD CONSTRAINT fk_users_grado_id FOREIGN KEY (grado_id) REFERENCES grados(id) ON DELETE SET NULL');
    }

    public function down()
    {
        $this->db->query('ALTER TABLE users DROP FOREIGN KEY fk_users_grupo_id');
        $this->forge->dropColumn('users', 'grupo_id');
    }
}
