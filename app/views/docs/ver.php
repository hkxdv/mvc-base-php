<?php

/**
 * ver.php
 * Vista para mostrar el contenido de un documento específico
 * 
 * NOTA: Esta vista es parte de la sección OPCIONAL de documentación
 * y puede ser eliminada en tus proyectos si no la necesitas.
 */

?>

<section class="min-h-screen flex flex-col">
    <main class="container mx-auto py-8 px-4 flex-grow">
        <div class="flex flex-col justify-center items-center">
            <div class="card p-10 max-w-4xl w-full">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold" style="color: var(--accent-color);">
                        <?php echo htmlspecialchars(str_replace('_', ' ', $documento)); ?>
                    </h1>
                    <a href="index.php?option=documentacion" class="btn-secondary inline-flex items-center px-4 py-2 rounded-md transition-all duration-200 transform hover:scale-105">
                        <i class="fas fa-arrow-left mr-2"></i> Volver
                    </a>
                </div>

                <div class="documentation-content" style="color: var(--text-primary);">
                    <?php echo $contenido_html; ?>
                </div>
            </div>
        </div>
    </main>
</section>

<style>
    section {
        background: radial-gradient(circle at center, var(--bg-secondary), var(--bg-primary));
    }

    /* Estilos específicos para la documentación generada por Parsedown */
    .documentation-content h1 {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 1rem;
        color: var(--accent-color);
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 0.5rem;
    }

    .documentation-content h2 {
        font-size: 1.75rem;
        font-weight: bold;
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: var(--text-primary);
    }

    .documentation-content h3 {
        font-size: 1.5rem;
        font-weight: bold;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        color: var(--text-primary);
    }

    .documentation-content h4 {
        font-size: 1.25rem;
        font-weight: bold;
        margin-top: 1.25rem;
        margin-bottom: 0.5rem;
        color: var(--text-primary);
    }

    .documentation-content p {
        margin-bottom: 1rem;
        line-height: 1.6;
    }

    .documentation-content ul {
        list-style-type: disc;
        margin-left: 2rem;
        margin-bottom: 1rem;
    }

    .documentation-content ol {
        list-style-type: decimal;
        margin-left: 2rem;
        margin-bottom: 1rem;
    }

    .documentation-content li {
        margin-bottom: 0.5rem;
    }

    .documentation-content pre {
        background-color: var(--bg-tertiary);
        padding: 1rem;
        border-radius: 0.375rem;
        overflow-x: auto;
        margin-bottom: 1rem;
        border: 1px solid var(--border-color);
    }

    .documentation-content code {
        font-family: monospace;
        color: var(--text-primary);
    }

    .documentation-content a {
        color: var(--accent-color);
        text-decoration: underline;
    }

    .documentation-content a:hover {
        color: var(--accent-hover);
    }

    .documentation-content table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1rem;
        overflow-x: auto;
        display: block;
    }

    .documentation-content th,
    .documentation-content td {
        padding: 0.5rem;
        border: 1px solid var(--border-color);
    }

    .documentation-content th {
        background-color: var(--bg-tertiary);
        font-weight: bold;
    }

    /* Mejoras para el código generado por Parsedown */
    .documentation-content pre code {
        display: block;
        padding: 0.5rem;
        white-space: pre;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .documentation-content blockquote {
        border-left: 4px solid var(--accent-color);
        padding-left: 1rem;
        margin-left: 1rem;
        margin-bottom: 1rem;
        color: var(--text-secondary);
    }

    /* Estilos para diferenciar cajas de alerta en Markdown */
    .documentation-content blockquote:has(p strong:first-child) {
        background-color: var(--bg-tertiary);
        border-left-width: 6px;
        padding: 1rem;
        border-radius: 0.375rem;
    }
</style>