<?php
namespace App\Models;
use CodeIgniter\Model;

class UserManagementModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'name', '', 'login','last_name','email', 'email_verified_at',
        'password', 'remember_token',
        'created_at', 'updated_at',
        'role_id','documento','telefono','direccion','genero','fecha_nacimiento','estado'
    ];
    
    protected $returnType = 'array';
    protected $useTimestamps = true; // usa created_at y updated_at automáticamente
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Método para obtener usuarios con su rol
public function getUsers($id = null) 
{
    $builder = $this->select('*, roles.nombre AS role_name')
                    ->join('roles', 'roles.id = users.role_id', 'left');

    if ($id !== null) {
        $builder->where('users.id', $id);

        // Imprimir la consulta generada

        $data = $builder->first();
        log_message('debug', 'Resultado de la consulta: ' . print_r($data, true));
        return $data;
    }

    return $builder->findAll();
}

 public function getMatriculaByEstudiante($estudianteId)
    {
        return $this->db->table('matriculas m')
            ->select('
                m.id AS matricula_id,
                m.fecha_matricula,
                u.id AS estudiante_id,
                u.name AS estudiante,
                u.documento,
                u.email,
                u.telefono,
                u.direccion,
                u.genero,
               r.name as role,
                u.fecha_nacimiento,
                u.estado,
                gra.nombre AS grado,
                gru.nombre AS grupo,
                j.nombre AS jornada
            ')
            ->join('users u', 'm.estudiante_id = u.id')
            ->join('grupos gru', 'm.grupo_id = gru.id')
            ->join('grados gra', 'gru.grado_id = gra.id')
            ->join('jornadas j', 'm.jornada_id = j.id')
            ->join('roles r', 'u.role_id = r.id')
            ->get()
            ->getRow(); // devuelve un solo registro
    }


    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function getUserById($id)
    {
        return $this->where('id', $id)->first();
    }


public function getPruebasPorDocumento($documento)
{
    $sql = "
        SELECT 
            u.documento,
             u.id as id_estudiante,
             p.id as prueba_id,
            CONCAT(u.name, ' ', u.last_name) as estudiante,
            j.nombre as jornada,
            CONCAT(gd.nombre, ' - ', g.nombre) as curso,
            p.nombre as prueba_presentada,
            a.nombre as materia,
            CONCAT(prof.name, ' ', prof.last_name) as profesor_asignador,
            COUNT(r.id) as preguntas_respondidas,
            SUM(CASE WHEN r.respuesta_correcta = 1 THEN 1 ELSE 0 END) as respuestas_correctas,
            ROUND((SUM(CASE WHEN r.respuesta_correcta = 1 THEN 1 ELSE 0 END) / COUNT(r.id)) * 100, 2) as porcentaje,
            DATE_FORMAT(MIN(r.fecha_respuesta), '%d/%m/%Y %H:%i') as fecha_presentacion
        FROM users u
        INNER JOIN matriculas m ON u.id = m.user_id
        INNER JOIN grupos g ON m.grupo_id = g.id
        INNER JOIN grados gd ON g.grado_id = gd.id  
        INNER JOIN jornadas j ON m.jornada_id = j.id
        INNER JOIN respuestas r ON u.id = r.estudiante_id
        INNER JOIN pruebas p ON r.prueba_id = p.id
        INNER JOIN asignaturas a ON p.asignatura_id = a.id
        INNER JOIN users prof ON p.profesor_id = prof.id
        INNER JOIN prueba_grupos pg ON p.id = pg.prueba_id AND g.id = pg.grupo_id
        WHERE u.role_id = 2
          AND u.documento = ?
        GROUP BY u.documento, u.name, u.last_name,
                 j.nombre, g.nombre, gd.nombre, 
                 p.id, p.nombre, a.nombre, 
                 prof.name, prof.last_name
        ORDER BY u.last_name, u.name, p.nombre
    ";

    return $this->db->query($sql, [$documento])->getResultArray();
}

public function getPruebasPorFiltros($grupo, $jornada, $profesorId)
{
    $sql = "
        SELECT 
            u.documento,
               u.id as id_estudiante,
             p.id as prueba_id,
            CONCAT(u.name, ' ', u.last_name) as estudiante,
            j.nombre as jornada,
            CONCAT(gd.nombre, ' - ', g.nombre) as curso,
            p.nombre as prueba_presentada,
            a.nombre as materia,
            CONCAT(prof.name, ' ', prof.last_name) as profesor_asignador,
            COUNT(r.id) as preguntas_respondidas,
            SUM(CASE WHEN r.respuesta_correcta = 1 THEN 1 ELSE 0 END) as respuestas_correctas,
            ROUND((SUM(CASE WHEN r.respuesta_correcta = 1 THEN 1 ELSE 0 END) / COUNT(r.id)) * 100, 2) as porcentaje,
            DATE_FORMAT(MIN(r.fecha_respuesta), '%d/%m/%Y %H:%i') as fecha_presentacion
        FROM users u
        INNER JOIN matriculas m ON u.id = m.user_id
        INNER JOIN grupos g ON m.grupo_id = g.id
        INNER JOIN grados gd ON g.grado_id = gd.id  
        INNER JOIN jornadas j ON m.jornada_id = j.id
        INNER JOIN respuestas r ON u.id = r.estudiante_id
        INNER JOIN pruebas p ON r.prueba_id = p.id
        INNER JOIN asignaturas a ON p.asignatura_id = a.id
        INNER JOIN users prof ON p.profesor_id = prof.id
        INNER JOIN prueba_grupos pg ON p.id = pg.prueba_id AND g.id = pg.grupo_id
        WHERE u.role_id = 2
          AND j.id = ?
          AND g.id = ?
          AND prof.id = ?
        GROUP BY u.documento, u.name, u.last_name,
                 j.nombre, g.nombre, gd.nombre, 
                 p.id, p.nombre, a.nombre, 
                 prof.name, prof.last_name
        ORDER BY u.last_name, u.name, p.nombre
    ";

    return $this->db->query($sql, [$jornada, $grupo, $profesorId])->getResultArray();
}






}
