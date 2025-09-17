<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- 
================================================================
ESTILOS CSS PARA LA VISTA DE ASIGNACIÓN DE PRUEBAS
================================================================
-->
<style>
/* 
------------------------------------------
ESTILOS GENERALES DEL CONTENEDOR
------------------------------------------
*/
.container {
    margin-top: 50px;     /* Espacio superior */
    margin-bottom: 50px;  /* Espacio inferior */
}

/* 
------------------------------------------
TÍTULO PRINCIPAL DE LA PÁGINA
------------------------------------------
*/
h2 {
    color: #7c431c;  /* Color verde institucional */
}

/* 
------------------------------------------
CÍRCULO CON ICONO EN LAS TARJETAS
------------------------------------------
*/
.icon-circle {
    background-color: #7c431c;  /* Fondo verde */
    color: white;               /* Texto blanco */
    width: 60px;                /* Ancho del círculo */
    height: 60px;               /* Alto del círculo */
    border-radius: 50%;         /* Hacer círculo perfecto */
    display: flex;              /* Usar flexbox */
    align-items: center;        /* Centrar verticalmente */
    justify-content: center;    /* Centrar horizontalmente */
    font-size: 24px;            /* Tamaño del icono */
    margin: 0 auto 15px auto;   /* Centrar y agregar margen inferior */
}

/* 
------------------------------------------
ESTILOS DE LAS TARJETAS DE PRUEBAS
------------------------------------------
*/
.card {
    border-radius: 12px;  /* Bordes redondeados */
    /* Transiciones suaves para efectos hover */
    transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
    position: relative;   /* Para posicionamiento de elementos hijos */
    overflow: hidden;     /* Ocultar contenido que se desborde */
}

/* Efecto hover en las tarjetas */
.card:hover {
    transform: translateY(-5px);           /* Levantar la tarjeta */
    box-shadow: 0 6px 16px rgba(0,0,0,0.2); /* Sombra más pronunciada */
}

/* 
------------------------------------------
ESTILOS DE BOTONES
------------------------------------------
*/
.btn-ver {
    background-color: #7c431c;  /* Fondo verde */
    color: #fff;                /* Texto blanco */
    border: none;               /* Sin bordes */
    font-weight: bold;          /* Texto en negrita */
    transition: all 0.3s ease;  /* Transición suave */
}

/* Efecto hover del botón */
.btn-ver:hover {
    background-color: #f0af84ff;  /* Verde más oscuro */
    color: #fff;                /* Mantener texto blanco */
}

/* Estado deshabilitado del botón */
.btn-ver:disabled {
    background-color: #6c757d;  /* Gris para indicar deshabilitado */
    cursor: not-allowed;        /* Cursor de "no permitido" */
}

/* 
------------------------------------------
CONTENEDORES DE SELECT Y INPUT
------------------------------------------
*/
.select-container {
    position: relative;   /* Para posicionar el icono absolutamente */
    margin-bottom: 15px;  /* Espacio inferior */
}

/* Iconos dentro de los select */
.select-container i {
    position: absolute;        /* Posicionamiento absoluto */
    top: 50%;                 /* Centrar verticalmente */
    left: 12px;               /* Posición desde la izquierda */
    transform: translateY(-50%); /* Centrar exactamente */
    color: #7c431c;           /* Color verde */
    z-index: 10;              /* Por encima del input */
}

/* Estilos para select e input */
.form-select, .form-control {
    padding-left: 35px;       /* Espacio para el icono */
    border: 2px solid #7c431c; /* Borde verde */
    border-radius: 8px;       /* Bordes redondeados */
    font-size: 16px;          /* Tamaño de fuente */
}

/* 
------------------------------------------
MENSAJES FLASH (ÉXITO/ERROR)
------------------------------------------
*/
.alert {
    font-size: 16px;    /* Tamaño de fuente */
    font-weight: bold;  /* Texto en negrita */
}

/* 
------------------------------------------
PAGINACIÓN
------------------------------------------
*/
.pagination {
    justify-content: center;  /* Centrar la paginación */
    margin-top: 20px;        /* Espacio superior */
}

/* 
------------------------------------------
ESTILOS DEL MODAL
------------------------------------------
*/
.modal-header {
    background-color: #7c431c;  /* Fondo verde en el header */
    color: white;               /* Texto blanco */
}



/* 
------------------------------------------
VISUALIZACIÓN DE FECHA LÍMITE EN LAS CARDS
------------------------------------------
*/
.fecha-limite {
    background-color: #f8f9fa;  /* Fondo gris claro */
    border: 1px solid #dee2e6;  /* Borde gris */
    border-radius: 6px;         /* Bordes redondeados */
    padding: 8px;               /* Espaciado interno */
    margin-top: 10px;           /* Espacio superior */
    font-size: 12px;            /* Fuente pequeña */
}
</style>

<!-- 
================================================================
ESTRUCTURA HTML PRINCIPAL
================================================================
-->
<div class="container">

    <!-- TÍTULO PRINCIPAL -->
    <h2 class="text-center mb-4">
        <i class="fas fa-tasks"></i> Asignar Pruebas a Grupos
    </h2>

    <!-- 
    ========================================
    MENSAJES FLASH DE ÉXITO O ERROR
    ========================================
    -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success text-center">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger text-center">
            <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- 
    ========================================
    FILTROS DE GRADO Y GRUPO
    ========================================
    -->
    <div class="row mb-4 justify-content-center">
        <!-- SELECT DE GRADO -->
        <div class="col-md-4 select-container">
            <i class="fas fa-layer-group"></i> <!-- Icono de grados -->
            <select id="grado" class="form-select">
                <option value="">Selecciona un grado...</option>
                <?php foreach ($grados as $grado): ?>
                    <option value="<?= esc($grado['id']) ?>"><?= esc($grado['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <!-- SELECT DE GRUPO (Se llena dinámicamente con AJAX) -->
        <div class="col-md-4 select-container">
            <i class="fas fa-users"></i> <!-- Icono de grupos -->
            <select id="grupo" class="form-select">
                <option value="">Seleccione un grupo...</option>
            </select>
        </div>
    </div>

    <!-- 
    ========================================
    BUSCADOR DE PRUEBAS
    ========================================
    -->
    <div class="row mb-4">
        <div class="col-md-6 offset-md-3">
            <div class="select-container">
                <i class="fas fa-search"></i> <!-- Icono de búsqueda -->
                <input type="text" id="searchPruebas" class="form-control" 
                       placeholder="Buscar prueba por nombre o asignatura...">
            </div>
        </div>
    </div>

    <!-- 
    ========================================
    GRID DE TARJETAS DE PRUEBAS
    ========================================
    -->
    <div class="row" id="contenedor-pruebas">
        <?php if(!empty($pruebas)): ?>
            <?php foreach($pruebas as $prueba): ?>
                <div class="col-md-3 col-sm-6 mb-4 prueba-item">
                    <div class="card text-center shadow-sm p-3" id="card-<?= $prueba['prueba_id'] ?>">
                        
                        <!-- ICONO DE LA PRUEBA -->
                        <div class="icon-circle">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        
                        <!-- INFORMACIÓN DE LA PRUEBA -->
                        <h5 class="card-title"><?= esc($prueba['nombre_prueba']) ?></h5>
                        <p class="card-text"><?= esc($prueba['descripcion']) ?></p>
                        <small class="text-muted">
                            <?= esc($prueba['asignatura']) ?> <br>
                            <i class="fas fa-calendar"></i> <?= esc($prueba['fecha_creacion']) ?>
                        </small>

                        <!-- MOSTRAR FECHA LÍMITE (Oculto inicialmente) -->
                        <div class="fecha-limite" id="fecha-limite-<?= $prueba['prueba_id'] ?>" style="display: none;">
                            <i class="fas fa-clock text-warning"></i>
                            <span class="fecha-texto">No establecida</span>
                        </div>

                        <!-- BOTÓN PARA ASIGNAR (Deshabilitado hasta seleccionar grupo) -->
                        <button type="button" class="btn btn-ver mt-2 btn-asignar" 
                                data-prueba-id="<?= $prueba['prueba_id'] ?>" 
                                data-prueba-nombre="<?= esc($prueba['nombre_prueba']) ?>" 
                                disabled>
                            <i class="fas fa-paper-plane"></i> Asignar
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted">No hay pruebas disponibles.</p>
        <?php endif; ?>
    </div>

    <!-- 
    ========================================
    PAGINACIÓN (Se genera dinámicamente)
    ========================================
    -->
    <div class="row">
        <div class="col-12">
            <ul class="pagination" id="pagination"></ul>
        </div>
    </div>

</div>

<!-- 
================================================================
MODAL PARA ESTABLECER FECHA LÍMITE
================================================================
-->
<div class="modal fade" id="modalFechaLimite" tabindex="-1" aria-labelledby="modalFechaLimiteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- HEADER DEL MODAL -->
            <div class="modal-header">
                <h5 class="modal-title" id="modalFechaLimiteLabel">
                    <i class="fas fa-calendar-plus"></i> Asignar Prueba con Fecha Límite
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- FORMULARIO PRINCIPAL -->
            <form id="formAsignarPrueba" method="POST" action="<?= base_url('profesor/asignar_prueba') ?>">
                <div class="modal-body">
                    
                    <!-- INFORMACIÓN DE LA PRUEBA Y GRUPO -->
                    <div class="mb-3">
                        <h6 id="nombrePrueba" class="text-primary"></h6>
                        <p id="infoGrupo" class="text-muted"></p>
                    </div>
                    
                    <!-- CAMPO PARA FECHA LÍMITE -->
                    <div class="mb-3">
                        <label for="fechaLimite" class="form-label">
                            <i class="fas fa-calendar-alt"></i> Fecha límite para completar la prueba:
                        </label>
                        <input type="datetime-local" class="form-control" id="fechaLimite" name="fecha_limite" required>
                        <small class="form-text text-muted">
                            Los estudiantes podrán realizar la prueba hasta esta fecha y hora.
                        </small>
                    </div>

                    <!-- CAMPOS OCULTOS PARA EL FORMULARIO -->
                    <input type="hidden" name="prueba_id" id="pruebaId">
                    <input type="hidden" name="grupo_id" id="grupoId">
                </div>
                
                <!-- BOTONES DEL MODAL -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Asignar Prueba
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 
================================================================
JAVASCRIPT PRINCIPAL - FUNCIONALIDAD COMPLETA
================================================================
-->
<script>
$(document).ready(function() {

    // ============================================================
    // VARIABLES GLOBALES
    // ============================================================
    const itemsPerPage = 8;     // Número de pruebas por página
    let currentPage = 1;        // Página actual
    let fechasLimite = {};      // Almacén temporal de fechas límite por prueba

    // ============================================================
    // SISTEMA DE PAGINACIÓN
    // ============================================================
    
    /**
     * Muestra una página específica de pruebas
     * @param {number} page - Número de página a mostrar
     */
    function showPage(page) {
        currentPage = page;
        
        // Obtener todos los elementos visibles (después de filtros)
        const allItems = $('.prueba-item:visible');
        
        // Ocultar todos los elementos
        allItems.hide();
        
        // Mostrar solo los elementos de la página actual
        // Cálculo: (página-1) * elementos_por_página hasta página * elementos_por_página
        allItems.slice((page - 1) * itemsPerPage, page * itemsPerPage).fadeIn();
        
        // Actualizar los controles de paginación
        createPagination();
    }

    /**
     * Crea los controles de paginación dinámicamente
     */
    function createPagination() {
        const visibleItems = $('.prueba-item:visible');
        const totalPages = Math.ceil(visibleItems.length / itemsPerPage);
        
        // Limpiar paginación existente
        $('#pagination').empty();

        // Si solo hay una página o menos, no mostrar paginación
        if (totalPages <= 1) return;

        // Crear botones de paginación
        for (let i = 1; i <= totalPages; i++) {
            $('#pagination').append(
                `<li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#">${i}</a>
                </li>`
            );
        }
    }

    // ============================================================
    // INICIALIZACIÓN Y EVENTOS DE PAGINACIÓN
    // ============================================================
    
    // Mostrar la primera página al cargar
    showPage(1);

    // Manejar clicks en los botones de paginación
    $('#pagination').on('click', '.page-link', function(e) {
        e.preventDefault(); // Evitar navegación
        const page = parseInt($(this).text()); // Obtener número de página
        showPage(page); // Mostrar la página seleccionada
    });

    // ============================================================
    // FUNCIONALIDAD DE BÚSQUEDA
    // ============================================================
    
    /**
     * Filtrar pruebas según el texto de búsqueda
     */
    $('#searchPruebas').on('keyup', function() {
        const value = $(this).val().toLowerCase(); // Convertir a minúsculas

        // Revisar cada tarjeta de prueba
        $('.prueba-item').each(function() {
            const text = $(this).text().toLowerCase(); // Texto completo de la tarjeta
            // Mostrar/ocultar según si contiene el texto buscado
            $(this).toggle(text.includes(value));
        });

        // Reiniciar a la página 1 después de filtrar
        showPage(1);
    });

    // ============================================================
    // CARGA DINÁMICA DE GRUPOS POR GRADO
    // ============================================================
    
    /**
     * Cargar grupos disponibles según el grado seleccionado
     * @param {string} gradoId - ID del grado seleccionado
     */
    function cargarGruposPorGrado(gradoId) {
        const grupoSelect = $('#grupo');
        
        // Mostrar estado de carga
        grupoSelect.empty().append('<option value="">Cargando...</option>');

        // Validar que se haya seleccionado un grado
        if (!gradoId || gradoId.trim() === '') {
            grupoSelect.html('<option value="">Selecciona un grado</option>');
            return;
        }

        // Petición AJAX para obtener grupos del grado
        $.ajax({
            url: "<?= base_url('profesor/usermanagement/showComboBox') ?>",
            type: "POST",
            data: {
                tabla: 'grupos',        // Tabla de la BD
                campo: 'grado_id',      // Campo de filtro
                id: gradoId,            // Valor del filtro
                <?= csrf_token() ?>: "<?= csrf_hash() ?>" // Token CSRF para seguridad
            },
            dataType: "json",
            success: function(data) {
                // Limpiar y agregar opción por defecto
                grupoSelect.empty().append('<option value="">Selecciona...</option>');
                
                if (data.length) {
                    // Agregar cada grupo como opción
                    data.forEach(grupo => {
                        grupoSelect.append(new Option(grupo.nombre, grupo.id));
                    });
                } else {
                    // No hay grupos disponibles
                    grupoSelect.append('<option value="">No hay grupos</option>');
                }
            },
            error: function() {
                // Error en la petición
                grupoSelect.html('<option value="">Error al cargar grupos</option>');
            }
        });
    }

    // ============================================================
    // EVENTOS DE LOS SELECT DE GRADO Y GRUPO
    // ============================================================
    
    // Cuando cambia la selección de grado
    $('#grado').on('change', function() {
        cargarGruposPorGrado($(this).val());
        
        // Limpiar fechas límite almacenadas al cambiar grado
        fechasLimite = {};
        $('.fecha-limite').hide().find('.fecha-texto').text('No establecida');
    });

    // Cuando cambia la selección de grupo
    $('#grupo').on('change', function() {
        const grupoId = $(this).val();
        
        // Habilitar/deshabilitar botones de asignación según si hay grupo seleccionado
        $('.btn-asignar').prop('disabled', !grupoId);
    });

    // ============================================================
    // MANEJO DEL MODAL DE FECHA LÍMITE
    // ============================================================
    
    /**
     * Manejar click en botón "Asignar" de cada prueba
     */
    $('.btn-asignar').on('click', function() {
        // Obtener valores actuales de los select
        const grado = $('#grado').val();
        const grupo = $('#grupo').val();
        const gradoTexto = $('#grado option:selected').text();
        const grupoTexto = $('#grupo option:selected').text();

        // VALIDACIÓN: Debe haber un grado seleccionado
        if (!grado) {
            Swal.fire({
                icon: 'warning',
                title: 'Seleccione un grado',
                text: 'Debe seleccionar un grado antes de asignar la prueba.',
                confirmButtonColor: '#7c431c'
            });
            return;
        }

        // VALIDACIÓN: Debe haber un grupo seleccionado
        if (!grupo) {
            Swal.fire({
                icon: 'warning',
                title: 'Seleccione un grupo',
                text: 'Debe seleccionar un grupo antes de asignar la prueba.',
                confirmButtonColor: '#7c431c'
            });
            return;
        }

        // Obtener información de la prueba desde los data attributes
        const pruebaId = $(this).data('prueba-id');
        const pruebaNombre = $(this).data('prueba-nombre');

        // Llenar información en el modal
        $('#nombrePrueba').text(pruebaNombre);
        $('#infoGrupo').text(`Grupo: ${gradoTexto} - ${grupoTexto}`);
        $('#pruebaId').val(pruebaId);
        $('#grupoId').val(grupo);

        // ====================================
        // CONFIGURACIÓN DE FECHA LÍMITE
        // ====================================
        
        // Establecer fecha mínima (1 hora desde ahora para dar tiempo)
        const now = new Date();
        now.setHours(now.getHours() + 1);
        const minDateTime = now.toISOString().slice(0, 16); // Formato YYYY-MM-DDTHH:MM
        $('#fechaLimite').attr('min', minDateTime);

        // Si ya se estableció una fecha para esta prueba, cargarla
        if (fechasLimite[pruebaId]) {
            $('#fechaLimite').val(fechasLimite[pruebaId]);
        } else {
            // Establecer fecha por defecto (7 días desde ahora)
            const defaultDate = new Date();
            defaultDate.setDate(defaultDate.getDate() + 7);
            defaultDate.setHours(23, 59); // Hasta las 11:59 PM del día 7
            $('#fechaLimite').val(defaultDate.toISOString().slice(0, 16));
        }

        // Mostrar el modal
        $('#modalFechaLimite').modal('show');
    });

    // ============================================================
    // ENVÍO DEL FORMULARIO DE ASIGNACIÓN
    // ============================================================
    
    /**
     * Manejar envío del formulario con validaciones
     */
    $('#formAsignarPrueba').on('submit', function(e) {
        e.preventDefault(); // Prevenir envío automático para validar primero
        
        
        // Obtener valores del formulario
        const fechaLimite = $('#fechaLimite').val();
        const pruebaId = $('#pruebaId').val();
console.log(fechaLimite);  

        // VALIDACIÓN: Fecha límite es requerida
        if (!fechaLimite) {
            Swal.fire({
                icon: 'warning',
                title: 'Fecha límite requerida',
                text: 'Debe establecer una fecha límite para la prueba.',
                confirmButtonColor: '#7c431c'
            });
            return false;
        }

        // VALIDACIÓN: La fecha debe ser futura
        const fechaSeleccionada = new Date(fechaLimite);
        const ahora = new Date();
        
        if (fechaSeleccionada <= ahora) {
            Swal.fire({
                icon: 'warning',
                title: 'Fecha inválida',
                text: 'La fecha límite debe ser posterior a la fecha actual.',
                confirmButtonColor: '#7c431c'
            });
            return false;
        }

        // ====================================
        // CONFIRMACIÓN ANTES DE ENVIAR
        // ====================================
        
        Swal.fire({
            title: '¿Confirmar asignación?',
            text: `Se asignará la prueba con fecha límite: ${fechaSeleccionada.toLocaleString('es-ES')}`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#7c431c',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, asignar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                
                // Guardar la fecha límite temporalmente (para mostrar en la tarjeta)
                fechasLimite[pruebaId] = fechaLimite;
                
                // Mostrar la fecha límite en la tarjeta correspondiente
                const fechaFormateada = fechaSeleccionada.toLocaleString('es-ES');
                $(`#fecha-limite-${pruebaId}`).show().find('.fecha-texto').text(`Hasta: ${fechaFormateada}`);
                
                // Cerrar el modal
                $('#modalFechaLimite').modal('hide');
                
                // Mostrar mensaje de carga mientras se procesa
                Swal.fire({
                    title: 'Asignando prueba...',
                    text: 'Por favor espere',
                    allowOutsideClick: false,    // No permitir cerrar haciendo click fuera
                    allowEscapeKey: false,       // No permitir cerrar con ESC
                    showConfirmButton: false,    // No mostrar botón de confirmación
                    willOpen: () => {
                        Swal.showLoading();      // Mostrar spinner de carga
                    }
                });
                
                // Enviar formulario después de un breve delay (mejor UX)
                    // Enviar formulario de forma tradicional (no AJAX)
                    // Esto permitirá que el controlador maneje la redirección normalmente
                    $('#formAsignarPrueba')[0].submit();
            }
        });
    });

    // ============================================================
    // LIMPIEZA DEL MODAL AL CERRARSE
    // ============================================================
    
    /**
     * Limpiar campos del modal cuando se cierre
     */
    $('#modalFechaLimite').on('hidden.bs.modal', function() {
        $('#fechaLimite').val(''); // Limpiar fecha
        // Nota: Los campos ocultos se mantienen hasta la próxima apertura
    });

});
</script>

<?= $this->endSection() ?>