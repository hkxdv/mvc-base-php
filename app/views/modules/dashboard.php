<?php

/**
 * dashboard.php
 * Página principal del sistema MVC Base
 */
?>

<div class="container mx-auto py-6">
    <div class="grid gap-4 mb-4">
        <div class="w-full">
            <div class="card card-accent">
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-4" style="color: var(--accent-color);">MVC Base PHP</h1>
                    <p class="text-lg mb-6">
                        Bienvenido a la estructura base MVC desarrollada en PHP. Este es un punto de partida y no un framework completo, diseñado para que lo adaptes a tus necesidades. Esta estructura proporciona:
                    </p>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <ul class="space-y-4">
                                <li class="flex items-center space-x-3">
                                    <i class="fas fa-layer-group text-xl" style="color: var(--accent-color);"></i>
                                    <span>Arquitectura Modelo-Vista-Controlador</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <i class="fas fa-code text-xl" style="color: var(--accent-color);"></i>
                                    <span>Sistema de autoloading optimizado</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <i class="fas fa-bug text-xl" style="color: var(--accent-color);"></i>
                                    <span>Manejo centralizado de errores</span>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <ul class="space-y-4">
                                <li class="flex items-center space-x-3">
                                    <i class="fas fa-puzzle-piece text-xl" style="color: var(--accent-color);"></i>
                                    <span>Implementación modular para escalabilidad</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <i class="fas fa-link text-xl" style="color: var(--accent-color);"></i>
                                    <span>Sistema de alias para simplificar rutas</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <i class="fas fa-book text-xl" style="color: var(--accent-color);"></i>
                                    <span>Documentación completa (opcional)</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Tarjeta de Documentación -->
        <div class="card">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="rounded-full w-10 h-10 flex items-center justify-center mr-3" style="background-color: var(--accent-transparent);">
                        <i class="fas fa-book text-lg" style="color: var(--accent-color);"></i>
                    </div>
                    <h2 class="text-lg font-semibold" style="color: var(--accent-color);">Documentación</h2>
                </div>
                <p class="mb-4">
                    Consulta la documentación del sistema. Esta sección y sus componentes son opcionales y puedes eliminarlos en tus proyectos.
                </p>
                <a href="index.php?option=documentacion" class="btn-primary inline-flex items-center px-4 py-2 rounded-md transition-all duration-200">
                    <i class="fas fa-arrow-right mr-2"></i> Ver documentación
                </a>
            </div>
        </div>

        <!-- Tarjeta de Estructura -->
        <div class="card">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="rounded-full w-10 h-10 flex items-center justify-center mr-3" style="background-color: var(--accent-transparent);">
                        <i class="fas fa-sitemap text-lg" style="color: var(--accent-color);"></i>
                    </div>
                    <h2 class="text-lg font-semibold" style="color: var(--accent-color);">Estructura MVC</h2>
                </div>
                <p class="mb-4">
                    Organización de archivos según el patrón Modelo-Vista-Controlador para un código más mantenible.
                </p>
                <a href="index.php?option=documentacion&action=ver&doc=ESTRUCTURA_BASE" class="btn-primary inline-flex items-center px-4 py-2 rounded-md transition-all duration-200">
                    <i class="fas fa-arrow-right mr-2"></i> Ver estructura
                </a>
            </div>
        </div>
        
        <!-- Tarjeta de Implementación -->
        <div class="card">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="rounded-full w-10 h-10 flex items-center justify-center mr-3" style="background-color: var(--accent-transparent);">
                        <i class="fas fa-code-branch text-lg" style="color: var(--accent-color);"></i>
                    </div>
                    <h2 class="text-lg font-semibold" style="color: var(--accent-color);">Empezar a Desarrollar</h2>
                </div>
                <p class="mb-4">
                    Personaliza esta estructura base para desarrollar tu próximo proyecto. Elimina los componentes que no necesites.
                </p>
                <a href="index.php?option=documentacion&action=ver&doc=INTEGRACION_MODULOS" class="btn-primary inline-flex items-center px-4 py-2 rounded-md transition-all duration-200">
                    <i class="fas fa-arrow-right mr-2"></i> Guía de desarrollo
                </a>
            </div>
        </div>
    </div>
</div>