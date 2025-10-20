<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-center align-items-center" 
     style="height: 80vh; background: #f8f9fa;"> 

  <div class="text-center p-5 rounded-3 shadow-lg" 
       style="background: #ffffff; 
              max-width: 420px; 
              color: #B3C69B; 
              border: 1px solid rgba(127, 76, 175, 0.1);
              box-shadow: 0 8px 32px rgba(127, 76, 175, 0.1);
              transition: transform 0.4s ease, box-shadow 0.4s ease;">
    
    <!-- Título -->
    <h1 class="display-6 mb-3" 
        style="font-weight: 700;">
      Bienvenido, Administrador
    </h1>
    
    <!-- Subtítulo -->
    <p class="lead mb-4" 
       style="font-size: 1rem; letter-spacing: 0.5px; color:#444;">
      Gestiona tu plataforma de manera rápida y segura.
    </p>

    <!-- Mensaje dinámico -->
    <div id="mensaje" 
         style="background: #e8f5e9; 
                padding: 8px 15px; 
                border-radius: 20px; 
                margin-bottom: 20px; 
                font-weight: 500;
                color: #B3C69B;
                transition: all 0.5s ease;">
      ✅ Sistema funcionando correctamente
    </div>
    
    <!-- Botón -->

    
  </div>
</div>

<script>
  // Cambia mensajes dinámicamente
  const mensajes = [
    "✅ Sistema funcionando correctamente",
    "🔒 Seguridad activada y estable",
    "🖥️ Todos los módulos cargados",
    "📊 Panel actualizado"
  ];

  let index = 0;
  setInterval(() => {
    document.getElementById('mensaje').textContent = mensajes[index];
    index = (index + 1) % mensajes.length;
  }, 4000); // cambia cada 4 segundos
</script>


<?= $this->endSection() ?>
