<?php

/**
 * listado.php
 * Vista para mostrar el listado de documentación disponible
 * 
 * NOTA: Esta vista es parte de la sección OPCIONAL de documentación
 * y puede ser eliminada en tus proyectos si no la necesitas.
 */
?>


<section class="min-h-screen flex flex-col">
    <main class="container mx-auto py-8 px-4 flex-grow">
        <div class="flex flex-col justify-center items-center">
            <div class="card text-center p-10 max-w-4xl w-full">
                <div class="relative mb-6">
                    <h1 class="text-3xl font-bold relative z-10" style="color: var(--text-primary); opacity: 0.9;">Documentación de la Estructura Base</h1>
                    <div class="absolute -top-5 -left-5 w-full h-full flex justify-center items-center">
                        <div class="text-4xl font-bold" style="color: var(--accent-color); opacity: 0.1;">Documentación</div>
                    </div>
                </div>

                <p class="text-xl mb-8" style="color: var(--text-secondary);">
                    Consulta la documentación de la estructura base MVC. Esta sección es opcional y puede ser eliminada en tus proyectos.
                </p>

                <div class="grid gap-4">
                    <?php if (empty($archivos)): ?>
                        <div class="card p-6 text-center">
                            <p style="color: var(--warning-color);">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                No se encontraron documentos disponibles.
                            </p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($archivos as $archivo): ?>
                            <div class="card p-6 text-left card-accent">
                                <h2 class="text-xl font-semibold mb-2" style="color: var(--accent-color);"><?php echo htmlspecialchars(str_replace('_', ' ', $archivo['nombre'])); ?></h2>
                                <p class="mb-4" style="color: var(--text-secondary);"><?php echo htmlspecialchars($archivo['descripcion']); ?></p>
                                <a href="index.php?option=documentacion&action=ver&doc=<?php echo urlencode($archivo['nombre']); ?>"
                                    class="btn-primary inline-flex items-center px-4 py-2 rounded-md transition-all duration-200 transform hover:scale-105">
                                    <i class="fas fa-book mr-2"></i> Leer documento
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</section>
<style>
    section {
        background: radial-gradient(circle at center, var(--bg-secondary), var(--bg-primary));
    }
</style>