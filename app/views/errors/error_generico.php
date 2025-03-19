<div class="flex flex-col justify-center items-center">
    <div class="card text-center p-10 max-w-lg">
        <div class="relative mb-6">
            <h1 class="text-9xl font-bold relative z-10" style="color: var(--text-primary); opacity: 0.9;"><?php echo isset($data['codigo']) ? $data['codigo'] : 'Error'; ?></h1>
            <div class="absolute -top-10 -left-10 w-full h-full flex justify-center items-center">
                <div class="text-9xl font-bold" style="color: var(--accent-color); opacity: 0.1;"><?php echo isset($data['codigo']) ? $data['codigo'] : 'Error'; ?></div>
            </div>
        </div>
        <h2 class="text-3xl font-semibold mb-4" style="color: var(--accent-color);"><?php echo isset($data['titulo']) ? $data['titulo'] : 'Error del Sistema'; ?></h2>
        <p class="text-xl mb-8" style="color: var(--text-secondary);"><?php echo isset($data['mensaje']) ? $data['mensaje'] : 'Se ha producido un error inesperado.'; ?></p>
        <div class="flex flex-col md:flex-row justify-center gap-4">
            <a href="index.php" class="btn-primary inline-flex items-center px-6 py-3 rounded-lg transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-home mr-2"></i> Volver al inicio
            </a>
            <button onclick="window.location.reload()" class="btn-secondary inline-flex items-center px-6 py-3 rounded-lg transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-sync-alt mr-2"></i> Reintentar
            </button>
        </div>
        <?php if (isset($_ENV['APP_DEBUG']) && $_ENV['APP_DEBUG'] === 'true'): ?>
        <div class="mt-8 p-4 rounded-lg text-left" style="background-color: var(--bg-tertiary); border: 1px solid var(--border-color);">
            <h3 class="text-lg font-medium mb-2" style="color: var(--danger-color);">Detalles del error:</h3>
            <pre class="text-sm overflow-auto max-h-40 p-2" style="color: var(--text-secondary); background-color: var(--bg-primary); border-radius: 4px;">
<?php echo isset($data['mensaje_detallado']) ? htmlspecialchars($data['mensaje_detallado']) : htmlspecialchars($data['mensaje']); ?>
            </pre>
        </div>
        <?php endif; ?>
    </div>
</div>