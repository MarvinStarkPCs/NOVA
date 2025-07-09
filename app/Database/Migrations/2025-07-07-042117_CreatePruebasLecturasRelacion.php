<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePruebasLecturasRelacion extends Migration
{
    public function up()
    {
        // Tabla pruebas
        $this->forge->addField([
            'id'              => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'asignatura_id'   => [
                'type'     => 'INT',
            ],
            'user_id'         => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],
            'nombre'          => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'descripcion'     => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('asignatura_id', 'asignaturas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pruebas');

        // Agregar prueba_id a lecturas
        $fieldsLecturas = [
            'prueba_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => false,
            ],
        ];
        $this->forge->addColumn('lecturas', $fieldsLecturas);
        $this->forge->addForeignKey('prueba_id', 'pruebas', 'id', 'CASCADE', 'CASCADE');

        // Agregar prueba_id a preguntas
        $fieldsPreguntas = [
            'prueba_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
                'after'    => 'asignatura_id',
            ],
        ];
        $this->forge->addColumn('preguntas', $fieldsPreguntas);
        $this->forge->addForeignKey('prueba_id', 'pruebas', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropForeignKey('preguntas', 'preguntas_prueba_id_foreign');
        $this->forge->dropColumn('preguntas', 'prueba_id');

        $this->forge->dropForeignKey('lecturas', 'lecturas_prueba_id_foreign');
        $this->forge->dropColumn('lecturas', 'prueba_id');

        $this->forge->dropTable('pruebas');
    }
}
